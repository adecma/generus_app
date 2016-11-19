@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-info">
				<div class="panel-heading">
					Edit permission : <strong>{{ $permission->display_name }}</strong>
				</div>

				{!! Form::model($permission, ['route' => ['permission.update', $permission->id], 'class' => 'form-horizontal', 'method' => 'put']) !!}
					<div class="panel-body">							
							@include('desa.permission._form')							
					</div>

					<div class="panel-footer">
						<a href="{{ route('permission.index') }}" class="btn btn-default btn-sm">Batal</a>
							
						<div class="pull-right">
							<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection