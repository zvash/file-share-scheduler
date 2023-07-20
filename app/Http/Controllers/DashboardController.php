<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $activeCustomers = Customer::getActives();
        return view('dashboard')->with('activeCustomers', $activeCustomers->toArray());
    }
}
