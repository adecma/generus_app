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
					Create Role
				</div>

				{!! Form::open(['route' => 'role.store', 'class' => 'form-horizontal']) !!}
					<div class="panel-body">							
							@include('desa.role._form')							
					</div>

					<div class="panel-footer">
						<a href="{{ route('role.index') }}" class="btn btn-default btn-sm">Batal</a>
							
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
		$('#permissions_list').select2({
			placeholder : 'Pilih permissions',
			allowClear: true
		});
	</script>
@endsection