<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\PartController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TypeBrandController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('brands', [BrandController::class, 'list']);
Route::get('brands/{id}', [BrandController::class, 'item']);
Route::post('brands', [BrandController::class, 'create']);
Route::put('brands/{id}', [BrandController::class, 'update']);
Route::get('brands/{brandId}/types', [BrandController::class, 'getTypesForBrand']);

// Ruta para listar todas las partes
Route::get('parts', [PartController::class, 'list']);
// Ruta para obtener los detalles de una parte por su ID
Route::get('parts/{id}', [PartController::class, 'item']);
// Ruta para crear una nueva parte
Route::post('parts', [PartController::class, 'create']);
// Ruta para actualizar los detalles de una parte
Route::put('parts/{id}', [PartController::class, 'update']);
// Ruta para obtener partes por nombre
Route::get('parts/general/{name}', [PartController::class, 'general']);
// Ruta para obtener detalles de partes por nombre
Route::get('parts/element/{name}', [PartController::class, 'element']);
// Ruta para obtener las partes asociadas a un modelo por su ID
Route::get('parts/model/{model}', [PartController::class, 'getPartsForModel']);

// Ruta para listar todos los tipos
Route::get('types', [TypeController::class, 'list']);

// Ruta para obtener los detalles de un tipo por su ID
Route::get('types/{id}', [TypeController::class, 'item']);

// Ruta para obtener tipos asociados a una marca por su ID
Route::get('types/forBrand/{brandId}', [TypeController::class, 'typesForBrand']);

// Ruta para crear un nuevo tipo
Route::post('types', [TypeController::class, 'create']);

// Ruta para actualizar los detalles de un tipo
Route::put('types/{id}', [TypeController::class, 'update']);

// Ruta para obtener tipos por nombre
Route::get('types/general/{name}', [TypeController::class, 'general']);

// Ruta para obtener detalles de tipos por nombre
Route::get('types/element/{name}', [TypeController::class, 'element']);


Route::get('/users/{id}', [UserController::class, 'item']);
Route::post('/users/create',[UserController::class, 'create']);
Route::get('/types/{id}/brands', [TypeController::class, 'typesForBrand']);
Route::post('/login', [AuthController::class,'login']);
Route::get('/parts/{id}/types', [PartController::class, 'partsFortypes']);

Route::delete('/brands/{id}', [BrandController::class, 'delete']);
Route::post('/brands/create', [BrandController::class,'create']);

Route::post('/users/update',[UserController::class, 'update']);
Route::Post('/brands/update',[BrandController::class, 'update']);
