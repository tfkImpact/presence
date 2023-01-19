<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
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
    
    }

    
    public function show($id)
    {
        //
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
        $user_to_delete = User::all()->find($id);
        $user_to_delete->delete();
        return back()->with('success', 'Presence has been deleted successfully');
    }
}
