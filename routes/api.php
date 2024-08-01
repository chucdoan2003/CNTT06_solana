<?php

use App\Http\Controllers\ActiveController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\NFTcontroller;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/wallet', [WalletController::class, 'postWallet']);


Route::post('/ticket/add', [TicketController::class, 'addTicket']);
Route::get('/ticket/list', [TicketController::class, 'listTicket']);
Route::get('/tickets-by-category/{cateID}', [TicketController::class, 'getTicketsByCategoryId']);
Route::get('/ticket/detail/{id}', [TicketController::class, 'getTicketsById']);


// CATEGORY:
Route::post('/category/add', [CategoryController::class, 'addCate']);
Route::get('/category/detail/{id}', [CategoryController::class, 'getCateById']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::put('/update-category/{id}', [CategoryController::class, 'update']);
Route::delete('/delete-category/{id}', [CategoryController::class, 'destroy']);


// add ticket by gameshift
Route::post('/Ticket/add/gameshift', [NFTcontroller::class, 'newTicket']);

Route::get('/active/list', [ActiveController::class, 'list']);
