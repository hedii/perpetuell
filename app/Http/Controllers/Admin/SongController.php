<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $songs = Auth::user()->songs()->latest()->paginate();

        return view('admin.pages.songs.index', compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.songs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'image' => 'required|image',
            'video' => 'required|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi',
        ];

        for ($i = 1; $i <= 8; $i++) {
            $rules["track_audio_{$i}"] = 'required|file|mimes:mpga';
            $rules["track_image_{$i}"] = 'required|image|mimes:png';
        }

        $this->validate($request, $rules);

        /** @var \App\Song $song */
        $song = $request->user()->songs()->create([
            'name' => $request->input('name'),
            'image' => $request->file('image')->store('images', 'public'),
            'video' => $request->file('video')->store('videos', 'public'),
            'is_published' => $request->input('is_published') ? true : false,
        ]);

        for ($i = 1; $i <= 8; $i++) {
            $song->tracks()->create([
                'audio' => $request->file("track_audio_{$i}")->store('audio', 'public'),
                'image' => $request->file("track_image_{$i}")->store('images', 'public'),
                'order' => $i,
            ]);
        }

        return redirect(route('admin.songs.edit', $song))
            ->with('status', "Song #{$song->id} ({$song->name}) created");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Song $song
     * @return \Illuminate\Http\Response
     */
    public function edit(Song $song)
    {
        $song->load(['tracks' => function ($query) {
            $query->orderBy('order');
        }]);

        return view('admin.pages.songs.edit', compact('song'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Song $song
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Song $song)
    {
        return redirect(route('admin.songs.edit', $song))
            ->with('status', "Song #{$song->id} ({$song->name}) updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Song $song
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Song $song)
    {
        $song->delete();

        return redirect(route('admin.songs.index'))
            ->with('status', "Song #{$song->id} ({$song->name}) deleted");
    }
}
