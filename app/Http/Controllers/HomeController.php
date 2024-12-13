<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
      
        if (auth()->check()) {
            $getId = auth()->id();
            $Wallet = Wallet::where('user_id', $getId)->firstOrFail();
            return view('index', ['wallet' => $Wallet]);
        } else {
            $wallet = 0;
            // Redirect to login page if not authenticated
            return view('index', ['wallet' => $wallet]);  // Or any other page you want
        }

    }
    public function about(){
        return view('aboutUs');
    }

}
