<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;

class Standings extends Model
{


	protected $fillable = ['team_id', 'championship_id', 'pos', 'pts', 'qty_games', 'qty_wins', 'qty_loses', 'qty_draw'];

	
    public function team(){
    	return $this->belongsTo(Team::class);
    }

    public function championship(){
    	return $this->belongsTo(Championship::class);

    }
}
