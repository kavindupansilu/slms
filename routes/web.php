<?php

 use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\LecturerController;
 use App\Http\Controllers\AuthController;
 use App\Http\Controllers\HomeController;
 use App\Http\Controllers\UserController;
 use App\Http\Controllers\StudentController;
 use App\Http\Controllers\VisitLecturerController;
 use App\Http\Controllers\DegreeController;
 use App\Http\Controllers\CourseController;
 use App\Http\Controllers\AttendanceController;
 use App\Http\Controllers\DashboardController;

 /*
 |--------------------------------------------------------------------------
 | Web Routes
 |--------------------------------------------------------------------------
 |
 | Here is where you can register web routes for your application. These
 | routes are loaded by the RouteServiceProvider and all of them will
 | be assigned to the "web" middleware group. Make something great!
 |
 */

 Route::get('/', function () {
     return view('welcome');
 })->name('welcome');


 // User CRUDs
 Route::controller(AuthController::class)->group(function () {
     Route::get('register', 'register')->name('register');
     Route::post('register', 'registerSave')->name('register.save');
     Route::get('login', 'login')->name('login');
     Route::post('login', 'loginAction')->name('login.action');
     Route::get('logout', 'logout')->middleware('auth')->name('logout');
     Route::get('/{user}/edit', 'edit')->name('user.edit');
     Route::put('/{user}', 'update')->name('users.update');
     Route::delete('/{user}', 'destroy')->name('users.destroy');
 });

 Route::get('/users', [AuthController::class, 'getUsers'])->name('users.all');
 //Route::get('/users', [AuthController::class, 'getLecturers'])->name('users.all');


 // Normal user routes
 Route::middleware('auth')->group(function () {
     Route::get('/home', [HomeController::class, 'index'])->name('home');
     Route::get('/profile', [UserController::class, 'userprofile'])->name('profile');
 });

 // Admin Student Dashboard
 Route::prefix('students')->controller(StudentController::class)->group(function () {

     Route::get('/', 'index')->name('dashboard.student');
     Route::get('sregister', 'sregister')->name('sregister');
     Route::post('sregister', 'registerSave')->name('sregister.save');
     Route::get('/{student}/edit', 'edit')->name('student.edit');
     Route::put('/{student}', 'update')->name('students.update');
     Route::delete('/{student}', 'destroy')->name('students.destroy');
     Route::get('students/qrcodes','showQRCodes')->name('students.qrcodes'); // Student with QR
     Route::get('students/qrcode/{student_id}','generateQRCode')->name('students.qrcode');
 });

 Route::get('/student-details', [StudentController::class, 'showQr']);

  // Admin Visiting Lecture Details
  Route::prefix('visitlecturers')->controller(VisitLecturerController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard.visitlecturer');
    Route::get('/{vlecturedetail}/edit', 'edit')->name('vlecturedetail.edit');
    Route::put('/{vlecturedetail}', 'update')->name('vlecturedetails.update');
    Route::delete('/{vlecturedetail}', 'destroy')->name('vlecturedetails.destroy');
});

 // Admin Degree Dashboard
Route::prefix('degrees')->controller(DegreeController::class)->group(function () {
    Route::get('degregister', 'degregister')->name('degregister');
    Route::post('degregister', 'registerSave')->name('degregister.save');
    Route::get('/{degree}/edit', 'edit')->name('degree.edit');
    Route::put('/{degree}', 'update')->name('degrees.update');
    Route::delete('/{degree}', 'destroy')->name('degrees.destroy');
});
Route::get('/degrees', [DegreeController::class, 'getDegrees'])->name('degrees.all');



 // Admin Degree Course Dashboard
Route::prefix('courses')->group(function () {
    Route::get('coursereg', [CourseController::class, 'coursereg'])->name('coursereg');
    Route::post('coursereg', [CourseController::class, 'registerSave'])->name('coursereg.save');
    Route::get('{course}/edit', [CourseController::class, 'edit'])->name('course.edit');
    Route::put('{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
});

Route::get('/dashboard/course/{degree_id}', [CourseController::class, 'indexes'])->name('dashboard.course');

 // Student Attendence
 Route::prefix('attendances')->controller(AttendanceController::class)->group(function () {
    Route::get('statregis', 'statregis')->name('statregis');
    Route::post('statregis', 'registerSave')->name('statregis.save');
    Route::get('dashboard','index')->name('dashboard.index');
    Route::get('dashboard/scan','scanQRCode')->name('dashboard.scan');
    Route::post('attendances/mark','markAttendance')->name('attendances.mark');
    Route::get('attendances/{attendance}/edit', [AttendanceController::class, 'edit'])->name('attendance.edit');
    Route::put('{attendance}', [AttendanceController::class, 'update'])->name('attendances.update');
    Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');

});


// Display
Route::get('admin/dashboard', [DashboardController::class, 'index']);

 Route::get('/student', [StudentController::class, 'index'])->name('student');
 Route::get('/lecturer', [LecturerController::class, 'index'])->name('lecturer');
 Route::get('/visitlecturer', [VisitLecturerController::class, 'index'])->name('visitlecturer');
 Route::get('/degree', [DegreeController::class, 'index'])->name('degree');
 Route::get('/user', [AuthController::class, 'index'])->name('user');
 Route::get('/lecturedetail', [LecturerController::class, 'lecturedetail'])->name('lecturedetail');
 Route::get('/course', [CourseController::class, 'index'])->name('course');
 Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');
 Route::get('/stdetail', [StudentController::class, 'stdetail'])->name('stdetail');
 Route::get('/dislecturer', [LecturerController::class, 'dislecturer'])->name('dislecturer');
 Route::get('/disstudent', [StudentController::class, 'disstudent'])->name('disstudent');
 Route::get('/disattendance', [AttendanceController::class, 'disattendance'])->name('disattendance');


// Admin Routes List
Route::middleware('auth')->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin/home');
    Route::get('/user', [AuthController::class, 'index'])->name('user');
});
