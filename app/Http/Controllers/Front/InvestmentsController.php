<?php

namespace App\Http\Controllers\Front;

use App\Investments;

use App\Http\Controllers\Controller;

class InvestmentsController extends Controller
{
    public function index()
    {
        $inwestycje = Investments::all('slug', 'nazwa', 'miniaturka', 'logo', 'lista');
        return view('front.investments.lista', ['list' => $inwestycje]);
    }

    public function show($slug)
    {
        $investment = Investments::where('slug', $slug)->first();
        $floor = $investment->floors;


        return view('front.investments.show',
            [
                'investment' => $investment,
                'floor' => $floor,
                'investplan' => 1
            ]
        );
    }
}
