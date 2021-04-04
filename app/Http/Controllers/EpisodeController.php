<?php

namespace App\Http\Controllers;

use App\Episode;
use App\Season;
use App\Show;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function show(Episode $episode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function edit(Episode $episode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $episode = Episode::findOrFail($id);

        //episode has been watched
        $episode->delete();

        //which season episode belongs?
        $season = $episode->season()->get();

        //which show season belongs?
        $show = $season[0]->show()->get();


        foreach ($season as $seas) {

            $epSeas = $seas->episodes()->get();

            //find all episodes to be watched yet
            $epTrashed = $epSeas->each(function ($ep) {
                return $ep->where('deleted_at', NULL);
            });

            //delete season when all episodes are watched
            if (count($epTrashed) === 0) {

                $seas->delete();

                //all seasons
                $allSeas = $show[0]->seasons()->get();

                //delete show if all seasons have been watched
                if (count($allSeas) === 0) {

                    $show[0]->delete();

                    return redirect('/progress');
                }
            }


//            }

        }

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Episode $episode)
    {
        //
    }
}
