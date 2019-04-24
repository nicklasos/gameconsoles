<?php

namespace App\Http\Controllers;

use App\Company;

class TestController extends Controller
{
    public function index()
    {
        $company = Company::find(1);

        // $company
        //     ->addMedia(base_path('stuff/sony-logo.jpg'))
        //     ->toMediaCollection('images');

        dd($company->getMedia('images')[0]->getUrl());
    }
}
