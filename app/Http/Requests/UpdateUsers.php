<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUsers extends FormRequest
{

    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Wpisz swoje imię!',
            'email.required' => 'Podaj adres e-mail!',
            'email.exists' => 'Podany adres e-mail istnieje w bazie!',
        ];
    }
}
