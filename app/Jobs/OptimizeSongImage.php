<?php

namespace App\Jobs;

use App\Song;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;

class OptimizeSongImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The song instance.
     *
     * @var \App\Song
     */
    private $song;

    /**
     * Create a new job instance.
     *
     * @param \App\Song $song
     */
    public function __construct(Song $song)
    {
        $this->song = $song->withoutRelations();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            Image::load(Storage::disk('public')->path($this->song->image))
                ->fit(Manipulations::FIT_CONTAIN, 1080, 9999)
                ->optimize()
                ->save();
        } catch (InvalidManipulation $exception) {
            unset($exception);
        }
    }
}
