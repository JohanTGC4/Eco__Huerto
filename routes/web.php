<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\MisplantasController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ComprarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');


// Route::get('/inicio', function () {
//     return view('home');
// })->name('home');
// Route::get('/blog', function () {
//     return view('blog');
// })->name('blog');

Route::get('/chatbot', function () {
    return view('chatbot');
})->name('chatbot');

// Route::get('/comprar', function () {
//     return view('comprar');
// })->name('comprar');

Route::get('/detalles', function () {
    return view('detalles');
})->name('detalles');

Route::get('/login', function () {
    return view('login');
})->name('login');

// Route::get('/misPlantas', function () {
//     return view('misplantas');
// })->name('misplantas');

// Route::get('/perfilC', function () {
//     return view('perfilcli');
// })->name('perfilcli');



Route::group(['prefix' => 'usuarios', 'middleware' => 'auth:usuario'], function() {
     Route::get('/perfilC', [PerfilController::class, 'index'])->name('perfilcli');
    Route::get('/blog', [blogController::class, 'index'])->name('blog');
   

    Route::resource('/misPlantas', MisplantasController::class);

Route::resource('/blog', BlogController::class);
Route::put('/blog/{id}', [BlogController::class, 'update'])->name('blog.update');

Route::delete('blog/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');



Route::post('/get-plantas-by-categoria', [MisPlantasController::class, 'getPlantasByCategoria'])->name('misplantas.getPlantasByCategoria');
Route::post('/get-planta-details', [MisPlantasController::class, 'getPlantaDetails'])->name('misplantas.getPlantaDetails');
// En routes/web.php

Route::get('/misplantas', [MisPlantasController::class, 'index'])->name('misplantas');



     Route::get('/comprar', [ComprarController::class, 'index'])->name('comprar');
    //  Route::get('/home', [PerfilController::class, 'home'])->name('home');
    Route::get('/home', function () { 
        return view('home');
})->name('home');
  
   
});



Route::group(['prefix' => 'administradores', 'middleware' => 'auth:admin'], function() {

   Route::get('/homeAdmin', function () { 
       return view('Plantas.homeCrud');
})->name('homeAdmin');
Route::get('/categoryCrud', function () { 
    return view('Plantas.homeCrud');
})->name('categoryCrud');

Route::get('/productCrud', function () { 
    return view('Plantas.homeCrud');
})->name('productCrud');

Route::get('/homeAdmin', function () { 
    return view('Plantas.homeCrud');
})->name('homeAdmin');
 
  
});


Route::post('/loginUsuario', [UsuarioController::class, 'login'])->name('loginUsuario');


Route::post('/registrar', [UsuarioController::class, 'register'])->name('registrar');

Route::get('/logout', [UsuarioController::class, 'logout'])->name('logout');