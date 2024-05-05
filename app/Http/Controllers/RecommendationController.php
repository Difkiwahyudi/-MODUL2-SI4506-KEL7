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
        $validatedData = $request->validate([
            'destination' => 'required',
            'description' => 'required',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $recommendation = new Recommendation($validatedData);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $recommendation->image = $imageName;
        }

        $recommendation->save();

        return redirect('/recommendations')->with('success', 'Rekomendasi perjalanan berhasil disimpan.');
    }

    // Metode lainnya tetap sama
}