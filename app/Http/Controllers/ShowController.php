<?php

namespace App\Http\Controllers;

use App\Episode;
use App\Season;
use App\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


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
        return view('progress', compact('shows'));
    }

    public function watched()
    {
        $watched = Show::onlyTrashed()->get();
        return view('watched', compact('watched'));
    }

    public function showWatched($id)
    {
        $show = Show::withTrashed()->findOrFail($id);
        $seasons = $show->seasons()->withTrashed()->get();
        $seasonsWatched = [];
        foreach ($seasons as $key=>$season) {
//            $episodes = Episode::onlyTrashed()->where('season_id', $season->id)->get();
//                $seasonsWatched[] = $season->episodes()->withTrashed()->get();
                $episodes = $season->episodes()->withTrashed()->where('season_id', $season->id)->get();
            $season->episodes()->saveMany($episodes);
//                $season['episodes'] = $episodes;

        }
        collect($seasonsWatched);

        return view('show-watched', compact('show', 'seasonsWatched', 'seasons'));
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
        $episodes = $request->episodes;
        $userLogged = Auth::user()->id;

        $request->validate([
            'name' => ['required', 'string', Rule::unique('shows')->where('user_id', $userLogged )],
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
        $show->user_id = $userLogged;
        $show->poster = $request->poster_path;
        $show->status = $request->status;
        $show->season_count = $request->season_number;
        $show->backdrop_path = $request->backdrop_path;

        $show->save();


        foreach ($episodes as $key => $episode) {

            $seas = new Season;

            $seas-> name = $episode['name'];
            $seas-> overview = $episode['overview'];
            $seas-> air_date = $episode['air_date'];
            $seas-> episode_count = count($episode['episodes']);
            $seas-> season_number = $episode['season_number'];
            $seas-> poster_path = $episode['poster_path'];
            $seas-> show_id = $show->id;

            $seas->save();


            foreach ($episode['episodes'] as $epSeas) {

                $ep = new Episode;
                $ep->name = $epSeas['name'];
                $ep->overview = $epSeas['overview'];
                $ep->season_number = $epSeas['season_number'];
                $ep->first_air_date = $epSeas['air_date'];
                $ep->episode_number = $epSeas['episode_number'];
                $ep->rating = $epSeas['vote_average'];
                $ep->image = $epSeas['still_path'];
                $ep->season_id = $seas->id;
                $ep->save();


            }
        }

        return response()->json('added', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = Show::withTrashed()->findOrFail($id);
        return view('show-serie', compact('show'));
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
    public function update($id)
    {
        // update show to watched
        $show = Show::findOrFail($id);

        $seasons = $show->seasons()->get();

        foreach ($seasons as $season) {
            $episodes = $season->episodes()->get();


            $episodes->each(function ($ep) {
                return $ep->delete();
            });


            $season->delete();

            $show->delete();
        }


        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //remove show from progress
        $show = Show::findOrFail($id);
        $show->forceDelete();
        $show->seasons()->forceDelete();
        return redirect()->back();
    }
}
