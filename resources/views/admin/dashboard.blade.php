@extends( 'admin.layout' )

@section( 'content' )
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-file-image-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Số Avatar Được Tạo</span>
                    <span class="info-box-number">{{ $photo_created }} <small>ảnh</small></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fa fa-photo"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Số Khung Được Tải Lên</span>
                    <span class="info-box-number">{{ $frame_uploaded }} <small>khung</small></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
    </div>
@endsection