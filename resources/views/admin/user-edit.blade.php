@extends( 'admin.layout' )

@section( 'content' )
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if ( session('message') )
        <p class="alert alert-success">{{ session('message') }}</p>
    @endif
    <div class="box box-default">
        <div class="box-body">
            <form action="{{ url()->current() }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Họ Tên:</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old( 'name', $user->name ) }}">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ old( 'email', $user->email ) }}">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu:</label>
                    <input type="password" class="form-control" name="password" id="password" value="{{ old( 'password' ) }}">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Nhập Lại Mật khẩu:</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="{{ old( 'password_confirmation' ) }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a class="btn btn-default" href="{{ url( 'admin/user' ) }}">Hủy</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push( 'styles' )
@endpush

@push( 'scripts' )
@endpush