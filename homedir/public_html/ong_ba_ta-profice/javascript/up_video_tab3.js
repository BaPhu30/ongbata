$(document).ready(function () {
  $(document).on('change', '#multipleVideo', function () {
      var iduser = $(this).parent().attr('data-user');
      var idmemeber = $(this).parent().attr('data-member');
      var count_file = $(this)[0].files.length;
      var file_data = document.getElementById('multipleVideo')
      var form_data = new FormData();
      var file = this.files[0];
      var  fileType = file['type'];
      var validvideo = ['video/ogg', 'video/mp4', 'video/webm','video/x-matroska'];
      if (validvideo .includes(fileType)) {
        for (var i = 0; i < file_data.files.length; i++) {
          form_data.append('uploadFilevideo[]', file_data.files.item(i));
          }
      }
      else {
          alert("wrong format");
          $("#multipleVideo").val('');
          return;
      }
      //khởi tạo đối tượng form data
   
      var insert = {
          membersid: idmemeber,
          Postcontent: "<center><b><i>Thêm "+count_file+" Video</b></i></center>",
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
                          form_data.append("type", "video");
                          form_data.append("membersid", idmemeber);
                          
                          $.ajax({
                             url: '../amazon_s3/upload_multiple_video.php',
                              dataType: 'text',
                              cache: false,
                              contentType: false,
                              processData: false,
                              data: form_data,
                              type: 'post',
                              success: function () { 
                                //   $("#multipleVideo").val("");
                                //   $('#video').load("../Process/upload_video_tab3.php").fadeIn("slow");
                                //   $(".load_sussce").show().delay(5000).fadeOut();
                                  fetchData(idmemeber,iduser);
                                  
                              }
                          });
                      }
                  })
              }
          }
      });
  });
  // setInterval(function(){//setInterval() method execute on every interval until called clearInterval()
  //   $('#list_posts').load("../Process/Post.php").fadeIn("slow");
  //   //load() method fetch data from fetch.php page
  //  }, 30000);
  function fetchData(idmemeber,iduser){

      $.ajax({
        method : "POST",
        url : "../index/fetch_video_tab3.php",
        type: 'JSON',
        cache: false,
        data:{
                'membersid':idmemeber,
                'userid':iduser,
        },
        success:function(data){
        $("#video").html(data);
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
      fetchData();
 
})