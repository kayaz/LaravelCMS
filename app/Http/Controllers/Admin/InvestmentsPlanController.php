<?php

namespace App\Http\Controllers\Admin;

use App\Investment;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class InvestmentsPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Investment $investment)
    {
        return view('investments.plan', ['investment' => $investment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Investment $investment)
    {
        if ($request->hasFile('qqfile')) {
            $investment->uploadPlan($request->file('qqfile'));
        }
        return response()->json(['success' => true]);
    }
}
