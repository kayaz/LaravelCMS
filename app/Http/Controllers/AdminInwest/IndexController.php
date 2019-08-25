<?php

namespace App\Http\Controllers\AdminInwest;

use App\Http\Requests\StoreInwest;
use App\Inwestycje;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    protected $redirectTo = 'admin/inwestycje';

    public function index()
    {
        $inwestycje = Inwestycje::all()->sortBy("sort");
        return view('inwestycje.index',
            array('lista' => $inwestycje)
        );
    }

    public function create()
    {
        return view('inwestycje.inwestycje-form',
            array(
                'cardtitle' => 'Dodaj inwestycje',
                'logowidth' => Inwestycje::LOGO_WIDTH,
                'logoheight' => Inwestycje::LOGO_HEIGHT,
                'thumbwidth' => Inwestycje::THUMB_WIDTH,
                'thumbheight' => Inwestycje::THUMB_HEIGHT,
            ))
            ->with('wpis', Inwestycje::make());
    }

    public function store(StoreInwest $request)
    {
        $slug = Str::slug($request->nazwa);
        request()->merge([ 'slug' => $slug ]);
        $entryId = Inwestycje::insertGetId(request(['typ', 'status', 'nazwa', 'slug', 'meta_tytul', 'meta_opis', 'email', 'telefon', 'adres', 'biuro', 'tekst', 'lista']));

        // Upload logo
        if ($request->hasFile('logo')) {
            Inwestycje::addLogo($slug, $request->file('logo'), $entryId);
        }

        // Upload thumb
        if ($request->hasFile('miniaturka')) {
            Inwestycje::addThumb($slug, $request->file('miniaturka'), $entryId);
        }
        return redirect($this->redirectTo)->with('success', 'Nowa inwestycja dodana');
    }

    public function show(Inwestycje $inwestycje)
    {
        //
    }

    public function edit($id)
    {
        $inwest = Inwestycje::where('id', $id)->first();
        return view('inwestycje.inwestycje-form',
            array(
                'wpis' => $inwest,
                'cardtitle' => 'Edytuj inwestycję - '.$inwest->nazwa,
                'logowidth' => Inwestycje::LOGO_WIDTH,
                'logoheight' => Inwestycje::LOGO_HEIGHT,
                'thumbwidth' => Inwestycje::THUMB_WIDTH,
                'thumbheight' => Inwestycje::THUMB_HEIGHT,
            )
        );
    }

    public function update(StoreInwest $request, Inwestycje $inwestycje, $id)
    {
        $slug = Str::slug($request->nazwa);
        request()->merge([ 'slug' => $slug ]);
        $inwestycje->find($id)->update(request(['typ', 'status', 'nazwa', 'slug', 'meta_tytul', 'meta_opis', 'email', 'telefon', 'adres', 'biuro', 'tekst', 'lista']));

        // Upload logo
        if ($request->hasFile('logo')) {
            $inwestycje->deleteLogo($inwestycje->logo);
            $inwestycje->addLogo($slug, $request->file('logo'), $id);
        }

        // Upload thumb
        if ($request->hasFile('miniaturka')) {
            $inwestycje->deleteThumb($inwestycje->miniaturka);
            $inwestycje->addThumb($slug, $request->file('miniaturka'), $id);
        }
        return redirect($this->redirectTo)->with('success', 'Inwestycja zaktualizowana');
    }

    public function destroy(Inwestycje $inwestycje)
    {
        //
    }
}
