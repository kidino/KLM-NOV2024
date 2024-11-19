<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index() {

        $plans = Plan::all()->groupBy('term');

        // dd($plans);

        return view('homepage.index2', compact('plans'));
    }

    public function pricing() {
        return view('homepage.pricing');
    }

}
