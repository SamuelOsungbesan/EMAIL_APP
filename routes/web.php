<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// routes/web.php

use App\Http\Controllers\EmailController;

Route::get('/emails', [EmailController::class, 'index'])->name('emails.index');
Route::get('/emails', [EmailController::class, 'index'])->name('emails.index');
Route::get('/emails', [EmailController::class, 'index'])->name('emails.index');
