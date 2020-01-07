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
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Inline $inline)
    {
        if($inline)
        {
            return response()->json($inline);
        } else {
            return response()->json([
                'error' => 'Brak wpisu w bazie',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inline  $inline
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Inline $inline)
    {
        if ($request->ajax()) {
            $inline->fill($request->all());
            $inline->save();

            if ($request->hasFile('obrazek')) {
                $inline->makeImg($request->obrazek_alt, $request->file('obrazek'), $request->obrazek_width, $request->obrazek_height);
            }

            return response()->json([
                'status' => 'success',
                'item' => $inline->id,
                'items' =>  array_filter($inline->toArray())
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
