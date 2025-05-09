<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\PaymentController;




Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
Route::post('/tickets/{ticket}/add-to-cart', [TicketController::class, 'addToCart'])->name('tickets.addToCart');
Route::get('/cart', [TicketController::class, 'viewCart'])->name('tickets.cart');
Route::post('/checkout', [TicketController::class, 'checkout'])->name('tickets.checkout');
Route::get('/budget', [BudgetController::class, 'show'])->name('budget.show');
Route::get('/budget/create', [BudgetController::class, 'create'])->name('budget.create');
Route::post('/budget', [BudgetController::class, 'store'])->name('budget.store');
Route::get('/', [TicketController::class, 'index']);


Route::get('/hotels/search', [HotelController::class, 'search'])->name('hotels.search');
Route::get('/cars/search', [CarController::class, 'search'])->name('cars.search');
Route::post('/cart/add/{hotel_id}/{car_id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::delete('/cart/remove/{hotel_id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

