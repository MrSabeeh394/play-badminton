<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerTeam extends Model
{
    protected $fillable = [
        'player_id',
        'team_id',
    ];
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
    public function players()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }

}
