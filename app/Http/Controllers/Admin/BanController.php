<?php

namespace App\Http\Controllers\Admin;

use App\Ban;
use App\Http\Requests\StoreBan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BanController extends Controller
{

    protected $redirectTo = 'admin/ban';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.ban.index', ['list' => Ban::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ban.form', ['cardtitle' => 'Dodaj wpis'])->with('entry', Ban::make());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBan $request)
    {
        Ban::create($request->only(['address', 'reason']));
        return redirect($this->redirectTo)->with('success', 'Nowy wpis dodany');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ban  $ban
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ban = Ban::where('id', $id)->first();
        return view('admin.ban.form', [
            'entry' => $ban,
            'cardtitle' => 'Edytuj boks'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ban  $ban
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBan $request, Ban $ban)
    {
        $ban->update($request->only(['address', 'reason']));
        return redirect($this->redirectTo)->with('success', 'Wpis zaktualizowany');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ban  $ban
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ban $ban)
    {
        $ban->delete();
        return response()->json(['success' => 'Boks usniety']);
    }
}
