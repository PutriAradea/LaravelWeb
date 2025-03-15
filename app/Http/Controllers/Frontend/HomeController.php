<?php

namespace App\Http\Controllers\Frontend;

use app\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home'); // Sesuaikan dengan nama view Anda
    }
}
