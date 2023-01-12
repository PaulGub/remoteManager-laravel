<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BuildingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $actualUser =  Auth::user()->id;

        $users = User::find($actualUser);
        $niv =$users->is_admin;

        if($niv== 1){
            $buildings = Building::all();
            return view('buildings.index', compact('buildings'));
        }
        else{
            return redirect('/');
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buildings.form');
    }

    public function insert(Request $request)
    {




        $name = $request->input('name');
        $capacity = $request->input('capacity');

        $test = $request->validate([
            "name" => ["required", "unique:".Building::class],
            "capacity" => ["required"],
        ]);

            $data = array('name' => $name, "capacity" => $capacity);

            DB::table('buildings')->insert($data);
            return redirect('/buildings');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Building $building
     * @return \Illuminate\Http\Response
     */
    public function show(Building $building)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Building $building
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $building)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Building $building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $building = Building::find($id);
        return view('buildings.form', compact('building'));
    }

    public function updateBD(Request $request, $id)
    {
        $name = $request->input('name');
        $capacity = $request->input('capacity');

        $test = $request->validate([
            "name" => ["required"],
            "capacity" => ["required"],
        ]);
        $data = array('name' => $name, "capacity" => $capacity);
        DB::table('buildings')
            ->where('id', $id)
            ->update($data);
        return redirect('/buildings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Building $building
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('buildings')->delete($id);
        return redirect('/buildings');
    }
}
