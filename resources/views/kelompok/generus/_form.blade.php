<div class="form-group {{ $errors->has('nama_lengkap') ? 'has-error' : '' }}">
	{{ Form::label('nama_lengkap', 'Nama Lengkap', ['class' => 'control-label col-sm-4']) }}
	
	<div class="col-sm-6">
		{{ Form::text('nama_lengkap', null, ['class' => 'form-control', 'placeholder' => 'Sesuai dengan akta/ijazah', 'autocomplete' =>'off']) }}
		
		@if($errors->has('nama_lengkap'))
			<span class="help-block">
				{{ $errors->first('nama_lengkap') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('nama_pendek') ? 'has-error' : '' }}">
	{{ Form::label('nama_pendek', 'Panggilan (*)', ['class' => 'control-label col-sm-4']) }}
	
	<div class="col-sm-6">
		{{ Form::text('nama_pendek', null, ['class' => 'form-control', 'placeholder' => 'Nama panggilan sehari-hari', 'autocomplete' =>'off']) }}
		
		@if($errors->has('nama_pendek'))
			<span class="help-block">
				{{ $errors->first('nama_pendek') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
	{{ Form::label('gender', 'Gender (*)', ['class' => 'control-label col-sm-4']) }}

	<div class="col-sm-6">
		<div class="radio">
			<label>
				{{ Form::radio('gender', 'Laki') }} Laki
			</label>
			&nbsp;&nbsp;
			<label>
				{{ Form::radio('gender', 'Perempuan') }} Perempuan
			</label>
		</div>

		@if($errors->has('gender'))
			<span class="help-block">
				{{ $errors->first('gender') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('tg_lahir') ? 'has-error' : '' }}">
	{{ Form::label('tg_lahir', 'Tanggal Lahir (*)', ['class' => 'control-label col-sm-4']) }}

	<div class="col-sm-6">
		{{ Form::date('tg_lahir', null, ['class' => 'form-control']) }}

		@if($errors->has('tg_lahir'))
			<span class="help-block">
				{{ $errors->first('tg_lahir') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
	{{ Form::label('status', 'Pendidikan / Pekerjaan', ['class' => 'control-label col-sm-4']) }}
	
	<div class="col-sm-6">
		{{ Form::text('status', null, ['class' => 'form-control', 'placeholder' => 'Status lengkap pendidikan / pekerjaan', 'autocomplete' =>'off']) }}
		
		@if($errors->has('status'))
			<span class="help-block">
				{{ $errors->first('status') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('kategori_id') ? 'has-error' : '' }}">
	{{ Form::label('kategori_id', 'Kategori (*)', ['class' => 'control-label col-sm-4']) }}

	<div class="col-sm-6">
		{{ Form::select('kategori_id', $kategoris, null, ['class' => 'form-control', 'placeholder' => 'Pilih kategori']) }}

		@if($errors->has('kategori_id'))
			<span class="help-block">
				{{ $errors->first('kategori_id') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('kelompok_id') ? 'has-error' : '' }}">
	{{ Form::label('kelompok_id', 'Kelompok (*)', ['class' => 'control-label col-sm-4']) }}

	<div class="col-sm-6">
		{{ Form::select('kelompok_id', $kelompoks, null, ['class' => 'form-control', 'placeholder' => 'Pilih kelompok']) }}

		@if($errors->has('kelompok_id'))
			<span class="help-block">
				{{ $errors->first('kelompok_id') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('orang_tua') ? 'has-error' : '' }}">
	{{ Form::label('orang_tua', 'Orang Tua', ['class' => 'control-label col-sm-4']) }}
	
	<div class="col-sm-6">
		{{ Form::text('orang_tua', null, ['class' => 'form-control', 'placeholder' => 'Nama orang tua / wali', 'autocomplete' =>'off']) }}
		
		@if($errors->has('orang_tua'))
			<span class="help-block">
				{{ $errors->first('orang_tua') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
	{{ Form::label('alamat', 'Alamat', ['class' => 'control-label col-sm-4']) }}
	
	<div class="col-sm-6">
		{{ Form::textarea('alamat', null, ['class' => 'form-control', 'placeholder' => 'Tempat tinggal sekarang']) }}
		
		@if($errors->has('alamat'))
			<span class="help-block">
				{{ $errors->first('alamat') }}
			</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('kontak') ? 'has-error' : '' }}">
	{{ Form::label('kontak', 'Kontak', ['class' => 'control-label col-sm-4']) }}
	
	<div class="col-sm-6">
		{{ Form::text('kontak', null, ['class' => 'form-control', 'placeholder' => 'No hp generus (jika memiliki)']) }}
		
		@if($errors->has('kontak'))
			<span class="help-block">
				{{ $errors->first('kontak') }}
			</span>
		@endif
	</div>
</div>