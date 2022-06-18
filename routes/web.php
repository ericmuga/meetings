<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\{DashboardController, MemberController,MeetingController,ReportController};
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

Route::get('/',fn()=>redirect(route('login')));
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('member', MemberController::class);
    Route::resource('meeting', MeetingController::class);
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/reports',[ReportController::class,'index'])->name('report.index');
    Route::get('/report/{id}',[ReportController::class,'show'])->name('report.show');
    Route::post('members/import',[MemberController::class,'upload'])->name('members.import');
    Route::get('members/download',[MemberController::class,'download'])->name('members.download');
});

require __DIR__.'/auth.php';

