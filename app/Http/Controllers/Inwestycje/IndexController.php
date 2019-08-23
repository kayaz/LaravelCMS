<?php

namespace App\Http\Controllers\Inwestycje;

use App\Inwestycje;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $inwestycje = Inwestycje::all('slug', 'nazwa', 'miniaturka', 'logo', 'lista');
        return view('inwestycje.lista',
            array('lista' => $inwestycje)
        );
    }
}
