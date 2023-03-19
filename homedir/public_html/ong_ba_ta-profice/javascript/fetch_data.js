
$(document).on('click', '.fetch_anh,.tab_3', function() {
    var iduser = $(this).attr('data-user');
    var idvisit = $(this).attr('data-vistor');
    var id_khach = $(this).attr('data-author');
    
    function fetchData(){
        $.ajax({
            url : "../index/fetch_anh_dai_dien_tab3.php",
            method : "POST",
            type: 'JSON',
            cache: false,
            data:{
                'id_khach':id_khach,
                'membersid':iduser,
                'userid':idvisit,
            },
            success:function(data){
            $("#gallery_dd_tab3").html(data);
            }
        });
        $.ajax({
            url : "../index/fetch_anh_dai_dien_modal.php",
            method : "POST",
            type: 'JSON',
            cache: false,
            data:{
                'membersid':iduser,
                'userid':idvisit,
            },
            success:function(data){
            $("#anh_dai_dien_modal").html(data);
            }
        });
  
        $.ajax({
            url : "../index/fecth_anh_cua_ban.php",
            method : "POST",
            type: 'JSON',
            cache: false,
            data:{
                'id_khach':id_khach,
                'membersid':iduser,
                'userid':idvisit,
            },
            success:function(data){
            $("#anh_cua_ban_tab3").html(data);
            }
        });

        $.ajax({
            url : "../index/fecth_anh_cua_ban_modal.php",
            method : "POST",
            type: 'JSON',
            cache: false,
            data:{
                'membersid':iduser,
                'userid':idvisit,
            },
            success:function(data){
            $("#anh_cua_ban_modal").html(data);
            }
        });
        
        }
        fetchData();
});
$(document).on('click', '.fetch_anh3,.tab_3', function() {
    var id_khach = $(this).attr('data-author');
    var iduser = $(this).attr('data-user');
    var idvisit = $(this).attr('data-vistor');
    function fetchData(){
  
        $.ajax({
            url : "../index/fecth_anh_bia_tab3.php",
            method : "POST",
            type: 'JSON',
            cache: false,
            data:{
                'id_khach':id_khach,
                'membersid':iduser,
                'userid':idvisit,
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
                'membersid':iduser,
                'userid':idvisit,
            },
            success:function(data){
            $("#anh_bia_modal").html(data);
            }
        });
        $.ajax({
            url : "../index/fetch_video_tab3.php",
            method : "POST",
            type: 'JSON',
            cache: false,
            data:{
                'id_khach':id_khach,
                'membersid':iduser,
                'userid':idvisit,
            },
            success:function(data){
            $("#video").html(data);
            // $("#video").load("../index/fetch_video_tab3.php");
            }
        });
        
        }
        fetchData();
        loadlibrary();
        loadlibraryson();
});
$(document).on('click', '.tab_home,.fet_data', function() {
    var membersid = $(this).attr('data-user')
    function fetchData(){
        var loadstatuspost = {
            method: 'loaddata',
            page: 1,
        }
     
        $.ajax({
            url : "../index/fetch_anh_modal_tab1.php",
            method : "POST",
            type: 'JSON',
            cache: false,
            data:{
                'membersid':membersid,
            },
            success:function(data){
            $("#anh_nho_tab1").html(data);
            }
        });
        $.ajax({
            url: '../Process/Post.php',
            type: 'POST',
            data: loadstatuspost,
            dataType: 'json',
            cache: false,
            success: function (data) {
                if (data.success == false) {
                    alert(data.name);
                } else {
                    
                }
                $("#list_posts").html(data);
            }
        })
    
        
        }
        fetchData();
        function Loadstatuspost(){
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
                    if (data.success == false) {
                        alert(data.name);
                    } else {
                        
                    }
                    $("#list_posts").html(data);
                }
            })
        }
        Loadstatuspost();


        
});
