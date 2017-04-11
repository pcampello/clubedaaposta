<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Championship;
use Illuminate\Support\Facades\Validator;

class ChampionshipController extends Controller
{

    protected function validator(array $data){

        $messages = [
            'name.required' => 'O nome é um campo obrigatório.',
            'name.unique' => 'Campeonato já cadastrado'
        ];

        return Validator::make($data, [
            'name' => 'required|max:255|unique:championships',            
        ], $messages);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $championships = Championship::all();

        return view('championship.index')->with(compact('championships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        
        


        return view('championship.create');
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

            return view('championship.create')->withErrors($validator);            
        }

        Championship::create(['name' => $request->name]);       

        return \Redirect::route('championships.index');
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
        $championship = Championship::find($id);

        if (!is_null($championship)){
            return view('championship.edit')->with(compact('championship'));
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



        

        $championship = Championship::find($id);
        

        if (!is_null($championship)){


            $validator = $this->validator($request->all());

            if ($validator->fails() ) {

                return view('championship.edit')->withErrors($validator)->with(compact('championship'));            
            }





            $championship->name = $request->name;
            $championship->save();

            return \Redirect::route('championships.index');
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
        $championship = Championship::find($id);

        if (!is_null($championship)){

            $championship->delete();

            return \Redirect::route('championships.index');

        }
    }
}
