<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    //
    public function index()
{
    $places = Place::getAllPlaces();
    // dd($places);
    return view('places.index', compact('places'));
}

public function apiSearch(Request $request)
{
    $query = $request->input('search');
    $allPlaces = Place::getAllPlaces(); // Asumsikan ini sekarang mengambil data dari wisata.json

    // Mengubah array menjadi koleksi untuk memudahkan pencarian
    $placesCollection = collect($allPlaces['provinsi']);

    $filteredPlaces = $placesCollection->flatMap(function ($provinsi) use ($query) {
        return collect($provinsi['wisata'])->filter(function ($place) use ($query) {
            return false !== stripos($place['namaa'], $query);
        });
    })->values();

    // Simpan inputan pencarian ke dalam session history pencarian
    $this->saveToSearchHistory($request, $query);
    // Simpan hasil pencarian ke dalam session
$request->session()->put('search_result', $filteredPlaces);
    // return response()->json($filteredPlaces);
    return redirect()->route('output');
}

private function saveToSearchHistory($request, $query)
{
    // Cek apakah 'search_history' sudah ada di session
    if ($request->session()->has('search_history')) {
        // Ambil 'search_history', tambahkan $query, dan simpan kembali
        $search_history = $request->session()->get('search_history');
        $search_history[] = $query; // Tambahkan $query ke array
        $request->session()->put('search_history', $search_history); // Simpan kembali
    } else {
        // Jika 'search_history' belum ada, buat baru dengan $query sebagai elemen pertama
        $request->session()->put('search_history', [$query]);
    }
}

public function removeHistory(Request $request)
    {
        // Validasi request
        $request->validate([
            'history' => 'string',
        ]);
        // dd($request->all()); // Cek semua data request


        // Mendapatkan history pencarian yang ingin dihapus
        $historyItem = $request->input('history');

        // Cek apakah 'search_history' sudah ada di session
        if ($request->session()->has('search_history')) {
            // Ambil 'search_history'
            $searchHistory = $request->session()->get('search_history');

            // Cari indeks dari historyItem dalam array searchHistory
            $key = array_search($historyItem, $searchHistory);

            // Hapus elemen jika indeks ditemukan
            if ($key !== false) {
                unset($searchHistory[$key]);

                // Simpan kembali ke session
                $request->session()->put('search_history', $searchHistory);
            }
        }

        // Redirect kembali ke halaman sebelumnya
        return redirect()->back();
    }

}
