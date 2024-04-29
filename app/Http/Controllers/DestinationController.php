<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index() {
        $items = Destination::all();

        return view('Destination', [
            'items' -> $items
        ]);

    }
}
