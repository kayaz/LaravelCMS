<?php

namespace App\Http\Controllers\Front;

use App\Rodo;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendMail;

use App\Mail\ContactForm;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('front.contact.index', ['validation' => 1, 'rules' => Rodo::orderBy('sort')->get()]);
    }

    public function send(SendMail $request)
    {
        Mail::send(new ContactForm($request));
        return back()->with('success', 'Twoja wiadomość została wysłana. W najbliższym czasie skontaktujemy się z Państwem celem omówienia szeczegółów!');
    }
}
