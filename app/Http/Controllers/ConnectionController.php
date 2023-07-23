<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConnectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //for the model dropdown
        $connection_types = DB::table('connection_types')->select('id', 'connection_type')->get();
        $activities = DB::table('activities')->select('id', 'activity')->get();
        $connection_helps = DB::table('connection_helps')->select('id', 'connection_help')->get();

        

        //for the table dropdown
        $connection = Connection::select('*')->where('status', 0)->get();

        $tooltip['shehwar'] = "shehwar1";
        $tooltip['shehwar2'] = "shehwar2";

        return view('active_connection', compact('tooltip', 'connection', 'connection_types', 'activities', 'connection_helps'));
    }

    public function indexParkedConnection()
    {
          //for the model dropdown
          $connection_types = DB::table('connection_types')->select('id', 'connection_type')->get();
          $activities = DB::table('activities')->select('id', 'activity')->get();
          $connection_helps = DB::table('connection_helps')->select('id', 'connection_help')->get();
  
          //for the table dropdown
          $connection = Connection::select('*')->where('status', 1)->get();
  
          $tooltip['shehwar'] = "shehwar1";
          $tooltip['shehwar2'] = "shehwar2";
  
          return view('parked_connection', compact('tooltip', 'connection', 'connection_types', 'activities', 'connection_helps'));
       
    }

    public function indexDashboard()
    {
      
        $connection = Connection::get();
        $main=$connection->where('status',0)->count();
        $park=$connection->where('status',1)->count();
        $user=User::count();
       
        return view('dashboard',compact('main','park','user'));
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
        try {

            $data = $request->only(['connection_name', 'connection_type_id', 'date_of_last_contact', 'is_individual', 'activity_id', 'connection_help_id', 'notes']);
            Connection::create($data);
            session()->flash("alert-message", "Great! Connection Added Successfully");
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
     * @param  \App\Models\Connection  $connection
     * @return \Illuminate\Http\Response
     */
    public function show(Connection $connection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Connection  $connection
     * @return \Illuminate\Http\Response
     */
    public function edit(Connection $connection)
    {
        //
        return $connection;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Connection  $connection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Connection $connection)
    {
        //
        // dd($request->all(),$connection);
        try {
            $data = $request->only(['connection_name', 'connection_type_id', 'date_of_last_contact', 'is_individual', 'activity_id', 'connection_help_id', 'notes']);
            $connection->update($data);
            session()->flash("alert-message", "Great! Connection Update Successfully");
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
     * @param  \App\Models\Connection  $connection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Connection $connection)
    {
        $connection->delete();
    }

    public function ActionConnection(Request $request)
    {
        try {
            $connection = Connection::find($request->id);

            if ($request->park) {
                $connection->status = 1;
                $connection->save();
                session()->flash("alert-message", "Great! Connection Park Successfully");
            }
            if ($request->unpark) {
                $connection->status = 0;
                $connection->save();
                session()->flash("alert-message", "Great! Connection UnPark Successfully");
            }
            if ($request->duplicate) {

                $connection = $connection->replicate();
                $connection->save();
                session()->flash("alert-message", "Great! Connection Duplicate Successfully");
            }
            if ($request->delete) {
                $connection->delete();
                session()->flash("alert-message", "Great! Connection Delete Successfully");
            }
            session()->flash("alert", "success");
        } catch (\Exception $ex) {

            session()->flash("alert-message", "Oh snap! Some thing went Wrong");
            session()->flash("alert", "danger");
        }

        try{

        }catch(\Exception $ex){

        }

        return back();
    }
}
