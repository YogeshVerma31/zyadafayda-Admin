<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerSliderController;
use App\Http\Controllers\DematAccountController;
use App\Http\Controllers\InsuranceCompanyController;
use App\Http\Controllers\InvestmentCompanyController;
use App\Http\Controllers\LearningVideoController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('jwt.verify')->group(function () {
    Route::post("banner", [BannerSliderController::class, 'post_banner']);
    Route::get("banner", [BannerSliderController::class, 'get_banner']);
    //demat
    Route::post("demat", [DematAccountController::class, 'post_demat_account']);
    Route::get("demat", [DematAccountController::class, 'get_demat_list']);

    //investment
    Route::post("investment", [InvestmentCompanyController::class, 'post_investment_account']);
    Route::get("investment", [InvestmentCompanyController::class, 'get_investment_list']);
    //insurance
    Route::post("insurance", [InsuranceCompanyController::class, 'post_insurance_account']);
    Route::get("insurance", [InsuranceCompanyController::class, 'get_insurance_list']);

     //video
     Route::post("video", [LearningVideoController::class, 'post_video_account']);
     Route::get("video", [LearningVideoController::class, 'get_video_list']);
});


Route::post("auth/register", [AuthController::class, 'register']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($request) {
    Route::post("login", [AuthController::class, 'login']);
});
