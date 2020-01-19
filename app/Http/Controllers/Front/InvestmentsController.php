<?php

namespace App\Http\Controllers\Front;

use App\Investment;

use App\Http\Controllers\Controller;

class InvestmentsController extends Controller
{
    public function index()
    {
        $investments = Investment::all('slug', 'name', 'thumb', 'logo', 'content_list');
        return view('front.investments.lista', ['list' => $investments]);
    }

    public function show($slug)
    {
        $investment = Investment::where('slug', $slug)->first();
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
