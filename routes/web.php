<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Auth::routes(['verify' => true]);

// Main route

Route::get('/admin', [App\Http\Controllers\Admin\AdminController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.admin');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::get('/rules', [App\Http\Controllers\RuleController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('rule');

Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('users');

Route::get('/teams', [App\Http\Controllers\TeamsController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('teams');

// Route create, join and team index

Route::get('/teams/create', [App\Http\Controllers\TeamsController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('teams.create');

Route::post('/teams/create', [App\Http\Controllers\TeamsController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('teams.create');

Route::get('/teams/join', [App\Http\Controllers\TeamsController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('teams.join');

Route::post('/teams/join', [App\Http\Controllers\TeamsController::class, 'joinTeam'])
    ->middleware(['auth', 'verified'])
    ->name('teams.join');

Route::get('/team', [App\Http\Controllers\TeamsController::class, 'teamIndex'])
    ->middleware(['auth', 'verified'])
    ->name('teams.team');

Route::delete('/team', [App\Http\Controllers\TeamsController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('teams.destroy');

Route::delete('/team/out', [App\Http\Controllers\TeamsController::class, 'Outteam'])
    ->middleware(['auth', 'verified'])
    ->name('teams.out');

Route::get('/team/edit/{teamname}', [App\Http\Controllers\TeamsController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('teams.edit');

Route::put('/team/edit/{teamname}', [App\Http\Controllers\TeamsController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('teams.update');

// Route user index
Route::get('/user/{name}', [App\Http\Controllers\UsersController::class, 'userIndex'])
    ->middleware(['auth', 'verified'])
    ->name('users.user');

Route::get('/setting', [App\Http\Controllers\UsersController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('users.setting');

Route::put('/setting/{name}', [App\Http\Controllers\UsersController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('users.update');

// Route Practices

Route::get('/practices', [App\Http\Controllers\PracticeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('practices');
Route::get('/practices/{name}', [App\Http\Controllers\PracticeController::class, 'show'])
    ->name('lab.show');
Route::get('/practice/download/{name}', [App\Http\Controllers\PracticeController::class, 'Practicedownload'])
    ->name('practice.download');
Route::post('/practices/{name}/submit', [App\Http\Controllers\PracticeController::class, 'submitFlag'])
    ->name('submit.practice');

// Route Challenges
Route::get('/challenges', [App\Http\Controllers\ChallengesController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('challenges');
Route::get('/challenges/{name}', [App\Http\Controllers\ChallengesController::class, 'show'])
    ->name('challenge.show');
Route::get('/download/{name}', [App\Http\Controllers\ChallengesController::class, 'download'])
    ->name('download');
Route::post('/challenges/{name}/submit', [App\Http\Controllers\ChallengesController::class, 'submitFlag'])
    ->name('submit.challenge');
Route::get('/challenges/error', [App\Http\Controllers\ChallengesController::class, 'index'])
    ->name('error.403');

// Route Scoreboards
Route::get('/scoreboards', [App\Http\Controllers\ScoreboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('scoreboards');

// Route for UserPanel

Route::get('/admin/user', [App\Http\Controllers\Admin\UserPanelController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.userpanel');

Route::get('/admin/user/edit/{name}', [App\Http\Controllers\Admin\UserPanelController::class, 'edit'])
    ->middleware(['auth', 'admin'])
    ->name('admin.user.edit');

Route::put('/admin/user/edit/{name}', [App\Http\Controllers\Admin\UserPanelController::class, 'update'])
    ->middleware(['auth', 'admin'])
    ->name('admin.update');

Route::delete('admin/user/{name}', [App\Http\Controllers\Admin\UserPanelController::class, 'destroy'])
    ->name('admin.user.destroy');

Route::get('/admin/user/create', [App\Http\Controllers\Admin\UserPanelController::class, 'create'])
    ->middleware(['auth', 'admin'])
    ->name('admin.user.create');

Route::post('/admin/user/create', [App\Http\Controllers\Admin\UserPanelController::class, 'store'])
    ->middleware(['auth', 'admin'])
    ->name('admin.user.store');

// Route for TeamPanel

Route::get('/admin/team', [App\Http\Controllers\Admin\TeamPanelController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.teampanel');

Route::get('/admin/team/edit/{teamname}', [App\Http\Controllers\Admin\TeamPanelController::class, 'edit'])
    ->middleware(['auth', 'admin'])
    ->name('admin.team.edit');

Route::put('/admin/team/edit/{teamname}', [App\Http\Controllers\Admin\TeamPanelController::class, 'update'])
    ->middleware(['auth', 'admin'])
    ->name('admin.team.update');

Route::delete('admin/team/{teamname}', [App\Http\Controllers\Admin\TeamPanelController::class, 'destroy'])
    ->name('admin.team.destroy');

Route::get('/admin/team/create', [App\Http\Controllers\Admin\TeamPanelController::class, 'create'])
    ->middleware(['auth', 'admin'])
    ->name('admin.team.create');

Route::post('/admin/team/create', [App\Http\Controllers\Admin\TeamPanelController::class, 'store'])
    ->middleware(['auth', 'admin'])
    ->name('admin.team.store');

// Route for PracticePanel
Route::get('/admin/practice', [App\Http\Controllers\Admin\PracticeController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.practicepanel');

Route::get('/admin/practice/create', [App\Http\Controllers\Admin\PracticeController::class, 'create'])
    ->middleware(['auth', 'admin'])
    ->name('admin.practice.create');

Route::post('/admin/practice/create', [App\Http\Controllers\Admin\PracticeController::class, 'store'])
    ->middleware(['auth', 'admin'])
    ->name('admin.practice.store');

Route::delete('admin/practice/{name}', [App\Http\Controllers\Admin\PracticeController::class, 'destroy'])
    ->name('admin.practice.destroy');

Route::get('/admin/practice/edit/{name}', [App\Http\Controllers\Admin\PracticeController::class, 'edit'])
    ->middleware(['auth', 'admin'])
    ->name('admin.practice.edit');

Route::put('/admin/practice/edit/{name}', [App\Http\Controllers\Admin\PracticeController::class, 'update'])
    ->middleware(['auth', 'admin'])
    ->name('admin.practice.update');

// Route ChallengePanel
Route::get('/admin/challenge', [App\Http\Controllers\Admin\ChallengePanelController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.challengepanel');

Route::delete('admin/challenge/{name}', [App\Http\Controllers\Admin\ChallengePanelController::class, 'destroy'])
    ->name('admin.challenge.destroy');

Route::get('/admin/challenge/edit/{name}', [App\Http\Controllers\Admin\ChallengePanelController::class, 'edit'])
    ->middleware(['auth', 'admin'])
    ->name('admin.challenge.edit');
    
Route::put('/admin/challenge/edit/{name}', [App\Http\Controllers\Admin\ChallengePanelController::class, 'update'])
    ->middleware(['auth', 'admin'])
    ->name('admin.challenge.update');

Route::get('/admin/challenge/create', [App\Http\Controllers\Admin\ChallengePanelController::class, 'create'])
    ->middleware(['auth', 'admin'])
    ->name('admin.challenge.create');

Route::post('/admin/challenge/create', [App\Http\Controllers\Admin\ChallengePanelController::class, 'store'])
    ->middleware(['auth', 'admin'])
    ->name('admin.challenge.store');