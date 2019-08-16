<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SendMail extends FormRequest
{
    public function rules()
    {
        return [
            'imie' => 'required',
            'email' => 'required',
            'telefon' => 'required',
            'wiadomosc' => 'required'
        ];
    }
    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'imie.required' => 'Wpisz swoje imię!',
            'email.required' => 'Podaj adres e-mail!',
            'telefon.required' => 'Podaj prawidłowy numer telefonu!',
            'wiadomosc.required' => 'Brak wiadomości?'
        ];
    }
}
