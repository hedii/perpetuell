<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Audio\AudioDuration;
use App\Song;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
        $songs = Auth::user()->songs()->latest()->paginate();

        return \view('admin.pages.songs.index', compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return \view('admin.pages.songs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     * @throws \App\Services\Audio\Exceptions\AudioFileDurationException
     */
    public function store(Request $request): RedirectResponse
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
            $track = $song->tracks()->create([
                'audio' => $request->file("track_audio_{$i}")->storeAs('audio', Str::random(40) . '.mp3', 'public'),
                'image' => $request->file("track_image_{$i}")->store('images', 'public'),
                'order' => $i,
            ]);

            $track->update(['duration' => AudioDuration::get(storage_path("app/public/{$track->audio}"))]);
        }

        return redirect(route('admin.songs.edit', $song))
            ->with('status', "Song #{$song->id} ({$song->name}) created");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Song $song
     * @return \Illuminate\View\View
     */
    public function edit(Song $song): View
    {
        $song->load(['tracks' => function ($query) {
            $query->orderBy('order');
        }]);

        return \view('admin.pages.songs.edit', compact('song'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Song $song
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Song $song): RedirectResponse
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

        return redirect(route('admin.songs.edit', $song))
            ->with('status', "Song #{$song->id} ({$song->name}) updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Song $song
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Song $song): RedirectResponse
    {
        $song->delete();

        return redirect(route('admin.songs.index'))
            ->with('status', "Song #{$song->id} ({$song->name}) deleted");
    }
}
