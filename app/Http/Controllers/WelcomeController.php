<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        Cache::flush();

        return view('welcome');
    }
}
