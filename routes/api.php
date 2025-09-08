<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/webhook-cakto', [WebhookController::class, 'handle'])->name('webhook.handle');
Route::post('/webhook-kiwify', [WebhookController::class, 'kiwify'])->name('webhook.kiwify');



