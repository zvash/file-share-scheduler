<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomerNotFoundException;
use App\Exceptions\TutorialsAccessDeniedException;
use App\Http\Requests\StoreTutorialRequest;
use App\Models\Tutorial;
use App\Repositories\CustomerRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TutorialController extends Controller
{

    public function index()
    {
        $tutorials = $this->getTutorials();
        return view('tutorials.tutorials-management')->with('tutorials', $tutorials);
    }

    public function visit(string $token, CustomerRepository $repository)
    {
        try {
            $customer = $repository->getCustomerByToken($token);
            $tutorials = $this->getTutorials();
            foreach ($tutorials as &$tutorial) {
                $tutorial['url'] = "/customers/{$token}{$tutorial['url']}";
            }
            return view('layouts.tutorials')
                ->with('tutorials', $tutorials)
                ->with('remainingTime', $customer->valid_until_string);
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

    public function authDownload(string $token)
    {
        $tutorial = Tutorial::query()
            ->where('token', $token)
            ->first();
        if (!$token) {
            return abort(404);
        }
        return redirect($tutorial->download_url);
    }

    public function guestDownload(string $customerToken, string $tutorialToken, CustomerRepository $repository)
    {
        try {
            $repository->getCustomerByToken($customerToken);
            $tutorial = Tutorial::query()
                ->where('token', $tutorialToken)
                ->first();
            return redirect($tutorial->download_url);
        } catch (CustomerNotFoundException $exception) {
            return abort(404);
        } catch (TutorialsAccessDeniedException $exception) {
            return view('layouts.access-expired');
        }
    }

    /**
     * @return array
     */
    private function getTutorials(): array
    {
        return Tutorial::query()
            ->orderBy('created_at')
            ->get(['title', 'size', 'thumbnail_url', 'token', 'url', 'size'])
            ->toArray();
    }
}
