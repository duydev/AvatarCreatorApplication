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
            <table class="table table-responsive table-bordered list">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hình Ảnh</th>
                        <th>Tải Lên Lúc</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Hình Ảnh</th>
                        <th>Tải Lên Lúc</th>
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
<link rel="stylesheet" href="{{ url( 'assets/libs/colorbox/colorbox.css' ) }}">
@endpush

@push( 'scripts' )
<script src="{{ url( 'assets/libs/colorbox/jquery.colorbox-min.js' ) }}"></script>
<script src="{{ url( 'assets/libs/datatables/jquery.dataTables.min.js' ) }}"></script>
<script src="{{ url( 'assets/libs/datatables/dataTables.bootstrap.min.js' ) }}"></script>
<script>
    $(document).ready(function () {

        $(document).on('click','.gallery',function (e) {
            e.preventDefault();
            $('.gallery').colorbox({
                rel:'group1'
            });
        });

        $('table.list').DataTable({
            // Setting
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ url( 'admin/avatar/list_process' ) }}",
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
                    return '<a class="gallery" href="' + data + '"><image src="' + data + '" height="150" /></a>';
                } },
            ],
            "columns": [
                { "data": "id" },
                { "data": "url" },
                { "data": "created_at" },
            ],
            "order": [[ 0, "desc" ]],
            "searching": false
        });

    });
</script>
@endpush