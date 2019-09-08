<?php

namespace App\Http\Controllers\Admin;

use App\Investments;
use App\Floor;

use Illuminate\Support\Str;

use App\Http\Requests\StoreFloor;
use App\Http\Controllers\Controller;

class InvestmentsFloorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Investments $investment)
    {
        $floor = $investment->floors;
        return view('floor.index', ['investment' => $investment, 'list' => $floor]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Investments $investment)
    {
        $invest = $investment->first();
        return view('floor.form',
            [
                'cardtitle' => 'Dodaj pietro',
                'planwidth' => Investments::PLAN_WIDTH,
                'planheight' => Investments::PLAN_HEIGHT,
                'investment' => $invest,
            ])
            ->with('entry', Floor::make());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFloor $request, Investments $investment)
    {
        $floor = Floor::create($request->merge(['slug' => Str::slug($request->nazwa), 'investments_id' => $investment->id])->only(
            [
                'investments_id',
                'typ',
                'nazwa',
                'slug',
                'meta_tytul',
                'meta_opis',
                'numer',
                'cords',
                'html',
                'zakres_powierzchnia',
                'zakres_pokoje',
                'zakres_cena'
            ]
        ));

        if ($request->hasFile('plik')) {
            $floor->makePlan($request->nazwa, $request->file('plik'));
        }

        return redirect('admin/investments/floors/'.$investment->id)->with('success', 'Nowe piętro dodane');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('floor.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $floor = Floor::where('id', $id)->first();
        $investment = Investments::where('id', $floor->investments_id)->first();
        return view('floor.form',
            [
                'cardtitle' => 'Edytuj pietro',
                'planwidth' => Investments::PLAN_WIDTH,
                'planheight' => Investments::PLAN_HEIGHT,
                'entry' => $floor,
                'investment' => $investment
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFloor $request, Floor $floor)
    {

        $floor->update($request->merge(['slug' => Str::slug($request->nazwa)])->only(
            [
                'typ',
                'nazwa',
                'slug',
                'meta_tytul',
                'meta_opis',
                'numer',
                'cords',
                'html',
                'zakres_powierzchnia',
                'zakres_pokoje',
                'zakres_cena'
            ]
        ));

        if ($request->hasFile('plik')) {
            $floor->makePlan($request->nazwa, $request->file('plik'));
        }

        return redirect('admin/investments/floors/'.$floor->investments_id)->with('success', 'Pietro zaktualizowane');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Floor $floor)
    {
        $floor->delete();
        return response()->json(['success' => 'Boks usniety']);
    }
}
