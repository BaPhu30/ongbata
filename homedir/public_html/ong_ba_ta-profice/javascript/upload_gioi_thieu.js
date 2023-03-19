$(document).ready(function () {


    $(document).on('click', '.edit_data_person', function () {
        $('.select_info,#Update_info3').css("display", "none");
        $this = $(this)
        const data_id_person = $(this).attr("data-id_data")
        const data_column = $(this).attr("data-column");
        const name = $(this).attr("name");
        $('#input_info').val(data_column).focus();
        $('#input_info').attr("name", name).focus();
        $('#Update_info_modal').modal('show');
        $('#Update_info')[0].onclick = saveTask;
        function saveTask(e) {
            const memberid = $('.member_idif').val()
            $('#Update_info_modal').modal('hide');
            let data_after = $('#input_info').val();
            e.preventDefault();
            $(data_id_person).text(data_after);
            $this.attr("data-column", data_after);
            $('.select_info,#Update_info3').css("display", "block");
            Update_info(memberid,name,data_after)
        }

    });


    $(document).on('click', '.edit_data3_person', function () {
        $this = $(this)
        const data_id_person = $(this).attr("data-id_data")
        const data_column = $(this).attr("data-column");
        const name = $(this).attr("name");
        document.getElementById('input_infor_date').value = data_column;
        $('#input_infor_date').attr("name", name);
        $('#Update_info_modal2').modal('show');
        $('#Update_info2')[0].onclick = saveTask2;
        function saveTask2(e) {
            const memberid = $('.member_idif').val()
            let data_after = $('#input_infor_date').val();
            e.preventDefault();
            var date = new Date(data_after);
            let get_date = ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '-' +
                ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) +
                '-' + date.getFullYear();
            $(data_id_person).text(get_date);
            $this.attr("data-column", data_after);
            $('#Update_info_modal2').modal('hide');
            Update_info(memberid,name,data_after)
        }

    });

    $(document).on('click', '.edit_data2_person', function () {
        $('#input_info,#Update_info').css("display", "none");
        $this = $(this)
        const data_id_person = $(this).attr("data-id_data")
        const name = $(this).attr("name");
        $('#Update_info_modal').modal('show');
        $('#Update_info3')[0].onclick = saveTask3;
        function saveTask3(e) {
            const memberid = $('.member_idif').val()
            var text_s = $("#select_info option:selected").text();
            $('#Update_info_modal').modal('hide');
            var data_after_s = $( "#select_info option:selected" ).val();
            e.preventDefault();
            $(data_id_person).text(text_s)
            $this.attr("data-column", data_after_s);
            $('#input_info,#Update_info').css("display", "block");
            $('.class_icon_edit').css("display", "none");
            $('#select_info').prop('selectedIndex', 0);
            Update_info(memberid,name,data_after_s);
        }

    });
    $(document).on('click', '.edit_data4_person', function () {
        const data_id_person = $(this).attr("data-id_data")
        const name = $(this).attr("name");
        const  memberid = $(".member_idif").val()
        $.ajax({
            url : "../index/fetch.php",
            method : "POST",
            type: 'JSON',
            cache: false,
            data:{
                'data_id_person':data_id_person,
                'name':name,
                'membersid':memberid,
            },
            success:function(data){
            $("#story_show").html(data);
            $('#Update_story').modal('show');
            }
        });
        
        
    });



    $(document).on('click', '.close', function () {
        $('#Update_info3,#Update_info,.select_info,#input_info').css("display", "block");
    });
    $(document).on('click', '.delete_data_person', function () {
        const memberid = $('.member_idif').val()
        $(this).parent().parent().parent().parent().remove();
        const name = $(this).attr('name');
        let data_d='';
        Update_info(memberid,name,data_d)
    });


    
    

    

    function Update_info(memberid,name,data){
        $.post("../Process/edit_information.php?edit_infor",
            {
                memberid: memberid,
                name: name,
                data: data
            });
    }
});

