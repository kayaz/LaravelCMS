<?php

namespace App\Http\Controllers\Admin;

use App\Menu;
use App\Http\Requests\StoreMenu;

use App\Http\Controllers\Controller;

class MenuController extends Controller
{

    protected $redirectTo = 'admin/menu';

    public function index()
    {
        return view('admin.menu.index');
    }

    public function create()
    {
        $selectMenu = Menu::pluck('nazwa', 'id');
        return view('admin.menu.form', ['cardtitle' => 'Dodaj stronę', 'selectMenu' => $selectMenu])->with('entry', Menu::make());
    }

    public function store(StoreMenu $request)
    {
        $result = Menu::create($request->only(
            [
                'nazwa',
                'menu',
                'id_parent',
                'meta_tytul',
                'meta_opis',
                'tekst',
                'slug'
            ]
        ));

        $uri = Menu::urigenerate($result->id);
        $justCreated = Menu::find($result->id);
        $justCreated->uri = $uri;
        $justCreated->save();

        return redirect($this->redirectTo)->with('success', 'Nowa strona dodana');
    }

    public function edit($id)
    {
        $menu = Menu::where('id', $id)->first();
        $selectMenu = Menu::where('id', '!=' , $id)->pluck('nazwa', 'id');
        return view('admin.menu.form',
            [
                'entry' => $menu,
                'selectMenu' => $selectMenu,
                'cardtitle' => 'Edytuj stronę'
            ]
        );
    }

    public function update(StoreMenu $request, Menu $menu)
    {
        $menu->update($request->only(
            [
                'nazwa',
                'menu',
                'id_parent',
                'meta_tytul',
                'meta_opis',
                'tekst',
                'slug'
            ]
        ));

        $uri = Menu::urigenerate($menu->id);
        $menu->uri = $uri;
        $menu->save();

        return redirect($this->redirectTo)->with('success', 'Strona zaktualizowana');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return response()->json(['success' => 'Strona usnięta']);
    }
}
