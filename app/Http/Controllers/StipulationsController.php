<?php

namespace App\Http\Controllers;

use App\Stipulation;
use Illuminate\Http\Request;

class StipulationsController extends Controller
{
    /**
     * Display a listing of all the stipulations.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stipulations = Stipulation::all();

        if ($this->wantsJson() || $this->ajax()) {
            return response()->json($stipulations);
        }

        return response()->view('stipulations.index', ['stipulations' => $stipulations]);
    }

    /**
     * Show the form for adding a new stipulation.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('stipulations.create', ['stipulation' => new Stipulation]);
    }

    /**
     * Store a newly added stipulation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:stipulations,name',
            'slug' => 'required|unique:stipulations,slug'
        ]);

        $stipulation = Stipulation::create([
            'name' => request('name'),
            'slug' => request('slug')
        ]);

        if ($this->wantsJson() || $this->ajax()) {
            return response()->json($stipulation);
        }

        return redirect(route('stipulations.index'));
    }

    /**
     * Display the stipulation.
     *
     * @param  Stipulation $stipulation
     * @return \Illuminate\Http\Response
     */
    public function show(Stipulation $stipulation)
    {
        if ($this->wantsJson() || $this->ajax()) {
            return response()->json($stipulation);
        }

        return response()->view('stipulations.show', ['stipulation' => $stipulation]);
    }

    /**
     * Show the form for editing a stipulation.
     *
     * @param  Stipulation  $stipulation
     * @return \Illuminate\Http\Response
     */
    public function edit(Stipulation $stipulation)
    {
        return response()->view('stipulations.edit', ['stipulation' => $stipulation]);
    }

    /**
     * Update the specified stipulation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Stipulation $stipulation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stipulation $stipulation)
    {
        dd($stipulation);
        $this->validate($request, [
            'name' => 'required|unique:stipulations,name,except,id',
            'slug' => 'required|unique:stipulations,slug,except,id'
        ]);

        $stipulation->update([
            'name' => request('name'),
            'slug' => request('slug')
        ]);

        if ($this->wantsJson() || $this->ajax()) {
            return response()->json($stipulation);
        }

        return redirect(route('stipulations.index'));
    }

    /**
     * Remove the specified stipulation.
     *
     * @param  Stipulation $stipulation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stipulation $stipulation)
    {
        $stipulation->delete();
        return redirect(route('stipulations.index'));
    }
}
