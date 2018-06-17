@extends( 'admin.starter_layout' )

@section( 'body_class' )
hold-transition login-page
@endsection

@section( 'body_content' )
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('') }}"><b>AVATAR</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ url()->current() }}" method="post">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Mật Khẩu">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Giữ Đăng Nhập
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng Nhập</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <a href="#">Quên Mật Khẩu</a><br>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection

@push( 'styles' )
<link rel="stylesheet" href="{{ url( 'assets/libs/iCheck/square/blue.css' ) }}">
@endpush

@push( 'scripts' )
<script src="{{ url( 'assets/libs/iCheck/icheck.min.js' ) }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
@endpush