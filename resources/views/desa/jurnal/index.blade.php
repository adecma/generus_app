@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					{!! $label !!}

					<div class="pull-right">
						@role('master')
							<a href="{{ route('jurnal.toexcel') }}" target="_blank" class="btn btn-warning btn-xs"><i class="fa fa-file-excel-o"></i></a>

							&nbsp;
						@endrole

						<a href="{{ route('jurnal.create') }}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></a>
					</div>
				</div>
				<div class="panel-body">
					@if(count($jurnals))
						{!! Form::open(['route' => 'jurnal.search', 'method' => 'get']) !!}
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
										<th>Kegiatan</th>
										<th>Oleh</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									@foreach($jurnals as $jurnal)
										<tr>
											<td>{{ $no++ }}</td>
											<td>
												<a href="{{ route('jurnal.show', $jurnal->id) }}" class="">{{ $jurnal->kegiatan }}</a> <br>
												Oleh {{ $jurnal->oleh }} <br>
												Bertempat di {{ $jurnal->tempat }} <br>
												Pada tanggal {{ $jurnal->tg->format('d F Y') }} <br>
												Dihadiri Insya Allah {{ $jurnal->peserta }} generus
											</td>
											<td>
												{{ $jurnal->user->name }} <br>
												{{ $jurnal->updated_at->diffForHumans() }}
											</td>
											<td>
												@permission('manage-jurnal')
													@if($jurnal->user_id == Auth::user()->id)
														{{ Form::open(['route' => ['jurnal.destroy', $jurnal->id], 'method' => 'delete', 'class' => 'ask-delete']) }}
															<a href="{{ route('jurnal.edit', $jurnal->id) }}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
															&nbsp;
															<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i></button>
														{{ Form::close() }}
													@else
														<i class="fa fa-minus-circle"></i>
													@endif
												@endpermission

												@permission('read-jurnal')
													<i class="fa fa-minus-circle"></i>
												@endpermission	
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							{{ $jurnals->links() }}
						</div>
					@else
						{!! Form::open(['route' => 'jurnal.search', 'method' => 'get']) !!}
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