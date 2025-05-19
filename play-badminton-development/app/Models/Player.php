<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'surname',
        'preferred_name',
        'year_of_birth',
        'email',
        'contact_number',
        'picture',
        'registered_with_badminton_england',
        'registration_number',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'date_of_birth' => 'datetime',
    ];

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'player_teams');
    }
    public function playerTeam()
    {
        return $this->hasMany(PlayerTeam::class);
    }


    // Define an accessor for the `picture` attribute
    public function getPictureAttribute($value)
    {
        if ($value) {
            return url('storage/' . $value);
        }
        return null;
    }


}
