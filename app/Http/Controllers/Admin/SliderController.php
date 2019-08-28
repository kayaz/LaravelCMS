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
        $slider = Slider::all()->sortBy("sort");
        return view('slider.index',
            array('panele' => $slider)
        );
    }

    public function create()
    {
        return view('slider.form',
            array(
                'cardtitle' => 'Dodaj panel',
                'imgwidth' => Slider::PC_WIDTH,
                'imgheight' => Slider::PC_HEIGHT
            ))
            ->with('wpis', Slider::make());
    }

    public function store(StoreSlider $request)
    {
        $slider = Slider::create($request->only(['nazwa']));

        if ($request->hasFile('plik')) {
            $slider->makeSlider($request->nazwa, $request->file('plik'));
        }

        return redirect($this->redirectTo)->with('success', 'Nowy panel dodany');
    }

    public function edit($id)
    {
        $slider = Slider::where('id', $id)->first();
        return view('slider.form',
            array(
                'wpis' => $slider,
                'cardtitle' => 'Edytuj panel',
                'imgwidth' => Slider::PC_WIDTH,
                'imgheight' => Slider::PC_HEIGHT
            )
        );
    }

    public function update(StoreSlider $request, Slider $slider)
    {
        $slider->update($request->only(['nazwa',]));

        if ($request->hasFile('plik')) {
            $slider->makeSlider($request->nazwa, $request->file('plik'));
        }

        return redirect($this->redirectTo)->with('success', 'Boks zaktualizowany');

    }

    public function sort(Request $request, Slider $slider)
    {
        $slider->sort($request);
    }

    public function destroy(Slider $slider)
    {
        $slider->deleteSlider();
        $slider->delete();
        return response()->json([
            'success' => 'Boks usniety'
        ]);
    }
}
