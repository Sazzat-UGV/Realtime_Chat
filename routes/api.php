<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('/connected_users', function (Request $request) {
    return response()->json(['message' => 'User connected'], 200);
});
