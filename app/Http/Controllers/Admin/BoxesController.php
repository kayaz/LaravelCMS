<?php

namespace App\Http\Controllers\Admin;

use App\Boxes;
use App\Http\Requests\StoreBox;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BoxesController extends Controller
{

    protected $redirectTo = 'admin/boks';

    public function index()
    {
        $boxes = Boxes::all()->sortBy("sort");
        return view('admin.boxes.index', ['list' => $boxes]);
    }

    public function create()
    {
        return view('admin.boxes.form',
            [
                'cardtitle' => 'Dodaj boks',
                'iconwidth' => Boxes::ICON_HEIGHT,
                'iconheight' => Boxes::ICON_HEIGHT
            ])
            ->with('entry', Boxes::make());
    }

    public function store(StoreBox $request)
    {
        $box = Boxes::create($request->only(['nazwa', 'tekst', 'link']));

        if ($request->hasFile('plik')) {
            $box->makeIcon($request->nazwa, $request->file('plik'));
        }

        return redirect($this->redirectTo)->with('success', 'Nowy boks dodany');
    }

    public function edit($id)
    {
        $box = Boxes::where('id', $id)->first();
        return view('admin.boxes.form',
            [
                'entry' => $box,
                'cardtitle' => 'Edytuj boks',
                'iconwidth' => Boxes::ICON_HEIGHT,
                'iconheight' => Boxes::ICON_HEIGHT
            ]
        );
    }

    public function update(StoreBox $request, Boxes $box)
    {
        $box->update($request->only(['nazwa', 'tekst', 'link']));

        if ($request->hasFile('plik')) {
            $box->makeIcon($request->nazwa, $request->file('plik'));
        }

        return redirect($this->redirectTo)->with('success', 'Boks zaktualizowany');
    }

    public function destroy(Boxes $box)
    {
        $box->deleteIcon();
        $box->delete();
        return response()->json(['success' => 'Boks usniety']);
    }

    public function sort(Request $request, Boxes $box)
    {
        $box->sort($request);
    }

}
