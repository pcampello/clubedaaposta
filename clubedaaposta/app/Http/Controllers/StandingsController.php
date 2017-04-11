<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Championship;
use App\Models\Game;
use App\Models\Standings;

class StandingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($championshipId = null)
    {

        if (is_null($championshipId)) {

            $championships = Championship::all();

            return view('standings.index')->with(compact('championships'));

        }else{

            Standings::truncate();

            $championship = Championship::find($championshipId);
            $games = $championship->games;

            

            foreach($games as $game){                

                $homePts = 0;
                $homeWins = 0;
                $homeLoses = 0;
                $homeDraw = 0;

                $awayPts = 0;
                $awayWins = 0;
                $awayLoses = 0;
                $awayDraw = 0;


                if ($game->home_goals > $game->away_goals){
                    $homePts = 3;
                    $awayPts = 0; 

                    $homeWins = 1;
                    $awayWins = 0;

                    $homeLoses = 0;
                    $awayLoses = 1;

                    $homeDraw = 0;
                    $awayDraw = 0;


                }elseif($game->home_goals < $game->away_goals){
                    $awayPts = 3;
                    $homePts = 0;

                    $awayWins = 1;
                    $homeWins = 0;

                    $awayLoses = 0;
                    $homeLoses = 1;

                    $awayDraw = 0;
                    $homeDraw = 0;
                }else{

                    $homePts = 1;
                    $awayPts = 1; 

                    $homeWins = 0;
                    $awayWins = 0;

                    $homeLoses = 0;
                    $awayLoses = 0;

                    $homeDraw = 1;
                    $awayDraw = 1;

                }


                $homeStandings = Standings::firstOrNew([ 
                    'team_id' => $game->homeTeam->id, 
                    'championship_id' => $game->championship->id ]
                );

                $homeStandings->qty_games++;
                $homeStandings->pts += $homePts;
                $homeStandings->qty_wins += $homeWins; 
                $homeStandings->qty_loses += $homeLoses;
                $homeStandings->qty_draw += $homeDraw;                
                $homeStandings->save();

                //dd($homeStandings);



                $awayStandings = Standings::firstOrNew([ 
                    'team_id' => $game->awayTeam->id, 
                    'championship_id' => $game->championship->id ]
                );

                $awayStandings->qty_games++;
                $awayStandings->pts += $awayPts;
                $awayStandings->qty_wins += $awayWins; 
                $awayStandings->qty_loses += $awayLoses;
                $awayStandings->qty_draw += $awayDraw;
                $awayStandings->save();             

            } 

            

            $stds = Standings::orderBy('pts', 'desc')->get();
            $pos = 1;
            foreach($stds as $standing){
                $standing->pos = $pos;
                $standing->save();
                $pos++;

            }

            

            



            $standings = Standings::has('championship')->find($championshipId)->orderBy('pos')->get();

            //dd($standings);

            return view('standings.show')->with(compact('standings'));

        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
        
}
