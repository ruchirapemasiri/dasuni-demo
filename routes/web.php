<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentsController;


//Login Section Routes
Route::get('/login', [AuthController::class, 'showloginForm'])->name('login');
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->name('logout');


//Super Admin Section Routes
Route::get('/superadmin',[RoleController::class,'viewRoleList'])->name('roles_list')->middleware('SuperAdminLogin');

Route::get('/superadmin/createrole', function(){
    return view('superadmin.create_role');
})->name('create_role_form')->middleware('SuperAdminLogin');

Route::post('/superadmin/createrole', [RoleController::class,'insertRole'])->name('superadmin.save_role')->middleware('SuperAdminLogin');

Route::get('/superadmin/createrole/{id}', [RoleController::class,'updateRoleForm'])->name('superadmin.edit_role')->middleware('SuperAdminLogin');
Route::put('/superadmin/createrole/{id}', [RoleController::class,'updateRole'])->name('superadmin.update_role')->middleware('SuperAdminLogin');

Route::delete('/superadmin/{id}',[RoleController::class,'deleteRole'])->name('superadmin.delete_role')->middleware('SuperAdminLogin');


//Students Section Routes
Route::get('/students',[StudentsController::class,'viewStudentsList'])->name('students_list');

Route::get('/students/createstudent',function(){
    return view('students.create_student');
})->name('students.create_student')->middleware('CheckRolePermissions:students,create');

Route::post('/students/createstudent',[StudentsController::class,'insertStudent'])->name('students.save_student');

Route::get('/students/editstudent/{id}',[StudentsController::class,'updateStudentForm'])->name('students.edit_student_form');
Route::put('/students/editstudent/{id}',[StudentsController::class,'updateStudent'])->name('students.edit_student');

Route::delete('/students/{id}',[StudentsController::class,'deleteStudent'])->name('students.delete_student');





// Middleware Including sample
// Route::get('/students/editstudent/{id}',[StudentsController::class,'updateStudentForm'])->name('students.edit_student_form')->middleware('CheckRolePermissions:students,update');