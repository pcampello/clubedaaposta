<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [''];


    public function championship(){

    	return $this->belongsTo(Championship::class);
    }

    public function homeTeam(){
    	return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam(){
    	return $this->belongsTo(Team::class, 'away_team_id');
    }
}
