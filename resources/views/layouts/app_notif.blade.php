@if(Session::has('notif'))
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<p class="text-center">{!! Session::get('notif') !!}</p>
	</div>
@endif