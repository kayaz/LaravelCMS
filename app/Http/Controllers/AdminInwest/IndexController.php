<?php

namespace App\Http\Controllers\AdminInwest;

use App\Http\Requests\StoreInwest;
use App\Inwestycje;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Image;
use File;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    protected $redirectTo = 'admin/inwestycje';
    protected $logoWidth = 150;
    protected $logoHeight = 60;
    protected $thumbWidth = 900;
    protected $thumbHeight = 620;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inwestycje = Inwestycje::all()->sortBy("sort");
        return view('inwestycje.index',
            array('lista' => $inwestycje)
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inwestycje.inwestycje-form',
            array(
                'cardtitle' => 'Dodaj inwestycje',
                'logowidth' => $this->logoWidth,
                'logoheight' => $this->logoHeight,
                'thumbwidth' => $this->thumbWidth,
                'thumbheight' => $this->thumbHeight,
            ))
            ->with('wpis', Inwestycje::make());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInwest $request)
    {
        $slug = Str::slug($request->nazwa);
        request()->merge([ 'slug' => $slug ]);
        $entryId = Inwestycje::insertGetId(request(['typ', 'status', 'nazwa', 'slug', 'meta_tytul', 'meta_opis', 'email', 'telefon', 'adres', 'biuro', 'tekst', 'lista']));

        // Upload logo
        if ($request->hasFile('logo')) {

            // Save new file
            $file = request()->file('logo');
            $name = $slug . '.' . $file->getClientOriginalExtension();
            $request->logo->storeAs('logo', $name, 'inwest_uploads');

            // Make thumbs
            $filepath = public_path('inwestycje/logo/' . $name);
            Image::make($filepath)->fit($this->logoWidth, $this->logoHeight)->save($filepath);

            // Name for SQL
            Inwestycje::find($entryId)->update(['logo' => $name ]);
        }

        // Upload thumb
        if ($request->hasFile('miniaturka')) {

            // Save new file
            $file = request()->file('miniaturka');
            $name = $slug . '.' . $file->getClientOriginalExtension();
            $request->miniaturka->storeAs('thumbs', $name, 'inwest_uploads');

            // Make thumbs
            $filepath = public_path('inwestycje/thumbs/' . $name);
            Image::make($filepath)->fit($this->thumbWidth, $this->thumbHeight)->save($filepath);

            // Name for SQL
            Inwestycje::find($entryId)->update(['miniaturka' => $name ]);
        }
        return redirect($this->redirectTo)->with('success', 'Nowa inwestycja dodana');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inwestycje  $inwestycje
     * @return \Illuminate\Http\Response
     */
    public function show(Inwestycje $inwestycje)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inwestycje  $inwestycje
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inwest = Inwestycje::where('id', $id)->first();
        return view('inwestycje.inwestycje-form',
            array(
                'wpis' => $inwest,
                'cardtitle' => 'Edytuj inwestycję - '.$inwest->nazwa,
                'logowidth' => $this->logoWidth,
                'logoheight' => $this->logoHeight,
                'thumbwidth' => $this->thumbWidth,
                'thumbheight' => $this->thumbHeight,
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inwestycje  $inwestycje
     * @return \Illuminate\Http\Response
     */
    public function update(StoreInwest $request, $id)
    {
        $slug = Str::slug($request->nazwa);
        request()->merge([ 'slug' => $slug ]);
        $inwestycja = Inwestycje::find($id);
        $inwestycja->update(request(['typ', 'status', 'nazwa', 'slug', 'meta_tytul', 'meta_opis', 'email', 'telefon', 'adres', 'biuro', 'tekst', 'lista']));

        // Upload logo
        if ($request->hasFile('logo')) {

            // Delete old files
            File::delete(public_path('inwestycje/logo/' . $inwestycja->logo));

            // Save new file
            $file = request()->file('logo');
            $name = $slug . '.' . $file->getClientOriginalExtension();
            $request->logo->storeAs('logo', $name, 'inwest_uploads');

            // Make thumbs
            $filepath = public_path('inwestycje/logo/' . $name);
            Image::make($filepath)->fit($this->logoWidth, $this->logoHeight)->save($filepath);

            // Name for SQL
            Inwestycje::find($id)->update(['logo' => $name ]);
        }

        // Upload thumb
        if ($request->hasFile('miniaturka')) {

            // Delete old files
            File::delete(public_path('inwestycje/thumbs/' . $inwestycja->miniaturka));

            // Save new file
            $file = request()->file('miniaturka');
            $name = $slug . '.' . $file->getClientOriginalExtension();
            $request->miniaturka->storeAs('thumbs', $name, 'inwest_uploads');

            // Make thumbs
            $filepath = public_path('inwestycje/thumbs/' . $name);
            Image::make($filepath)->fit($this->thumbWidth, $this->thumbHeight)->save($filepath);

            // Name for SQL
            Inwestycje::find($id)->update(['miniaturka' => $name ]);
        }
        return redirect($this->redirectTo)->with('success', 'Inwestycja zaktualizowana');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inwestycje  $inwestycje
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inwestycje $inwestycje)
    {
        //
    }
}
