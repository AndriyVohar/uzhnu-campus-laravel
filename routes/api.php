<?php

use App\Http\Controllers\Api\InfoController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WorkController;
use App\Http\Controllers\Api\AdvertisementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*z
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

Route::apiResources([
    'infos' => InfoController::class,
    'users' => UserController::class,
    'works' => WorkController::class,
    'advertisements' => AdvertisementController::class,
]);
Route::get('/users/{id}/advertisements',[UserController::class, 'getUserAdvertisements']);