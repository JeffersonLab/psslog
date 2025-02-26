<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PsslogController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/entries',[PsslogController::class,'index'])
    ->name('psslog.index');

Route::get('/entries/{psslog}',[PsslogController::class,'item'])
    ->name('psslog.item');

Route::get('/entries/{psslog}/attachments/{attachment}',[PsslogController::class,'attachment'])
    ->name('psslog.attachment');

Route::redirect('/','/entries');

