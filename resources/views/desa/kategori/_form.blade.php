<div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
	{{ Form::label('nama', 'Nama', ['class' => 'control-label col-sm-4']) }}
	
	<div class="col-sm-6">
		{{ Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Nama kategori', 'autocomplete' =>'off']) }}
		
		@if($errors->has('nama'))
			<span class="help-block">
				{{ $errors->first('nama') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('keterangan') ? 'has-error' : '' }}">
	{{ Form::label('keterangan', 'Keterangan', ['class' => 'control-label col-sm-4']) }}
	
	<div class="col-sm-6">
		{{ Form::textarea('keterangan', null, ['class' => 'form-control', 'placeholder' => 'Keterangan kategori', 'autocomplete' =>'off']) }}
		
		@if($errors->has('keterangan'))
			<span class="help-block">
				{{ $errors->first('keterangan') }}
			</span>
		@endif
	</div>
</div>