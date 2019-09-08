<?php

namespace App\Http\Controllers\Front;

use App\Investments;

use App\Http\Controllers\Controller;

class InwestycjaController extends Controller
{
    public function index()
    {
        $inwestycje = Investments::all('slug', 'nazwa', 'miniaturka', 'logo', 'lista');
        return view('inwestycja.lista', ['lista' => $inwestycje]);
    }
}
