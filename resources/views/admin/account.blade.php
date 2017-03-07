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
                <input type="text" class="form-control" name="name" id="name" value="{{ auth()->user()->name }}">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ auth()->user()->email }}" readonly>
            </div>
            <div class="form-group">
                <label for="password">Mật Khẩu Cũ:</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="form-group">
                <label for="newpassword">Mật Khẩu Mới:</label>
                <input type="password" class="form-control" name="newpassword" id="newpassword">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a class="btn btn-default" href="{{ url( 'admin' ) }}">Hủy</a>
            </div>
        </form>
    </div>
</div>
@endsection