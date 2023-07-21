<?php

use App\Http\Controllers\Backend\BaseSettingController;
use App\Http\Controllers\Backend\CertificateController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProfessionalExperienceController;
use App\Http\Controllers\Backend\FormationController;
use App\Http\Controllers\Backend\HobbieController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\ProjectImageController;
use App\Http\Controllers\Backend\SkillController;
use App\Http\Controllers\Backend\SpokenLanguageController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

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

/**
 * Frontend
 */
Route::get('/', [FrontendController::class, 'index']);
Route::get('/bubblesplit', [FrontendController::class, 'openGameBubble']);
Route::post('/contact', [FrontendController::class, 'contact']);

/**
 * Backend
 */
Route::middleware('auth')->group(function () {
    
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('experience', ProfessionalExperienceController::class)->except('show');
        Route::resource('formation', FormationController::class)->except('show');
        Route::resource('skill', SkillController::class)->except(['show', 'create', 'edit']);
        Route::resource('certificate', CertificateController::class)->except('show');
        Route::resource('spokenLanguage', SpokenLanguageController::class)->except('show', 'create', 'edit');
        Route::resource('hobbie', HobbieController::class)->except('show');
        Route::resource('base_settings', BaseSettingController::class)->only('index', 'update');
        Route::resource('dashboard', DashboardController::class)->only('index');
        Route::resource('project', ProjectController::class);
        Route::resource('projectImage', ProjectImageController::class)->only('store', 'destroy');
        Route::resource('contact', ContactController::class)->only('store', 'update', 'destroy');
    });

});

require __DIR__.'/auth.php';
