<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{

    public function store(StoreCustomerRequest $request)
    {
        Customer::store($request->validated());
        return back()->with('status', 'customer-added');
    }
}
