<?php

namespace App\Services\Audio;

use App\Services\Audio\Exceptions\AudioFileDurationException;

class AudioDuration
{
    /**
     * Get the duration of an audio file, in seconds.
     *
     * @param string $audioPath
     * @return int
     * @throws \App\Services\Audio\Exceptions\AudioFileDurationException
     */
    public static function get(string $audioPath): int
    {
        $info = shell_exec("ffmpeg -i {$audioPath} 2>&1");

        if (preg_match("/: Invalid /", $info)) {
            throw new AudioFileDurationException('Cannot get audio file duration');
        }

        preg_match("/Duration: (.{2}):(.{2}):(.{2})/", $info, $duration);

        if (! isset($duration[1])) {
            throw new AudioFileDurationException('Cannot get audio file duration');
        }

        $hours = $duration[1];
        $minutes = $duration[2];
        $seconds = $duration[3];

        return $seconds + ($minutes * 60) + ($hours * 60 * 60);
    }
}
