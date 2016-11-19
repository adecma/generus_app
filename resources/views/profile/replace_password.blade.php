@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				{!! Form::open(['route' => 'home.update_password', 'class' => 'form-horizontal']) !!}
					<div class="panel-heading">Replace Password {!! Session::get('old_password') !!}</div>
					<div class="panel-body">
						<div class="form-group {{ $errors->has('old_password') || Session::has('old_password') ? 'has-error' : '' }}">
							{{ Form::label('old_password', 'Sandi Lama', ['class' => 'control-label col-sm-4']) }}
								
							<div class="col-sm-6">
								{{ Form::password('old_password', ['class' => 'form-control', 'placeholder' => 'Kata sandi lama', 'autocomplete' =>'off']) }}
								
								@if($errors->has('old_password') || Session::has('old_password'))
									<span class="help-block">
										{{ $errors->first('old_password') }} {{ Session::get('old_password') }}
									</span>
								@endif
							</div>
						</div>

						<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
							{{ Form::label('password', 'Sandi Baru', ['class' => 'control-label col-sm-4']) }}
							
							<div class="col-sm-6">
								{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Kata sandi baru', 'autocomplete' =>'off']) }}
									
								@if($errors->has('password'))
									<span class="help-block">
										{{ $errors->first('password') }}
									</span>
								@endif
							</div>
						</div>

						<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
							{{ Form::label('password_confirmation', 'Ulangi Sandi Baru', ['class' => 'control-label col-sm-4']) }}
							
							<div class="col-sm-6">
								{{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Ulangi kata sandi baru', 'autocomplete' =>'off']) }}
								
								@if($errors->has('password_confirmation'))
									<span class="help-block">
										{{ $errors->first('password_confirmation') }}
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