<?php

namespace App\Http\Controllers;

use App\Song;
use Illuminate\View\View;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
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
     * @return \Illuminate\View\View
     */
    public function show(Song $song): View
    {
        $song->load(['tracks' => function ($query) {
            $query->orderBy('order');
        }]);

        return view('front.pages.songs.show', compact('song'));
    }
}
