<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Presence;
use Illuminate\Http\Request;

class StatsController extends Controller
{
   
    public function index()
    {
        
    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        $employee = Employee::all()->find($id);

        $presence = Presence::all()->where('emplyee_id',$id);
        $result = array();
        $weeks = array();
        $total = 0;
       if(!is_null($presence)){
        foreach($presence as $pres){
             if($pres->created_at->format('l') == "Monday"){
                 
             }
         $date = $pres->created_at;
            $total = $this->calculate($pres->arrival_hour);
         
            $result[date_format($date,"l")] = $total;
         }
         return view('stats',['employee'=>$employee,'late'=>$total,'data'=>$result]);
       }
        $employees = Employee::all();
        return view('all_employees',['employees'=> $employees]);
    }

    private function calculate($mystr){
        $total_late_minute = 0;
        switch(substr($mystr,0,2)) {
            case "09":  $total_late_minute = $total_late_minute + (int)substr($mystr,3,2); 
                break;
            case "10":  
                $total_late_minute = $total_late_minute + (int)substr($mystr,3,2)+60; 
                break;
            case "11":  
                $total_late_minute = $total_late_minute + (int)substr($mystr,3,2)+120; 
                break;
            case "12":  
                $total_late_minute = $total_late_minute + (int)substr($mystr,3,2)+180; 
                break;
            // case "14":  
            //     $total_late_minute = $total_late_minute + (int)substr($mystr,3,2); 
            //     break;
            // case "15":  
            //     $total_late_minute = $total_late_minute + (int)substr($mystr,3,2)+60; 
            //     break;
            // case "16":  
            //     $total_late_minute = $total_late_minute + (int)substr($mystr,3,2)+120; 
            //     break;
            // case "17":  
            //     $total_late_minute = $total_late_minute + (int)substr($mystr,3,2)+180; 
            //     break;
            default:
                $total_late_minute = $total_late_minute;
        }
        return $total_late_minute ;
    }

   
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
