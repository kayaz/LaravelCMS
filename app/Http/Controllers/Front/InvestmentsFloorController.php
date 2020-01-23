<?php

namespace App\Http\Controllers\Front;

use App\Floor;
use App\Investment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvestmentsFloorController extends Controller
{
    public function index(Request $request, $slug, $floorslug)
    {
        $investment = Investment::where('slug', $slug)->first();
        $floor = Floor::where('slug', $floorslug)->first();
        $rooms = $floor->rooms;
        $orderByRooms = $orderByArea = 'desc';

        if ($request->has('orderRooms') && $request->query('orderRooms') == 'asc') {
            $rooms = $rooms->sortBy('rooms');
            $orderByRooms = 'asc';
        } else {
            $rooms = $rooms->sortByDesc('rooms');
        }

        if ($request->has('orderArea') && $request->query('orderArea') == 'asc') {
            $rooms = $rooms->sortBy('area_search');
            $orderByArea = 'asc';
        } else {
            $rooms = $rooms->sortByDesc('area_search');
        }

        return view('front.investments.floor',
            [
                'investment' => $investment,
                'floor' => $floor,
                'rooms' => $rooms,
                'orderByRooms' => $orderByRooms,
                'orderByArea' => $orderByArea,
                'floorplan' => 1
            ]);
    }
}
