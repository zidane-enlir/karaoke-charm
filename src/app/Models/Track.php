<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'title', 'artist'
    ];

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Define a many-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function playlists()
    {
        return $this->belongsToMany('App\Models\Playlist')
                    ->withTimestamps();
    }

    /**
     * Define a one-to-one relationship.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function trackImage()
    {
        return $this->hasOne('App\Models\TrackImage');
    }
}
