<?php

namespace App\Jobs;

use App\Song;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Pbmedia\LaravelFFMpeg\FFMpeg;

class ConvertVideo implements ShouldQueue
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
     * @param \Pbmedia\LaravelFFMpeg\FFMpeg $ffmpeg
     * @return void
     */
    public function handle(FFMpeg $ffmpeg): void
    {
        $convertedVideoPath = 'converted/' . Str::before($this->song->video, '.') . '.mp4';

        $ffmpeg
            ->fromDisk('public')
            ->open($this->song->video)
            ->export()
            ->toDisk('public')
            ->inFormat(
                (new X264('libmp3lame', 'libx264'))->setKiloBitrate(500)
            )
            ->save($convertedVideoPath);

        $this->song->update(['video' => $convertedVideoPath]);
    }
}
