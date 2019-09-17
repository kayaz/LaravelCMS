<?php

namespace App\Http\Controllers\Admin;

use App\Floor;
use App\Room;
use App\Investments;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class InvestmentsRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Floor $floor)
    {
        $investment = Investments::find($floor->investments_id);
        $rooms = $floor->rooms;

        return view('room.index', [
            'investment' => $investment,
            'floor' => $floor,
            'list' => $rooms
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Floor $floor)
    {
        $investment = Investments::where('id', $floor->investments_id)->first();
        return view('room.form',
            [
                'cardtitle' => 'Edytuj mieszkanie',
                'planwidth' => Investments::PLAN_WIDTH,
                'planheight' => Investments::PLAN_HEIGHT,
                'floor' => $floor,
                'investment' => $investment
            ])
            ->with('entry', Room::make());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Floor $floor)
    {
        $room = Room::create($request->merge(['slug' => Str::slug($request->nazwa), 'floor_id' => $floor->id])->only(
            [
                'floor_id',
                'nazwa',
                'slug',
                'meta_tytul',
                'meta_opis',
                'cords',
                'html',
                'status',
                'pokoje',
                'metry',
                'szukaj_metry',
                'cena',
                'szukaj_cena',
                'cena_m'
            ]
        ));

        if ($request->hasFile('plik')) {
            $room->makePlan($request->nazwa, $request->file('plik'));
        }

        if ($request->hasFile('plikpdf')) {
            $room->makePdf($request->nazwa, $request->file('plikpdf'));
        }

        return redirect('admin/investments/rooms/'.$floor->id)->with('success', 'Nowe mieszkanie dodane');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Room $room
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = Room::where('id', $id)->first();
        $floor = Floor::where('id', $room->floor_id)->first();
        $investment = Investments::where('id', $floor->investments_id)->first();
        return view('room.form',
            [
                'cardtitle' => 'Edytuj mieszkanie',
                'planwidth' => Investments::PLAN_WIDTH,
                'planheight' => Investments::PLAN_HEIGHT,
                'entry' => $room,
                'floor' => $floor,
                'investment' => $investment
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Room $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $room->update($request->merge(['slug' => Str::slug($request->nazwa)])->only(
            [
                'nazwa',
                'slug',
                'meta_tytul',
                'meta_opis',
                'cords',
                'html',
                'status',
                'pokoje',
                'metry',
                'szukaj_metry',
                'cena',
                'szukaj_cena',
                'cena_m'
            ]
        ));

        if ($request->hasFile('plik')) {
            $room->makePlan($request->nazwa, $request->file('plik'));
        }

        if ($request->hasFile('plikpdf')) {
            $room->makePdf($request->nazwa, $request->file('plikpdf'));
        }

        return redirect('admin/investments/rooms/'.$room->floor_id)->with('success', 'Mieszkanie zaktualizowane');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Room $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
    }

}
