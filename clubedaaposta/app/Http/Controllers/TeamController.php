<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{

    protected function validator(array $data){

        $messages = [
            'name.required' => 'O nome é um campo obrigatório.',
            'name.unique' => 'Time já cadastrado'
        ];

        return Validator::make($data, [
            'name' => 'required|max:255|unique:teams', ], $messages);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();

        return view('team.index')->with(compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        
        


        return view('team.create');
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

            return view('team.create')->withErrors($validator);            
        }

        Team::create(['name' => $request->name]);       

        return \Redirect::route('teams.index');
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
        $team = Team::find($id);

        if (!is_null($team)){
            return view('team.edit')->with(compact('team'));
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



        

        $team = Team::find($id);
        

        if (!is_null($team)){


            $validator = $this->validator($request->all());

            if ($validator->fails() ) {

                return view('team.edit')->withErrors($validator)->with(compact('team'));            
            }





            $team->name = $request->name;
            $team->save();

            return \Redirect::route('teams.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Team::find($id);

        if (!is_null($team)){

            $team->delete();

            return \Redirect::route('teams.index');

        }
    }
}
