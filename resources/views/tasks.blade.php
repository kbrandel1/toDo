@extends('home')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			@if (count($tasks) > 0)
				<div class="col-xs-12 panel panel-default">
					<div class="panel-heading">
						Current Tasks
					</div>
					<div class="panel-body">
						<table class="table table-striped task-table">
							<thead>
							<th>Task</th>
							<th>&nbsp;</th>
							</thead>
							<tbody>
							@foreach($tasks as $task)
								<tr>
									<td class="table-text">
										<div>
											{{ $task->name }}
										</div>
									</td>
									<td>
										<form action="/task/{{ $task->id }}" method="POST">
											{{csrf_field()}}
											{{method_field('Delete')}}

											<button type="submit" class="btn btn-danger">
												<i class="fa  fa-trash"></i> Delete
											</button>
										</form>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			@endif

			<div class="panel-body">
				@include('errors')

				<form action="task" method="POST" class="form-horizontal">
					{{csrf_field()}}

					<div class="form-group">
						<label for="task" class="col-sm-3 control-label"> Task</label>

						<div class="col-sm-6">
							<input type="text" name="name" id="task-name" class="form-control">

						</div>

					</div>

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-6">
							<button type="submit" class="btn btn-default">
								<i class="fa fa-plus>"> </i> Add Task
							</button>

						</div>

					</div>
				</form>
			</div>
		</div>
	</div>

@endsection
