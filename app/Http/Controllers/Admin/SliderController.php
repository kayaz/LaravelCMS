<?php

namespace App\Http\Controllers\Admin;

use App\Slider;
use App\Http\Requests\StoreSlider;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class SliderController extends Controller
{

    protected $redirectTo = 'admin/slider';

    public function index()
    {
        return view('admin.slider.index', ['list' => Slider::all()->sortBy("sort")]);
    }

    public function create()
    {
        return view('admin.slider.form',
            [
                'cardtitle' => 'Dodaj panel',
                'imgwidth' => Slider::PC_WIDTH,
                'imgheight' => Slider::PC_HEIGHT
            ])
            ->with('entry', Slider::make());
    }

    public function store(StoreSlider $request)
    {
        $slider = Slider::create($request->only(['name']));

        if ($request->hasFile('file')) {
            $slider->makeSlider($request->name, $request->file('file'));
        }

        return redirect($this->redirectTo)->with('success', 'Nowy panel dodany');
    }

    public function edit($id)
    {
        $slider = Slider::where('id', $id)->first();
        return view('admin.slider.form',
            [
                'entry' => $slider,
                'cardtitle' => 'Edytuj panel',
                'imgwidth' => Slider::PC_WIDTH,
                'imgheight' => Slider::PC_HEIGHT
            ]
        );
    }

    public function update(StoreSlider $request, Slider $slider)
    {
        $slider->update($request->only(['name',]));

        if ($request->hasFile('file')) {
            $slider->makeSlider($request->name, $request->file('file'));
        }

        return redirect($this->redirectTo)->with('success', 'Panel zaktualizowany');
    }

    public function sort(Request $request, Slider $slider)
    {
        $slider->sort($request);
    }

    public function destroy(Slider $slider)
    {
        $slider->deleteSlider();
        $slider->delete();
        return response()->json(['success' => 'Panel usniety']);
    }
}
