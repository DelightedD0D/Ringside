<?php

namespace App\Http\Controllers;

use App\Arena;
use Illuminate\Http\Request;

class ArenasController extends Controller
{
    /**
     * Display a listing of all the arenas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arenas = Arena::all();

        return view('arenas.index', ['arenas' => $arenas]);
    }

    /**
     * Show the form for adding an arena.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('arenas.create', ['arena' => new Arena]);
    }

    /**
     * Store a newly added arena.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  Arena $arena
     * @return \Illuminate\Http\Response
     */
    public function show(Arena $arena)
    {
        return view('arenas.show', ['arena' => $arena]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
