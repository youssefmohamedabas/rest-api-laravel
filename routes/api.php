<?php

use App\Http\Controllers\APi\V1\LessonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APi\V1\UserController;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\APi\V1\RelationsController;
use App\Http\Controllers\APi\V1\TagController;

Route::middleware('auth:sanctum')->group(function () {
   
    Route::get('/users', function (Request $request) {
        return $request->user();
    });

    
    Route::apiResource('user', UserController::class);
    Route::apiResource('lessons',LessonController::class);
    Route::apiResource('tags',TagController::class);
    

    
    Route::get('users/{id}/lessons',[RelationsController::class,'userLessons'])->name('user.lesson');
    Route::get('lessons/{id}/tags',[RelationsController::class,'lessonTags'])->name('lesson.tags');
    Route::get('tags/{id}/lessons',[RelationsController::class,'tagLessons'])->name('tag.lessons');
 
});

// Public route for login
Route::post('/login', [LoginController::class, 'login']);