<?php

namespace App\Jobs;

use App\Track;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;

class OptimizeTrackImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The track instance.
     *
     * @var \App\Track
     */
    private $track;

    /**
     * Create a new job instance.
     *
     * @param \App\Track $track
     */
    public function __construct(Track $track)
    {
        $this->track = $track->withoutRelations();
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
            Image::load(Storage::disk('local')->path($this->track->image))
                ->fit(Manipulations::FIT_CONTAIN, 1680, 9999)
                ->optimize()
                ->save();

            // copy image from local disk to cloud disk
            Storage::writeStream(
                $this->track->image,
                Storage::disk('local')->readStream($this->track->image)
            );

            // delete image from local disk
            Storage::disk('local')->delete($this->track->image);
        } catch (InvalidManipulation $exception) {
            unset($exception);
        }
    }
}
