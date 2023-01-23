<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Presence;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class PresenceController extends Controller
{
    
    public function index()
    {

        $presence = Presence::all();
        $employee = Employee::all();
        return view('presence',['presence'=>$presence,'employee'=>$employee,'employee_count'=>$employee->count()]);
    }

   
    public function create()
    {
        //
    }
    
    public function store(Request $request)
    {
        $presence = new Presence();
        $presence->arrival_hour = $request->time;
        $presence->emplyee_id = $request->employee;

        if($request->date == null)
            $presence->created_at = Carbon::now();
        else
            $presence->created_at = $request->date;
        $presence->save();
        $presence = Presence::all();
        $employee = Employee::all();
    
        return view('presence',['presence'=>$presence,'employee'=>$employee]);

    }

   
    public function show(Presence $presence)
    {
        //
    }

   
    public function edit(Presence $presence)
    {
        //
    }

  
    public function update(Request $request, Presence $presence)
    {
        //
    }

  
    public function destroy($id)
    {
        $pres_to_delete = Presence::all()->find($id);
        $pres_to_delete->delete();
        return back()->with('success', 'Presence has been deleted successfully');
    }
}
