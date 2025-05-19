<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'level',
        'team_type',
        'max_teams',
        'points',
        'event_type',
        'event_detail',
        'shuttle_type',
        'date',
        'location',
        'team_id',
        'complete_results',
    ];

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'event_teams');
    }
}

