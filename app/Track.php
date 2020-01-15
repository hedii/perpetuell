<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Track extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the song that owns the track.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function song(): BelongsTo
    {
        return $this->belongsTo(Song::class);
    }

    /**
     * Get the track audio full url.
     *
     * @return string
     */
    public function getAudioUrlAttribute(): string
    {
        return Storage::url($this->audio);
    }

    /**
     * Get the track image full url.
     *
     * @return string
     */
    public function getImageUrlAttribute(): string
    {
        return Storage::url($this->image);
    }
}
