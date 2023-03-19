<style>
    .close{
        left: unset;
        right: 0;
    }
    .login_mobile_btn{
        background-color: #f44336;
        color: white;
        font-size: 18px;
    }
    .login_mobile_btn i {
        margin: 0 2px;
    }
</style>
<div class="modal fade" id="login_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close p-2 end-0 position-absolute close_modal" data-bs-dismiss="modal"
                aria-label="Close">&times;</button>
            <div id="form_mobile">
                <div class="modal-header mb-2">
                    <h5 class="modal-title title_modal_login">Bạn phải đăng nhập để thực hiện chức năng này</h5>
                </div>
                <div class="text-center mb-2">
                    <button class="login_mobile_btn btn ">
                        <i class="fas fa-mobile"></i>
                        Đăng nhập bằng số điện thoại
                    </button>
                </div>
                <div class="login_mobile mb-2" style="display: none;">
                    <div id="firebaseui_modal">

                    </div>
                </div>
                <!-- Facebook login or logout button -->
                <div onclick="Facebooklogin()"  class="text-center mb-2 d-none">
                    <a href="javascript:void(0);" onclick="fbLogin()" class=" btn btn-primary" id="fbLink">
                        <div class="fbLink d-flex align-items-center">
                            <div class="logofacebook"> </div>
                            <b>Tiếp tục đăng nhập với facebook</b>
                        </div>

                    </a>
                </div>



                <div id="gSignInWrapper" class="d-flex justify-content-center mb-2">

                    <div id="customBtn" class=" d-flex customGPlusSignIn">
                        <span class="icon"></span>
                        <div class="buttonText d-flex text-white align-items-center">
                            <span class=""><b>Tiếp tục đăng nhập với Google</b></span>
                        </div>

                    </div>
                </div>
            </div>
            <form class="" id="register_numberphone_form" method="post" style="display: none;">

                <div class="modal-header">
                    <h5 class="modal-title">Đăng nhập</h5>
                </div>
                <div class="modal-body">
                    <center><b>Số điện thoại này chưa đăng ký tài khoản, nếu bạn chưa đăng ký tài khoản thì bạn vui
                            lòng nhập
                            tên và email để tiếp tục</b></center>
                    <div class="mb-1">
                        <label for="name_user" class="form-label" style=" margin-bottom: 0;">Nhập tên:</label>
                        <input type="text" class="form-control " id="name_user" name="name_user" required>
                    </div>
                    <div class="mb-1">
                        <label for="email_user" class="form-label" style=" margin-bottom: 0;">Nhập email:</label>
                        <input type="email" class="form-control " id="email_user" name="email_user" required>
                        <div id="validationServerUsernameFeedback" class="invalid-feedback" style="display: none;">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="numberphone_login" id="numberphone_login" value>
                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                </div>

            </form>
        </div>
    </div>



    <!-- Main JS -->
    <script>
    // url web
     const path_url = $('meta[name="url_get"]').attr('content')
     $(document).on('click','.login',function(){
        $('#login_modal').modal('show')
        $('.title_modal_login').text('Đăng nhập')
    })
    // ** Register number_phone
    $(document).on('focus', '#email_user', function() {
        $('#email_user').removeClass("is-invalid")
        $('#validationServerUsernameFeedback').hide();
    })
    $("#register_numberphone_form").on("submit", function(e) {
        e.preventDefault();
        $.post('https://giapha.ongbata.vn/user-data_api.php?data_send_number', $(this).serialize(),
            function(data) {
                if (data.mobile === 'error') {
                    $('#email_user').addClass("is-invalid")
                    $('#validationServerUsernameFeedback').text('Định dạng email không đúng vui lòng nhập lại');
                    $('#validationServerUsernameFeedback').show();
                }
                else if(data.mobile === 'exist') {
                    $('#email_user').addClass("is-invalid")
                    $('#validationServerUsernameFeedback').text('Trường username hoặc email đã tồn tại!');
                    $('#validationServerUsernameFeedback').show();
                }
                else {
                    $.post("https://giapha.ongbata.vn/ajax.php?pg=login-numberphone", {
                            numberphone: data.mobile,
                        },
                        function(puerto) {
                            if (puerto.type == "success") {
                                setTimeout(function() {
                                    location.reload();
                                }, 2500);
                            } else {
                                // $.puerto_confirm(lang.error, puerto.msg, "red");
                            }
                            $('#register_numberphone').modal('hide');
                        },
                        "json"
                    );
                }
            },
            "json"
        );
    })


    </script>
      <!--sign with google-->
    <script>
    $(document).on('click','.close_modal', function(){
        $('#login_modal').modal('hide')
    })
   
    function fbLogin() {
        // <!-- script login with facebook -->
        window.fbAsyncInit = function() {
            // FB JavaScript SDK configuration and setup
            FB.init({
                  appId      : '<?php select_api($db,'ftree_v1_4_configs','variable="Facebook_apilogin_appId"') ?>', // FB App ID
                  cookie     : true,  // enable cookies to allow the server to access the session
                  xfbml      : true,  // parse social plugins on this page
                  version    : '<?php select_api($db,'ftree_v1_4_configs','variable="Facebook_apilogin_version"') ?>' // use graph api version 2.8
            });

            // Check whether the user already logged in
            FB.getLoginStatus(function(response) {
                if (response.status === 'connected') {
                    //display user data
                    getFbUserData();
                }
            });
            return false;
        };

        // Load the JavaScript SDK asynchronously
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/vi_VN/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        // Facebook login with JavaScript SDK

        FB.login(function(response) {
            if (response.authResponse) {
                // Get and display the user profile data
                getFbUserData();
            } else {
                document.getElementById('status').innerHTML =
                'User cancelled login or did not fully authorize.';
            }
        }, {
            scope: 'email'
        });
        // Save user data to the database
        function saveUserData(userData, token) {
            var datacheck = JSON.stringify(userData);
            $.post('https://giapha.ongbata.vn/user-data_api.php', {
                    token: token,
                    oauth_provider: 'facebook',
                    userData: JSON.stringify(userData)
                },
                function(data) {

                    $.post("https://giapha.ongbata.vn/ajax.php?pg=send-facebook-login", {

                            checkuser: datacheck,
                        },
                        function(puerto) {
                            if (puerto.type == "success") {
                                setTimeout(function() {
                                    // $(location).attr("href", path + "/index.php");
                                    location.reload();
                                }, 2500);
                                $.puerto_confirm(lang.success, puerto.msg, "green");
                            } else {
                                $.puerto_confirm(lang.error, puerto.msg, "red");
                            }
                        },
                        "json"
                    );
                    return false;
                });
            return false;

        }
        // Fetch the user profile data from facebook
        function getFbUserData() {
            var access_token = FB.getAuthResponse()['accessToken'];

            FB.api('/me', {
                    locale: 'vi_VN',
                    fields: 'id,first_name,last_name,email,link,gender,locale,picture'
                },
                function(response) {
                    //  $('.fbLink').attr("onclick","fbLogout()");
                    // Save user data
                    saveUserData(response, access_token);
                });
            return false;
        }
    }
    // logout social

    // ** sign with google

    var googleUser = {};
    var startApp = function() {
        gapi.load('auth2', function() {
            // Retrieve the singleton for the GoogleAuth library and set up the client.
            auth2 = gapi.auth2.init({
                client_id: '<?php select_api($db,'ftree_v1_4_configs','variable="google_login_client_id"') ?>',
                cookiepolicy: 'single_host_origin',
                // Request scopes in addition to 'profile' and 'email'
                //scope: 'additional_scope'
            });
            attachSignin(document.getElementById('customBtn'));
        });
    };

    function attachSignin(element) {

        auth2.attachClickHandler(element, {},
            function(googleUser) {
                var token = gapi.auth2.getAuthInstance().currentUser.get().getAuthResponse().id_token;
                gapi.client.load('oauth2', 'v2', function() {
                    var request = gapi.client.oauth2.userinfo.get({
                        'userId': 'me'
                    });
                    request.execute(function(resp) {
                        // Display the user details

                        saveUserDataG(resp, token);
                    });
                });
            },
            function(error) {
                //   alert(JSON.stringify(error, undefined, 2));
            });
    }
    // Save user data to the database
    function saveUserDataG(userDatagoogle, token) {
        var datagoogle = JSON.stringify(userDatagoogle)
        $.post('https://giapha.ongbata.vn/user-data_api.php', {
                id_google: userDatagoogle.id,
                token: token,
                oauth_provider: 'google',
                userDatagoogle: datagoogle,
            },
            function(data) {

                $.post("https://giapha.ongbata.vn/ajax.php?pg=send-google-login", {
                        id_google: userDatagoogle.id,
                        checkdatagoogle: datagoogle,
                    },
                    function(puerto) {
                        if (puerto.type == "success") {
                            setTimeout(function() {
                                // $(location).attr("href", path + "/index.php");
                                location.reload();
                            }, 2500);
                            $.puerto_confirm(lang.success, puerto.msg, "green");
                        } else {
                            $.puerto_confirm(lang.error, puerto.msg, "red");
                        }
                    },
                    "json"
                );


            }
        );


    }
    </script>
    <script>
    startApp();
    </script>