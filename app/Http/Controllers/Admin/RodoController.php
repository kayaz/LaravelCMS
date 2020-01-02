<?php

namespace App\Http\Controllers\Admin;

use App\Rodo;
use App\Http\Requests\StoreRodo;

use App\Http\Controllers\Controller;

class RodoController extends Controller
{
    protected $redirectTo = 'admin/rodo';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.rodo.index', ['list' => Rodo::orderBy('sort')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rodo.form',
            [
                'cardtitle' => 'Dodaj wpis'
            ])
            ->with('entry', Rodo::make());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRodo $request)
    {
        Rodo::create($request->only(
            [
                'title',
                'time',
                'text',
                'required',
                'status'
            ]
        ));

        return redirect($this->redirectTo)->with('success', 'Nowa regułka dodana');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rodo  $rodo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rodo = Rodo::where('id', $id)->first();
        return view('admin.rodo.form',
            [
                'entry' => $rodo,
                'cardtitle' => 'Edytuj regułkę'
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rodo  $rodo
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRodo $request, Rodo $rodo)
    {
        $rodo->update($request->only(
            [
                'title',
                'time',
                'text',
                'required',
                'status'
            ]
        ));

        return redirect($this->redirectTo)->with('success', 'Regułka zaktualizowana');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rodo  $rodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rodo $rodo)
    {
        $rodo->delete();
        return response()->json(['success' => 'Regułka usnieta']);
    }
}
