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
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \Illuminate\Contracts\Filesystem\FileExistsException
     */
    public function handle(): void
    {
        try {
            Image::load(Storage::disk('local')->path($this->song->image))
                ->fit(Manipulations::FIT_CONTAIN, 1080, 9999)
                ->optimize()
                ->save();

            // copy image from local disk to cloud disk
            Storage::disk('s3')->writeStream(
                $this->song->image,
                Storage::disk('local')->readStream($this->song->image)
            );

            // delete image from local disk
            Storage::disk('local')->delete($this->song->image);
        } catch (InvalidManipulation $exception) {
            unset($exception);
        }
    }
}
