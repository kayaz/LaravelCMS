<?php

namespace App\Http\Controllers\Front;

use App\Inwestycja;

use App\Http\Controllers\Controller;

class InwestycjaController extends Controller
{
    public function index()
    {
        $inwestycje = Inwestycja::all('slug', 'nazwa', 'miniaturka', 'logo', 'lista');
        return view('inwestycja.lista',
            array('lista' => $inwestycje)
        );
    }
}
