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
//        $request->session()->flash('success',   'testing success the flash message');
//        $request->session()->flash('warning',   'testing warning the flash message');
//        $request->session()->flash('error',     'testing   error the flash message');
        return view('home');
    }
}
