<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\RoleHasPermission;
use Illuminate\Support\Facades\Log;

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
        // auth()->user()->assignRole('Delete');
        // User::all()->where('name','Kenza')->first()->assignRole('Consulte');
        $role = Role::findById(6);
        $perm = $role->getPermissionNames();
        $roles = Role::all();
        $users = User::all();
        return view('home',['users'=>$users,'rolePerm'=>$perm,'roles'=>$roles]);
    }
    
    public function assignPermissions(Request $request){
     
        $role = Role::findById($request->role_id);
        foreach($request->permissions as $permission){
           $role->givePermissionTo($permission);
        }
        $answer = $request->role_id;
        return response()->json(['answer' => $answer]);
    }

    public function revokePermissions(Request $request){
        $role = Role::findById($request->role_id);
        foreach($request->permissions as $permission){
            $role->revokePermissionTo($permission);
         }
         $answer = $request->role_id;
         return response()->json(['answer' => $answer]);
    }
    
    public function assignRoles(Request $request){

        $user = User::all()->find($request->user_id);
        foreach($request->roles as $role){
            $user->assignRole($role);
        }
        return response()->json(['answer' => 'good']);
    }

}
