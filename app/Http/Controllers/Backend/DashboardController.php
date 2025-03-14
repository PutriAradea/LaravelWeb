<?php 

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 

class DashboardController extends Controller
{
    // Contoh method
    public function index()
    {
        return view('backend.dashboard');
    }
}