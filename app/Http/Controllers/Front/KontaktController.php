<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\SendMail;
use App\Http\Controllers\Controller;

class KontaktController extends Controller
{
    public function index()
    {
        return view('kontakt.index', ['validation' => 1]);
    }

    public function send(SendMail $request)
    {
        Mail::send('email.contact',
            [
                'ip' => $_SERVER['REMOTE_ADDR'],
                'data' => date('Y-m-d H:i:s'),
                'imie' => $request->get('imie'),
                'email' => $request->get('email'),
                'telefon' => $request->get('telefon'),
                'wiadomosc' => $request->get('wiadomosc')
            ], function($message) use ($request)
            {
                $message->from('kacpersky@gmail.com');
                $message->to('kacpersky@gmail.com', 'Admin')->subject('Wiadmość z formularza kontaktowego');
            });

        return redirect('kontakt')->with('success', 'Twoja wiadomość została wysłana. W najbliższym czasie skontaktujemy się z Państwem celem omówienia szeczegółów!');
    }
}
