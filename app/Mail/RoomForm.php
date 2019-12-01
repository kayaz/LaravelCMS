<?php

namespace App\Mail;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RoomForm extends Mailable
{
    use Queueable, SerializesModels;

    private $roomname;
    private $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request, $room)
    {
        $this->request = $request;
        $this->roomname = $room;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('kacpersky@localhost')
            ->view('email.contact')
            ->with([
                'ip' => $this->request->ip(),
                'data' => date('Y-m-d H:i:s'),
                'imie' => $this->request['imie'],
                'email' => $this->request['email'],
                'telefon' => $this->request['telefon'],
                'wiadomosc' => $this->request['wiadomosc']
            ])
            ->subject("'Wiadmość z formularza mieszkania: ".$this->roomname)
            ->to('kacpersky@localhost');
    }
}
