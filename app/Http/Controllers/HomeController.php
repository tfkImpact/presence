<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        
        // Role::create(['name'=>'Consulte']);
        // Role::create(['name'=>'Create']);
        // Role::create(['name'=>'Update']);
        // Role::create(['name'=>'Delete']);
        // Permission::create(['name'=>'Consulte presence','slug'=>'presence']);
        // Permission::create(['name'=>'Create presence','slug'=>'presence']);
        // Permission::create(['name'=>'Update presence','slug'=>'presence']);
        // Permission::create(['name'=>'Delete presence','slug'=>'presence']);
        // $role = Role::findById(1);
        // $permission = Permission::findById(1);
        // $role->revokePermissionTo($permission);
        // dd(auth()->user());
        // auth()->user()->givePermissionTo('edit article');
        // auth()->user()->assignRole('writer');
        // User::all()->where('name','Hamza')->first()->assignRole('tester');

        $users = User::all();
        return view('home',['users'=>$users]);
    }
    


    public function assignPermissions(Request $request){

        info($request);
        $role = Role::findById($request->role_id);
        foreach($request->permissions as $permission){
           $role->givePermissionTo($permission);
        }

        $answer = $request->role_id;
        return response()->json(['answer' => $answer]);
    }
    
    public function assignRoles(){
        $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all();
        return view('home',['users'=>$users,'roles'=>$roles,'permissions'=>$permissions]);
    }

}
