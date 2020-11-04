<?php

use App\Http\Controllers\AuthController;

use App\Http\Controllers\DadosPessoaisController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('api')->group(function () {
    // -> dados_pessoais
    Route::prefix('dados_pessoais')->group(function () {
        Route::post('/', [DadosPessoaisController::class, 'create']);
    });
});

Route::post('/login', [AuthController::class, 'login']);

//Route::post('/gcms', [DadosPessoaisController::class, 'create']);
