<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Place extends Model
{
    public static function getAllPlaces()
    {
        $json = File::get(database_path('wisata.json'));
        return json_decode($json, true);
    }
}