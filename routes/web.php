<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
Route::post('/tickets/{ticket}/add-to-cart', [TicketController::class, 'addToCart'])->name('tickets.addToCart');
Route::get('/cart', [TicketController::class, 'viewCart'])->name('tickets.cart');
Route::post('/checkout', [TicketController::class, 'checkout'])->name('tickets.checkout');



// Route::get('/', function () {
//     return view('welcome');
// });
