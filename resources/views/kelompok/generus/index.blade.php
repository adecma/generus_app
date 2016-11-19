@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					{!! $label !!}
						
					<div class="pull-right">
						<a href="#" class="btn btn-success btn-xs"><i class="fa fa-bar-chart"></i></a>

						&nbsp;

						<a href="{{ route('generus.create') }}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></a>
					</div>
				</div>
				<div class="panel-body">
					@if(count($gens))
						{!! Form::open(['route' => 'generus.search', 'method' => 'get']) !!}
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
										<th>Nama</th>
										<th>Kategori</th>
										<th>Kelompok</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									@foreach($gens as $gen)
										<tr>
											<td>{{ $no++ }}</td>
											<td>												
												<a style="position:relative; padding-left:50px;" href="{{ route('generus.show', $gen->id) }}">
													<img src="/uploads/avatars/{{ $gen->avatar }}" alt="{{ $gen->nama_pendek }}" style="width:25px; height:25px; position:absolute; left:10px; border-radius:50%;">

													{{ $gen->nama_pendek }}
												</a>

												&nbsp;&nbsp;

												@if($gen->gender == 'Laki')
													<i class="fa fa-male"></i>
												@else
													<i class="fa fa-female"></i>
												@endif

												&nbsp;&nbsp;

												<i class="fa fa-heartbeat"></i>&nbsp;{{ $gen->tg_lahir->diffInYears() }} 
											</td>
											<td>{{ $gen->kategori->nama }}</td>
											<td>{{ $gen->kelompok->nama }}</td>
											<td>
												@permission('manage-generus')
													{{ Form::open(['route' => ['generus.destroy', $gen->id], 'method' => 'delete', 'class' => 'ask-delete']) }}
														<a href="{{ route('generus.edit', $gen->id) }}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
														&nbsp;
														<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i></button>
													{{ Form::close() }}
												@endpermission

												@permission('read-generus')
													<i class="fa fa-minus-circle"></i>
												@endpermission													
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							{{ $gens->links() }}
						</div>
					@else
						{!! Form::open(['route' => 'generus.search', 'method' => 'get']) !!}
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