<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name'
    ];

    /**
     * Get the streams for the game.
     */
    public function streams(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Stream::class, 'game_id');
    }
}
