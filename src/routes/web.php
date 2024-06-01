<?php

use App\Http\Controllers\UploaderController;
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

Route::get('/', function () {
//    return view('welcome');
    return redirect(route('uploader.mainXLSXUploadPage'));
});

Route::group([
    'as' => 'uploader.',
    ],
    function ()
    {
        Route::get('upload-xlsx', [UploaderController::class, 'mainXLSXView'])->name('mainXLSXUploadPage');
    }
);
