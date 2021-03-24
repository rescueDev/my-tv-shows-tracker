<?php

namespace App\Http\Controllers;

use App\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = Show::all();
        return view('progress', compact('shows'));
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
        // dd(Auth::user());
        $request->validate([
            'name' => 'required|string|unique:shows',
            'overview' => 'required',
            'first_air_date' => 'required|date',
            'vote_average' => 'required|integer',
            'original_language' => 'required|string',
            'user_id' => 'required|integer',
        ]);

        $show = new Show;
        $show->name = $request->name;
        $show->overview = $request->overview;
        $show->first_air_date = $request->first_air_date;
        $show->vote_average = $request->vote_average;
        $show->original_language = $request->original_language;
        $show->user_id = $request->user_id;

        $show->save();
        dd($show);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function show(Show $show)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function edit(Show $show)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Show $show)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function destroy(Show $show)
    {
        //
    }
}
