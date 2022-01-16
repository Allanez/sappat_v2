<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Illuminate\Contracts\Auth\StatefulGuard;


class RegisterResponse implements RegisterResponseContract
{  
    protected $guard;

    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function toResponse($request)
    {
        // below is the existing response
        // replace this with your own code


        session()->flash('status', 'Your account was succesfully created. Please wait while the administrator confirms your account. To follow-up, you may send an email to jdultra at up.edu.ph.');

        $this->guard->logout();

        return $request->wantsJson()
                    ? new JsonResponse('', 201)
                    : redirect('login');
    }
}