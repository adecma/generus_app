<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Sorry, no Accesss</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- font awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome-4.7.0/css/font-awesome.min.css') }}">

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <style>
        .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 172px;
                margin-bottom: 40px;
            }
    </style>
</head>
<body>
    <div id="app">        
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="title text-center">:(</div>
                    <p class="text-center">Maaf, Anda tidak memiliki akses untuk fitur ini. <br> <a href="{{ url('/')}}">Kembali ke halaman awal</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
