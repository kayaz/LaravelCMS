<?php

namespace App\Http\Controllers\Admin;

use App\Map;
use App\Http\Requests\StoreMap;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapController extends Controller
{

    protected $redirectTo = 'admin/map';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.map.index', ['list' => Map::orderBy('id', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.map.form',
            [
                'cardtitle' => 'Dodaj punkt'
            ])
            ->with('entry', Map::make());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreMap $request)
    {
        $map = Map::create($request->only(['name', 'lat', 'lng', 'zoom', 'address', 'group_id']));
        return redirect($this->redirectTo)->with('success', 'Nowy punkt dodany');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('admin.map.form', [
            'entry' => Map::where('id', $id)->first(),
            'cardtitle' => 'Edytuj punkt'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Map $map
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(StoreMap $request, Map $map)
    {
        $map->update($request->only(['name', 'lat', 'lng', 'zoom', 'address', 'group_id']));
        return redirect($this->redirectTo)->with('success', 'Punkt zaktualizowany');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function destroy(Map $map)
    {
        $map->delete();
        return response()->json(['success' => 'Punkt usniety']);
    }
}
