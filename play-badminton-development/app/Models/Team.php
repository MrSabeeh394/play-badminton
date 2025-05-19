<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function players()
    {
        return $this->belongsToMany(Player::class, 'player_teams');
    }
    // public function players()
    // {
    //     return $this->belongsToMany(Player::class, 'player_team', 'team_id', 'player_id');
    // }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_teams');
    }
}

