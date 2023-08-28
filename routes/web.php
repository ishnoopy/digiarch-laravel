<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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
});

Route::view("/home", "shared.homepage")->name("home");
Route::view("/admin-login", "auth.admin-login")->name("admin-login");

//user login
Route::view("/login", "auth.login")->name("login");
Route::post('/login', [AuthController::class, 'login']);

//user signup
Route::view("/signup", "auth.signup")->name("signup");
Route::post('/signup', [AuthController::class, 'signup']);

//user logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//user dashboard
Route::get('/dashboard', [UserController::class, 'getUserDetails'])->name('dashboard');

//user search
Route::get('/search', [UserController::class, 'showSearchView'])->name('search');
Route::get('/search-thesis', [UserController::class, 'searchThesis'])->name('search-thesis');

//admin dashboard
Route::view('/admin-dashboard', "admin.dashboard")->name('admin-dashboard');
Route::get('/users-table', [AdminController::class, 'showUsersTable'])->name('users-table');
Route::delete('/admin-dashboard/delete/{id}', [AdminController::class, 'deleteUser'])->name('delete-user');
Route::post('/admin-dashboard/create-accounts', [AdminController::class, 'addAccountViaCSV'])->name('create-users');
Route::get('/thesis-form', [AdminController::class, 'showThesisForm'])->name('thesis-form');
Route::post('/thesis-form', [AdminController::class, 'addThesis'])->name('add-thesis');

Route::get('/course-form', [AdminController::class, 'showCourseForm'])->name('course-form');
Route::post('/course-form', [AdminController::class, 'addCourse'])->name('add-course');

Route::view('/department-form', "admin.departmentForm")->name('department-form');
Route::post('/department-form', [AdminController::class, 'addDepartment'])->name('add-department');

//admin documents
Route::get('/documents', [UserController::class, 'getAllThesis'])->name('documents');
Route::delete('/documents/delete/{id}', [AdminController::class, 'deleteThesis'])->name('delete-thesis');
Route::get('/documents/edit/{id}', [AdminController::class, 'showeditThesisView'])->name('edit-thesis-form');

Route::put('/documents/edit/{id}', [AdminController::class, 'editThesis'])->name('edit-thesis');
Route::get('/documents/{id}', [UserController::class, 'getThesisById'])->name('thesis-details');

Route::post('/documents/filter', [UserController::class, 'filterThesis'])->name('filter-thesis');
Route::get('/documents/download/{id}', [UserController::class, 'incrementDownloadCount'])->name('increment-download-count');

//admin reports and analytics
Route::get('/reports', [AdminController::class, 'showReportsView'])->name('reports');