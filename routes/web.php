<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
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

  
Route::view('/tasks/create' ,'create')->name('tasks.create');

// Route::get('/tasks/{id}/edit', function ($id) {
//     return view('edit', [
//         'task' => Task::findOrFail($id)
//     ]);
// })->name('tasks.edit');



Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task' => $task
    ]);
})->name('tasks.edit');


Route::get('/tasks/{task}' , function (Task $task) {
    return view('show' , ['task' => $task]);
 }) ->name('tasks.show');


// Route::get('/hello/{name}' , function ($name){
//     return 'hi '.$name;
// });


Route::post('/tasks' , function(TaskRequest $request){

    // $data = $request->validated();
    // $task = new Task;
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    $task = Task::create($request->validated());
    return redirect()->route('tasks.show' , ['task' => $task->id])
       ->with('success' , 'Task created successfully!')
    ;

})->name('tasks.store');


Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {

    // $data = $request->validated();
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    $task->update( $request->validated());  //MASS ASSIGNEMENT
  
    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task updated successfully!');
})->name('tasks.update');
