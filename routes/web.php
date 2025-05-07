<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BudgetController;

Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
Route::post('/tickets/{ticket}/add-to-cart', [TicketController::class, 'addToCart'])->name('tickets.addToCart');
Route::get('/cart', [TicketController::class, 'viewCart'])->name('tickets.cart');
Route::post('/checkout', [TicketController::class, 'checkout'])->name('tickets.checkout');
Route::get('/budget', [BudgetController::class, 'show'])->name('budget.show');
Route::get('/budget/create', [BudgetController::class, 'create'])->name('budget.create');
Route::post('/budget', [BudgetController::class, 'store'])->name('budget.store');



// Route::get('/', function () {
//     return view('welcome');
// });
