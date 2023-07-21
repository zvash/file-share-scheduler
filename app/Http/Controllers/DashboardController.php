<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $activeCustomers = Customer::getActives();
        $inactiveCustomers = Customer::getInActives();
        return view('dashboard')
            ->with('activeCustomers', $activeCustomers->toArray())
            ->with('inactiveCustomers', $inactiveCustomers->toArray());
    }
}
