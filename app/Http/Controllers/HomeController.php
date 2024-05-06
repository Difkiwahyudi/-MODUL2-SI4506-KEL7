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
   
<<<<<<< HEAD
    ##Travel journey create
    public function create_traveljourney()
    {
        return view('home.create_traveljourney');

    }
}
=======
    public function create_traveljourney()
    {
        return view('home.create_traveljourney');
    }
   
}
>>>>>>> 938c2da411919d0d133a770f072b255a271235bd
