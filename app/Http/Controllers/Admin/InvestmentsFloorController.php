<?php

namespace App\Http\Controllers\Admin;

use App\Investment;
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
    public function index(Investment $investment)
    {
        return view('floor.index', ['investment' => $investment, 'list' => $investment->floors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Investment $investment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Investment $investment)
    {
        return view('floor.form', [
                'cardtitle' => 'Dodaj pietro',
                'planwidth' => Investment::PLAN_WIDTH,
                'planheight' => Investment::PLAN_HEIGHT,
                'investment' => $investment,
            ])
            ->with('entry', Floor::make());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFloor $request, Investment $investment)
    {
        $floor = Floor::create($request->merge([
                'slug' => Str::slug($request->name),
                'investment_id' => $investment->id
            ])->only([
                'investment_id',
                'typ',
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
            $floor->makePlan($request->name, $request->file('file'));
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $floor = Floor::where('id', $id)->first();
        $investment = Investment::where('id', $floor->investment_id)->first();

        return view('floor.form', [
                'cardtitle' => 'Edytuj pietro',
                'planwidth' => Investment::PLAN_WIDTH,
                'planheight' => Investment::PLAN_HEIGHT,
                'entry' => $floor,
                'investment' => $investment
            ]);
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
        $floor->update($request->merge(['slug' => Str::slug($request->name)])->only(
            [
                'typ',
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
            ]
        ));

        if ($request->hasFile('file')) {
            $floor->makePlan($request->name, $request->file('file'));
        }

        return redirect('admin/investments/floors/'.$floor->investment_id)->with('success', 'Pietro zaktualizowane');
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
        return response()->json(['success' => 'Piętro usunięte']);
    }
}
