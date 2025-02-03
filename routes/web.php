<?php

use App\Http\Controllers\CallController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// });


Route::get('/', [CallController::class, 'index'])->name('index');



Route::get('/call/{sn}', [CallController::class, 'vinCall'])->name('call');


Route::get('/test/{sn}', [CallController::class, 'test'])->name('test');







// Route::get('/call/{sn}', function ($sn) {
//     return $sn;
// });
