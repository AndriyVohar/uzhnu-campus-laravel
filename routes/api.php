<?php

use App\Http\Controllers\Api\InfoController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WashingController;
use App\Http\Controllers\Api\WorkController;
use App\Http\Controllers\Api\AdvertisementController;
use App\Http\Controllers\Api\WorkerTaskController;
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

Route::get('/works/approve',[WorkController::class,'getWorksToApprove']);
Route::get('/users/{id}/advertisements',[UserController::class, 'getUserAdvertisements']);
Route::get('/{dormitory}/advertisements',[AdvertisementController::class, 'getAdvertisementsByDormitory']);
Route::get('/{dormitory}/advertisements/approve',[AdvertisementController::class, 'getAdvertisementsByDormitoryApprove']);
Route::get('/{dormitory}/infos',[InfoController::class, 'getInfosByDormitory']);
Route::get('/washings/{dormitory}/{washing_machine_num}/{day}',[WashingController::class, 'getWashingDay']);
Route::get('/{dormitory}/worker-tasks/{worker}',[WorkerTaskController::class, 'getWorkerTasksByDormitory']);
Route::apiResources([
    'infos' => InfoController::class,
    'users' => UserController::class,
    'works' => WorkController::class,
    'advertisements' => AdvertisementController::class,
    'washings'=>WashingController::class,
    'worker-tasks'=>WorkerTaskController::class,
]);