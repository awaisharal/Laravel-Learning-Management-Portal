<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminViewsController;
use App\Http\Controllers\Students\StudentAuthController;
use App\Http\Controllers\Students\StudentViewsController;
use App\Http\Controllers\Instructor\InstructorAuthController;
use App\Http\Controllers\Instructor\InstructorViewsController;
use App\Http\Controllers\mainController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [mainController::class,'index_view']);


// ==========Admin Routes==========


Route::get('/admin/login', [AuthController::class,'login_view']);
Route::POST('/admin/login', [AuthController::class,'loginAdmin'])->name('admin.login');

Route::group(['middleware' => ['AdminAuth']], function(){

	Route::get('/admin', [AdminViewsController::class,'index_view']);
	Route::get('/admin/logout', [AuthController::class,'logoutAdmin']);
	Route::get('/admin/all-instructors', [AdminViewsController::class,'all_instructors_view']);
	Route::get('/admin/add-instructors', [AdminViewsController::class,'add_instructors_view']);
	Route::POST('/admin/add-instructors', [InstructorAuthController::class,'add_instructor'])->name('admin.add_instructor');
	Route::get('/admin/all-students', [AdminViewsController::class,'all_students_view']);
	Route::get('/admin/add-students', [AdminViewsController::class,'add_students_view']);
	Route::POST('/admin/add-students', [StudentAuthController::class,'add_students'])->name('admin.add_student');
	Route::get('/admin/all-courses', [AdminViewsController::class,'all_courses_view']);
	Route::get('/admin/add-courses', [AdminViewsController::class,'add_courses_view']);
	Route::get('/admin/setting', [AdminViewsController::class,'setting_view']);
	Route::POST('/admin/setting/change-password', [AuthController::class,'change_password'])->name('admin.change-password');

});

// ==========Instructor Routes==========

Route::get('/instructor/login', [InstructorAuthController::class,'login_view']);
Route::POST('/instructor/login', [InstructorAuthController::class,'login'])->name('instructor.login');

Route::group(['middleware' => ['InstructorAuth']], function(){

	Route::get('/instructor/', [InstructorViewsController::class,'instructor_dashboard']);
	Route::get('/instructor/dashboard', [InstructorViewsController::class,'dashboard_view']);
	Route::get('/instructor/add-course', [InstructorViewsController::class,'add_course_view']);
	Route::post('/instructor/add-course', [InstructorViewsController::class,'add_course'])->name('course.create');
	Route::get('/instructor/my-courses', [InstructorViewsController::class,'my_courses_view']);
	Route::get('/instructor/course/{id}/curriculum', [InstructorViewsController::class,'course_curriculum_view']);
	Route::post('/instructor/course/add/section', [InstructorViewsController::class,'add_section'])->name('course.addSection');
	Route::post('/instructor/course/add/lecture', [InstructorViewsController::class,'add_lecture'])->name('course.addLecture');
	Route::post('/instructor/course/delete/lecture', [InstructorViewsController::class,'delete_lecture'])->name('lecture.delete');
	Route::get('/instructor/reviews', [InstructorViewsController::class,'reviews_view']);
	Route::get('/instructor/students', [InstructorViewsController::class,'students_view']);
	Route::get('/instructor/edit-profile', [InstructorViewsController::class,'edit_profile_view']);
	Route::post('/instructor/edit-profile', [InstructorViewsController::class,'edit_profile'])->name('instructor.updateProfile');
	Route::get('/instructor/security', [InstructorViewsController::class,'security_view']);
	Route::post('/instructor/security', [InstructorViewsController::class,'update_password'])->name('instructor.passwordUpdate');
	Route::get('/instructor/social-profiles', [InstructorViewsController::class,'social_profile_view']);
	Route::get('/instructor/logout', [InstructorAuthController::class,'logoutInstructor']);

});

// ==========Student Routes=========

Route::get('/login', [StudentAuthController::class,'login_view']);
Route::POST('/login', [StudentAuthController::class,'login'])->name('student.login');
	
Route::group(['middleware' => ['StudentAuth']], function(){
	
	Route::get('/student/', [StudentViewsController::class,'student_dashboard']);
	Route::get('/student/dashboard', [StudentViewsController::class,'dashboard_view']);
	Route::get('/student/add-course', [StudentViewsController::class,'add_course_view']);
	Route::get('/student/my-courses', [StudentViewsController::class,'my_courses_view']);
	Route::get('/student/edit-profile', [StudentViewsController::class,'edit_profile_view']);
	Route::get('/student/security', [StudentViewsController::class,'security_view']);
	Route::get('/student/logout', [StudentAuthController::class,'logoutStudent']);
	Route::get('/student/social-profiles', [StudentViewsController::class,'social_profile_view']);

});