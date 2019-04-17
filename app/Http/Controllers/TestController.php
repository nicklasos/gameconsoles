<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    public function index()
    {
    }

    public function imgPng()
    {
        // sleep(1);
        return file_get_contents(public_path('img/bowser-2.png'));
    }

    public function imgJpg()
    {
        sleep(1);
        return file_get_contents(public_path('img/bowser-1.jpg'));
    }
}
