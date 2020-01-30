<?php

namespace App\Http\Controllers\Admin;

use App\Building;
use App\Http\Requests\StoreBuilding;
use App\Investment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

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
    public function store(StoreBuilding $request, Investment $investment)
    {
        $building = Building::create($request->merge([
            'slug' => Str::slug($request->name),
            'investment_id' => $investment->id
        ])->only([
            'investment_id',
            'name',
            'slug',
            'meta_title',
            'meta_description',
            'number',
            'cords',
            'html',
            'area_range',
            'rooms_range',
            'price_range',
        ]));

        if ($request->hasFile('file')) {
            $building->makePlan($request->name, $request->file('file'));
        }

        return redirect('admin/investments/buildings/'.$investment->id)->with('success', 'Nowy budynek dodany');
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $building = Building::where('id', $id)->first();
        $investment = Investment::where('id', $building->investment_id)->first();

        return view('building.form', [
            'cardtitle' => 'Edytuj budynek',
            'planwidth' => Investment::PLAN_WIDTH,
            'planheight' => Investment::PLAN_HEIGHT,
            'entry' => $building,
            'investment' => $investment
        ]);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBuilding $request, Building $building)
    {
        $building->update($request->merge(['slug' => Str::slug($request->name)])->except(['investment_id']));

        if ($request->hasFile('file')) {
            $building->makePlan($request->name, $request->file('file'));
        }

        return redirect('admin/investments/buildings/'.$building->investment_id)->with('success', 'Budynek zaktualizowany');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $building)
    {
        $building->deletePlan();
        $building->delete();

        return response()->json(['success' => 'Piętro usunięte']);
    }
}
