<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $page_title or ''  }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ url( 'assets/libs/bootstrap/css/bootstrap.min.css' ) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ url( 'assets/admin-lte/css/AdminLTE.min.css' ) }}">
    <link rel="stylesheet" href="{{ url( 'assets/admin-lte/css/skins/skin-blue.min.css' ) }}">
    @stack( 'styles' )

    <link rel='shortcut icon' type='image/x-icon' href='{{ url( 'assets/images/favicon.ico' ) }}' />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="@yield( 'body_class' )">
@yield( 'body_content' )

<!-- REQUIRED JS SCRIPTS -->
<script src="{{ url( 'assets/libs/jQuery/jquery-2.2.3.min.js' ) }}"></script>
<script src="{{ url( 'assets/libs/bootstrap/js/bootstrap.min.js' ) }}"></script>
<script src="{{ url( 'assets/admin-lte/js/app.min.js' ) }}"></script>
@stack( 'scripts' )
</body>
</html>
