<?php

use App\Models\ApplicationDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

use function PHPUnit\Framework\returnSelf;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Citizen Portal API Routes (Public)
Route::prefix('citizen')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Api\CitizenPortalController::class, 'dashboard']);
    Route::get('/tenders', [App\Http\Controllers\Api\CitizenPortalController::class, 'tenders']);
    Route::get('/tenders/{tender}', [App\Http\Controllers\Api\CitizenPortalController::class, 'tender']);
    Route::get('/contracts', [App\Http\Controllers\Api\CitizenPortalController::class, 'contracts']);
    Route::get('/contracts/{contract}', [App\Http\Controllers\Api\CitizenPortalController::class, 'contract']);
    Route::get('/mda-spending', [App\Http\Controllers\Api\CitizenPortalController::class, 'mdaSpending']);
    Route::get('/top-contractors', [App\Http\Controllers\Api\CitizenPortalController::class, 'topContractors']);
    Route::get('/project-status', [App\Http\Controllers\Api\CitizenPortalController::class, 'projectStatus']);
    Route::get('/mdas', [App\Http\Controllers\Api\CitizenPortalController::class, 'mdas']);
    Route::get('/search', [App\Http\Controllers\Api\CitizenPortalController::class, 'search']);
});

// Authenticated API Routes
Route::middleware('auth:sanctum')->group(function () {
    // User profile
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Admin API routes
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        // Admin-specific API routes will go here
    });

    // MDA Officer API routes
    Route::middleware('role:mda_officer')->prefix('mda')->group(function () {
        // MDA-specific API routes will go here
    });

    // Vendor API routes
    Route::middleware('role:vendor')->prefix('vendor')->group(function () {
        // Vendor-specific API routes will go here
    });

    // Auditor API routes
    Route::middleware('role:auditor')->prefix('auditor')->group(function () {
        // Auditor-specific API routes will go here
    });
});

Route::get('/tty', function ()
{
    $targetFolder = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public/';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/public/storage';
    symlink($targetFolder,$linkFolder);
    echo 'Symlink process successfully completed';
});
