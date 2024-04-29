<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
   public function index()
   {

    if (Auth::id())
    {
        $usertype=Auth()->user()->usertype;

        if($usertype=='user')
        {
            return view('home.homepage');
        }

        else if($usertype=='admin')
        {
            return view('admin.adminhome');
        }

        else 
        {
            return redirect()->back();
        }
    }
   }

   public function homepage()
    {
        return view('home.homepage');
    }
   
    public function create_traveljourney()
    {
        return view('home.create_traveljourney');
    }
   
}
