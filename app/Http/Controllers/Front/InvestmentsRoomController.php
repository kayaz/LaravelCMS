<?php

namespace App\Http\Controllers\Front;

use App\Floor;
use App\Http\Requests\SendMail;
use App\Investment;
use App\Mail\RoomForm;
use App\Room;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class InvestmentsRoomController extends Controller
{
    public function index($slug, $floorslug, $roomslug)
    {
        $investment = Investment::where('slug', $slug)->first();
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

    public function send(SendMail $request, $slug, $floorslug, $roomslug)
    {
        $floor = Floor::where('slug', $floorslug)->first();
        $room = Room::where([
            'slug' => $roomslug,
            'floor_id' => $floor->id,
        ])->firstOrFail();

        Mail::send(new RoomForm($request, $room->name));
        return back()->with('success', 'Twoja wiadomość została wysłana. W najbliższym czasie skontaktujemy się z Państwem celem omówienia szeczegółów!');
    }
}
