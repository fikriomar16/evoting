<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GlobalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterUserController;
use App\Http\Controllers\MasterAdminController;
use App\Http\Controllers\MasterCandidateController;

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

Route::get('/', [UserController::class, 'index'])->name('homepage');
Route::get('/home', function ()
{
    return redirect('/');
});
Route::get('/pengumuman', [UserController::class, 'announcement'])->name('announcement');
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'show_login'])->name('login');
    Route::post('/login', [AuthController::class, 'check_login']);
    Route::get('/register', [AuthController::class, 'show_register'])->name('register');
    Route::post('/register', [AuthController::class, 'check_register']);
});
Route::get('/get_count_vote', [DashboardController::class, 'count_vote'])->name('get.count.vote');
Route::get('/count_voter', [DashboardController::class, 'count_voter'])->name('count.voter');
Route::get('/get_token', [GlobalController::class, 'getToken'])->name('get.token');
Route::middleware(['auth'])->group(function () {
    Route::get('/fetch-candidate/{candidate}', [GlobalController::class, 'fetchCandidate'])->name('fetch.candidate');
    Route::get('/pemilihan', [UserController::class, 'voting'])->name('voting');
    Route::post('/pilih_kandidat/{candidate}', [GlobalController::class, 'select_candidate'])->name('voting.candidate');
    Route::get('/hasil', [UserController::class, 'result'])->name('voting.result');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserController::class, 'update_profile']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::middleware(['auth:admin'])->group(function () {
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/user', MasterUserController::class);
        Route::post('/user/get-user', [MasterUserController::class, 'getUsers'])->name('user.data');
        Route::post('/user/active-all', [MasterUserController::class, 'active_all'])->name('active.all');
        Route::post('/user/inactive-all', [MasterUserController::class, 'inactive_all'])->name('inactive.all');
        Route::resource('/candidate', MasterCandidateController::class);
        Route::post('/candidate/get-candidate', [MasterCandidateController::class, 'getCandidates'])->name('candidate.data');
        Route::post('/candidate/edit/{candidate}', [MasterCandidateController::class, 'update_data'])->name('candidate.ud');
        Route::resource('/admin', MasterAdminController::class);
        Route::post('/admin/get-admin', [MasterAdminController::class, 'getAdmins'])->name('admin.data');
        Route::get('/voting_data', [DashboardController::class, 'voting_data'])->name('voting.data');
        Route::post('/get_voting_data', [DashboardController::class, 'get_voting'])->name('get.voting.data');
        Route::get('/configuration', [DashboardController::class, 'configuration'])->name('configuration');
        Route::put('/update_config/{config}', [DashboardController::class, 'update_config'])->name('update.config');
        Route::put('/update_announcement/{config}', [DashboardController::class, 'update_announcement'])->name('update.announcement');
        Route::post('/reset_user', [DashboardController::class, 'resetUser'])->name('reset.user');
        Route::post('/reset_candidate', [DashboardController::class, 'resetCandidate'])->name('reset.candidate');
        Route::post('/reset_vote', [DashboardController::class, 'resetVote'])->name('reset.vote');
    });
    Route::post('/logout_admin', [AuthController::class, 'logout_admin'])->name('logout.admin');
});