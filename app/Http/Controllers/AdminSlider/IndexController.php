<?php

namespace App\Http\Controllers\AdminSlider;

use App\Http\Requests\StoreSlider;
use App\Slider;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
        $slug = Str::slug($request->nazwa);
        $entryId = Slider::insertGetId(request(['nazwa']));
        if ($request->hasFile('plik')) {
            Slider::addThumb($slug, $request->file('plik'), $entryId);
        }
        return redirect($this->redirectTo)->with('success', 'Nowy panel dodany');
    }

    public function edit($id)
    {
        $slider = Slider::where('id', $id)->first();
        return view('slider.form',
            array('wpis' => $slider, 'cardtitle' => 'Edytuj panel')
        );
    }

    public function updatess(StoreSlider $request, $id)
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

    public function update(StoreSlider $request, $id)
    {
        $slug = Str::slug($request->nazwa);
        $panel = Slider::find($id);
        $panel->update(request(['nazwa']));

        if ($request->hasFile('plik')) {
            Slider::deletePanel($panel->plik);
            Slider::addThumb($slug, $request->file('plik'), $id);
        }

        return redirect($this->redirectTo)->with('success', 'Wpis zaktualizowany');
    }

    public function sort(Request $request)
    {
        Slider::sort($request);
    }

    public function destroy($id)
    {
        $slider = Slider::find($id);
        Slider::deletePanel($slider->plik);
        $slider->delete();
        return response()->json([
            'success' => 'Panel usniety'
        ]);
    }
}
