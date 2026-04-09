<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnboardingController extends Controller
{
    public function index()
    {
        if (session('onboarded')) {
            return redirect()->route('dashboard');
        }
        return view('onboarding');
    }

    public function store(Request $request)
    {
        session(['onboarded' => true]);
        return redirect()->route('dashboard');
    }
}
