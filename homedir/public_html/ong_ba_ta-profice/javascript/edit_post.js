$(document).on('click', '.edit_post', function () {
    var post_id = $(this).attr("data-edit-post");
    $.ajax({
        url: "../index/fetch_post_edit.php",
        method: "POST",
        data: { 
            'edit-post': post_id,
        },
        Type: "json",
        success: function (data) {
            $('#chinh_sua_bai_viet').modal('show');
            // console.log(data)
            // $('#nhap_thoi_gian').val(data.thoi_gian);
            // $('#nhap_sk').val(data.su_kien);
            // $('#chi_tiet_su_kien').val(data.chi_tiet_su_kien);
            // $('#su_kien_id').val(data.id);
            
            $('#fect_edit').html(data);
            $('#post_sm_'+post_id).modal('hide');



        }



    });
});