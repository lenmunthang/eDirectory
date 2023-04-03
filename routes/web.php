<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\districtController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('home');

Route::controller(AuthController::class)->group(function(){
    Route::get('/signup', 'signup')->name('signup');
    Route::post('/signup', 'storeUser')->name('store_user');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/login', 'authenticate')->name('authenticate');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(UserController::class)->middleware('auth')->group(function(){
    Route::get('/account-settings', 'accountSettings')->name('account_settings');
    Route::post('/account-settings', 'accountSettingsUpdate')->name('account_settings_update');

    Route::get('/add-judge', 'addJudge')->name('add_judge');
    Route::post('/add-judge', 'storeJudge')->name('store_judge');
    Route::get('/judges', 'judgesList')->name('judges_list');
    Route::delete('/judges/{id}', 'delete')->name('judge_delete');
    Route::get('/update-judge/{id}', 'updateJudgeShow')->name('update_judge_show');

    Route::get('/add-judicial-officer', 'addJudicialOfficer')->name('add_jud_officer');
    Route::post('/add-judicial-officer', 'storeJudicialOfficer')->name('store_judicial_officer');
    Route::get('/judicial-officer', 'viewJudicialOfficer')->name('view_jud_officer');
    Route::post('/grade-data', 'gradeData')->name('grade_data');
});

Route::controller(districtController::class)->middleware('auth')->group(function(){
    Route::get('/district', 'viewDistrict')->name('view_district');
    Route::post('/district', 'storeDistrict')->name('store_district');
    Route::delete('/district/{id}', 'deleteDistrict')->name('delete_district');
    Route::post('/show-district', 'updateDistrictShow')->name('update_district_show');
    Route::post('/update-district', 'updateDistrictData')->name('update_district_data');

    Route::get('/sub-division', 'viewSubDivision')->name('view_sub_division');
    Route::post('/sub-division', 'storeSubDivision')->name('store_sub_division');
    Route::delete('/sub-division/{id}', 'deleteSubDivision')->name('delete_sub_division');
    Route::post('/show-sub-division', 'updateSubDivisionShow')->name('update_sub_division_show');
    Route::post('/update-sub-division', 'updateSubDivisionData')->name('sub_div_update_data');

    
});

