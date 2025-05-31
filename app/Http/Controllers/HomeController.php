<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        // Redirect based on user role
        if ($user->hasRole('Admin')) {
            return redirect()->route('dashboard');
        } elseif ($user->hasRole('Lab Manager')) {
            return view('home', ['message' => 'Welcome, Lab Manager!']);
        } elseif ($user->hasRole('Chemist Supervisor')) {
            return view('home', ['message' => 'Welcome, Chemist Supervisor!']);
        } elseif ($user->hasRole('Lab Technician')) {
            return view('home', ['message' => 'Welcome, Lab Technician!']);
        } else {
            return view('home', ['message' => 'Welcome!']);
        }
    }
}
