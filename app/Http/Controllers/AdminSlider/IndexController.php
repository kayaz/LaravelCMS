<?php

namespace App\Http\Controllers\AdminSlider;

use App\Http\Requests\StoreSlider;
use App\Slider;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Image;
use File;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    protected $redirectTo = 'admin/slider';

    public function index()
    {
        $slider = Slider::all()->sortBy("sort");
        return view('slider.index',
            array('panele' => $slider)
        );
    }

    public function create()
    {
        return view('slider.form',
            array('cardtitle' => 'Dodaj panel'))
            ->with('wpis', Slider::make());
    }

    public function store(StoreSlider $request)
    {
        $slider = new Slider();
        $slider->nazwa = $request->get('nazwa');

        // Upload files?
        if ($request->hasFile('plik')) {

            // Save new file
            $file = request()->file('plik');
            $name = Str::slug($request->nazwa, '-') . '.' . $file->getClientOriginalExtension();
            $request->plik->storeAs('slider', $name, 'public_uploads');

            // Make thumbs
            $filepath = public_path('uploads/slider/' . $name);
            $thumbnailpath = public_path('uploads/slider/thumbs/' . $name);
            Image::make($filepath)->fit(1920, 700)->save($filepath);
            Image::make($filepath)->resize(200, 200, function ($constraint) {$constraint->aspectRatio();})->save($thumbnailpath);

            // Name for SQL
            $slider->plik = $name;
        }

        $slider->save();
        return redirect($this->redirectTo)->with('success', 'Nowy wpis dodany');
    }

    public function edit($id)
    {
        $slider = Slider::where('id', $id)->first();
        return view('slider.form',
            array('wpis' => $slider, 'cardtitle' => 'Edytuj panel')
        );
    }

    public function update(StoreSlider $request, $id)
    {
        $slider = Slider::find($id);
        $slider->nazwa = $request->get('nazwa');

        // Upload file?
        if ($request->hasFile('plik')) {

            // Delete old files
            File::delete(public_path('uploads/slider/' . $slider->plik));
            File::delete(public_path('uploads/slider/thumbs/' . $slider->plik));

            // Save new file
            $file = request()->file('plik');
            $name = Str::slug($request->nazwa, '-') . '.' . $file->getClientOriginalExtension();
            $request->plik->storeAs('slider', $name, 'public_uploads');

            // Make thumbs
            $filepath = public_path('uploads/slider/' . $name);
            $thumbnailpath = public_path('uploads/slider/thumbs/' . $name);
            Image::make($filepath)->fit(1920, 700)->save($filepath);
            Image::make($filepath)->resize(200, 200, function ($constraint) {$constraint->aspectRatio();})->save($thumbnailpath);

            // Name for SQL
            $slider->plik = $name;
        }

        $slider->save();
        return redirect($this->redirectTo)->with('success', 'Wpis zaktualizowany');
    }

    public function sort(Request $request)
    {
        $updateRecordsArray = $request->get('recordsArray');
        $listingCounter = 1;
        foreach ($updateRecordsArray as $recordIDValue) {
            $slider = Slider::find($recordIDValue);
            $slider->sort = $listingCounter;
            $slider->save();
            $listingCounter = $listingCounter + 1;
        }
    }

    public function destroy($id)
    {
        // Usuwamy pliki
        $slider = Slider::find($id);
        File::delete( public_path('/storage/slider/' . $slider->plik));
        File::delete( public_path('/storage/slider/thumbs/' . $slider->plik));

        $slider->delete();
        return response()->json([
            'success' => 'Wpis usniety'
        ]);
    }
}
