<?php

namespace App\Http\Controllers\AdminBoksy;

use App\Http\Requests\StoreBoksy;
use App\Boksy;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    protected $redirectTo = 'admin/boksy';

    public function index()
    {
        $boksy = Boksy::all()->sortBy("sort");
        return view('boksy.index',
            array('lista' => $boksy)
        );
    }

    public function create()
    {
        return view('boksy.form',
            array(
                'cardtitle' => 'Dodaj boks',
                'iconwidth' => Boksy::ICON_HEIGHT,
                'iconheight' => Boksy::ICON_HEIGHT
            ))
            ->with('wpis', Boksy::make());
    }

    public function store(StoreBoksy $request)
    {
        $slug = Str::slug($request->nazwa);
        $entryId = Boksy::insertGetId(request(['nazwa', 'tekst', 'link']));
        if ($request->hasFile('plik')) {
            Boksy::addIcon($slug, $request->file('plik'), $entryId);
        }
        return redirect($this->redirectTo)->with('success', 'Nowy boks dodany');
    }

    public function edit($id)
    {
        $boks = Boksy::where('id', $id)->first();
        return view('boksy.form',
            array(
                'wpis' => $boks,
                'cardtitle' => 'Edytuj boks',
                'iconwidth' => Boksy::ICON_HEIGHT,
                'iconheight' => Boksy::ICON_HEIGHT
            )
        );
    }

    public function update(StoreBoksy $request, $id)
    {
        $slug = Str::slug($request->nazwa);
        $boks = Boksy::find($id);
        $boks->update(request(['nazwa', 'tekst', 'link']));

        if ($request->hasFile('plik')) {
            Boksy::deleteIcon($boks->plik);
            Boksy::addIcon($slug, $request->file('plik'), $id);
        }
        return redirect($this->redirectTo)->with('success', 'Boks zaktualizowany');
    }

    public function destroy($id)
    {
        $boks = Boksy::find($id);
        Boksy::deleteIcon($boks->plik);
        $boks->delete();
        return response()->json([
            'success' => 'Boks usniety'
        ]);
    }

    public function sort(Request $request)
    {
        Boksy::sort($request);
    }
}
