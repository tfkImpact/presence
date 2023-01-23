<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => ['auth']], function() {

    //---employees routing bundle
    Route::get('/',[EmployeeController::class, 'index']);
    Route::get('/employees',[EmployeeController::class, 'index']);
    Route::post('/add_employees',[EmployeeController::class, 'store'])->name('add_employees.store');
    Route::delete('/employees/{id}',[EmployeeController::class, 'destroy'])->name('employees.destroy');

    //---presence routing bundle
    Route::get('/presence',[PresenceController::class, 'index']);
    Route::post('/add_presence',[PresenceController::class, 'store'])->name('add_presence.store');
    Route::delete('/presence/{id}',[PresenceController::class,'destroy'])->name('presence.destroy');

    //---stats routing bundle
    Route::get('/stats/{id}',[StatsController::class,'show'])->name('stats.show');

    Route::group(['middleware' => ['role:Admin']], function () {
        //-----users routing bundle
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/all_user',[UserController::class,'index'])->name('user.index');
        Route::post('/user',[UserController::class,'store'])->name('user.store');
        Route::delete('/user/{id}',[UserController::class,'destroy'])->name('user.destroy');
        Route::post('/permissionsToRole',[HomeController::class,'assignPermissions'])->name('permissionsToRole.assignPermissions');
        Route::post('/rolesToUser',[HomeController::class,'assignRoles'])->name('rolesToUser.assignRoles');
        Route::post('/revokePermission',[HomeController::class,'revokePermissions'])->name('revokePermission.revokePermissions');
        Route::post('/revokeRoleFromUser',[HomeController::class,'revokeRole'])->name('revokeRoleFromUser.revokeRole');

        //-------role  routing bundle
        Route::get('/role',[RoleController::class,'index'])->name('role.index');
        Route::post('/role',[RoleController::class,'store'])->name('role.store');
        Route::delete('/role',[RoleController::class,'destroy'])->name('role.destroy');
        
        //--------permissions routing bundle
        Route::get('/permission',[PermissionController::class,'index'])->name('permission.index');
        Route::post('/permission',[PermissionController::class,'store'])->name('permission.store');
        Route::delete('/permission',[PermissionController::class,'destroy'])->name('permission.destroy');
    });

});

Auth::routes();
