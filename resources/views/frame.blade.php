<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page_title or '' }}</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset( 'css/bootstrap.min.css' ) }}">
    <link rel="stylesheet" href="{{ asset( 'css/font-awesome.min.css' ) }}">
    <link rel="stylesheet" href="{{ asset( 'css/cropper.min.css' ) }}">
    <link rel="stylesheet" href="{{ asset( 'css/styles.css' ) }}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="loader"></div>
<div class="container main-content">
    <div class="row">
        <div class="col-md-7 col-sm-7 left-block">
            <div class="dyn-box">
                <div class="frame-image"></div>
                <div class="crop-image">
                    <img class="preview-image" src="{{ asset( 'images/logohyd.jpg' ) }}" alt="Preview image">
                    <input type="file" class="hidden" name="upload-file" id="upload-file" accept="image/*">
                </div>
            </div>
        </div>
        <div class="col-md-5 col-sm-5 right-block">
            <a href="http://hutechyouthdev.vn">
                <div class="logo-hyd"></div>
            </a>
            <div class="crop-tool">
                <button type="button" class="btn btn-primary btn-upload"><i class="fa fa-upload"></i> Tải lên</button>
                <button type="button" class="btn btn-rotate-left hidden"><i class="fa fa-undo"></i></button>
                <button type="button" class="btn btn-rotate-right hidden"><i class="fa fa-repeat"></i></button>
                <button type="button" class="btn btn-zoom-in hidden"><i class="fa fa-search-plus"></i></button>
                <button type="button" class="btn btn-zoom-out hidden"><i class="fa fa-search-minus"></i></button>
                <button type="button" class="btn btn-flip-horizon hidden"><i class="fa fa-arrows-h"></i></button>
                <button type="button" class="btn btn-flip-vertical hidden"><i class="fa fa-arrows-v"></i></button>
                <button type="button" class="btn btn-reset hidden"><i class="fa fa-refresh"> Làm lại</i></button>
                <button type="button" class="btn btn-success btn-download hidden"><i class="fa fa-download"></i> Tải xuống</button>
            </div>
            <div class="frame-change">
                <h3>Chọn khung:</h3>
                <select name="frame" id="frame" class="form-control" data-action="{{ url( 'process' ) }}" data-token="{{ csrf_token() }}">
                @if( $frames->count() == 0 )
                    <option> - Trống - </option>
                @else
                    @foreach($frames as $frame)
                    <option value="{{ $frame->url }}" data-id="{{ $frame->id }}" data-output-size="{{ $frame->height }}">{{ $frame->title }}</option>
                    @endforeach
                @endif
                </select>
            </div>
            <div class="guide">
                <h3>Hướng dẫn:</h3>
                <ol>
                    <li>Click vào nút "Tải lên" để chọn và upload ảnh lên website.</li>
                    <li>Sử dụng các phím chức năng như xoay trái, xoay phải, phóng to, thu nhỏ, lật dọc, lật ngang hoặc reset để chỉnh sửa ảnh cho phù hợp với khung.</li>
                    <li>Click vào "Tải về" để tải ảnh sau khi chỉnh sửa kèm với khung đã chọn về máy.</li>
                </ol>
                <p>Mọi thông báo lỗi hoặc góp ý vui lòng liên hệ qua: <a href="mailto:hi@duydev.me">hi@duydev.me</a> hoặc <a href="https://fb.com/Trannhatduy"><i class="fa fa-facebook-square"> Trần Nhật Duy</i></i></a>.</p>
            </div>
            <div class="statistics">Có <span class="counter">{{ $avatar_count or '0' }}</span> avatar được tạo bằng ứng dụng này.</div>
        </div>
    </div>
</div>
<div class="container footer">
    <div class="row">
        <p>Copyright &copy; 2017 - Xây dựng và phát triển bởi <a href="mailto:hi@duydev.me">Trần Nhật Duy</a>.</p>
    </div>
</div>

<iframe src="" frameborder="0"></iframe>

<script src="{{ asset( 'js/jquery-3.1.1.min.js' ) }}"></script>
<script src="{{ asset( 'js/bootstrap.min.js' ) }}"></script>
<script src="{{ asset( 'js/cropper.min.js' ) }}"></script>
<script src="{{ asset( 'js/main.js' ) }}"></script>
</body>
</html>