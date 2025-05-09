<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PreferenceController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return redirect()->route('preferences');
});

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
Route::get('/select', [CartController::class, 'showSelectionForm'])->name('cart.select');
Route::post('/cart/add/{hotel_id?}/{car_id?}', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{type}/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove'); // type = hotel|car


// Preferences (Feature 1)
Route::get('/preferences', [PreferenceController::class, 'showPreferences'])->name('preferences');
Route::post('/preferences/budget', [PreferenceController::class, 'setBudget'])->name('preferences.budget');
Route::post('/preferences/bookmarks', [PreferenceController::class, 'addBookmark'])->name('preferences.bookmark.add');
Route::post('/preferences/bookmarks/remove', [PreferenceController::class, 'removeBookmark'])->name('preferences.bookmark.remove');

// Recommendations (Feature 2)
Route::get('/recommendations', [RecommendationController::class, 'showRecommendations'])->name('recommendations');

// Reviews (Features 3 & 4)
Route::get('/reviews/{type}/{id}', [ReviewController::class, 'showReviews'])->name('reviews.show');
Route::post('/reviews', [ReviewController::class, 'postReview'])->name('reviews.store');