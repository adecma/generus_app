<div class="form-group {{ $errors->has('kegiatan') ? 'has-error' : '' }}">
	{{ Form::label('kegiatan', 'Kegiatan', ['class' => 'control-label col-sm-4']) }}
	
	<div class="col-sm-6">
		{{ Form::text('kegiatan', null, ['class' => 'form-control', 'placeholder' => 'Nama kegiatan', 'autocomplete' =>'off']) }}
		
		@if($errors->has('kegiatan'))
			<span class="help-block">
				{{ $errors->first('kegiatan') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('oleh') ? 'has-error' : '' }}">
	{{ Form::label('oleh', 'Oleh', ['class' => 'control-label col-sm-4']) }}

	<div class="col-sm-6">
		{{ Form::select('oleh', $oleh, null, ['class' => 'form-control', 'placeholder' => 'Pilih kelompok/desa']) }}

		@if($errors->has('oleh'))
			<span class="help-block">
				{{ $errors->first('oleh') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('tempat') ? 'has-error' : '' }}">
	{{ Form::label('tempat', 'Tempat', ['class' => 'control-label col-sm-4']) }}
	
	<div class="col-sm-6">
		{{ Form::text('tempat', null, ['class' => 'form-control', 'placeholder' => 'Lokasi pelaksanaan kegiatan', 'autocomplete' =>'off']) }}
		
		@if($errors->has('tempat'))
			<span class="help-block">
				{{ $errors->first('tempat') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('tg') ? 'has-error' : '' }}">
	{{ Form::label('tg', 'Tanggal', ['class' => 'control-label col-sm-4']) }}

	<div class="col-sm-6">
		{{ Form::date('tg', null, ['class' => 'form-control']) }}

		@if($errors->has('tg'))
			<span class="help-block">
				{{ $errors->first('tg') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('peserta') ? 'has-error' : '' }}">
	{{ Form::label('peserta', 'Peserta', ['class' => 'control-label col-sm-4']) }}
	
	<div class="col-sm-6">
		{{ Form::text('peserta', null, ['class' => 'form-control', 'placeholder' => 'Jumlah peserta', 'autocomplete' =>'off']) }}
		
		@if($errors->has('peserta'))
			<span class="help-block">
				{{ $errors->first('peserta') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('materi') ? 'has-error' : '' }}">
	{{ Form::label('materi', 'Materi', ['class' => 'control-label col-sm-4']) }}
	
	<div class="col-sm-6">
		{{ Form::textarea('materi', null, ['class' => 'form-control', 'placeholder' => 'Detail materi dan yang menyampaikan', 'autocomplete' =>'off']) }}
		
		@if($errors->has('materi'))
			<span class="help-block">
				{{ $errors->first('materi') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('deskripsi') ? 'has-error' : '' }}">
	{{ Form::label('deskripsi', 'Deskription', ['class' => 'control-label col-sm-4']) }}
	
	<div class="col-sm-6">
		{{ Form::textarea('deskripsi', null, ['class' => 'form-control', 'placeholder' => 'Keterangan tambahan tentang kegiatan ini', 'autocomplete' =>'off']) }}
		
		@if($errors->has('deskripsi'))
			<span class="help-block">
				{{ $errors->first('deskripsi') }}
			</span>
		@endif
	</div>
</div>