<?php

namespace App\Http\Controllers;

use App\Console;

class MainPageController extends Controller
{
    public function index()
    {
        $consoles = Console::with('company')
            ->orderByDesc('released_at')
            ->get();

        return view('main', compact('consoles'));
    }
}
