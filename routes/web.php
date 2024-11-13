<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SolicitacaoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::controller(HomeController::class)->group(function (){
    Route::get('/','index')->name('home');
    Route::get('/assistentes','getAssistantsByProvince');
    Route::get('/assistente/{id}','show')->name('assistante.profile');;
    Route::get('/startmozbiz','start')->name('start');
});

Route::post('/enviarNewsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');


// Rota para o dashboard do usuário
Route::prefix('user')->middleware(['auth', 'isUser'])->group(function () {
    Route::get('perfil',[App\Http\Controllers\UserController::class, 'perfil'])->name('perfil');
    Route::post('perfil',[App\Http\Controllers\UserController::class, 'updateUserDetails'])->name('updateUserDetails');
    Route::get('change-password',[App\Http\Controllers\UserController::class, 'passwordCreate'])->name('change-password');
    Route::post('change-password',[App\Http\Controllers\UserController::class, 'changePassword'])->name('changePassword');
    Route::post('/solicitar-contatos', [SolicitacaoController::class, 'store'])->name('solicitacao.store');
    Route::post('assistente/{item}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    //assistentes
    Route::controller(App\Http\Controllers\AssistenteController::class)->group(function (){
        Route::get('/informação','index')->name('informação.index');
        Route::POST('/informação','store')->name('informação.store');
    });
});

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/solicitacoes', [SolicitacaoController::class, 'solicitacoes'])->name('solicitacoes');
    Route::get('solicitacoes/{solicitacao}', [SolicitacaoController::class, 'showSolicitacao'])->name('solicitacoes.show');
    Route::put('solicitacoes/{solicitacao}/aprovar', [SolicitacaoController::class, 'aprovarPagamento'])->name('solicitacoes.aprovar');
    //assistentes
    Route::controller(App\Http\Controllers\Admin\AssistentesController::class)->group(function (){
        Route::get('/assistentes','index')->name('assistants.index');
        Route::get('/assistentes/criar','criar');
        Route::POST('/assistentes','store')->name('assistants.store');
        Route::get('/assistentes/{item}/edit','edit');
        Route::PUT('/assistentes/{item}','update')->name('assistants.update');
        Route::get('/assistentes/{item}/delete', 'destroy');
        Route::get('/cadastros', 'cadastros')->name('assistants.cadastro');
        Route::get('/assistentes/{id}/status', 'editStatus')->name('assistants.editStatus');
        Route::post('assistentes/{id}/status', 'updateStatus')->name('assistants.updateStatus');

    });

    //newsletter
    Route::controller(App\Http\Controllers\Admin\NewsletterController::class)->group(function (){
        Route::get('/newsletters/whatsapp','showWhatsapp')->name('newsletters.whatsapp');
        Route::POST('/newsletters/whatsapp/send','sendWhatsapp')->name('newsletters.whatsapp.send');
        Route::get('/newsletters/email','showEmail')->name('newsletters.email');
        Route::post('newsletters/email/send', 'sendEmail')->name('newsletters.email.send');

    });

    Route::get('/admin/user/', [App\Http\Controllers\UserController::class, 'index'])->name('admin.user');
    Route::get('/admin/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('admin.user.create');
    Route::post('/admin/user', [App\Http\Controllers\UserController::class, 'store'])->name('admin.user.store');
    Route::get('/admin/user/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('admin.user.edit');
    Route::PUT('/admin/user/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('admin.user.update');
    Route::DELETE('/admin/user/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('admin.user.destroy');

});