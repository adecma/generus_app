@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
					<div class="panel-heading">Profile {{ $user->name }}</div>
					<div class="panel-body">
						<div class="dl-horizontal">
							<dt>Nama</dt>
							<dd>{{ $user->name }}</dd>
							<dt>Email</dt>
							<dd>{{ $user->email }}</dd>
							<dt>Dibuat</dt>
							<dd>{{ $user->created_at->diffForHumans() }}</dd>
							<dt>Logged In</dt>
							<dd>{{ $user->last_logged_in_at->diffForHumans() }}</dd>
							<dt>Akses</dt>
							<dd>
								@if($user->kelompoks)
									@foreach($user->kelompoks as $kelompok)
										Kelompok {{ $kelompok->nama }} <br>
									@endforeach
								@else
									Tidak ada
								@endif
							</dd>
						</div>
					</div>
					<div class="panel-footer">
						<a href="{{ route('home.replace_password') }}" class="btn btn-sm btn-success">Ganti Sandi</a>

						<div class="pull-right">
							<a href="{{ route('home.profile_edit') }}" class="btn btn-sm btn-primary">Edit Profile</a>
						</div>
					</div>
			</div>
		</div>
	</div>
@endsection