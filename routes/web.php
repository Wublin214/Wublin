<?php


use App\Http\Controllers\ChatController;
use App\Http\Controllers\PageController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});




Route::get('/register', [App\Http\Controllers\RegisterController::class, 'router']) -> name('register');


Route::get('/LoginClient', [App\Http\Controllers\LoginClientController::class, 'router'])-> name('LoginClient');
Route::post('/LoginClient', [App\Http\Controllers\LoginClientController::class, 'login'])-> name('LoginClient');
Route::get('/RegisterClient', [App\Http\Controllers\RegisterClientController::class, 'router'])-> name('RegisterClient');
Route::post('/RegisterClient', [App\Http\Controllers\RegisterClientController::class, 'store'])-> name('store');;

Route::get('/LoginMaster', [App\Http\Controllers\LoginMasterController::class, 'router'])-> name('LoginMaster');
Route::post('/LoginMaster', [App\Http\Controllers\LoginMasterController::class, 'login']);
Route::get('/RegisterMaster', [App\Http\Controllers\RegisterMasterController::class, 'router'])-> name('RegisterMaster');
Route::post('/RegisterMaster', [App\Http\Controllers\RegisterMasterController::class, 'store']);


// Masters-specific routes
Route::middleware(['auth:masters', 'verified'])->group(function () {

    Route::get('/MainMaster', [App\Http\Controllers\MainMasterController::class, 'router'])->name('MainMaster');
    Route::get('/MainMaster/Profile', [App\Http\Controllers\MasterProfileController::class, 'router'])->name('MasterProfile');
    Route::get('/MainMaster/Profile/Portfolio', [App\Http\Controllers\MasterProfileController::class, 'MasterPartfolioPartfolio'])->name('MasterPartfolio');
    Route::get('/MainMaster/Profile/Portfolio/NewPortfolio', [App\Http\Controllers\MasterProfileController::class, 'MasterNewPortfolio'])->name('MasterNewPortfolio');
    Route::post('/MainMaster/Profile/Portfolio/NewPortfolio', [App\Http\Controllers\MasterProfileController::class, 'MasterPostNewPortfolio'])->name('MasterPostNewPortfolio');
    Route::get('/MainMaster/Application', [App\Http\Controllers\ApplicationController::class, 'router'])->name('ApplicationView');
    Route::post('/MainMaster/Application/Accept', [App\Http\Controllers\ApplicationController::class, 'AcceptApplication'])->name('AcceptApplication');
    Route::post('/MainMaster/Application/Reject', [App\Http\Controllers\ApplicationController::class, 'RejectApplication'])->name('RejectApplication');
});

// Clients-specific routes
Route::middleware(['auth:clients', 'verified'])->group(function () {
    Route::get('/MainClient', [App\Http\Controllers\MainClientController::class, 'router'])->name('MainClient');
    Route::get('/MainClient/Profile', [App\Http\Controllers\ClientProfilController::class, 'router'])->name('ClientProfile');
    Route::get('/MainClient/Profile/Editing', [App\Http\Controllers\ProfileEditingClientController::class, 'router'])->name('ProfileEditingClient');

    Route::post('/MainClient/Profile/Editing', [App\Http\Controllers\ProfileEditingClientController::class, 'postEditing']);
    Route::get('/MainClient/Profile/Portfolio', [App\Http\Controllers\PartfolioClientController::class, 'Partfolio'])->name('Partfolio');
    Route::get('/MainClient/Profile/Portfolio/NewPortfolio', [App\Http\Controllers\PartfolioClientController::class, 'NewPortfolio'])->name('NewPortfolio');
    Route::post('/MainClient/Profile/Portfolio/NewPortfolio', [App\Http\Controllers\PartfolioClientController::class, 'PostNewPortfolio'])->name('PostNewPortfolio');


});

Route::middleware(['multi-auth:masters,clients'])->group(function () {
    Route::get('/email/verify', function () {
        return view('auth/verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/register');
    })->middleware(['signed'])->name('verification.verify');


    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Ссылка для подтверждения отправлена!');
    })->middleware(['throttle:6,1'])->name('verification.send');


    Route::get('/chat', [ChatController::class, 'route'])->name('ClientChat');
    Route::post('/MainClient/chat/create', [ChatController::class, 'StoryChat'])->name('chat.create');
    Route::post('/MainClient/chat/send', [ChatController::class, 'StoryMessage'])->name('message.send');
    Route::get('/MainClient/chat/messages', [ChatController::class, 'getMessageChat'])->name('message.send');
    Route::post('/MainClient/chat/send', [ChatController::class, 'StoryMessage'])->name('message.send');

    Route::get('/order-view', [\App\Http\Controllers\PageController::class, 'OrderView'])->name('Order');
    Route::get('/freelanser-profil', [\App\Http\Controllers\ClientCardController::class, 'ClientView']);
    Route::post('/TakeOrder', [PageController::class, 'TakeOrder'])->name('TakeOrder');
});





