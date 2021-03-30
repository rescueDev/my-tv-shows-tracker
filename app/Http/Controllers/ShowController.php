<?php

namespace App\Http\Controllers;

use App\Season;
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
        $userLogged = Auth::user()->id;
        $shows = Show::where('user_id', $userLogged)->get();
        // dd($shows);
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

        $seasons = $request->seasons;


        $request->validate([
            'name' => 'required|string|unique:shows,name',
            'overview' => 'required',
            'first_air_date' => 'required|date',
            'vote_average' => 'required',
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
        $show->poster = $request->poster_path;
        $show->status = $request->status;
        $show->season_count = $request->season_number;



        $show->save();


        foreach ($seasons as $key => $season) {


            $seas = new Season;

            $seas-> name = $season['name'];
            $seas-> overview = $season['overview'];
            $seas-> air_date = $season['air_date'];
            $seas-> episode_count = $season['episode_count'];
            $seas-> season_number = $season['season_number'];
            $seas-> poster_path = $season['poster_path'];
            $seas-> show_id = $show->id;
            $seas->save();

        }
        return response()->json('Season/s saved', 200);
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
