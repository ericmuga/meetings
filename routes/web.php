<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\{AdminController,
                          DashboardController,
                          MemberController,
                          MeetingController,
                          ReportController,
                          ScoreController,
                          SetupController,
                          GradingRuleController,
                          MakeupRequestController,
                          ZoomController,
                         GuestController};
use App\Http\Resources\MemberResource;
use App\Models\Guest;
use App\Models\MakeupRequest;
use App\Models\Meeting;
use App\Models\Member;
use Illuminate\Http\Request;

// use App\Models\GradingRule;

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
Route::resource('makeup', MakeupRequestController::class);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('member', MemberController::class);
    Route::resource('guest', GuestController::class);
    Route::resource('meeting', MeetingController::class);


    Route::delete('grading/{id}',[GradingRuleController::class,'destroy'])->name('grading.destroy');
     Route::resource('grading', GradingRuleController::class);
     // Route::resource('scores', ScoreController::class);
    Route::get('scores/{meeting}', [ScoreController::class,'index']);
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/reports',[ReportController::class,'index'])->name('report.index');
    Route::get('/report/{id}',[ReportController::class,'show'])->name('report.show');
    Route::post('members/import',[MemberController::class,'upload'])->name('members.import');
    Route::get('members/download',[MemberController::class,'download'])->name('members.download');

    //all API functions
    Route::get('members/all',fn()=>Member::all('id','name')->sortBy('name'));
    Route::get('guests/all',fn()=>Guest::all('id','name')->sortBy('name'));
    Route::get('makeups/all',fn()=>MakeupRequest::all()->sortBy('name'));

    Route::get('findGuest/{name}',fn(Request $request)=>Guest::where('name','like',$request->name.'%')->get());


    Route::post('meeting/scores',[MeetingController::class,'scores'])->name('meeting.scores');
    Route::post('zoom/meetings',[ZoomController::class,'getMeetings'])->name('zoom.meetings');
    Route::get('/meetings/{meeting}/participants',[ZoomController::class,'fetchParticipants'])->name('zoom.participants');
    Route::get('/meetings/{meeting}/grade',[ZoomController::class,'gradeParticipants'])->name('zoom.grade');
    // Route::get('meeting/{meeting}/members',[MeetingController::class, 'members']));

    Route::get('makeups',[MakeupRequestController::class, 'index'])->name('makeup.index');


    Route::get('/setup', [SetupController::class,'index'])->name('setup.index');
    Route::get('/admin', [AdminController::class ,'index'])->name('admin.index');

});

require __DIR__.'/auth.php';

