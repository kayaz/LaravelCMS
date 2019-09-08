<?php

namespace App\Http\Controllers\Admin;

use App\Investments;
use App\Http\Requests\StoreInvestment;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class InvestmentsController extends Controller
{

    protected $redirectTo = 'admin/inwestycja';

    public function index()
    {
        $investment = Investments::all()->sortBy("sort");
        return view('investments.index', ['list' => $investment]);
    }

    public function create()
    {
        return view('investments.inwestycja-form',
            [
                'cardtitle' => 'Dodaj inwestycje',
                'logowidth' => Investments::LOGO_WIDTH,
                'logoheight' => Investments::LOGO_HEIGHT,
                'thumbwidth' => Investments::THUMB_WIDTH,
                'thumbheight' => Investments::THUMB_HEIGHT,
            ])
            ->with('investment', Investments::make());
    }

    public function store(StoreInvestment $request)
    {
        $investment = Investments::create($request->merge(['slug' => Str::slug($request->nazwa)])->only(
            [
                'typ',
                'status',
                'nazwa',
                'slug',
                'meta_tytul',
                'meta_opis',
                'email',
                'telefon',
                'adres',
                'biuro',
                'tekst',
                'lista'
            ]
        ));

        if ($request->hasFile('logo')) {
            $investment->makeLogo($request->nazwa, $request->file('logo'));
        }

        if ($request->hasFile('miniaturka')) {
            $investment->makeThumb($request->nazwa, $request->file('miniaturka'));
        }
        return redirect($this->redirectTo)->with('success', 'Nowa inwestycja dodana');
    }

    public function edit($id)
    {
        $investment = Investments::where('id', $id)->first();
        return view('investments.inwestycja-form',
             [
                'investment' => $investment,
                'cardtitle' => '',
                'logowidth' => Investments::LOGO_WIDTH,
                'logoheight' => Investments::LOGO_HEIGHT,
                'thumbwidth' => Investments::THUMB_WIDTH,
                'thumbheight' => Investments::THUMB_HEIGHT,
             ]
        );
    }

    public function update(StoreInvestment $request, Investments $investment)
    {
        $investment->update($request->merge(['slug' => Str::slug($request->nazwa)])->only(
            [
                'typ',
                'status',
                'nazwa',
                'slug',
                'meta_tytul',
                'meta_opis',
                'email',
                'telefon',
                'adres',
                'biuro',
                'tekst',
                'lista'
            ]
        ));

        // Upload logo
        if ($request->hasFile('logo')) {
            $investment->makeLogo($request->nazwa, $request->file('logo'));
        }

        // Upload thumb
        if ($request->hasFile('miniaturka')) {
            $investment->makeThumb($request->nazwa, $request->file('miniaturka'));
        }
        return redirect($this->redirectTo)->with('success', 'Inwestycja zaktualizowana');
    }

    public function destroy(Investments $investment)
    {
        //
    }
}
