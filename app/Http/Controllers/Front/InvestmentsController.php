<?php

namespace App\Http\Controllers\Front;

use App\Investment;

use App\Http\Controllers\Controller;

class InvestmentsController extends Controller
{
    public function index()
    {
        $investments = Investment::all('slug', 'name', 'thumb', 'logo', 'content_list');
        return view('front.investments.index', ['list' => $investments]);
    }

    public function show($slug)
    {
        $investment = Investment::where('slug', $slug)->first();

        // Inwestycja osiedlowa
        if ($investment->typ === 1) {
            $building = $investment->building;
            return view('front.investments.showbuildings',
                [
                    'investment' => $investment,
                    'building' => $building,
                    'investplan' => 1
                ]
            );
        }

        // Inwestycja budynkowa
        if ($investment->typ === 2) {
            $floor = $investment->floors;
            return view('front.investments.showfloors',
                [
                    'investment' => $investment,
                    'floor' => $floor,
                    'investplan' => 1
                ]
            );
        }
    }
}
