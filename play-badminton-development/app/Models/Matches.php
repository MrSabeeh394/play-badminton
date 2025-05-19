<?php

namespace App\Models;
use App\Models\Team;
use App\Models\Event;

use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    protected $fillable = [
        'event_id',
        'team1_id',
        'team2_id',
        'type',
        'sets',
        'setting',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }


}
