<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{

    public function index()
    {
        return view('form');
    }

    public function getStatus()
    {
        system("uptime");
    }
}
