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
        <div class="box-header">
            <a class="btn btn-primary" href="{{ url( 'admin/frame/add' ) }}">Thêm mới</a>
        </div>
        <div class="box-body">
            <table class="table table-responsive table-bordered list">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hình Ảnh</th>
                        <th>Tiêu Đề</th>
                        <th>Tải Lên Bởi</th>
                        <th>Tải Lên Lúc</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Hình Ảnh</th>
                        <th>Tiêu Đề</th>
                        <th>Tải Lên Bởi</th>
                        <th>Tải Lên Lúc</th>
                        <th>Hành Động</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@push( 'styles' )
<link rel="stylesheet" href="{{ url( 'assets/libs/datatables/jquery.dataTables.min.css' ) }}">
<link rel="stylesheet" href="{{ url( 'assets/libs/datatables/jquery.dataTables_themeroller.css' ) }}">
<link rel="stylesheet" href="{{ url( 'assets/libs/datatables/dataTables.bootstrap.css' ) }}">
@endpush

@push( 'scripts' )
<script src="{{ url( 'assets/libs/datatables/jquery.dataTables.min.js' ) }}"></script>
<script src="{{ url( 'assets/libs/datatables/dataTables.bootstrap.min.js' ) }}"></script>
<script>
    $(document).ready(function () {
        $('table.list').DataTable({
            // Setting
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ url( 'admin/frame/list_process' ) }}",
                "type": "POST",
                "data": function ( d ) {
                    d._token = "{{ csrf_token() }}";
                }
            },
            // Language
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Vietnamese.json"
            },
            // Define Column Render
            "columnDefs": [
                { "targets": 0, "render": function ( data, type, row ) {
                    return '#' + data;
                } },
                { "targets": 1, "orderable": false, "render": function ( data, type, row ) {
                    return '<image src="' + data + '" height="150" />';
                } },
                { "targets": 5, "orderable": false, "render": function ( data, type, row ) {
                    return '<a class="btn btn-primary btn-edit" href="{{ url( 'admin/frame/edit' ) }}/' + data + '"><i class="fa fa-pencil"></i> Sửa</a>' +
                           '<a class="btn btn-danger btn-delete" href="{{ url( 'admin/frame/delete' ) }}/' + data + '"><i class="fa fa-trash"></i> Xóa</a>';
                } },
            ],
            "columns": [
                { "data": "id" },
                { "data": "url" },
                { "data": "title" },
                { "data": "user.name" },
                { "data": "created_at" },
                { "data": "id" }
            ]
        });

        $(document).on("click", "table.list .btn-delete", function (e) {
            e.preventDefault();
            var _this = e.target;
            var url = $(_this).attr('href');
            if( url ) {
                if( confirm( 'Bạn có chắc chắn muốn xóa khung này không?' ) ) {
                    console.log( $(_this).attr('href') );
                    window.location = url;
                }
            }
        });

    });
</script>
@endpush