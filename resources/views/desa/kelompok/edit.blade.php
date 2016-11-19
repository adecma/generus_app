@extends('layouts.app')

@section('css')
	<!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('vendor/select2-4.0.3/css/select2.min.css') }}">
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-info">
				<div class="panel-heading">
					Edit Kelompok : <strong>{{ $kelompok->nama }}</strong>
				</div>

				{!! Form::model($kelompok, ['route' => ['kelompok.update', $kelompok->id], 'class' => 'form-horizontal', 'method' => 'put']) !!}
					<div class="panel-body">							
							@include('desa.kelompok._form')							
					</div>

					<div class="panel-footer">
						<a href="{{ route('kelompok.index') }}" class="btn btn-default btn-sm">Batal</a>
							
						<div class="pull-right">
							<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection

@section('js')
	<!-- select2 -->
	<script src="{{ asset('vendor/select2-4.0.3/js/select2.min.js') }}"></script>
	<script>
		$('#kategoris_list').select2({
			placeholder : 'Pilih kategori',
			allowClear: true
		});
	</script>
@endsection