<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recommendation;

class RecommendationController extends Controller
{
    public function index()
    {
        $recommendations = Recommendation::all();
        return view('recommendations.index', compact('recommendations'));
    }

    public function create()
    {
        return view('recommendations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'destination' => 'required',
            'description' => 'required',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $recommendation = new Recommendation([
            'destination' => $request->get('destination'),
            'description' => $request->get('description'),
            'category' => $request->get('category'),
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension(); // Mengambil ekstensi gambar dengan benar
            $image->move(public_path('images'), $imageName);
            $recommendation->image = $imageName;
        }

        $recommendation->save();

        return redirect('/recommendations')->with('success', 'Rekomendasi perjalanan berhasil disimpan.');
    }

    public function show($id)
    {
        $recommendation = Recommendation::find($id);

        if (!$recommendation) {
            return redirect('/recommendations')->with('error', 'Rekomendasi perjalanan tidak ditemukan.');
        }

        return view('recommendations.show', compact('recommendation'));
    }

    public function edit($id)
    {
        $recommendation = Recommendation::find($id);

        if (!$recommendation) {
            return redirect('/recommendations')->with('error', 'Rekomendasi perjalanan tidak ditemukan.');
        }

        return view('recommendations.edit', compact('recommendation'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'destination' => 'required',
            'description' => 'required',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $recommendation = Recommendation::find($id);

        if (!$recommendation) {
            return redirect('/recommendations')->with('error', 'Rekomendasi perjalanan tidak ditemukan.');
        }

        $recommendation->destination = $request->get('destination');
        $recommendation->description = $request->get('description');
        $recommendation->category = $request->get('category');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $recommendation->image = $imageName;
        }

        $recommendation->save();

        return redirect('/recommendations')->with('success', 'Rekomendasi perjalanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $recommendation = Recommendation::find($id);

        if (!$recommendation) {
            return redirect('/recommendations')->with('error', 'Rekomendasi perjalanan tidak ditemukan.');
        }

        $recommendation->delete();

        return redirect('/recommendations')->with('success', 'Rekomendasi perjalanan berhasil dihapus.');
    }
}
