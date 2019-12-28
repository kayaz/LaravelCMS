<?php

namespace App\Http\Controllers\Admin;

use App\Menu;
use App\Http\Requests\StoreMenu;

use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class MenuController extends Controller
{

    protected $redirectTo = 'admin/menu';

    public function index()
    {
        $memu = Menu::all()->sortBy("sort");
        return view('admin.menu.index', ['list' => $memu]);
    }

    public function create()
    {
        return view('admin.menu.form', ['cardtitle' => 'Dodaj stronę'])->with('entry', Menu::make());
    }

    public function store(StoreMenu $request)
    {
        Menu::create($request->merge(['slug' => Str::slug($request->nazwa)])->only(
            [
                'nazwa',
                'menu',
                'id_parent',
                'meta_tytul',
                'meta_opis',
                'tekst'
            ]
        ));
        return redirect($this->redirectTo)->with('success', 'Nowa strona dodana');
    }

    public function edit($id)
    {
        $menu = Menu::where('id', $id)->first();
        return view('admin.menu.form',
            [
                'entry' => $menu,
                'cardtitle' => 'Edytuj stronę'
            ]
        );
    }

    public function update(StoreMenu $request, Menu $menu)
    {
        $menu->update($request->merge(['slug' => Str::slug($request->nazwa)])->only(
            [
                'nazwa',
                'menu',
                'id_parent',
                'meta_tytul',
                'meta_opis',
                'tekst'
            ]
        ));
        return redirect($this->redirectTo)->with('success', 'Strona zaktualizowana');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return response()->json(['success' => 'Strona usnięta']);
    }
}
