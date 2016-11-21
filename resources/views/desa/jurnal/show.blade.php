@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					Show jurnal <strong>{{ $jurnal->kegiatan }}</strong>
				</div>

				<div class="panel-body">
					<div class="row">
						<div class="col-sm-4">
							<h3>Kegiatan</h3>
							{{ $jurnal->kegiatan }} Bertempat di {{ $jurnal->tempat }}. Dilaksanakan pada tanggal {{ $jurnal->tg->format('d F Y') }} dan dihadiri {{ $jurnal->peserta }} generus.
						</div>
						<div class="col-sm-4">
							<h3>Materi</h3>
							{!! $jurnal->materi !!}
						</div>
						<div class="col-sm-4">
							<h3>Deskripsi</h3>
							{!! $jurnal->deskripsi !!}
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<h3>Galeri Kegiatan</h3>
							@if($jurnal->user_id == Auth::user()->id)
							{!! Form::open(['route' => ['jurnal.galeri', $jurnal->id], 'class' => '', 'enctype' => 'multipart/form-data']) !!}
								<div class="text-center">
									<div class="form-group {{ $errors->has('galeri') ? 'has-error' : '' }}">
										{{ Form::file('galeri') }}
										@if($errors->has('galeri'))
											<span class="help-block">
												{{ $errors->first('galeri') }}
											</span>
										@endif								
									</div>

									<div class="input-group {{ $errors->has('label') ? 'has-error' : '' }}">
										{{ Form::text('label', null, ['class' => 'form-control', 'placeholder' => 'Title / label', 'autocomplete' =>'off']) }}

										<span class="input-group-btn">
											{{ Form::submit('Add Foto', ['class' => $errors->has('label') ? 'btn btn-danger' : 'btn btn-success' ]) }}
										</span>	
										
									</div>

									@if($errors->has('label'))
										<span class="text-danger">
											{{ $errors->first('label') }}
										</span>
									@endif	
								</div>														
							{!! Form::close() !!}
							@endif
							<hr>							
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							@if(count($galeris))
								@foreach($galeris->chunk(3) as $galeri)
									<div class="row">
										@foreach($galeri as $foto)
											<div class="col-xs-4">
												<img src="/uploads/galeris/{{ $foto->filename }}" style="max-width:100%;, height:auto;display: block;" class="img-thumbnail">
													
																								
													{{ Form::open(['route' => ['jurnal.destroy_galeri', $jurnal->id, $foto->id], 'method' => 'delete', 'class' => 'ask-delete']) }}
													&nbsp;
														<p class="text-center">
															@if($jurnal->user_id == Auth::user()->id)
															<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i></button>
															@endif
															{{ $foto->label }}
														</p>
													{{ Form::close() }}
													
											</div>
										@endforeach
									</div>							
								@endforeach
							@else
								<p class="text-center">
									Belum ada foto kegiatan									
								</p>
							@endif		
						</div>
					</div>							
				</div>

				<div class="panel-footer">
					<a href="{{ route('jurnal.index') }}" class="btn btn-default btn-sm">Kembali</a>

					@if($jurnal->user_id == Auth::user()->id)
					<div class="pull-right">
						<a href="{{ route('jurnal.edit', $jurnal->id) }}" class="btn btn-info btn-sm">Edit</a>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection
