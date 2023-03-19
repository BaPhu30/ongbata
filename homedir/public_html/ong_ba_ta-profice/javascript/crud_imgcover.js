$(document).ready(function () {
    $(document).on('change', '#multipleFile3', function () {
        var membersid = $(this).parent().attr('data-member')
        var userid = $(this).parent().attr('data-user')
        var file_data = document.getElementById('multipleFile3')
        var form_data = new FormData();

        if (checkfileimg(file_data)) {
            for (var i = 0; i < file_data.files.length; i++) {
                form_data.append('filetoupload', file_data.files.item(i));
            }
        } else {
            alert("wrong format");
            $("#multipleFile3").val('');
        }
        //khởi tạo đối tượng form data
      
        var insert = {
            membersid: membersid,
            Postcontent: "<center><b><i>Cập nhật ảnh bìa </b></i></center>",
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
                            form_data.append("postid", data.lastid)
                            form_data.append("type", "cover_image");
                            form_data.append("membersid", membersid);
                            $.ajax({
                                url: '../amazon_s3/upload_sg.php',
                                dataType: 'text',
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: form_data,
                                type: 'POST',
                                success: function () { 
                                    
                                  
                                    $.ajax({
                                        url: '../index/fet_anh_bia-big.php',
                                        method : "POST",
                                        type: 'JSON',
                                        cache: false,
                                        data:{
                                            membersid:membersid,
                                        },
                                        success: function (data) {
                                            $(".gallery_bia").html(data);
                                        }
                                    });
                                    $.ajax({
                                        url : "../index/fecth_anh_bia_tab3.php",
                                        method : "POST",
                                        type: 'JSON',
                                        cache: false,
                                        data:{
                                            membersid:membersid,
                                            userid:userid,
                                        },
                                        success:function(data){
                                        $("#anh_bia_tab3").html(data);
                                        }
                                    });
                                    
                                    $.ajax({
                                        url : "../index/fecth_anh_bia_modal.php",
                                        method : "POST",
                                        type: 'JSON',
                                        cache: false,
                                        data:{
                                            membersid:membersid,
                                        },
                                        success:function(data){
                                        $("#anh_bia_modal").html(data);
                                        }
                                    });
                                    $.ajax({
                                        url : "../index/fetch_anh_daidien_son.php",
                                        method : "POST",
                                        type: 'JSON',
                                        cache: false,
                                        data:{
                                            membersid:membersid,
                                        },
                                        success:function(data){
                                        $(".gallery_dd_s").html(data);
                                        }
                                    });
                                    $("#multipleFile3").val("");
                                    // $(".load_sussce").show().delay(5000).fadeOut();                                 
                                    $('#anh_bia_tab3').load("../index/fecth_anh_bia_tab3.php").fadeIn("slow");
                                    
                                }
                            });
                        }
                    })
                }
            }
        });
    });

    // Fetch Data from Database
  
})