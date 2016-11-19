@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Create Kategori
				</div>

				{!! Form::open(['route' => 'kategori.store', 'class' => 'form-horizontal']) !!}
					<div class="panel-body">							
							@include('desa.kategori._form')							
					</div>

					<div class="panel-footer">
						<a href="{{ route('kategori.index') }}" class="btn btn-default btn-sm">Batal</a>
							
						<div class="pull-right">
							<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection