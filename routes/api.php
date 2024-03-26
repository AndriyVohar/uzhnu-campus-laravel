<?php

use App\Http\Controllers\Api\InfoController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WashingController;
use App\Http\Controllers\Api\WorkController;
use App\Http\Controllers\Api\AdvertisementController;
use App\Http\Controllers\Api\WorkerTaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:api')->group(function () {
    Route::get('/{dormitory}/infos',[InfoController::class, 'getInfosByDormitory']);
    Route::get('/works/approve',[WorkController::class,'getWorksToApprove']);
    Route::get('/users/{id}/advertisements',[UserController::class, 'getUserAdvertisements']);
    Route::get('/{dormitory}/advertisements/approve',[AdvertisementController::class, 'getAdvertisementsByDormitoryApprove']);

    Route::post('infos', [InfoController::class, 'store']);
    Route::put('infos/{info}', [InfoController::class, 'update']);
    Route::delete('infos/{info}', [InfoController::class, 'destroy']);
    
    // Route::get('users', [UserController::class, 'index']);
    Route::get('users/{user}', [UserController::class, 'show']);
    Route::post('users', [UserController::class, 'store']);
    Route::put('users/{user}', [UserController::class, 'update']);
    Route::delete('users/{user}', [UserController::class, 'destroy']);

    Route::post('works', [WorkController::class, 'store']);
    Route::put('works/{work}', [WorkController::class, 'update']);
    Route::delete('works/{work}', [WorkController::class, 'destroy']);
    
    Route::post('advertisements', [AdvertisementController::class, 'store']);
    Route::put('advertisements/{advertisement}', [AdvertisementController::class, 'update']);
    Route::delete('advertisements/{advertisement}', [AdvertisementController::class, 'destroy']);
    
    Route::post('washings', [WashingController::class, 'store']);
    Route::put('washings/{washing}', [WashingController::class, 'update']);
    Route::delete('washings/{washing}', [WashingController::class, 'destroy']);

    Route::post('worker-tasks', [WorkerTaskController::class, 'store']);
    Route::put('worker-tasks/{worker_task}', [WorkerTaskController::class, 'update']);
    Route::delete('worker-tasks/{worker_task}', [WorkerTaskController::class, 'destroy']);
});
Route::get('infos', [InfoController::class, 'index']);
Route::get('infos/{info}', [InfoController::class, 'show']);
Route::get('works', [WorkController::class, 'index']);
Route::get('works/{work}', [WorkController::class, 'show']);
Route::get('advertisements', [AdvertisementController::class, 'index']);
Route::get('advertisements/{advertisement}', [AdvertisementController::class, 'show']);
Route::get('washings', [WashingController::class, 'index']);
Route::get('washings/{washing}', [WashingController::class, 'show']);
Route::get('worker-tasks', [WorkerTaskController::class, 'index']);
Route::get('worker-tasks/{worker_task}', [WorkerTaskController::class, 'show']);

Route::get('/{dormitory}/advertisements',[AdvertisementController::class, 'getAdvertisementsByDormitory']);
Route::get('/{dormitory}/infos',[InfoController::class, 'getInfosByDormitory']);
Route::get('/washings/{dormitory}/{washing_machine_num}/{day}',[WashingController::class, 'getWashingDay']);
Route::get('/{dormitory}/worker-tasks/{worker}',[WorkerTaskController::class, 'getWorkerTasksByDormitory']);
Route::get('/auth',[AuthController::class,'authenticateWithGoogle']);