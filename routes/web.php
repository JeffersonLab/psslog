<?php

use App\Http\Controllers\PsslogController;
use Illuminate\Support\Facades\Route;

Route::get('/entries', [PsslogController::class, 'index'])
    ->name('psslog.index')
    ->middleware(\App\Http\Middleware\DisplaySettings::class);

Route::get('/entries/list', [PsslogController::class, 'list'])
    ->name('psslog.list')
    ->middleware(\App\Http\Middleware\DisplaySettings::class);

Route::get('/entries/{psslog}', [PsslogController::class, 'item'])
    ->name('psslog.item');

Route::get('/entries/{psslog}/attachments/{attachment}', [PsslogController::class, 'attachment'])
    ->name('psslog.attachment');

Route::get('/accesses/open', [PsslogController::class, 'openAccesses'])
    ->name('accesses.open');

Route::redirect('/', '/entries');
