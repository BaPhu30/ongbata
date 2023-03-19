$(document).ready(function () {
    const path =jQuery('meta[name="url_get"]').attr('content')
    
    const firebaseConfig = {
        apiKey: $('#config_firebase').attr('apiKey'),
        authDomain: $('#config_firebase').attr('authDomain'),
        projectId: $('#config_firebase').attr('projectId'),
        storageBucket: $('#config_firebase').attr('storageBucket'),
        messagingSenderId: $('#config_firebase').attr('messagingSenderId'),
        appId: $('#config_firebase').attr('appId'),
        measurementId: $('#config_firebase').attr('measurementId')
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    /* firebase otp number */
    function firebase_otp(elment, to, page, other) {
        firebase.auth().signOut();
        var uiConfig = {
            'callbacks': {
                'signInSuccessWithAuthResult': function (user, credential, redirectUrl) {
                    handleSignedInUser(user)
                }
            },
            // Leave the lines as is for the providers you want to offer your users.
            //  signInSuccessUrl: 'https://hovangiap.toidayhoc.com/index.php',
            signInOptions: [{
                provider: firebase.auth.PhoneAuthProvider.PROVIDER_ID,
                defaultCountry: 'VN',
            }],
            tosUrl: 'https://giapha.ongbata.vn/page/2',
            // Privacy policy url/callback.
            privacyPolicyUrl: function () {
                window.location.assign('https://giapha.ongbata.vn/page/1');
            }
        }
        // Initialize the FirebaseUI Widget using Firebase.
        var ui = new firebaseui.auth.AuthUI(firebase.auth());
        var handleSignedOutUser = function () {
            ui.start(elment, uiConfig);
        };

        firebase.auth().onAuthStateChanged(function (user) {
            user ? handleSignedInUser(user) : handleSignedOutUser();
        });
        var handleSignedInUser = function (user) {
            firebase.auth().signOut();
            $.post(to,
                {
                    other,
                    numberphone: user.phoneNumber,
                },
                function (puerto) {
                    if (page == 'index') {
                        if (puerto.type == "success") {
                            setTimeout(function () {
                                $(location).attr("href", path + "/index.php");
                            }, 2500);
                            $.puerto_confirm(lang.success, puerto.msg, "green");
                        } else {
                            $('#register_numberphone_index').modal('show')
                            $('#numberphone_login').val(user.phoneNumber)
                            // $.puerto_confirm(lang.error, puerto.msg, "red");
                        }
                    }else if(page == 'update_mobile'){
                        $('#modal_upmobile').remove()
                    }else if(page == 'modal_login'){
                        if (puerto.type == "success") {
                            setTimeout(function() {
                                location.reload();
                            }, 2500);
                        } else {
                            $('#numberphone_login').val(user.phoneNumber);
                            $('#form_mobile').hide(1000);
                            $('#register_numberphone_form').css("display", "block");
                            // $.puerto_confirm(lang.error, puerto.msg, "red");
                        }
                    }
                }, "json");
            return false;
        }
    }

    $(document).on('click', '.change_method_lg', function () {
        let checkform_firebase = document.getElementById('firebaseui-container_index');
        let child_fribase = checkform_firebase.firstElementChild
        if(child_fribase == null){
            firebase_otp('#firebaseui-container_index', path + "/ajax.php?pg=login-numberphone", 'index');
        }
    });
    /* Up mobile*/
    var check_mobile = document.getElementById('modal_upmobile');
    if (check_mobile != null) {
        $(".modal-verticalnumberphone").animate({
            bottom: '40%'
        }, "slow");
    }

    $(".btn-verticalnumberphone").click(function () {
        let userid = $(this).attr('data-user')
        firebase_otp('#firebaseui-container', path + "/user-data_api.php", 'update_mobile', { otp_number: 1, id_user: userid });
        $("#container").show(1000);
        $(".modal-verticalnumberphone-title").remove();
        $(".modal-verticalnumberphone").animate({
            bottom: '10%'
        }, "slow");
    });
    
    /* Login modal */
    $(document).on('click','.login_mobile_btn', function(){
        var cv =  $('.login_mobile').attr('style')
        let checkform_firebase = document.getElementById('firebaseui_modal');
        let child_fribase = checkform_firebase.firstElementChild
        if (cv== 'display: none;') {
            if (child_fribase ==null) {
                firebase_otp('#firebaseui_modal', path + "/ajax.php?pg=login-numberphone", 'modal_login');
            }
            $('.login_mobile').show(1000)
            $(this).text('Đóng')
        }
        else
        {
            $('.login_mobile').hide(1000)
            $(this).html('<i class="fas fa-mobile"></i>Đăng nhập bằng số điện thoại')
        }

    })




    /* //  Get token  */
    
    const id_user_loged = $('#id_user').val()
    if (parseInt(id_user_loged) > 0) {
        const messaging = firebase.messaging();
        messaging
            .requestPermission()
            .then(function () {
                console.log("Notification permission granted.");
                // get the token in the form of promise
                return messaging.getToken()
            })
            .then(function (token) {
                $.post(path + "/ajax.php?pg=up_token_user",
                    {
                        token: token,
                        userid: id_user_loged
                    },
                    function (data) {
                        
                    });
            })
            .catch(function (err) {
                console.log("Unable to get permission to notify.", err);
            });
    }
       
           // send server notification
    var id_user_send = [];
    $(function () {
        
        $.post("ajax.php?pg=get_mem_had_token",
            function (data) {
                var data_mem = JSON.parse(data);
                var data_me = []
                data_me.push('<option   value="Tất cả">')
                for (var i = 0; i < data_mem.length; i++) {
                    var item = '<option   value="' + data_mem[i]['username'] +
                        '" data-id="' + data_mem[i]['id'] + '" >'
                    data_me.push(item)
                };

                $('#select_data').html(data_me)
            });
    });
    $(document).on("change", "#choose_data", function () {
        if ($(this).val() == 'Tất cả') {
            $('option[value="Tất cả"]').remove()
            id_user_send.push('Tất cả')
            $(this).attr('list', '')
            $('#list_choosed_mem').append(
                '<li class="rounded-3 p-1 bg-success m-1">Tất cả <span id="Tất cả" class="text-black delete_mem"><b>x</b></span></li>'
            )
        } else {
            var Value = $('option[value="' + $(this).val() + '"]').attr('data-id');
            if (id_user_send == '') {
                id_user_send.push(Value)
                $('#list_choosed_mem').append('<li class="rounded-3 p-1 bg-success m-1">' + $(this)
                    .val() +
                    '<span id="' + Value + '" class="text-black delete_mem"><b>x</b></span></li>')
            } else {
                for (let i = 0; i < id_user_send.length; i++) {
                    if (id_user_send.indexOf(Value) == -1) {
                        id_user_send.push(Value)
                        $('#list_choosed_mem').append('<li class="rounded-3 p-1 bg-success m-1">' + $(
                            this).val() +
                            '<span id="' + Value +
                            '" class="text-black delete_mem"><b>x</b></span></li>')
                    }
                }
            }

        }
        $('#choose_data').val('')
        check_val()

    })
    $(document).on('click', '.delete_mem', function () {
        let index = id_user_send.indexOf($(this).attr('id'));
        id_user_send.splice(index, 1);
        $(this).parent().remove()
        $('#choose_data').attr('list', 'select_data')
        check_val()

    })

    function check_val() {

        if (id_user_send != '' && id_user_send != 'Tất cả') {
            $('option[value="Tất cả"]').remove()
        } else if (id_user_send == '' && id_user_send != 'Tất cả') {
            $('#select_data').prepend('<option   value="Tất cả">')
        }
   
    }
    // SEND NOTIFICATION
    $(document).on('submit', '#send_message', function (e) {
      
        $('#send').text('Đang gửi')
        e.preventDefault();
        let formData = new FormData(this);
        if (id_user_send != '') {
            formData.append('id', id_user_send)
            $.ajax({
                url: 'ajax.php?pg=test_notification',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    $('.message_status').text('Thành công')
                    $("#send_message")[0].reset()
                    id_user_send = []
                    $('#list_choosed_mem').html('')
                    $('#send').text('GỬi')
                    check_val();
                    $(".message_status").show();
                    setTimeout(function () { $(".message_status").hide(); }, 5000);
             
                },
                error: function (e) {
                    console.log(data)
                }
            });
        } else {
            $('.message_status').text('Thêm người nhận vào')
        }

    })
    //fix menu mobile button - VL
        // $(document).on('click','#mobile',function(){
        //         // let icon_this = $('.icon_nav_mobile i').attr('class')
        //         // if (icon_this ==  'fa fa-close') {
        //         //     $('.icon_nav_mobile i').attr('class','fa fa-bars')
        //         // }else{
        //         //     $('.icon_nav_mobile i').attr('class','fa fa-close')
        //         // }               
        //         $('#mobile > i').toggleClass('fa-bars fa-close');                
        //     })
             $(document).on('click','.menu-mobile',function(){
                let icon_this = $('.icon_nav_mobile i').attr('class')
                if (icon_this ==  'fa fa-close') {
                    $('.icon_nav_mobile i').attr('class','fa fa-bars')
                }else{
                    $('.icon_nav_mobile i').attr('class','fa fa-close')
                }
        
                
            })
            
            
            
            
    

});
