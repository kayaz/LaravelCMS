<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Mail\ContactForm;
use Illuminate\Support\Facades\Mail;

class KontaktController extends Controller
{
    public function index()
    {
        return view('front.kontakt.index', ['validation' => 1]);
    }

    public function send(Request $request)
    {
        Mail::send(new ContactForm($request));
        return back()->with('success', 'Twoja wiadomość została wysłana. W najbliższym czasie skontaktujemy się z Państwem celem omówienia szeczegółów!');
    }
}
