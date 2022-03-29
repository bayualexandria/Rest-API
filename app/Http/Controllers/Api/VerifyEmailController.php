<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


class VerifyEmailController extends Controller
{


    public function sendVerificationEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return ['message' => 'Already verified'];
        }else{

            $request->user()->sendEmailVerificationNotification();
            return ['message' => 'verification-link-send'];
        }
        
       
    }

    public function verify(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return ['message' => 'Email already verified'];
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return ['message' => 'Email has been verified'];
    }
}
