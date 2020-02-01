<?php

namespace App\Http\Controllers\Front;

use App\Menu;
use App\Rodo;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendMail;

use App\Mail\ContactForm;
use Illuminate\Support\Facades\Mail;

use MetaTag;

class ContactController extends Controller
{
    public function index()
    {
        $page = Menu::where('slug', 'kontakt')->firstOrFail(['title','meta_title', 'meta_description']);
        return view('front.contact.index', [
            'validation' => 1,
            'rules' => Rodo::orderBy('sort')->get(),
            'page' => $page
        ]);
    }

    public function send(SendMail $request)
    {
        Mail::send(new ContactForm($request));
        return back()->with('success', 'Twoja wiadomość została wysłana. W najbliższym czasie skontaktujemy się z Państwem celem omówienia szeczegółów!');
    }
}
