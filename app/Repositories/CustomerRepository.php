<?php


namespace App\Repositories;


use App\Exceptions\CustomerNotFoundException;
use App\Exceptions\TutorialsAccessDeniedException;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CustomerRepository
{

    public function getCustomerByToken(string $token)
    {
        $customer = Customer::query()
            ->where('token', $token)
            ->first();
        if (!$customer) {
            throw new CustomerNotFoundException("Customer was not found!");
        }
        if (Auth::guest() && !$customer->is_visited) {
            $customer->setAttribute('is_visited', true)
                ->setAttribute('valid_until', Carbon::now()->addHours($customer->hours))
                ->save();
        }
        if ($customer->valid_until && $customer->valid_until->timestamp < Carbon::now()->timestamp) {
            throw new TutorialsAccessDeniedException("Expired!");
        }
        return $customer;
    }

}
