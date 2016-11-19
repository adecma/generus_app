<div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
	{{ Form::label('nama', 'Nama', ['class' => 'control-label col-sm-4']) }}
	
	<div class="col-sm-6">
		{{ Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Nama kelompok', 'autocomplete' =>'off']) }}
		
		@if($errors->has('nama'))
			<span class="help-block">
				{{ $errors->first('nama') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
	{{ Form::label('alamat', 'Alamat', ['class' => 'control-label col-sm-4']) }}
	
	<div class="col-sm-6">
		{{ Form::textarea('alamat', null, ['class' => 'form-control', 'placeholder' => 'Alamat kelompok', 'autocomplete' =>'off']) }}
		
		@if($errors->has('alamat'))
			<span class="help-block">
				{{ $errors->first('alamat') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('kategoris_list') ? 'has-error' : '' }}">
	{{ Form::label('kategoris_list', 'Kategori', ['class' => 'control-label col-sm-4']) }}

	<div class="col-sm-6">
		{{ Form::select('kategoris_list[]', $kategoris, null, ['id' => 'kategoris_list', 'multiple' => true, 'class' => 'form-control']) }}

		@if($errors->has('kategoris_list'))
			<span class="help-block">
				{{ $errors->first('kategoris_list') }}
			</span>
		@endif
	</div>
</div>