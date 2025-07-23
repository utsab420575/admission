<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleAssignmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //return view('welcome');
    if (Auth::check()) {
        return redirect('/dashboard');
    } else {
        return redirect()->route('login');
    }
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/user/logout', 'UserDestroy')->name('user.logout');
    });




    ///Permission All Route More actions
    // Roles/Permissions
    Route::controller(RoleController::class)->group(function () {
        //Permission
        Route::get('/permission/all', 'AllPermission')->name('permission.all');
        Route::get('/permission/add', 'AddPermission')->name('permission.add');
        Route::post('/permission/store', 'StorePermission')->name('permission.store');
        Route::get('/permission/edit/{id}', 'EditPermission')->name('permission.edit');
        Route::post('/permission/update', 'UpdatePermission')->name('permission.update');
        Route::get('/permission/delete/{id}', 'DeletePermission')->name('permission.delete');

        //Role
        Route::get('/roles/all', 'AllRoles')->name('roles.all');
        Route::get('/roles/add', 'AddRoles')->name('roles.add');
        Route::post('/roles/store', 'StoreRoles')->name('roles.store');
        Route::get('/roles/edit/{id}', 'EditRoles')->name('roles.edit');
        Route::post('/roles/update', 'UpdateRoles')->name('roles.update');
        Route::get('/roles/delete/{id}', 'DeleteRoles')->name('roles.delete');



        ///Add Roles in Permission All Route (Assign Permission(Route) In Roles)
        /// Here We select Which Role Can Access Which Permission
        Route::get('/roles/permissions/add', 'AddRolesPermission')->name('roles.permissions.add');
        //Role and related permission store into database
        Route::post('/role/permission/store','StoreRolesPermission')->name('role.permission.store');
        Route::get('roles/permission/all','AllRolesPermission')->name('roles.permission.all');
        Route::get('roles/permission/edit/{id}','EditRolePermissions')->name('role.permission.edit');
        Route::post('/role/permission/update','UpdateRolePermission')->name('role.permission.update');
        Route::get('/role/permission/delete/{id}','DeleteRolesPermission')->name('role.permission.delete');
    });

    // User RoleAssign Add/Edit/Delete
    Route::controller(RoleAssignmentController::class)->group(function(){
        Route::get('/role/assignments', 'AllRoleAssignments')->name('role.assignments.all');
        Route::get('/role/assignments/add','AddRoleAssignments')->name('role.assignments.add');
        Route::post('/role/assignments/store','StoreRoleAssignments')->name('role.assignments.store');


        Route::get('/role/assignments/edit/{id}','EditRoleAssignments')->name('role.assignments.edit');
        Route::post('/role/assignments/update','UpdateRoleAssignments')->name('role.assignments.update');
        Route::get('/role/assignments/delete/{id}','DeleteRoleAssignments')->name('role.assignments.delete');
    });

});
require __DIR__.'/auth.php';
