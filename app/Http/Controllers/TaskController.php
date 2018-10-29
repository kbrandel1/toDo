<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	public function index()
	{
		$tasks = Task::orderby( 'created_at', 'asc' )->get();

		return view( 'tasks', [ 'tasks' => $tasks ] );
	}

	public function destroy( Request $request, Task $task )
	{
		if($request->user()->can('destroy', $task)){
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
