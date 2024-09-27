<?php

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

// Route::get('attendance','AttendanceController@create')->name('create-attendance');
Route::get('payslip-api/{empid}/{id}', 'PayrollController@payslipAPI')->name('payslip-api');
Route::get('sss-api/', 'PayrollController@sss_get')->name('sss-api');
Route::get('sss-update/', 'PayrollController@sss_update')->name('sss-update');
Route::post('api/sss-post', 'PayrollController@sss_post')->name('sss-post');

Auth::routes();
Route::post('rates', 'PayrollController@getRatesStore')->name('store-rates');

Route::group(['middleware' => 'auth'], function () {

    Route::get('sample', 'AttendanceController@sample');
    Route::get('/get-history', 'AttendanceController@get')->name('scum');

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/home', 'HomeController@index')->name('home');

    //users
    Route::get('/users', 'UserController@index')->name('users');
    Route::post('change-pass', 'UserController@changepass');
    Route::get('/record/{id}', 'UserController@getrecord')->name('record');

    //groups
    Route::get('groups', 'GroupController@index')->name('groups');
    Route::post('new-group', 'GroupController@new')->name('new-group');

    //holidays
    Route::get('holidays', 'HolidayController@index')->name('holidays');
    Route::post('new-holiday', 'HolidayController@create')->name('holidays');
    Route::get('delete-holiday/{id}', 'HolidayController@delete_holiday');
    Route::post('edit-holiday/{id}', 'HolidayController@edit_holiday');

    // Route::group(['middleware' => 'store-account'], function () {
        //Stores
        Route::get('stores', 'StoreController@index')->name('store');
        Route::get('store-remove', 'StoreController@remove')->name('store-remove');
    // });
    //generate payroll
    Route::get('generate', 'PayrollController@index')->name('generate-payroll');
    Route::post('generate', 'PayrollController@save')->name('save-payroll');
    Route::get('payrolls', 'PayrollController@payrolls')->name('payrolls');
    Route::get('save_payrolls', 'PayrollController@savePayrolls')->name('savePayrolls');
    Route::post('batch-check-existing-payrolls', 'PayrollController@batchCheckExistingPayrolls')->name('batchCheckExistingPayrolls');
    Route::get('payroll/{id}', 'PayrollController@payroll')->name('payroll');
    Route::get('display/{id}', 'PayrollController@display')->name('display');
    Route::get('billing/{id}', 'PayrollController@billing')->name('billing');
    Route::get('test', 'PayrollController@test')->name('test');
    Route::get('edit-payroll/{id}', 'PayrollController@editPayroll');
    Route::post('edit-payroll/edit-payroll/{id}', 'PayrollController@saveEditPayroll');
    Route::post('transfer-payroll/{id}', 'PayrollController@transferPayroll');
    Route::post('remove-payroll', 'PayrollController@removePayroll');
    Route::post('edit-government/{id}', 'PayrollController@editGovernment');
    Route::post('delete-payroll', 'PayrollController@deletePayroll');
    Route::post('save-payroll', 'PayrollController@savePayroll');
    Route::get('payslips', 'PayrollController@payslips');
    Route::get('payslip/{id}', 'PayrollController@payslip');
    Route::get('payslips_all','PayrollController@payslips_all');

    Route::post('additional-income/{id}', 'PayrollController@additionaIncome');
    Route::delete('additional-income/delete/{allowanceId}', 'PayrollController@deleteAllowance');
    Route::post('deduction-income/{id}', 'PayrollController@deductionIncome');
    Route::delete('deduction-income/delete/{deductionId}', 'PayrollController@deleteDeduction');


    //Salaries
    Route::get('salaries', 'SalaryController@index')->name('salary');
    Route::post('new-salary', 'SalaryController@create')->name('new-salary');

    //Rates
    Route::get('rates/{id}', 'PayrollController@getRates')->name('rates');
    Route::get('rates-stk/{id}', 'PayrollController@getRatesSTK')->name('rates-stk');
    Route::post('edit-rates', 'PayrollController@setRates')->name('edit-rates');
    Route::post('edit-store-rates', 'PayrollController@setStoreRates')->name('edit-store-rates');
    Route::post('delete-rates', 'PayrollController@deleteRates')->name('delete-rates');
    Route::post('delete-store-rates', 'PayrollController@deleteStoreRates')->name('delete-store-rates');

    //SSS
    Route::get('sss', 'SssController@index')->name('sss');
    Route::post('new-sss', 'SssController@create')->name('new-sss');
    Route::post('edit-sss', 'SssController@edit')->name('edit-sss');

});
