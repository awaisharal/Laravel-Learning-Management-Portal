<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminViewsController;
use App\Http\Controllers\Admin\AdminMainController;
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

	Route::get('/admin/all-instructors',[AdminViewsController::class,'all_instructors_view']);
	Route::get('/admin/add-instructors',[AdminViewsController::class,'add_instructors_view']);
	Route::POST('/admin/add-instructors', [InstructorAuthController::class,'add_instructor'])->name('admin.add_instructor');
	Route::get('/admin/view/{id}/instructor',[AdminMainController::class,'edit_instructors_view']);
	Route::get('/admin/course/{id}/curriculum', [AdminMainController::class,'curriculum_view'])->name('admin.edit_instructor');
	Route::get('/admin/course/curriculum/{id}/details', [AdminMainController::class,'course_curriculum_detail_view']);
	Route::POST('/admin/instructor/ban', [AdminMainController::class,'ban_instructor'])->name('admin.ban_instructor');
	Route::POST('/admin/instructor/unban', [AdminMainController::class,'unban_instructor'])->name('admin.unban_instructor');


	Route::get('/admin/all-students', [AdminViewsController::class,'all_students_view']);
	Route::get('/admin/add-students', [AdminViewsController::class,'add_students_view']);
	Route::POST('/admin/add-students', [StudentAuthController::class,'add_students'])->name('admin.add_student');
	Route::POST('/admin/ban-student', [AdminMainController::class,'ban_student'])->name('admin.ban_student');
	Route::POST('/admin/unban-student', [AdminMainController::class,'unban_student'])->name('admin.unban_student');
	Route::POST('/admin/delete-student', [AdminMainController::class,'delete_student'])->name('admin.delete_student');

	Route::get('/admin/all-courses', [AdminViewsController::class,'all_courses_view']);
	Route::get('/admin/add-courses', [AdminViewsController::class,'add_courses_view']);
	Route::POST('/admin/approve-course', [AdminMainController::class,'approve_course'])->name('admin.approve_course');
	Route::POST('/admin/reject-course', [AdminMainController::class,'reject_course'])->name('admin.reject_course');
	Route::POST('/admin/ban-course', [AdminMainController::class,'ban_course'])->name('admin.ban_course');
	Route::POST('/admin/unban-course', [AdminMainController::class,'unban_course'])->name('admin.unban_course');

	
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
	Route::get('/instructor/course/{id}/edit', [InstructorViewsController::class,'editCourseView']);
	Route::post('/instructor/course/edit', [InstructorViewsController::class,'editCourse'])->name('course.update');
	
	Route::get('/instructor/my-courses', [InstructorViewsController::class,'my_courses_view']);
	Route::get('/instructor/course/{id}/curriculum', [InstructorViewsController::class,'course_curriculum_view']);

	Route::post('/instructor/course/add/section', [InstructorViewsController::class,'add_section'])->name('course.addSection');
	Route::post('/instructor/course/edit/section', [InstructorViewsController::class,'edit_section'])->name('course.editSection');
	Route::post('/instructor/course/delete/section', [InstructorViewsController::class,'delete_section'])->name('course.deleteSection');

	Route::post('/instructor/course/add/lecture', [InstructorViewsController::class,'add_lecture'])->name('course.addLecture');
	Route::get('/instructor/course/{id}/edit/curriculum', [InstructorViewsController::class,'editLectureView']);
	Route::POST('/instructor/course/edit/curriculum', [InstructorViewsController::class,'editLecture'])->name('course.editLecture');
	Route::post('/instructor/course/delete/lecture', [InstructorViewsController::class,'delete_lecture'])->name('lecture.delete');

	Route::get('/instructor/reviews', [InstructorViewsController::class,'reviews_view']);
	Route::get('/instructor/students', [InstructorViewsController::class,'students_view']);

	Route::get('/instructor/edit-profile', [InstructorViewsController::class,'edit_profile_view']);
	Route::post('/instructor/edit-profile', [InstructorViewsController::class,'edit_profile'])->name('instructor.updateProfile');
	Route::post('/instructor/edit-address', [InstructorViewsController::class,'edit_address'])->name('instructor.updateAddress');
	
	Route::get('/instructor/security', [InstructorViewsController::class,'security_view']);
	Route::post('/instructor/security', [InstructorViewsController::class,'update_password'])->name('instructor.passwordUpdate');
	
	Route::get('/instructor/social-profiles', [InstructorViewsController::class,'social_profile_view']);
	Route::POST('/instructor/social-profiles', [InstructorViewsController::class,'edit_social_links'])->name('instructor.socialUpdate');
	
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
// this is testing