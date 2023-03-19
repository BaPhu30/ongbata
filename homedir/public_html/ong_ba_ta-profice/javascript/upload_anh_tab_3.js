$(document).ready(function () {
    $(document).on('change', '#multipleFile_tab3', function () {
        var iduser = $(this).parent().attr('data-user');
        var idmemeber = $(this).parent().attr('data-member');
        var count_file = $(this)[0].files.length;
        var file_data = document.getElementById('multipleFile_tab3')
        var form_data = new FormData();

        if (checkfileimg(file_data)) {
            for (var i = 0; i < file_data.files.length; i++) {
                form_data.append('uploadFileimg[]', file_data.files.item(i));
            }
        } else {
            alert("wrong format");
            $("#multipleFile_tab3").val('');
            return;
        }
        //khởi tạo đối tượng form data
        form_data.append("method", "Uploadimgcover")
        var insert = {
            membersid: idmemeber,
            Postcontent: "<center><b><i>Thêm "+count_file+" ảnh</b></i></center>",
            fileimgpost: "true",
            method: 'createpost'
        }
        //thêm files vào trong form data
        $.ajax({
            url: '../Process/Post.php',
            type: "POST",
            cache: false,
            data: insert,
            dataType: 'json',
            success: function (data) {
                if (data.success == false) {
                    alert(data.name);
                } else {
                    $(document).ready(function () {
                        $("#success").show();
                        if (data.lastid != null) {
                            form_data.append("postid",data.lastid)
                            form_data.append("type", "normal_photo");
                            form_data.append("membersid", idmemeber);
                            $.ajax({
                                url: '../amazon_s3/upload_multiple_image.php',
                                dataType: 'text',
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: form_data,
                                type: 'post',
                                success: function () { 
                                    $("#multipleFile_tab3").val("");
                                    // $(".load_sussce").show().delay(5000).fadeOut();
                                    $('#anh_cua_ban_tab3').load("../index/fecth_anh_cua_ban.php").fadeIn("slow");
                                    fetchData(idmemeber,iduser);
                                }
                            });
                        }
                    })
                }
            }
        });
    });
    function fetchData(idmemeber,iduser){
  
        $.ajax({
            url : "../index/fecth_anh_cua_ban.php",
            type: 'JSON',
            cache: false,
            data:{
                    'membersid':idmemeber,
                    'userid':iduser,
            },
            cache: false,
            success:function(data){
            $("#anh_cua_ban_tab3").html(data);
            }
        });

        $.ajax({
            url : "../index/fecth_anh_cua_ban_modal.php",
            type: 'JSON',
            cache: false,
            data:{
                    'membersid':idmemeber,
                    'userid':iduser,
            },
            cache: false,
            success:function(data){
            $("#anh_cua_ban_modal").html(data);
            }
        });


        var loadstatuspost = {
            method: 'loaddata',
            page: 1,
        }
        $.ajax({
            url: '../Process/Post.php',
            type: 'POST',
            data: loadstatuspost,
            dataType: 'json',
            cache: false,
            success: function (data) {
                $("#list_posts").html(data);
            }
        })
        
        }
  
   
})