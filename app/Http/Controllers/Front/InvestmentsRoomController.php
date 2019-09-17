<?php

namespace App\Http\Controllers\Front;

use App\Floor;
use App\Investments;
use App\Room;

use App\Http\Controllers\Controller;

class InvestmentsRoomController extends Controller
{
    public function index($slug, $floorslug, $roomslug)
    {
        $investment = Investments::where('slug', $slug)->first();
        $floor = Floor::where('slug', $floorslug)->first();
        $room = Room::where([
            'slug' => $roomslug,
            'floor_id' => $floor->id,
        ])->firstOrFail();
        return view('front.investments.room',
            [
                'investment' => $investment,
                'floor' => $floor,
                'room' => $room,
                'validation' => 1
            ]);
    }
}
