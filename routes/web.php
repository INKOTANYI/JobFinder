<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\SectorController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Job;
use App\Models\User;
use App\Models\JobApplication;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/jobs', [JobListingController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [JobListingController::class, 'show'])->name('jobs.show');
Route::post('/jobs/{job}/apply', [JobListingController::class, 'apply'])->name('jobs.apply');

Route::middleware(['auth', \App\Http\Middleware\Admin::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard/jobs', [AdminController::class, 'getJobs'])->name('dashboard.jobs');
    Route::get('/dashboard/users', [AdminController::class, 'getUsers'])->name('dashboard.users');
    Route::get('/dashboard/applications', [AdminController::class, 'getApplications'])->name('dashboard.applications');
    Route::get('/dashboard/applications/pending', [AdminController::class, 'getPendingApplications'])->name('dashboard.applications.pending');
    Route::resource('admin/provinces', ProvinceController::class)->except(['store', 'create']);
    Route::get('admin/provinces/create', [ProvinceController::class, 'create'])->name('admin.provinces.create');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/dashboard', function () {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    })->name('dashboard');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/provinces', [ProvinceController::class, 'store'])->name('provinces.store');
    Route::get('/provinces', [ProvinceController::class, 'getProvinces'])->name('provinces.index');
    Route::get('admin/districts/create', [DistrictController::class, 'create'])->name('admin.districts.create');
    Route::post('admin/districts', [DistrictController::class, 'store'])->name('admin.districts.store');
    Route::get('admin/sectors/create', [SectorController::class, 'create'])->name('admin.sectors.create');
    Route::post('admin/sectors', [SectorController::class, 'store'])->name('admin.sectors.store');
    Route::get('admin/departments/create', [DepartmentController::class, 'create'])->name('admin.departments.create');
    Route::post('admin/departments', [DepartmentController::class, 'store'])->name('admin.departments.store');
});
