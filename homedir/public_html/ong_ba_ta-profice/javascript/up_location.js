
$('#insert_form_location').on("submit", function (event) {
    event.preventDefault();
    if ($('#nhap_ten-diadiem').val() == "") {
        alert("tên địa điểm trống");
    }
    else if ($('#location').val() == '') {
        alert("ví trí trống");
    }

    else {
        $.ajax({
            url: "../Process/upload_location.php",
            method: "POST",
            data: $('#insert_form_location').serialize(),
            beforeSend: function () {
                $('#insert_lc').val("Đang thêm");
            },
            success: function (data) {
                $('#insert_form_location')[0].reset();
                $('#them_vi_tri').modal('hide');
                $(".load_sussce").show().delay(5000).fadeOut();
                $(document).ajaxStop(function(){
                    window.location.reload();
                });
                $('#insert_lc').val("Thêm ví trí mới");

                   
            }
        });
    }
});