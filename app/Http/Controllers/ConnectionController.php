<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ConnectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    

        if(session('adminData')['role']==1){
            $connection = Connection::select('*')->latest()->where('status', 0)->get();
        }else{
            $connection = Connection::select('*')->latest()->where('user_id',session('adminData')['id'])->where('status', 0)->get();
        }        

        return view('active_connection', compact('connection'));
    }

    public function indexParkedConnection()
    {
        //for the model dropdown
        $connection_types = DB::table('connection_types')->select('id', 'connection_type')->get();
        $activities = DB::table('activities')->select('id', 'activity')->get();
        $connection_helps = DB::table('connection_helps')->select('id', 'connection_help')->get();

        //for the table dropdown
        $connection = Connection::select('*')->where('status', 1)->get();

       

        return view('parked_connection', compact('connection', 'connection_types', 'activities', 'connection_helps'));
    }

    // public function indexDashboard()
    // {

    //     $connection = Connection::get();
    //     $main = $connection->where('status', 0)->count();
    //     $park = $connection->where('status', 1)->count();
    //     $user = User::count();

    //     return view('dashboard', compact('main', 'park', 'user'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $connection_types = DB::table('connection_types')->select('id', 'connection_type')->get();
        $activities = DB::table('activities')->select('id', 'activity')->get();
        $connection_helps = DB::table('connection_helps')->select('id', 'connection_help')->get();
       
       return view('create',compact('connection_types','activities','connection_helps'));
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
            $data['user_id']= session('adminData')['id'];
            Connection::create($data);
            session()->flash("alert-message", "Great! Connection Added Successfully");
            session()->flash("alert", "success");
        } catch (\Exception $ex) {

            session()->flash("alert-message", "Oh snap! Some thing went Wrong");
            session()->flash("alert", "danger");
        }


        return back();
    }

    public function ConnectionMemberStore(Request $request)
    {
         
         DB::table('connection_teams')->insert([
            'connection_id' => $request->member_update_id,
             'member_id' => $request->member_id,
             'team_id' =>  $request->team_id,
          ]);
          session()->flash("alert-message", "Great! Connection Added Successfully");
          session()->flash("alert", "success");
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
      

        $connection_types = DB::table('connection_types')->select('id', 'connection_type')->get();
        $activities = DB::table('activities')->select('id', 'activity')->get();
        $connection_helps = DB::table('connection_helps')->select('id', 'connection_help')->get();
 
        $notIn=Member::distinct()->pluck('member_id');
       

        if(session('adminData')['role']==1){
              
            $member = Connection::select('id','connection_name')->latest()->where('is_individual',1)->whereNotIn('id',$notIn)->get();
        }else{
            $member = Connection::select('id','connection_name')->latest()->where('is_individual',1)->whereNotIn('id',$notIn)->where('user_id',session('adminData')['id'])->get();
        }
       

        $team = DB::table('teams')->select('id', 'title')->get();

       

         $selected_dropdown= DB::table('connection_teams')->where('connection_id',$connection->id)->get();
         
          $member_table=Member::where('connection_id',$connection->id)->get();
        
        // //   dd($d->team_data->title);
        //   dd($d->member_data->connection_name);

       return view('edit',compact('member_table','connection','connection_types','activities','connection_helps','member','team','selected_dropdown'));
     




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
            $data['user_id']= session('adminData')['id'];
            $connection->update($data);

            // DB::table('connection_teams')->where('connection_id',$connection->id)->delete();
            
            // foreach($request->connection_teams as $data){
                
            //     DB::table('connection_teams')->insert([
            //      'connection_id' => $connection->id,
            //       'member_id' => $data['member_id'],
            //       'team_id' => $data['team_id'],
            //    ]);
            // }
           
            
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

    public function DeleteMember($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        session()->flash("alert-message", "Great! Member Delete Successfully");
        session()->flash("alert", "success");
        return back();
    
    }

    public function ActionConnection(Request $request)
    {
        try {
            $connection = Connection::find($request->id);

            if ($request->park) {
                $connection->status = 1;
                $connection->save();
                session()->flash("alert-message", "Great! Connection Parked Successfully");
            }
            if ($request->unpark) {
                $connection->status = 0;
                $connection->save();
                session()->flash("alert-message", "Great! Connection UnParked Successfully");
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

        try {
        } catch (\Exception $ex) {
        }

        return back();
    }
}
