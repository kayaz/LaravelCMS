<?php

namespace App\Http\Controllers\Admin;

use App\Box;
use App\Http\Requests\StoreBox;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BoxesController extends Controller
{

    protected $redirectTo = 'admin/boks';

    public function index()
    {
        return view('admin.boxes.index', ['list' => Box::all()->sortBy("sort")]);
    }

    public function create()
    {
        return view('admin.boxes.form', [
                'cardtitle' => 'Dodaj boks',
                'iconwidth' => Box::ICON_HEIGHT,
                'iconheight' => Box::ICON_HEIGHT
            ])
            ->with('entry', Box::make());
    }

    public function store(StoreBox $request)
    {
        $box = Box::create($request->only(['title', 'content', 'url']));

        if ($request->hasFile('file')) {
            $box->makeIcon($request->title, $request->file('file'));
        }

        return redirect($this->redirectTo)->with('success', 'Nowy boks dodany');
    }

    public function edit($id)
    {
        $box = Box::where('id', $id)->first();
        return view('admin.boxes.form', [
                'entry' => $box,
                'cardtitle' => 'Edytuj boks',
                'iconwidth' => Box::ICON_HEIGHT,
                'iconheight' => Box::ICON_HEIGHT
            ]);
    }

    public function update(StoreBox $request, Box $box)
    {
        $box->update($request->only(['title', 'content', 'url']));

        if ($request->hasFile('file')) {
            $box->makeIcon($request->title, $request->file('file'));
        }

        return redirect($this->redirectTo)->with('success', 'Boks zaktualizowany');
    }

    public function destroy(Box $box)
    {
        $box->deleteIcon();
        $box->delete();
        return response()->json(['success' => 'Boks usniety']);
    }

    public function sort(Request $request, Box $box)
    {
        $box->sort($request);
    }
}
