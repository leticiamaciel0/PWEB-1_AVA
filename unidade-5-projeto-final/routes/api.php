<?php

use App\Http\Controllers\Api\ProdutoApiController;
use Illuminate\Support\Facades\Route;

Route::apiResource('produtos', ProdutoApiController::class);