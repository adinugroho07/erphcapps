<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function show()
    {
        return new WelcomeMail();
    }

    public function send()
    {
        Mail::to('adisiub_2012@yahoo.com')->send(new WelcomeMail());
        return "email send !";
    }
}
