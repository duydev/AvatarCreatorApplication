/**
 * Created by DuyDev on 12/02/2017.
 */

$(document).ready(function () {

    var preview = $('.preview-image');
    var scaleX = 1;
    var scaleY = 1;
    var output_size = 620; // px

    var clickEvent = new MouseEvent("click", {
        "view": window,
        "bubbles": true,
        "cancelable": false
    });

    preview.cropper({
        aspectRatio: 1 / 1,
        dragMode: 'move',
        guides: false,
        center: false,
        modal: false,
        cropBoxMovable: false,
        cropBoxResizable: false,
        minCropBoxWidth: $('.dyn-box').outerWidth(),
        toggleDragModeOnDblclick: false,
    });

    // Switch Frame Event
    $('.frame-change select').change(function () {
        $('.frame-image').css('background-image', 'url(' + $(this).val() + ')');
        output_size = $(this).find('option:selected').data('output-size');
    });


    // Button Upload Click Event
    $('.btn-upload').click(function () {
        $('#upload-file').click();
    });

    // Upload Image Event
    $('#upload-file').change(function (e) {
        var file = e.target.files[0];
        if (!file) {
            return;
        }
        var reader = new FileReader();
        reader.onload = function (e) {
            var image_url = e.target.result;
            preview.cropper('replace', image_url);
            $('.btn').removeClass('hidden');
        };
        reader.readAsDataURL(file);
    });


    $('.btn-rotate-left').click(function () {
        preview.cropper('rotate', -90);
    });

    $('.btn-rotate-right').click(function () {
        preview.cropper('rotate', 90);
    });

    $('.btn-zoom-in').click(function () {
        preview.cropper('zoom', 0.1);
    });

    $('.btn-zoom-out').click(function () {
        preview.cropper('zoom', -0.1);
    });

    $('.btn-flip-horizon').click(function () {
        scaleX = -scaleX;
        preview.cropper('scaleX', scaleX);
    });

    $('.btn-flip-vertical').click(function () {
        scaleY = -scaleY;
        preview.cropper('scaleY', scaleY);
    });

    $('.btn-reset').click(function () {
        preview.cropper('reset');
        scaleX = 1;
        scaleY = 1;
    });

    $('.btn-download').click(function () {
        $('.loader').addClass('show');
        preview.cropper('crop');
        var cropped_image = preview.cropper('getCroppedCanvas');

        var canvas = document.createElement('canvas');
        canvas.width = output_size;
        canvas.height = output_size;
        var ctx = canvas.getContext('2d');

        var _img = new Image();

        _img.src = cropped_image.toDataURL();
        _img.onload = function () {
            ctx.drawImage(_img, 0, 0, _img.width, _img.height, 0, 0, output_size, output_size);
            var data = {
                _token: $('.frame-change select').data('token'),
                frameID: $('.frame-change select option:selected').data('id'),
                image: canvas.toDataURL()
            };

            $.post(
                $('.frame-change select').data('action'),
                data,
                function (res) {
                    if (res) {
                        if (res.success === true) {
                            // window.open( res.url );
                            $('iframe').attr('src', res.url);
                            $('.loader').removeClass('show');
                        } else {
                            alert(res.error);
                        }
                    } else {
                        alert('Ứng dụng Web này đang gặp lỗi. Vui lòng tải lại trang và thử lại.');
                    }
                }
            );
        };
    });

    // Fire Switch Frame for First Load
    $('.frame-change select').trigger('change');
});

