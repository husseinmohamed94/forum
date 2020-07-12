<?php

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

Route::group(["prefix" => "v1","namespace"=>"ApI"],function($router){
   //below mentio routes are public,user can accss thosr wihout any restriction
       Route::group(["prefix"=>"auth"],function(){ 
        //create new user
        Route::post("register","AuthController@register");
        //login user
        Route::post("login","AuthController@login");

        //refersh JWt token 
        Route::get("refresh","AuthController@refresh");

    });

    //below mention route are available only for the aythticate users
    Route::group(["middleware"=>"auth:api","prefix"=>"auth"],function(){
        //logout user form appliction
        Route::post('logout',"AuthController@logout");
        //get user info
        Route::get("user","AuthController@user");
    });
});