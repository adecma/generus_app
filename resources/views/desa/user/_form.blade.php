<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
	{{ Form::label('name', 'Name', ['class' => 'control-label col-sm-4']) }}
	
	<div class="col-sm-6">
		{{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nama lengkap', 'autocomplete' =>'off']) }}
		
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
		{{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Alamat email', 'autocomplete' =>'off']) }}
		
		@if($errors->has('email'))
			<span class="help-block">
				{{ $errors->first('email') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
	{{ Form::label('password', 'Password', ['class' => 'control-label col-sm-4']) }}
	
	<div class="col-sm-6">
		{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Kata sandi']) }}
		
		@if($errors->has('password'))
			<span class="help-block">
				{{ $errors->first('password') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('roles_list') ? 'has-error' : '' }}">
	{{ Form::label('roles_list', 'Role', ['class' => 'control-label col-sm-4']) }}

	<div class="col-sm-6">
		{{ Form::select('roles_list[]', $roles, null, ['id' => 'roles_list', 'class' => 'form-control', 'placeholder' => 'Pilih roles']) }}

		@if($errors->has('roles_list'))
			<span class="help-block">
				{{ $errors->first('roles_list') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('kelompoks_list') ? 'has-error' : '' }}">
	{{ Form::label('kelompoks_list', 'Akses Kelompok', ['class' => 'control-label col-sm-4']) }}

	<div class="col-sm-6">
		{{ Form::select('kelompoks_list[]', $kelompoks, null, ['id' => 'kelompoks_list', 'class' => 'form-control', 'multiple' => true]) }}

		@if($errors->has('kelompoks_list'))
			<span class="help-block">
				{{ $errors->first('kelompoks_list') }}
			</span>
		@endif
	</div>
</div>