

$(document).ready(function () {
    var fileimgpost;
    // check file type img
    
    //delete post
    $(document).on('click', '.btn--del', function (e) {

        var idpost = $(this).attr('data-id');
        var delpost = {
            delpostid: idpost,
            method: 'deletepost'
        }
        Postdata = $(this).closest(".postroot").get(0)
        console.log(Postdata);
        $.ajax({
            url: '../Process/Post.php',
            type: 'POST',
            data: delpost,
            dataType: 'json',
            cache: false,
            success: function (data) {
                if (data.success == false) {
                    alert(data.name);
                } else {
                    alert("Delete POST successfully!");
                    Postdata.remove();
                }
                loadlink();
            }
        })
    })


    $(function () {
        var input_file = document.getElementById('uploadFileimg');
        var  input_file_video = document.getElementById('uploadFilevideo');
        var remove_products_ids = [];
        var product_dynamic_id = 0;
        var remove_products_video = [];
        var product_dynamic_video = 0;
        $("#uploadFileimg").change(function (event) {
            var len = input_file.files.length;
            $('#display_product_list ul').html("");

            for (var j = 0; j < len; j++) {
                var src = "";
                var name = event.target.files[j].name;
                var mime_type = event.target.files[j].type.split("/");
                if (mime_type[0] == "image") {
                    src = URL.createObjectURL(event.target.files[j]);
                } else if (mime_type[0] == "video") {
                    src = 'icons/video.png';
                } else {
                    src = 'icons/file.png';
                }
                $('#display_product_list ul').append("<li class='liimage col pd_5' id='" + product_dynamic_id + "'><div class='ic-sing-file  position-relative'><img id='" + product_dynamic_id + "' src='" + src + "' title='" + name + "' class='anh_fullscren'><p class='close material-icons position-absolute top-0 end-0 pd_5 cursor_p' id='" + product_dynamic_id + "' data-bs-toggle='tooltip'data-placement='top' title='Xóa ảnh'>remove_circle_outline</p></div></li>");
                product_dynamic_id++;
            }
        });
        $("#uploadFilevideo").change(function (event) {
            var len_video =  input_file_video.files.length;
            $('#display_product_list_video ul').html("");
      
            for (var k = 0; k < len_video; k++) {
              var src = "";
              var name = event.target.files[k].name;
              var mime_type = event.target.files[k].type.split("/");
              if (mime_type[0] == "video") {
                src = URL.createObjectURL(event.target.files[k]);
              } else if (mime_type[0] == "image") {
                src = 'icons/file.png';
              } else {
                src = 'icons/video.png';
              }
              $('#display_product_list_video ul').append("<li class='livideo col pd_5' id='" + product_dynamic_video + "'><div class='ic-sing-file  position-relative'><video width='150' height='150' controls><source id='" + product_dynamic_video + "' src='" + src + "' title='" + name + "'type='video/mp4'></video><p class='close_video material-icons position-absolute top-0 end-0 pd_5 cursor_p' id='" +  product_dynamic_video+ "' data-bs-toggle='tooltip'data-placement='top' title='Xóa video'>remove_circle_outline</p></div></li>");
              product_dynamic_video++;
            }
          });
        $(document).on('click', 'p.close', function () {
            var id = $(this).attr('id');
            remove_products_ids.push(id);
            $(this).parent().parent().remove();
            if ((".liimage").length == 0) document.getElementById('products_uploaded').value = "";
            console.log(remove_products_video);
        });
        $(document).on('click', 'p.close_video', function () {
            var id = $(this).attr('id');
            $click = $(this);
            remove_products_video.push(id);
            $(this).parent().parent().remove();
            if ((".livideo").length == 0) document.getElementById('uploadFilevideo').value = "";
            console.log(remove_products_video);
          });
        $("form#AddPost").submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            fi = document.getElementById('uploadFileimg');
            $('#name + .throw_error').empty(); //Clear the messages first
            $('#success').empty();
            var Postcontent = editor1.getData();
            var membersid= $('.data_member').val();
            if (filedata != null) {
                fileimgpost = 'true'
            } else {
                fileimgpost = 'false'
            }
            var insert = {
                membersid: membersid,
                Postcontent: Postcontent,
                fileimgpost: fileimgpost,
                method: 'createpost'
            }
            $.ajax({
                url: '../Process/Post.php',
                type: 'POST',
                data: insert,
                dataType: 'json',
                cache: false,
                success: function (data) {
                    if (data.success == false) {
                        alert(data.name);
                    } else {
                        // console.log(data.lat)
                        $(document).ready(function () {
                            alert("The post has been successfully added, adding images and videos, success will be displayed in the article");
                            if (data.lastid != null) {

                                var post_id = data.lastid;
                                
                                if( input_file_video.files.length > 0 ){
                                    console.log(post_id)
                                            formData.append("postid",  post_id)
                                            formData.append("remove_products_ids_video", remove_products_video);
                                            formData.append("type", 'video');
                                            $.ajax({
                                                url: '../amazon_s3/upload_multiple_video.php',
                                                type: 'POST',
                                                data: formData,
                                                processData: false,
                                                contentType: false,
                                                success: function (data) {
                                                 
                                                },
                                                error: function (e) {
                                                    $('#display_product_list ul').html("<li class='text-danger'>Something wrong! Please try again.</li>");
                                                }
                                            });
                                      
                                };
                                
                                if(input_file.files.length > 0 ){
                                    console.log(post_id)
                                        formData.append("postid",  post_id)
                                        formData.append("remove_products_ids", remove_products_ids);
                                        formData.append("type", "normal_photo");
                                        $.ajax({
                                            url: '../amazon_s3/upload_multiple_image.php',
                                            type: 'POST',
                                            data: formData,
                                            processData: false,
                                            contentType: false,

                                            success: function (data) {
                                                $('.editor').html('');
                                                $('.editor').val('');
                                                
                                            },
                                            error: function (e) {
                                                $('#display_product_list ul').html("<li class='text-danger'>Something wrong! Please try again.</li>");
                                            }
                                        });
                                  
                                }
                                
                                   
                                   
                                    $('#AddPos').val("");
                                    $('#uploadFileimg').val("");
                                    $('#uploadFilevideo').val("");
                                    $('.ck-content').html('');
                                    $('.preview li').remove();
                                    Loadstatuspost_add(membersid);
                                        loadlink();
                                    $('#them_bai_viet').modal('hide');
                                  $('#them_bai_viet').modal('hide');  

                           
                                
                            }
                        })

                    
                    }
                }
            });
           
            e.stopImmediatePropagation(); // to prevent more than once submission
            return false
        });


    });
    // comment
    function Loadstatuspost_add(membersid) {
        var loadstatuspost = {
            method: 'loaddata',
            page: 1,
            membersid:membersid
        }
        $.ajax({
            url: '../Process/Post.php',
            method: 'GET',
            data: loadstatuspost,
            type: 'json',
            cache: false,
            success: function (data) {
    
                if (data.success == false) {
                    alert(data.name);
                } else {
                    $("#list_posts").html(data);
                    loadlink();
                    addcomment();
                    time_ago();
                    $.ajax({
                        url : "../index/fetch_anh_daidien_son.php",
                        method : "POST",
                        type: 'JSON',
                        cache: false,
                        data:{'membersid':membersid},
                        success:function(data){
                        $(".gallery_dd_s").html(data);
                        }
                    });
                }
               
            }
        })
        
    }
    

})