<?php

namespace App\Http\Controllers\AdminBoksy;

use App\Http\Requests\StoreBoksy;
use App\Boksy;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Image;
use File;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    protected $redirectTo = 'admin/boksy';
    protected $iconWidth = 120;
    protected $iconHeight = 120;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boksy = Boksy::all()->sortBy("sort");
        return view('boksy.index',
            array('lista' => $boksy)
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('boksy.form',
            array('cardtitle' => 'Dodaj boks'))
            ->with('wpis', Boksy::make());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBoksy $request)
    {
        $boks = new Boksy();
        $boks->nazwa = $request->get('nazwa');
        $boks->tekst = $request->get('tekst');
        $boks->link = $request->get('link');

        // Upload files?
        if ($request->hasFile('plik')) {

            // Save new file
            $file = request()->file('plik');
            $name = Str::slug($request->nazwa, '-') . '.' . $file->getClientOriginalExtension();
            $request->plik->storeAs('boksy', $name, 'public_uploads');

            // Make thumbs
            $filepath = public_path('uploads/boksy/' . $name);
            Image::make($filepath)->resize($this->iconWidth, $this->iconHeight, function ($constraint) {$constraint->aspectRatio();})->save($filepath);

            // Name for SQL
            $boks->plik = $name;
        }

        $boks->save();
        return redirect($this->redirectTo)->with('success', 'Nowy boks dodany');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Boksy  $boksy
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $boks = Boksy::where('id', $id)->first();
        return view('boksy.form',
            array('wpis' => $boks, 'cardtitle' => 'Edytuj boks')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Boksy  $boksy
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBoksy $request, $id)
    {
        $boks = Boksy::find($id);
        $boks->nazwa = $request->get('nazwa');
        $boks->tekst = $request->get('tekst');
        $boks->link = $request->get('link');

        // Upload file?
        if ($request->hasFile('plik')) {

            // Delete old files
            File::delete(public_path('uploads/boksy/' . $boks->plik));

            // Save new file
            $file = request()->file('plik');
            $name = Str::slug($request->nazwa, '-') . '.' . $file->getClientOriginalExtension();
            $request->plik->storeAs('slider', $name, 'public_uploads');

            // Make thumbs
            $filepath = public_path('uploads/boksy/' . $name);
            Image::make($filepath)->resize($this->iconWidth, $this->iconHeight, function ($constraint) {$constraint->aspectRatio();})->save($filepath);

            // Name for SQL
            $boks->plik = $name;
        }

        $boks->save();
        return redirect($this->redirectTo)->with('success', 'Wpis zaktualizowany');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Boksy  $boksy
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Usuwamy pliki
        $boks = Boksy::find($id);
        File::delete( public_path('uploads/boksy/' . $boks->plik));

        $boks->delete();
        return response()->json([
            'success' => 'Boks usniety'
        ]);
    }

    public function sort(Request $request)
    {
        $updateRecordsArray = $request->get('recordsArray');
        $listingCounter = 1;
        foreach ($updateRecordsArray as $recordIDValue) {
            $slider = Boksy::find($recordIDValue);
            $slider->sort = $listingCounter;
            $slider->save();
            $listingCounter = $listingCounter + 1;
        }
    }

}
