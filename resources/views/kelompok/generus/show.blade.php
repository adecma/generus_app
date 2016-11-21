@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-success">
				<div class="panel-heading">
					Show Generus
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-8">
							<div class="dl-horizontal">
								<dt>Nama Lengkap</dt>
								<dd>{{ $gen->nama_lengkap }}</dd>
								<dt>Panggilan</dt>
								<dd>{{ $gen->nama_pendek }}</dd>
								<dt>Gender</dt>
								<dd>
									@if($gen->gender == 'Laki')
										<i class="fa fa-male"></i>
									@else
										<i class="fa fa-female"></i>
									@endif
									
									&nbsp;

									{{ $gen->gender }}
								</dd>
								<dt>Tanggal Lahir</dt>
								<dd>{{ $gen->tg_lahir->format('d F Y') }}</dd>
								<dt>Usia</dt>
								<dd><i class="fa fa-heartbeat"></i> &nbsp; {{ $gen->tg_lahir->diffInYears() }} th</dd>
								<dt>Kategori</dt>
								<dd>{{ $gen->kategori->nama }}</dd>
								<dt>Kelompok</dt>
								<dd>{{ $gen->kelompok->nama }}</dd>
								<dt>Orang Tua</dt>
								<dd>{{ $gen->orang_tua }}</dd>
								<dt>Alamat</dt>
								<dd>{{ $gen->alamat }}</dd>
								<dt>Kontak</dt>
								<dd>{{ $gen->kontak }}</dd>
								<dt>Status (school / work)</dt>
								<dd>{{ $gen->status }}</dd>
							</div>
						</div>

						<div class="col-sm-4">
							<img src="/uploads/avatars/{{ $gen->avatar }}" style="max-width:100%;, height:auto;display: block;" class="img-thumbnail" alt="{{ $gen->nama_lengkap }}" >
							{!! Form::open(['route' => ['generus.avatar', $gen->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
								<div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
									{{ Form::file('avatar') }}
									@if($errors->has('avatar'))
										<span class="help-block">
											{{ $errors->first('avatar') }}
										</span>
									@endif
								</div>
								
								<div class="pull-right">
									{{ Form::submit('Update Foto', ['class' => 'btn btn-xs btn-success']) }}
								</div>								
							{!! Form::close() !!}
						</div>
					</div>											
				</div>
				<div class="panel-footer">
					<a href="{{ route('generus.index') }}" class="btn btn-default btn-sm">Kembali</a>

					<div class="pull-right">
						<a href="{{ route('generus.edit', $gen->id) }}" class="btn btn-info btn-sm">Edit</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection