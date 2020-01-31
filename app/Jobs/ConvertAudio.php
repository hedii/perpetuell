<?php

namespace App\Jobs;

use App\Track;
use FFMpeg\Format\Audio\Mp3;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Pbmedia\LaravelFFMpeg\FFMpeg;

class ConvertAudio implements ShouldQueue
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
     * @param \Pbmedia\LaravelFFMpeg\FFMpeg $ffmpeg
     * @return void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \Illuminate\Contracts\Filesystem\FileExistsException
     */
    public function handle(FFMpeg $ffmpeg): void
    {
        $convertedAudioPath = 'converted/' . Str::before($this->track->audio, '.') . '.mp3';

        $media = $ffmpeg
            ->fromDisk('local')
            ->open($this->track->audio)
            ->export()
            ->toDisk('local')
            ->inFormat(
                (new Mp3())->setAudioKiloBitrate(96)
//                (new Mp3())->setAudioKiloBitrate(128)
            )
            ->save($convertedAudioPath);

        // delete raw audio file from local disk
        Storage::disk('local')->delete($this->track->audio);

        // update Track Model
        $this->track->update([
            'audio' => $convertedAudioPath,
            'duration' => $media->getDurationInSeconds()
        ]);

        // copy converted audio file from local disk to cloud disk
        Storage::writeStream(
            $convertedAudioPath,
            Storage::disk('local')->readStream($convertedAudioPath)
        );

        // delete converted audio file from local disk
        Storage::disk('local')->delete($convertedAudioPath);
    }
}
