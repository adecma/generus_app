@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				{!! Form::model($user, ['route' => 'home.profile_update', 'class' => 'form-horizontal']) !!}
					<div class="panel-heading">Edit Profile {{ $user->name }}</div>
					<div class="panel-body">
						<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
							{{ Form::label('name', 'Nama', ['class' => 'control-label col-sm-4']) }}
								
							<div class="col-sm-6">
								{{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Kata sandi lama', 'autocomplete' =>'off']) }}
								
								@if($errors->has('name'))
									<span class="help-block">
										{{ $errors->first('name') }}
									</span>
								@endif
							</div>
						</div>

						<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
							{{ Form::label('email', 'Email', ['class' => 'control-label col-sm-4']) }}
							
							<div class="col-sm-6">
								{{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Kata sandi baru', 'autocomplete' =>'off']) }}
									
								@if($errors->has('email'))
									<span class="help-block">
										{{ $errors->first('email') }}
									</span>
								@endif
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<a href="{{ route('home.index') }}" class="btn btn-sm btn-default">Batal</a>

						<div class="pull-right">
							<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection