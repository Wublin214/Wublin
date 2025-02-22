<?php


use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});




Route::get('/register', [App\Http\Controllers\RegisterController::class, 'router']) -> name('register');
//все страницы связаные с клиентами (фрилансерами )

Route::get('/LoginClient', [App\Http\Controllers\LoginClientController::class, 'router'])-> name('LoginClient');
Route::post('/LoginClient', [App\Http\Controllers\LoginClientController::class, 'login'])-> name('LoginClient');

Route::get('/RegisterClient', [App\Http\Controllers\RegisterClientController::class, 'router'])-> name('RegisterClient');
Route::post('/RegisterClient', [App\Http\Controllers\RegisterClientController::class, 'store'])-> name('store');;



Route::middleware(['auth:clients'])->group( function () {


    Route::get('/MainClient', [App\Http\Controllers\MainClientController::class, 'router'])->name('MainClient');

    Route::get('/MainClient/orders', [App\Http\Controllers\MainClientController::class, 'AllOrder'])->name('MainClientOrders');

    //Уведомление о подтверждении электронной почты
    Route::get('/email/verify', function () {
        return view('verify-email');
    })->middleware('auth')->name('verification.notice');

//Обработчик проверки электронной почты
    Route::get('/email-verify/{id}/{hash}', function (EmailVerificationRequest $request) {

        Log::info($request->all()); // Log the request data
        $request->fulfill();

        return redirect()->route("register");
    })->middleware('signed')->name('verification.verify');

//Повторная отправка письма с подтверждением
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Ссылка для подтверждения отправлена!');
    })->middleware( 'throttle:3,1')->name('verification.send');



});




Route::get('/LoginMaster', [App\Http\Controllers\LoginMasterController::class, 'router'])-> name('LoginMaster');
Route::post('/LoginMaster', [App\Http\Controllers\LoginMasterController::class, 'login']);

Route::get('/RegisterMaster', [App\Http\Controllers\RegisterMasterController::class, 'router'])-> name('RegisterMaster');
Route::post('/RegisterMaster', [App\Http\Controllers\RegisterMasterController::class, 'store']);



Route::middleware(['auth:masters'])->group( function () {

    Route::get('/MainMaster', [App\Http\Controllers\MainMasterController::class, 'CreateFreelansersCard']);
    Route::get('/MainMaster', [App\Http\Controllers\MainMasterController::class, 'router'])->name('MainMaster');



    Route::get('/email/verify', function () {
        return view('verify-email');
    })->middleware('auth')->name('verification.notice');

//Обработчик проверки электронной почты
    Route::get('/email-verify/{id}/{hash}', function (EmailVerificationRequest $request) {

        Log::info($request->all()); // Log the request data
        $request->fulfill();

        return redirect()->route("register");
    })->middleware('signed')->name('verification.verify');

//Повторная отправка письма с подтверждением
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Ссылка для подтверждения отправлена!');
    })->middleware( 'throttle:3,1')->name('verification.send');



});
//странички пользователей и заказа
Route::get('/order-view', [\App\Http\Controllers\PageController::class, 'OrderView']);
Route::get('/freelanser-profil', [\App\Http\Controllers\FrelanserCardController::class, 'ClientView']);
