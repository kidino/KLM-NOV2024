<?php

use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\MembershipController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [
    HomepageController::class, 'index'
])->name('home');

Route::get('/pricing', [
    HomepageController::class, 'pricing'
])->name('pricing');



Route::get('/demo', function(){
    return view('daisyui-test');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/learning',[
    LearningController::class, 
    'index'
])->middleware(['auth','verified'])->name('learning');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/membership', [MembershipController::class, 'index'])->name('membership.index');

});

Route::get('kelas-malam-laravel', function(){
    echo "<h1>Selamat Datang ke Kelas Malam Laravel</h1>";
});

Route::resource('user', UserController::class)->middleware(['auth', 'admin']);
Route::resource('plan', PlanController::class)->middleware(['auth', 'admin']);

// checkout/BAS-123/securepay
Route::get('/checkout/{plan:code}/{payment_method}',
    [
        CheckoutController::class,
        'index'
    ])->name('checkout.go');

// verify/12121212121222112255855/securepay
Route::get('/verify/{payment:payment_code}/{payment_method}',
    [
        CheckoutController::class,
        'verify'
    ])->name('checkout.verify');

Route::post('/verify/{payment:payment_code}/{payment_method}',
[
    CheckoutController::class,
    'verify'
]);

// Route::view('/mail/expiry-reminder','mail.expiry-reminder');

Route::get('/mail/expiry-reminder', function(){
    return view('mail.expiry-reminder', [
        'user' => \App\Models\User::first()
    ]);
});

require __DIR__.'/auth.php';
