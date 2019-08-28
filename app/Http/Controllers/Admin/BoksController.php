<?php

namespace App\Http\Controllers\Admin;

use App\Boks;
use App\Http\Requests\StoreBoks;

use App\Http\Controllers\Controller;

class BoksController extends Controller
{

    protected $redirectTo = 'admin/boks';

    public function index()
    {
        $boksy = Boks::all()->sortBy("sort");
        return view('boks.index',
            array('lista' => $boksy)
        );
    }

    public function create()
    {
        return view('boks.form',
            array(
                'cardtitle' => 'Dodaj boks',
                'iconwidth' => Boks::ICON_HEIGHT,
                'iconheight' => Boks::ICON_HEIGHT
            ))
            ->with('wpis', Boks::make());
    }

    public function store(StoreBoks $request)
    {
        $boks = Boks::create($request->only(['nazwa', 'tekst', 'link']));

        if ($request->hasFile('plik')) {
            $boks->makeIcon($request->nazwa, $request->file('plik'));
        }

        return redirect($this->redirectTo)->with('success', 'Nowy boks dodany');
    }

    public function edit($id)
    {
        $boks = Boks::where('id', $id)->first();
        return view('boks.form',
            array(
                'wpis' => $boks,
                'cardtitle' => 'Edytuj boks',
                'iconwidth' => Boks::ICON_HEIGHT,
                'iconheight' => Boks::ICON_HEIGHT
            )
        );
    }

    public function update(StoreBoks $request, Boks $boks)
    {
        $boks->update($request->only(['nazwa', 'tekst', 'link']));

        if ($request->hasFile('plik')) {
            $boks->makeIcon($request->nazwa, $request->file('plik'));
        }

        return redirect($this->redirectTo)->with('success', 'Boks zaktualizowany');
    }

    public function destroy(Boks $boks)
    {
        $boks->deleteIcon();
        $boks->delete();
        return response()->json([
            'success' => 'Boks usniety'
        ]);
    }
}
