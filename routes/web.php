<?php

use App\Http\Controllers\ExaminerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleAssignmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CoordinatorController;
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
        Route::get('/user/password/change','UserPasswordChange')->name('user.password.change');
        Route::post('/user/password/update','UserPasswordUpdate')->name('user.password.update');
    });


    //we add/edit/delete on only user(examiner/scrutinizer/admin/superadmin)
    Route::controller(UserController::class)->group(function () {
        Route::get('/user/all', 'AllUser')->name('user.all');
        Route::get('/user/add', 'AddUser')->name('user.add');
        Route::post('/user/store', 'StoreUser')->name('user.store');
        Route::get('/user/edit/{id}', 'EditUser')->name('user.edit');
        Route::post('/user/update', 'UpdateUser')->name('user.update');
        Route::get('/user/delete/{id}', 'DeleteUser')->name('user.delete');
    });

    //here route will be coordinator/dashboard
    //here route name will be coordinator.dashboard
    //here route name will be coordinator.examiner.assign
    Route::prefix('coordinator')->name('coordinator.')->controller(CoordinatorController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/examiner-assign', 'examinerAssign')->name('examiner.assign');
        Route::post('/examiner-assign', 'storeExaminerAssign')->name('examiner.assign.store');
    });


    //for examiner
    Route::prefix('examiner')->name('examiner.')->controller(ExaminerController::class)->group(function () {
        Route::get('/dashboard', 'ExaminerDashboard')->name('dashboard');
        Route::get('/mark-entry', 'ExaminerMarkEntry')->name('mark.entry');
        Route::post('/mark-entry', 'storeExaminerMarkEntry')->name('mark.entry.store');
    });


    //for report
    Route::prefix('report')->name('report.')->controller(ReportController::class)->group(function () {
        // First + Second Combined Pass
        Route::get('/student-15-question-check', 'studentQuestionCheck')->name('student.15.question.check');
        Route::get('/student-15-question-check/{id}', 'studentQuestionCheckByDepartment')->name('student.15.question.check.department');

        // English MCQ
        Route::get('/english-mcq-pass', 'englishMcqPass')->name('english.mcq.pass');
        Route::get('/english-mcq-pass/{id}', 'englishMcqPassByDepartment')->name('english.mcq.pass.department');

        // First Part Pass
        Route::get('/first-part-pass', 'firstPartPass')->name('first.part.pass');
        Route::get('/first-part-pass/{id}', 'firstPartPassByDepartment')->name('first.part.pass.department');

        // Second Part Pass
        Route::get('/second-part-pass', 'secondPartPass')->name('second.part.pass');
        Route::get('/second-part-pass/{id}', 'secondPartPassByDepartment')->name('second.part.pass.department');

        // First + Second Combined Pass
        Route::get('/first-second-part-pass', 'firstSecondPartPass')->name('first.second.part.pass');
        Route::get('/first-second-part-pass/{id}', 'firstSecondPartPassByDepartment')->name('first.second.part.pass.department');
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
