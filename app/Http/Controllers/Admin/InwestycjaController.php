<?php

namespace App\Http\Controllers\Admin;

use App\Inwestycja;
use App\Http\Requests\StoreInwest;

use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class InwestycjaController extends Controller
{

    protected $redirectTo = 'admin/inwestycja';

    public function index()
    {
        $inwestycje = Inwestycja::all()->sortBy("sort");
        return view('inwestycja.index',
            array('lista' => $inwestycje)
        );
    }

    public function create()
    {
        return view('inwestycja.inwestycja-form',
            array(
                'cardtitle' => 'Dodaj inwestycje',
                'logowidth' => Inwestycja::LOGO_WIDTH,
                'logoheight' => Inwestycja::LOGO_HEIGHT,
                'thumbwidth' => Inwestycja::THUMB_WIDTH,
                'thumbheight' => Inwestycja::THUMB_HEIGHT,
            ))
            ->with('wpis', Inwestycja::make());
    }

    public function store(StoreInwest $request)
    {
        $inwestycje = Inwestycja::create($request->merge(['slug' => Str::slug($request->nazwa)])->only(['typ', 'status', 'nazwa', 'slug', 'meta_tytul', 'meta_opis', 'email', 'telefon', 'adres', 'biuro', 'tekst', 'lista']));

        if ($request->hasFile('logo')) {
            $inwestycje->makeLogo($request->nazwa, $request->file('logo'));
        }

        if ($request->hasFile('miniaturka')) {
            $inwestycje->makeThumb($request->nazwa, $request->file('miniaturka'));
        }
        return redirect($this->redirectTo)->with('success', 'Nowa inwestycja dodana');
    }

//    public function show(Inwestycja $inwestycje)
//    {
//
//    }

    public function edit($id)
    {
        $inwest = Inwestycja::where('id', $id)->first();
        return view('inwestycja.inwestycja-form',
            array(
                'wpis' => $inwest,
                'cardtitle' => 'Edytuj inwestycję - '.$inwest->nazwa,
                'logowidth' => Inwestycja::LOGO_WIDTH,
                'logoheight' => Inwestycja::LOGO_HEIGHT,
                'thumbwidth' => Inwestycja::THUMB_WIDTH,
                'thumbheight' => Inwestycja::THUMB_HEIGHT,
            )
        );
    }

    public function update(StoreInwest $request, Inwestycja $inwestycja)
    {

        $inwestycja->update($request->merge(['slug' => Str::slug($request->nazwa)])->only(['typ', 'status', 'nazwa', 'slug', 'meta_tytul', 'meta_opis', 'email', 'telefon', 'adres', 'biuro', 'tekst', 'lista']));

        // Upload logo
        if ($request->hasFile('logo')) {
            $inwestycja->makeLogo($request->nazwa, $request->file('logo'));
        }

        // Upload thumb
        if ($request->hasFile('miniaturka')) {
            $inwestycja->makeThumb($request->nazwa, $request->file('miniaturka'));
        }
        return redirect($this->redirectTo)->with('success', 'Inwestycja zaktualizowana');
    }

    public function destroy(Inwestycja $inwestycje)
    {
        //
    }
}
