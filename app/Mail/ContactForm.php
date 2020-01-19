<?php

namespace App\Mail;

use App\Rodo;
use App\RodoClient;
use App\RodoClientRules;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    protected $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Sprawdzamy czy dane adres email istnieje w bazie
        if (RodoClient::where('mail', $this->request['email'])->exists()) {

            //Klient istnieje, aktualizujemy dane
            RodoClient::where('mail', $this->request['email'])->update([
                'ip' => $this->request->ip(),
                'host' => gethostbyaddr($this->request->ip()),
                'browser' => $_SERVER['HTTP_USER_AGENT']
            ]);

        } else {

            //Klient nie istnieje, tworzymy profil. Pobieramy też ID dodanego rekordu
            $saveUser = RodoClient::create([
                'name' => $this->request['name'],
                'mail'  => $this->request['email'],
                'ip' => $this->request->ip(),
                'host' => gethostbyaddr($this->request->ip()),
                'browser' => $_SERVER['HTTP_USER_AGENT']
            ]);

            // Pobieramy zaznaczone regułki
            $checkbox = preg_grep("/rule_([0-9])/i", array_keys($this->request->all()));

            foreach($checkbox as $rule) {

                // Wyciągamy numer regułki
                $getId = preg_replace('/[^0-9]/', '', $rule);

                // Pobieramy regułkę
                $rodo = Rodo::where('id', $getId)->first();

                // Zapisujemy regułkę do bazy
                RodoClientRules::create([
                    'id_rule' => $getId,
                    'id_client' => $saveUser->id,
                    'ip' => $this->request->ip(),
                    'duration' => strtotime("+".$rodo->time." months", strtotime(date("y-m-d"))),
                    'months' => $rodo->time,
                    'status' => 1
                ]);
            }
        }

        dd('Zrobione');

//        return $this->from('kacpersky@localhost')
//            ->view('email.contact')
//            ->with([
//                'ip' => $this->request->ip(),
//                'data' => date('Y-m-d H:i:s'),
//                'imie' => $this->request['imie'],
//                'email' => $this->request['email'],
//                'telefon' => $this->request['telefon'],
//                'wiadomosc' => $this->request['wiadomosc']
//            ])
//            ->subject('Formularz kontaktowy')
//            ->to('kacpersky@localhost');
    }
}
