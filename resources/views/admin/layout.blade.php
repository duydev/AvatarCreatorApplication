@extends( 'admin.starter_layout' )

@section( 'body_class' )
hold-transition skin-blue sidebar-mini
@endsection

@section( 'body_content' )
<div class="wrapper">
    <!-- Main Header -->
    @include( 'admin.main-header' )
    <!-- Left side column. contains the logo and sidebar -->
    @include( 'admin.main-sidebar' )

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $page_title or '' }}
                <small>{{ $page_description or ''  }}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @yield( 'content' )
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    @include( 'admin.main-footer' )

</div>
<!-- ./wrapper -->
@endsection

@push( 'styles' )
<link rel="stylesheet" href="{{ url( 'assets/libs/pace/pace.min.css' ) }}">
@endpush

@push( 'scripts' )
<script src="{{ url( 'assets/libs/pace/pace.min.js' ) }}"></script>
@endpush