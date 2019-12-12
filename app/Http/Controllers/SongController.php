<?php

namespace App\Http\Controllers;

use App\Song;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $songs = Song::with(['tracks' => function ($query) {
            $query->orderBy('order');
        }])->latest()->get();

        return view('front.pages.songs.index', compact('songs'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Song $song
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        $song->load(['tracks' => function ($query) {
            $query->orderBy('order');
        }]);

        return view('front.pages.songs.show', compact('song'));
    }
}
