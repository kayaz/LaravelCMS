<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Inline;
use Illuminate\Http\Request;

class InlineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.inline.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inline  $inline
     * @return \Illuminate\Http\Response
     */
    public function show(Inline $inline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inline  $inline
     * @return \Illuminate\Http\Response
     */
    public function edit(Inline $inline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inline  $inline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inline $inline)
    {
        if ($request->ajax()) {
            $inline->fill($request->all());
            $saved = $inline->save();
        }
        if(!$saved){

        } else {
            return response()->json([
                'status' => 'success',
                'item' => $inline->id,
                'items' =>  array_filter($request->all())
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inline  $inline
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inline $inline)
    {
        //
    }
}
