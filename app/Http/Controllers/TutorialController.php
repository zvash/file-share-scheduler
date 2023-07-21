<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomerNotFoundException;
use App\Exceptions\TutorialsAccessDeniedException;
use App\Http\Requests\StoreTutorialRequest;
use App\Models\Tutorial;
use App\Repositories\CustomerRepository;

class TutorialsController extends Controller
{

    public function index()
    {
        return view('tutorials.tutorials-management');
    }

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

    public function store(StoreTutorialRequest $request)
    {
        Tutorial::store($request->validated());
        return back()->with('status', 'tutorial-added');
    }
}
