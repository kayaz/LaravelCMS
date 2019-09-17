<?php

namespace App\Http\Controllers\Front;

use App\Floor;
use App\Investments;

use App\Http\Controllers\Controller;

class InvestmentsFloorController extends Controller
{
    public function index($slug, $floorslug)
    {
        $investment = Investments::where('slug', $slug)->first();
        $floor = Floor::where('slug', $floorslug)->first();
        $rooms = $floor->rooms;

        return view('front.investments.floor',
            [
                'investment' => $investment,
                'floor' => $floor,
                'rooms' => $rooms,
                'floorplan' => 1
            ]);
    }
}
