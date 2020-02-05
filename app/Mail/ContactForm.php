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
        if ($rodoClient = RodoClient::where('mail', $this->request['email'])->first(['id'])) {

            //Klient istnieje, aktualizujemy dane
            RodoClient::where('mail', $this->request['email'])->update([
                'ip' => $this->request->ip(),
                'host' => gethostbyaddr($this->request->ip()),
                'browser' => $_SERVER['HTTP_USER_AGENT']
            ]);

            // Pobieramy zaznaczone regułki
            $checkbox = preg_grep("/rule_([0-9])/i", array_keys($this->request->all()));

            foreach($checkbox as $rule) {

                // Wyciągamy numer regułki
                $getId = preg_replace('/[^0-9]/', '', $rule);

                $rodo = RodoClientRules::where('id_rule', $getId)->where('id_client', $rodoClient->id)->first();

                dd($rodo);

            }

//            foreach($regulki as $key => $number){
//                $getId = preg_replace('/[^0-9]/', '', $number);
//
//                $regulkaArchiv = $db->fetchRow($db->select()->from('rodo_regulki_klient')->where('id_regulka = ?', $getId)->where('id_klient = ?', $klient->id));
//
//                if($regulkaArchiv){
//
//                    $arrayRegulka = json_decode(json_encode($regulkaArchiv),true);
//                    unset($arrayRegulka['id']);
//                    $arrayRegulka['data_anulowania'] = strtotime(date("Y-m-d H:i:s"));
//
//                    $db->insert('rodo_regulki_archiwum', $arrayRegulka);
//
//                    $regulka = $db->fetchRow($db->select()->from('rodo_regulki')->where('id = ?', $getId));
//                    $dataRodo = array(
//                        'id_regulka' => $getId,
//                        'id_klient' => $klient->id,
//                        'ip' => $ip,
//                        'data_podpisania' => strtotime(date("Y-m-d H:i:s")),
//                        'termin' => strtotime("+".$regulka->termin." months", strtotime(date("y-m-d"))),
//                        'miesiace' => $regulka->termin,
//                        'status' => 1
//                    );
//
//                    $where = array(
//                        'id_regulka = ?' => $getId,
//                        'id_klient = ?' => $klient->id
//                    );
//                    $db->update('rodo_regulki_klient', $dataRodo, $where);
//
//                } else {
//
//                    $regulka = $db->fetchRow($db->select()->from('rodo_regulki')->where('id = ?', $getId));
//                    $dataRodo = array(
//                        'id_regulka' => $getId,
//                        'id_klient' => $klient->id,
//                        'ip' => $ip,
//                        'data_podpisania' => strtotime(date("Y-m-d H:i:s")),
//                        'termin' => strtotime("+".$regulka->termin." months", strtotime(date("y-m-d"))),
//                        'miesiace' => $regulka->termin,
//                        'status' => 1
//                    );
//                    $db->insert('rodo_regulki_klient', $dataRodo);
//                }
//            }

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
