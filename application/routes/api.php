<?php

use App\Http\Controllers\Api\IncomeController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\SaleController;
use App\Http\Controllers\Api\StockController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([AuthMiddleware::class])->group(function () {
    Route::get('sales', [SaleController::class, 'list']);
    Route::get('orders', [OrderController::class, 'list']);
    Route::get('stocks', [StockController::class, 'list']);
    Route::get('incomes', [IncomeController::class, 'list']);
});
