<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class AboutController extends Controller
{
    public function index()
    {
        return view('about');
    }
}