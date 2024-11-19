<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index() {
        $plans = Plan::all()->groupBy('term');
        return view('membership.index', compact('plans'));
    }

}
