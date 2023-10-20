<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/' , function() {
    return redirect()->route('tasks.index');
});

// query builder examples 
// php artisan tinker : executer des query builder on the cli command

Route::get('/tasks', function (){
    return view('index', [
        'tasks' => App\Models\Task::latest()->where('completed', true)->get()
    ]);
})->name('tasks.index');

 Route::get('/tasks/{id}' , function ($id) {
    $task = \App\Models\Task::findOrFail( $id );
    return view('show' , ['task' => $task]);
 }) ->name('tasks.show');

Route::get('/hello/{name}' , function ($name){
    return 'hi '.$name;
});
 
