<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'id', 'title', 'viewer_count', 'started_at'
    ];

    /**
     * Get the game associated with the stream.
     */
    public function game(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Game::class, 'game_id');
    }


    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'streams_tags'

        );
    }
}
