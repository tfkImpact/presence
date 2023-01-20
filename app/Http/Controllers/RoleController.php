<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
   
    public function index()
    {
        $MAC = exec('getmac');
        $MAC = strtok($MAC, ' ');

        $roles = Role::all();
        $permissions = Permission::all();
        return view('roleAssign',['roles'=>$roles,'permissions'=>$permissions,'mac'=>$MAC]);
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
        //
    }
}
