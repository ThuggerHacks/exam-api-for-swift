<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::controller(UserController::class)->group(function(){
    Route::post("/user","index");
    Route::post("/login","login");
    Route::get("/user/{id?}","one");
    Route::put("/user/{id?}","update");
});

Route::controller(ExamController::class)->group(function(){
    Route::get("/exam","all");
    Route::get("/exam/{id?}","one");
    Route::get("/exam/user/{id?}","userId");
    Route::post("/exam","index");
    Route::post("/exam/find","get");
    Route::post("/category","onCategorySelect");
    Route::post("/inst","onInstitutionSelect");
    Route::put("/exam/{id?}","update");
    Route::delete("/exam/{id?}","delete");
});

Route::controller(FeedbackController::class)->group(function(){
    Route::post("/feed","index");
    Route::get("/feed","all");
    Route::get("/feed/{id?}","one");
    Route::get("/feed/exam/{id?}","byExamId");
    Route::delete("/feed/{id?}","delete");
});