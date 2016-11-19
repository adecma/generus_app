@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-success">
				<div class="panel-heading">
					Count Generus

					<div class="pull-right">
						<a href="{{ route('generus.index') }}" class="btn btn-xs btn-default">Kembali</a>
					</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Kategori</th>
									<th>Keterangan</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								@foreach($kategoris as $kategori)
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $kategori->nama }}</td>
										<td>{{ $kategori->keterangan }}</td>
										<td><a href="{{ route('generus.search', 'cari='.$kategori->nama) }}">{{ $kategori->gen_count }}</a></td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection