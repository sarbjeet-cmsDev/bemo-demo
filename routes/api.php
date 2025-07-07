<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

// Ticket API routes
Route::get('tickets/stats', [TicketController::class, 'stats']);
Route::get('tickets/export-csv', [TicketController::class, 'exportCsv']);
Route::post('tickets/{id}/classify', [TicketController::class, 'classify']);
Route::get('tickets/get-catagories', [TicketController::class, 'GetCatagories']);
Route::apiResource('tickets', TicketController::class);



// Route::controller(TicketController::class)->group(function () {
//     Route::post('/tickets', 'store'); // Create a new ticket
//     Route::get('/tickets', 'index'); // List tickets with filter, search, pagination
//     Route::get('/tickets/{id}', 'show'); // Get ticket details
//     Route::patch('/tickets/{id}', 'update'); // Update ticket status, category, note
//     Route::post('/tickets/{id}/classify', 'classify'); // Dispatch queued AI job
// });
