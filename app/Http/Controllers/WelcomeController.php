<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

use function Laravel\Prompts\alert;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        Cache::flush();
        return view('welcome');
    }
}