$(document).ready(function () {
    $.ajaxSetup({cache: true});
    $.getScript('//connect.facebook.net/en_US/sdk.js', function () {
        FB.init({
            appId: '138339313382281',
            version: 'v2.7'
        });

        $('.btn-fb-upload').click(function () {
            FB.getLoginStatus(function (response) {
                if (response.status === 'connected') {
                    fetchFBProfilePicture();
                }
                else {
                    FB.login(function () {
                        fetchFBProfilePicture();
                    });
                }
            });
        });

        fetchFBProfilePicture = function () {
            FB.api("/me", {fields: "id,name,picture"}, function (res) {
                var preview = $('.preview-image');
                var id = res.id;
                var url = "https://graph.facebook.com/" + id + "/picture?type=large&width=500&height=500";
                preview.cropper('replace', url);
                $('.btn').removeClass('hidden');
            });
        }

    });
});