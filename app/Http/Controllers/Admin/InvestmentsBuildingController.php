<?php

namespace App\Http\Controllers\Admin;

use App\Building;
use App\Investment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvestmentsBuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Investment $investment)
    {
        return view('building.index', ['investment' => $investment, 'list' => $investment->building]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Investment $investment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Investment $investment)
    {
        return view('building.form', [
                'cardtitle' => 'Dodaj budynek',
                'planwidth' => Investment::PLAN_WIDTH,
                'planheight' => Investment::PLAN_HEIGHT,
                'investment' => $investment,
            ])
            ->with('entry', Building::make());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show(Building $building)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $building)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Building $building)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $building)
    {
        //
    }
}
