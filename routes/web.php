<?php

use App\Task;
use Illuminate\Http\Request;

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

Route::get('/tasks', 'TaskController@index', function () {
    $tasks = Task::orderby('created_at','asc')->get();
    return view('tasks',['tasks' =>$tasks]);
});

Route::post('/task','TaskController@store', function(Request $request)
{
$validator = Validator::make($request->all(),['name' => 'required|max:255',]);

if ($validator->fails())
{
    return redirect('/')
        ->withInput()
        ->withErrors($validator);
}
});
Route::delete('/task/{task}', 'TaskController@destroy', function (Task $task)
{
$task->delete();

Return redirect('/');
});

Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(),
        [
            'name' => 'required|max:255',
        ]);
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/');
});

Route::Auth();

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
