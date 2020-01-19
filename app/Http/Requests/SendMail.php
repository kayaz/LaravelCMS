<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SendMail extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required'
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
            'name.required' => 'Wpisz swoje imię!',
            'email.required' => 'Podaj adres e-mail!',
            'phone.required' => 'Podaj prawidłowy numer telefonu!',
            'message.required' => 'Brak wiadomości?'
        ];
    }
}
