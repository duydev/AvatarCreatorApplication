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
            <form action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Tiêu Đề:</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old( 'title', $frame->title ) }}">
                </div>
                <div class="form-group">
                    <label for="email">Ảnh Khung:</label>
                    <input type="file" class="form-control" id="file"  name="image" accept="image/png">
                    <img class="preview hidden" src="" height="200" alt="Ảnh xem trước...">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a class="btn btn-default" href="{{ url( 'admin/frame' ) }}">Hủy</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push( 'styles' )
@endpush

@push( 'scripts' )
<script>
    $(document).ready(function () {
        $('#file').change(function (e) {
            var _this = $(e.target);
            var preview = _this.parents('.form-group').find('.preview');
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function () {
                preview.attr('src', reader.result);
            };
            if(file) {
                reader.readAsDataURL(file);
                preview.removeClass('hidden');
            } else {
                preview.addClass('hidden');
            }

        });
    });
</script>
@endpush