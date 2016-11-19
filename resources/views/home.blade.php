@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <p class="text-center">
                        Hay {{ Auth::user()->name }}, You are logged in!
                    </p>
                        <hr>
                    <p class="text-center">  
                        <span class="label label-success">LDII TV </span> &nbsp;&nbsp;Ayo Hormati Guru! #GerakanMenghormatiGuru <i class="fa fa-smile-o"></i>
                    </p>

                    <div class="embed-responsive embed-responsive-16by9">
                        <video controls class="embed-responsive-item">
                            <source src="{{ asset('video/GerakanMenghormatiGuru.MP4') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
