<?php

namespace App\Http\Controllers\Kontakt;

use App\Http\Requests\SendMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('kontakt.index');
    }

    public function send(SendMail $request)
    {
        \Mail::send('email.contact',
            array(
                'ip' => $_SERVER['REMOTE_ADDR'],
                'data' => date('Y-m-d H:i:s'),
                'imie' => $request->get('imie'),
                'email' => $request->get('email'),
                'telefon' => $request->get('telefon'),
                'wiadomosc' => $request->get('wiadomosc')
            ), function($message) use ($request)
            {
                $message->from('kacpersky@gmail.com');
                $message->to('kacpersky@gmail.com', 'Admin')->subject('Wiadmość z formularza kontaktowego');
            });

        //return back()->with('success', 'Form wysłany');
        return redirect('kontakt')->with('success', 'Twoja wiadomość została wysłana. W najbliższym czasie skontaktujemy się z Państwem celem omówienia szeczegółów!');
    }
}
