<?php

use App\Http\Controllers\BannerSliderController;
use App\Http\Controllers\DematAccountController;
use App\Http\Controllers\InsuranceCompanyController;
use App\Http\Controllers\InvestmentCompanyController;
use App\Http\Controllers\LearningVideoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/banner', [BannerSliderController::class, 'index'])->name('view-banner');
Route::get('/add-banner', function () {
    return view('banner/add');
})->name('add-banner');
Route::post('/post-banner', [BannerSliderController::class, 'create'])->name('post-banner');
Route::get('/edit-banner/{id}', [BannerSliderController::class, 'edit'])->name('edit-banner');
Route::patch('/update-banner/{id}', [BannerSliderController::class, 'update'])->name('updateBanner');
Route::delete('/delete-banner/{id}', [BannerSliderController::class, 'delete'])->name('deleteBanner');

Route::get('/users', [UserController::class, 'index'])->name('view-users');


Route::get('/videos', [LearningVideoController::class, 'index'])->name('view-videos');
Route::get('/add-video', function () {
    return view('learningVideo/add');
})->name('add-video');
Route::post('/post-video', [LearningVideoController::class, 'create'])->name('post-video');
Route::get('/edit-video/{id}', [LearningVideoController::class, 'edit'])->name('edit-video');
Route::patch('/update-video/{id}', [LearningVideoController::class, 'update'])->name('updateVideo');
Route::delete('/delete-video/{id}', [LearningVideoController::class, 'delete'])->name('deleteVideo');
Route::get('/video/status/{id}', [LearningVideoController::class, 'updateStatus'])->name('updateVideoStatus');


Route::get('/demat', [DematAccountController::class, 'index'])->name('view-demat');
Route::get('/add-demat', function () {
    return view('demat/add');
})->name('add-demat');
Route::post('/post-demat', [DematAccountController::class, 'create'])->name('post-demat');
Route::get('/edit-demat/{id}', [DematAccountController::class, 'edit'])->name('edit-demat');
Route::patch('/update-demat/{id}', [DematAccountController::class, 'update'])->name('updateDemat');
Route::delete('/delete-demat/{id}', [DematAccountController::class, 'delete'])->name('deleteDemat');
Route::get('/demat/status/{id}', [DematAccountController::class, 'updateStatus'])->name('updateDematStatus');

Route::get('/insurance', [InsuranceCompanyController::class, 'index'])->name('view-insurance');
Route::get('/add-insurance', function () {
    return view('insurance/add');
})->name('add-insurance');
Route::post('/post-insurance', [InsuranceCompanyController::class, 'create'])->name('post-insurance');
Route::get('/edit-insurance/{id}', [InsuranceCompanyController::class, 'edit'])->name('edit-insurance');
Route::patch('/update-insurance/{id}', [InsuranceCompanyController::class, 'update'])->name('updateInsurance');
Route::delete('/delete-insurance/{id}', [InsuranceCompanyController::class, 'delete'])->name('deleteInsurance');
Route::get('/insurance/status/{id}', [InsuranceCompanyController::class, 'updateStatus'])->name('updateInsuranceStatus');

Route::get('/investment', [InvestmentCompanyController::class, 'index'])->name('view-investment');
Route::get('/add-investment', function () {
    return view('investment/add');
})->name('add-investment');
Route::post('/post-investment', [InvestmentCompanyController::class, 'create'])->name('post-investment');
Route::get('/edit-investment/{id}', [InvestmentCompanyController::class, 'edit'])->name('edit-investment');
Route::patch('/update-investment/{id}', [InvestmentCompanyController::class, 'update'])->name('updateInvestment');
Route::delete('/delete-investment/{id}', [InvestmentCompanyController::class, 'delete'])->name('deleteInvestment');
Route::get('/investment/status/{id}', [InvestmentCompanyController::class, 'updateStatus'])->name('updateInvestmentStatus');



Route::get('/', function () {
    return view('index');
});
