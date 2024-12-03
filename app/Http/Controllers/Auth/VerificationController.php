<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\VerifiesEmails;
use App\Http\Controllers\Controller;

class VerificationController extends Controller
{
    use VerifiesEmails;

    /**
     * Where to redirect users after verifying their email address.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard'; 
}
