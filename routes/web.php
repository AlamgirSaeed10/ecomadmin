<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\CoursesController;
use App\Http\Controllers\admin\CertificatesController;
use App\Http\Controllers\admin\EnrollmentController;
use App\Http\Controllers\admin\CoursePlanController;

Route::get('/', function () {return view('auth.login'); });
Auth::routes();
/* <===========================================================================================================>
                                               DASHBOARD CONTROLLER
<===========================================================================================================>*/
Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post("admin/send-email", [DashboardController::class, "composeEmail"])->name("send-email");

/* <===========================================================================================================>
                                               CERTIFICATE CONTROLLER
<===========================================================================================================>*/
Route::get('admin/certificates', [CertificatesController::class, 'index'])->name('certificates.index');
Route::get('admin/certificates/create', [CertificatesController::class, 'create'])->name('certificates.create');
Route::post('admin/certificates', [CertificatesController::class, 'store'])->name('certificates.store');
Route::get('admin/certificates/{id}', [CertificatesController::class, 'show'])->name('certificates.show');
Route::get('admin/certificates/{id}/edit', [CertificatesController::class, 'edit'])->name('certificates.edit');
Route::put('admin/certificates/{id}', [CertificatesController::class, 'update'])->name('certificates.update');
Route::delete('admin/certificates/{id}', [CertificatesController::class, 'destroy'])->name('certificates.destroy');
Route::get('admin/getStudentData/{studentID}', [CertificatesController::class, 'getStudentData'])->name('admin.getStudentData');
/* <===========================================================================================================>
                                               COURSES CONTROLLER
<===========================================================================================================>*/
Route::get('admin/courses', [CoursesController::class, 'index'])->name('courses.index');
Route::get('admin/courses/create', [CoursesController::class, 'create'])->name('courses.create');
Route::post('admin/courses', [CoursesController::class, 'store'])->name('courses.store');
Route::get('admin/courses/{id}', [CoursesController::class, 'show'])->name('courses.show');
Route::get('admin/courses/{id}/edit', [CoursesController::class, 'edit'])->name('courses.edit');
Route::put('admin/courses/{id}', [CoursesController::class, 'update'])->name('courses.update');
Route::delete('admin/courses/{id}', [CoursesController::class, 'destroy'])->name('courses.destroy');
Route::get('/get-courses', [CoursesController::class,'getCourses'])->name('course_plan.getCourses');


/* <===========================================================================================================>
                                               ENROLLMENT CONTROLLER
<===========================================================================================================>*/
Route::get('admin/enrollments', [EnrollmentController::class,'index'])->name('enrollments.index');
Route::get('admin/enrollments/create', [EnrollmentController::class,'create'])->name('enrollments.create');
Route::post('admin/enrollments', [EnrollmentController::class,'store'])->name('enrollments.store');
Route::get('admin/enrollments/{id}', [EnrollmentController::class,'show'])->name('enrollments.show');
Route::get('admin/enrollments/{id}/edit', [EnrollmentController::class,'edit'])->name('enrollments.edit');
Route::put('admin/enrollments/{id}', [EnrollmentController::class,'update'])->name('enrollments.update');
Route::delete('admin/enrollments/{id}', [EnrollmentController::class,'destroy'])->name('enrollments.destroy');

/* <===========================================================================================================>
                                               COURSE PLAN CONTROLLER
<===========================================================================================================>*/
Route::get('/course_plans', [CoursePlanController::class,'index'])->name('course_plan.index');
Route::get('/course_plans/create', [CoursePlanController::class,'create'])->name('course_plan.create');
Route::post('/course_plans', [CoursePlanController::class,'store'])->name('course_plan.store');
Route::get('/course_plans/{id}', [CoursePlanController::class,'show'])->name('course_plan.show');
Route::get('/course_plans/{id}/edit', [CoursePlanController::class,'edit'])->name('course_plan.edit');
Route::put('/course_plans/{id}', [CoursePlanController::class,'update'])->name('course_plan.update');
Route::delete('/course_plans/{id}', [CoursePlanController::class,'destroy'])->name('course_plan.destroy');

