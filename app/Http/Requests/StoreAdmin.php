<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAdmin extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'autor' => 'required|string|max:255',
            'email' => 'required|email',
            'meta_nazwa_strony' => 'required|string|max:255',
            'meta_opis_strony' => 'required|string|max:255',
            'adres_strony' => 'required|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'autor.required' => 'Podaj autora strony',
            'email.required' => 'Podaj adres e-mail!',
            'meta_nazwa_strony.required' => 'Podaj meta tag - nazwa strony',
            'meta_opis_strony.required' => 'Podaj meta tag - opis strony',
            'adres_strony.required' => 'Podaj adres strony',
        ];
    }
}
