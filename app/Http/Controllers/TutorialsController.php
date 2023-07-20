<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomerNotFoundException;
use App\Exceptions\TutorialsAccessDeniedException;
use App\Repositories\CustomerRepository;

class TutorialsController extends Controller
{

    public function visit(string $token, CustomerRepository $customerRepository)
    {
        try {
            $customer = $customerRepository->getCustomerByToken($token);
            dd('show list of videos');
        } catch (CustomerNotFoundException $exception) {
            return abort(404);
        } catch (TutorialsAccessDeniedException $exception) {
            return view('layouts.access-expired');
        }
    }
}
