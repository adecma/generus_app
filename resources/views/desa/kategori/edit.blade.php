@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-info">
				<div class="panel-heading">
					Edit Kategori : <strong>{{ $kategori->nama }}</strong>
				</div>

				{!! Form::model($kategori, ['route' => ['kategori.update', $kategori->id], 'class' => 'form-horizontal', 'method' => 'put']) !!}
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