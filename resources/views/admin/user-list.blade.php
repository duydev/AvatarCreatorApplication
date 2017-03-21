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
            <a class="btn btn-primary" href="{{ url( 'admin/user/add' ) }}">Thêm mới</a>
        </div>
        <div class="box-body">
            <table class="table table-responsive table-bordered list">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Họ Tên</th>
                        <th>Email</th>
                        <th>Tạo Lúc</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Họ Tên</th>
                        <th>Email</th>
                        <th>Tạo Lúc</th>
                        <th>Hành Động</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@push( 'styles' )
<link rel="stylesheet" href="{{ asset( 'libs/datatables/jquery.dataTables.min.css' ) }}">
<link rel="stylesheet" href="{{ asset( 'libs/datatables/jquery.dataTables_themeroller.css' ) }}">
<link rel="stylesheet" href="{{ asset( 'libs/datatables/dataTables.bootstrap.css' ) }}">
@endpush

@push( 'scripts' )
<script src="{{ asset( 'libs/datatables/jquery.dataTables.min.js' ) }}"></script>
<script src="{{ asset( 'libs/datatables/dataTables.bootstrap.min.js' ) }}"></script>
<script>
    $(document).ready(function () {
        $('table.list').DataTable({
            // Setting
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ url( 'admin/user/list_process' ) }}",
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
                { "targets": 4, "orderable": false, "render": function ( data, type, row ) {
                    if( data == '{{ auth()->user()->id }}' ) {
                        return '';
                    }
                    return '<a class="btn btn-primary btn-edit" href="{{ url( 'admin/user/edit' ) }}/' + data + '"><i class="fa fa-pencil"></i> Sửa</a>' +
                           '<a class="btn btn-danger btn-delete" href="{{ url( 'admin/user/delete' ) }}/' + data + '"><i class="fa fa-trash"></i> Xóa</a>';
                } },
            ],
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "email" },
                { "data": "created_at" },
                { "data": "id" }
            ]
        });

        $(document).on("click", "table.list .btn-delete", function (e) {
            e.preventDefault();
            var _this = e.target;
            var url = $(_this).attr('href');
            if( url ) {
                if( confirm( 'Bạn có chắc chắn muốn xóa người dùng này không?' ) ) {
                    console.log( $(_this).attr('href') );
                    window.location = url;
                }
            }
        });

    });
</script>
@endpush