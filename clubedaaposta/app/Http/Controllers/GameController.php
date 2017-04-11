<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Championship;
use App\Models\Team;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{

    protected function validator(array $data){

        $messages = [
            'home_team_id.required' => 'Escolha o time da casa.',
            'away_team_id.required' => 'Escolha o time visitante.',
            'home_goals.required' => 'Informe os gols do time da casa.',
            'away_goals.required' => 'Informe os gols do time visitante.'            
        ];

        return Validator::make($data, [
            'home_team_id' => 'required',            
            'away_team_id' => 'required',
            'home_goals' => 'required',
            'away_goals' => 'required',
        ], $messages);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();

        return view('game.index')->with(compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        
        
        $championships = Championship::all();
        $teams = Team::all();


        return view('game.create')->with(compact('championships', 'teams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        

        $validator = $this->validator($request->all());

        if ($validator->fails() ) {

            $championships = Championship::all();
            $teams = Team::all();

            return view('game.create')->with(compact('championships', 'teams'))
                                      ->withErrors($validator);            
        }      

        $championship = Championship::find($request->championshipId);
        $homeTeam = Team::find($request->home_team_id);
        $awayTeam = Team::find($request->away_team_id);
        $errorMsg = null;

        if (!is_null($championship) && !is_null($homeTeam) && !is_null($awayTeam) ){  

            if ($homeTeam->id == $awayTeam->id){                
                $errorMsg = 'Os times devem ser diferentes um do outro'; 
            }          

            if (is_null($errorMsg)) {



                $game = new Game;
                $game->championship()->associate($championship);
                $game->homeTeam()->associate($homeTeam);
                $game->awayTeam()->associate($awayTeam);
                $game->home_goals = $request->home_goals;
                $game->away_goals = $request->away_goals;

                $game->save();

                return \Redirect::route('games.index');   

            }

            

        }else{
            $errorMsg = 'Erro de integridade de dados - Contate o administrador'; 
        }



        $championships = Championship::all();
        $teams = Team::all();  

        

        
        return view('game.create')->with(compact('championships', 'teams'))
                                  ->with($request->all())
                                  ->withErrors(['error' => $errorMsg]);

            
        

        

        
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
        $game = Game::find($id);

        $championships = Championship::all();
        $teams = Team::all();  


        if (!is_null($game)){
            return view('game.edit')->with(compact('game', 'championships', 'teams'));
        }
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

        $validator = $this->validator($request->all());

        if ($validator->fails() ) {

            $championships = Championship::all();
            $teams = Team::all();

            return view('game.create')->with(compact('championships', 'teams'))
                                      ->withErrors($validator);            
        }      

        $championship = Championship::find($request->championship_id);
        $homeTeam = Team::find($request->home_team_id);
        $awayTeam = Team::find($request->away_team_id);
        $errorMsg = null;

        if (!is_null($championship) && !is_null($homeTeam) && !is_null($awayTeam) ){  

            if ($homeTeam->id == $awayTeam->id){                
                $errorMsg = 'Os times devem ser diferentes um do outro'; 
            }          

            if (is_null($errorMsg)) {



                $game = Game::find($id);
                $game->championship()->associate($championship);
                $game->homeTeam()->associate($homeTeam);
                $game->awayTeam()->associate($awayTeam);
                $game->home_goals = $request->home_goals;
                $game->away_goals = $request->away_goals;

                $game->save();

                return \Redirect::route('games.index');   

            }

            

        }else{
            $errorMsg = 'Erro de integridade de dados - Contate o administrador'; 
        }



        $championships = Championship::all();
        $teams = Team::all();  

        

        
        return view('game.create')->with(compact('championships', 'teams'))
                                  ->with($request->all())
                                  ->withErrors(['error' => $errorMsg]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $game = Game::find($id);

        if (!is_null($game)){

            $game->delete();

            return \Redirect::route('games.index');

        }
    }
}
