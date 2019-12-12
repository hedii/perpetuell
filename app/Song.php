<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Song extends Model
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

        static::deleted(function (Song $song) {
            Storage::disk('public')->delete([$song->image, $song->video]);
        });
    }

    /**
     * Get the user that owns the song.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the tracks for the song.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tracks(): HasMany
    {
        return $this->hasMany(Track::class);
    }

    /**
     * Get the song image full url.
     *
     * @return string
     */
    public function getImageUrlAttribute(): string
    {
        return Storage::url($this->image);
    }

    /**
     * Get the song video full url.
     *
     * @return string
     */
    public function getVideoUrlAttribute(): string
    {
        return Storage::url($this->video);
    }
}
