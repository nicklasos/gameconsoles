<?php

namespace App\Http\Controllers;

use App\Company;

class TestController extends Controller
{
    public function index()
    {
        dd(env('APP_ENV'));
    }
}
