<?php

namespace App\Http\Controller;

use Easy\Log\Log;
use Easy\View\View;
use Easy\Mail\Mail;
use App\Queue\EmailQueue;

class TestController extends Controller
{
    
    public function index()
    {
        View::view('/test');
    }
}
