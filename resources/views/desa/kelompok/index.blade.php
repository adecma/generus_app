@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					{!! $label !!}

					<div class="pull-right">
						<a href="{{ route('kelompok.create') }}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></a>
					</div>
				</div>
				<div class="panel-body">
					@if(count($kelompoks))
						{!! Form::open(['route' => 'kelompok.search', 'method' => 'get']) !!}
							<div class="input-group {{ $errors->has('cari') ? 'has-error' : 'has-warning' }}">
								{{ Form::text('cari', Request::has('cari') ? Request::input('cari') : null, ['placeholder' => 'Pencarian disini ...', 'class' => 'form-control']) }}

								<span class="input-group-btn">
									{{ Form::submit('Cari', ['class' => $errors->has('cari') ? 'btn btn-danger' : 'btn btn-warning' ]) }}
								</span>									
							</div>
							@if($errors->has('cari'))
								<span class="help-block text-center">
									{{ $errors->first('cari') }}
								</span>
							@endif								
						{!! Form::close() !!}

						<hr>

						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Kelompok</th>
										<th>Kategori</th>
										<th>Alamat</th>
										<th>Updated</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									@foreach($kelompoks as $kelompok)
										<tr>
											<td>{{ $no++ }}</td>
											<td>{{ $kelompok->nama }}</td>
											<td>
												@foreach($kelompok->kategoris as $kategori)
													<span class="label label-info">{{ $kategori->nama }}</span>
												@endforeach
											</td>
											<td>
												{{ $kelompok->alamat }}
											</td>
											<td>{{ $kelompok->updated_at->diffForHumans() }}</td>
											<td>
												{{ Form::open(['route' => ['kelompok.destroy', $kelompok->id], 'method' => 'delete', 'class' => 'ask-delete']) }}
													<a href="{{ route('kelompok.edit', $kelompok->id) }}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
													&nbsp;
													<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i></button>
												{{ Form::close() }}
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							{{ $kelompoks->links() }}
						</div>
					@else
						{!! Form::open(['route' => 'kelompok.search', 'method' => 'get']) !!}
							<div class="input-group {{ $errors->has('cari') ? 'has-error' : 'has-warning' }}">
								{{ Form::text('cari', Request::has('cari') ? Request::input('cari') : null, ['placeholder' => 'Pencarian disini ...', 'class' => 'form-control']) }}

								<span class="input-group-btn">
									{{ Form::submit('Cari', ['class' => $errors->has('cari') ? 'btn btn-danger' : 'btn btn-warning' ]) }}
								</span>									
							</div>
							@if($errors->has('cari'))
								<span class="help-block text-center">
									{{ $errors->first('cari') }}
								</span>
							@endif								
						{!! Form::close() !!}

						<hr>
						
						<p class="text-center">
							{!! $message !!}
						</p>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection