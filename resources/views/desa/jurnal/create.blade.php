@extends('layouts.app')

@section('css')
	<!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('vendor/select2-4.0.3/css/select2.min.css') }}">
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Create jurnal
				</div>

				{!! Form::open(['route' => 'jurnal.store', 'class' => 'form-horizontal']) !!}
					<div class="panel-body">							
							@include('desa.jurnal._form')							
					</div>

					<div class="panel-footer">
						<a href="{{ route('jurnal.index') }}" class="btn btn-default btn-sm">Batal</a>
							
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
		$('#oleh').select2({
			placeholder: "Pilih kelompok/desa",
			allowClear: true
		});
	</script>
@endsection