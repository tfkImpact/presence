<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    
    public function index()
    {
        $employees = Employee::all();
        return view('all_employees',['employees'=> $employees]);
    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
       
        if(isset($request->id)){
            $this->update($request);
            return back()->with('success', 'employee has been Added successfully');
        }
        $employee = new Employee();
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->adress = $request->adress;
        $employee->save();
        return back()->with('success', 'employee has been Added successfully');
    }

    
    public function show(Employee $employee)
    {
        //
    }

    
    public function edit(Employee $employee)
    {
        //
    }

    
    public function update(Request $request)
    {
        $employee = Employee::all()->find($request->id);
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->adress = $request->adress;
        $employee->save();
        return back()->with('success', 'employee has been Added successfully');
    }

   
    public function destroy($id)
    {
        Employee::all()->find($id)->delete();
        return back()->with('success', 'employee has been deleted successfully');
    }
}
