<?php

namespace App\Http\Controllers\AdminMenu;

use App\Http\Requests\StoreMenu;
use App\Menu;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    protected $redirectTo = 'admin/menu';

    public function index()
    {
        $memu = Menu::all()->sortBy("sort");
        return view('menu.index',
            array('lista' => $memu)
        );
    }

    public function create()
    {
        return view('menu.form',
            array('cardtitle' => 'Dodaj stronę'))
            ->with('wpis', Menu::make());
    }

    public function store(StoreMenu $request)
    {
        $menu = new Menu();
        $this->persist($menu, $request);
        return redirect($this->redirectTo)->with('success', 'Nowa strona dodana');
    }

    public function edit(Menu $menu, $id)
    {
        $menu = Menu::where('id', $id)->first();
        return view('menu.form',
            array('wpis' => $menu, 'cardtitle' => 'Edytuj stronę')
        );
    }

    public function update(StoreMenu $request, $id)
    {
        $menu = Menu::find($id);
        $this->persist($menu, $request);
        return redirect($this->redirectTo)->with('success', 'Strona zaktualizowana');
    }

    protected function persist($menu, $request)
    {
        $menu->fill($request->only([
            'nazwa',
            'menu',
            'id_parent',
            'meta_tytul',
            'meta_opis',
            'tekst',
        ]));
        $menu->slug = Str::slug($request->get('nazwa'), '-');
        $menu->save();
    }

    public function destroy(Menu $menu, $id)
    {
        // Usuwamy pliki
        $menu = Menu::find($id);
        $menu->delete();
        return response()->json([
            'success' => 'Strona usnięta'
        ]);
    }
}
