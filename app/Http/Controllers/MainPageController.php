<?php

namespace App\Http\Controllers;

use App\Company;

class MainPageController extends Controller
{
    public function index()
    {
        return view('main', [
            'company' => Company::find(6),
        ]);
    }
}
