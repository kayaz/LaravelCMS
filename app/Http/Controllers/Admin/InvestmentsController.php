<?php

namespace App\Http\Controllers\Admin;

use App\Investment;
use App\Http\Requests\StoreInvestment;

use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class InvestmentsController extends Controller
{

    protected $redirectTo = 'admin/investments';

    public function index()
    {
        return view('investments.index', ['list' => Investment::all()->sortBy("sort")]);
    }

    public function create()
    {
        return view('investments.inwestycja-form', [
                'cardtitle' => 'Dodaj inwestycje',
                'logowidth' => Investment::LOGO_WIDTH,
                'logoheight' => Investment::LOGO_HEIGHT,
                'thumbwidth' => Investment::THUMB_WIDTH,
                'thumbheight' => Investment::THUMB_HEIGHT,
            ])
            ->with('investment', Investment::make());
    }

    public function store(StoreInvestment $request)
    {
        $investment = Investment::create($request->only(
            [
                'typ',
                'status',
                'name',
                'slug',
                'meta_title',
                'meta_description',
                'email',
                'phone',
                'address',
                'office',
                'content',
                'content_list'
            ]
        ));

        if ($request->hasFile('logo')) {
            $investment->makeLogo($request->name, $request->file('logo'));
        }

        if ($request->hasFile('thumb')) {
            $investment->makeThumb($request->name, $request->file('thumb'));
        }
        return redirect($this->redirectTo)->with('success', 'Nowa inwestycja dodana');
    }

    public function edit($id)
    {
        $investment = Investment::where('id', $id)->first();
        return view('investments.inwestycja-form', [
                'investment' => $investment,
                'cardtitle' => '',
                'logowidth' => Investment::LOGO_WIDTH,
                'logoheight' => Investment::LOGO_HEIGHT,
                'thumbwidth' => Investment::THUMB_WIDTH,
                'thumbheight' => Investment::THUMB_HEIGHT,
             ]);
    }

    public function update(StoreInvestment $request, Investment $investment)
    {
        $investment->update($request->only(
            [
                'typ',
                'status',
                'name',
                'slug',
                'meta_title',
                'meta_description',
                'email',
                'phone',
                'address',
                'office',
                'content',
                'content_list'
            ]
        ));

        // Upload logo
        if ($request->hasFile('logo')) {
            $investment->makeLogo($request->name, $request->file('logo'));
        }

        // Upload thumb
        if ($request->hasFile('thumb')) {
            $investment->makeThumb($request->name, $request->file('thumb'));
        }
        return redirect($this->redirectTo)->with('success', 'Inwestycja zaktualizowana');
    }

    public function destroy(Investment $investment)
    {
        //
    }
}
