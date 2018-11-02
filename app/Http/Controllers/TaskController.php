<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	public function index()
	{
		$tasks = Task::orderby( 'created_at', 'asc' )->get();

		return view( 'tasks', [ 'tasks' => $tasks ] );
	}

	public function store(Request $request)
	{
		$validator = Validator::make( $request->all(),
			[
				'name' => 'required|max:255',
			] );
		if( $validator->fails() ){
			return redirect( '/' )
				->withInput()
				->withErrors( $validator );
		}
		$task       = new Task($request->all());
		$task->save();

		return redirect( '/' );
	}

	public function complete(Task $task)
    {

        $task->complete = true;
        $task->save();

        //return redirect('/');
    }

	public function destroy( Request $request, Task $task )
	{
		if($request->user()->can('delete', $task)){
			$task->delete();
			Return redirect( '/' );
		}else{
			return view('tasks', [
				'tasks' => Task::orderby( 'created_at', 'asc' )->get(),
				'errors' => [
					'You cannot delete this item',
				]
			]);
		}




	}
}
