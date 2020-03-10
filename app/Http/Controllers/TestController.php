<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    public function index()
    {
        $c = \App\Console::find(4);

        dd($c->children->toArray());
    }
}
