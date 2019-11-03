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
     * The "booting" method of the model.
     */
    public static function boot()
    {
        parent::boot();

        static::deleted(function (Track $song) {
            Storage::disk('public')->delete([$song->audio, $song->image]);
        });
    }

    /**
     * Get the song that owns the track.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function song(): BelongsTo
    {
        return $this->belongsTo(Song::class);
    }
}
