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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'author' => 'required|string|max:255',
            'email' => 'required|email',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:255',
            'url' => 'required|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'author.required' => 'Podaj autora strony',
            'email.required' => 'Podaj adres e-mail!',
            'meta_title.required' => 'Podaj meta tag - nazwa strony',
            'meta_description.required' => 'Podaj meta tag - opis strony',
            'url.required' => 'Podaj adres strony',
        ];
    }
}
