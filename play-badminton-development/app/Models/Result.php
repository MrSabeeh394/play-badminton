<?php

namespace App\Models;
use App\Models\Team;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['match_id', 'team1_id', 'team2_id', 'score_team1', 'score_team2', 'is_final'];
    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }

}
