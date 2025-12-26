<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\PublicTaxController;
use App\Http\Controllers\TaxpayerPublicController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

//  صفحات المكلفين
Route::prefix('public')->name('public.')->group(function () {
    Route::get('/check-debt', [PublicTaxController::class, 'checkDebt'])->name('check-debt');
    Route::post('/query-debt', [PublicTaxController::class, 'queryDebt'])->name('query-debt');
    Route::post('/request-clearance/{id}', [PublicTaxController::class, 'requestClearance'])->name('request-clearance');
 });


 // لوحة التحكم (Filament)
Route::prefix('admin')->group(function () { });
    Route::get('/view', [CertificateController::class, 'view'])->name('view') ;

// وثائق البراءة
Route::prefix('certificates')->name('certificates.')->group(function () { 
    Route::get('/{certificate}/view', [CertificateController::class, 'view'])->name('view') ;
    Route::get('/{certificate}/view', [CertificateController::class, 'view'])->name('view') ;
    Route::get('/{certificate}/print', [CertificateController::class, 'print'])->name('print') ;
     });
