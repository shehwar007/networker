<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {

            Team::create(['title' => $request->title]);
            session()->flash("alert-message", "Great! Team Added Successfully");
            session()->flash("alert", "success");
        } catch (\Exception $ex) {
            session()->flash("alert-message", "Oh snap! Some thing went Wrong");
            session()->flash("alert", "danger");
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
        return $team;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        try {
            $data = $request->only('title');
            $team->update($data);
            session()->flash("alert-message", "Great! Team Update Successfully");
            session()->flash("alert", "success");
        } catch (\Exception $ex) {

            session()->flash("alert-message", "Oh snap! Some thing went Wrong");
            session()->flash("alert", "danger");
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
        try {
            $team->delete();
            session()->flash("alert-message", "Great! Team Delete Successfully");
            session()->flash("alert", "success");
        } catch (\Exception $ex) {

            session()->flash("alert-message", "Oh snap! Some thing went Wrong");
            session()->flash("alert", "danger");
        }
        return back();
      
    }
}
