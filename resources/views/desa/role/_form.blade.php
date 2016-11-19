<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
	{{ Form::label('name', 'Name', ['class' => 'control-label col-sm-4']) }}
	
	<div class="col-sm-6">
		{{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nama role', 'autocomplete' =>'off']) }}
		
		@if($errors->has('name'))
			<span class="help-block">
				{{ $errors->first('name') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('display_name') ? 'has-error' : '' }}">
	{{ Form::label('display_name', 'Display Name', ['class' => 'control-label col-sm-4']) }}
	
	<div class="col-sm-6">
		{{ Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => 'Nama role yang akan ditampilkan', 'autocomplete' =>'off']) }}
		
		@if($errors->has('display_name'))
			<span class="help-block">
				{{ $errors->first('display_name') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
	{{ Form::label('description', 'Deskription', ['class' => 'control-label col-sm-4']) }}
	
	<div class="col-sm-6">
		{{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Deskripsi role', 'autocomplete' =>'off']) }}
		
		@if($errors->has('description'))
			<span class="help-block">
				{{ $errors->first('description') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('permissions_list') ? 'has-error' : '' }}">
	{{ Form::label('permissions_list', 'Permissions', ['class' => 'control-label col-sm-4']) }}

	<div class="col-sm-6">
		{{ Form::select('permissions_list[]', $permissions, null, ['id' => 'permissions_list', 'multiple' => true, 'class' => 'form-control']) }}

		@if($errors->has('permissions_list'))
			<span class="help-block">
				{{ $errors->first('permissions_list') }}
			</span>
		@endif
	</div>
</div>