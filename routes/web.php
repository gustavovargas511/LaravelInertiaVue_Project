<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/** Basic navigation routes */
Route::get('/', function () {
    // sleep(1);
    return Inertia::render('Home');
})->name('home');

Route::get('/about', function () {
    // sleep(1);
    return inertia('About', [
        'title' => 'About Us',
        'content' => 'This is the about page content.'
    ]);
})->name('about');

/** Created the middleware route to put in all the routes that will have that middleware
 * instead of aading it to each route individually like this:
 * ->middleware('auth')
 */
Route::middleware('auth')->group(function(){
    //Auth Routes
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //Task Routes
    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks-edit');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks-update');
    Route::put('/tasks/{id}/status', [TaskController::class, 'updateStatus'])->name('tasks-update-status');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks-destroy');
});

Route::middleware('guest')->group(function(){
    Route::inertia('/register', 'Auth/Register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

/** End Basic navigation routes */


/** Register, login and logout routes */
//inertia its a get request by default, otherwise you need to specify the method
// Route::inertia('/register', 'Auth/Register')->name('register');
// Route::post('/register', [AuthController::class, 'register']);

// Route::inertia('/login', 'Auth/Login')->name('login');
// Route::post('/login', [AuthController::class, 'login']);

/** End Register, login and logout routes */

/** */