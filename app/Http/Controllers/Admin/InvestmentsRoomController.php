<?php

namespace App\Http\Controllers\Admin;

use App\Floor;
use App\Room;
use App\Investment;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class InvestmentsRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Floor $floor)
    {
        return view('room.index', [
            'investment' => Investment::find($floor->investment_id),
            'floor' => $floor,
            'list' => $floor->rooms
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Floor $floor)
    {
        $investment = Investment::where('id', $floor->investment_id)->first();
        return view('room.form', [
                'cardtitle' => 'Edytuj mieszkanie',
                'planwidth' => Investment::PLAN_WIDTH,
                'planheight' => Investment::PLAN_HEIGHT,
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
        $room = Room::create($request->merge(['slug' => Str::slug($request->name), 'floor_id' => $floor->id])->only(
            [
                'floor_id',
                'name',
                'number',
                'slug',
                'meta_title',
                'meta_description',
                'cords',
                'html',
                'status',
                'rooms',
                'area',
                'area_search',
                'price',
                'price_search',
                'price_m'
            ]
        ));

        if ($request->hasFile('file')) {
            $room->makePlan($request->name, $request->file('file'));
        }

        if ($request->hasFile('pdf')) {
            $room->makePdf($request->name, $request->file('pdf'));
        }

        return redirect('admin/investments/rooms/'.$floor->id)->with('success', 'Nowe mieszkanie dodane');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Room $room
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $room = Room::where('id', $id)->first();
        $floor = Floor::where('id', $room->floor_id)->first();
        $investment = Investment::where('id', $floor->investment_id)->first();
        return view('room.form', [
                'cardtitle' => 'Edytuj mieszkanie',
                'planwidth' => Investment::PLAN_WIDTH,
                'planheight' => Investment::PLAN_HEIGHT,
                'entry' => $room,
                'floor' => $floor,
                'investment' => $investment
            ]);
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
        $room->update($request->merge(['slug' => Str::slug($request->name)])->only(
            [
                'name',
                'number',
                'slug',
                'meta_title',
                'meta_description',
                'cords',
                'html',
                'status',
                'rooms',
                'area',
                'area_search',
                'price',
                'price_search',
                'price_m'
            ]
        ));

        if ($request->hasFile('file')) {
            $room->makePlan($request->name, $request->file('file'));
        }

        if ($request->hasFile('pdf')) {
            $room->makePdf($request->name, $request->file('pdf'));
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
