<?php
 require_once('../connectserve/connect.php');
if(!empty($_POST))  
{  
     $postid = $_POST["edit-post"];
     $query = " SELECT * FROM ftree_v1_4_post WHERE id='{$postid}' limit 1";

     $result = mysqli_query($connect, $query);
                                                     
     while ($row = mysqli_fetch_array($result)){?>
               <?php  $membersid = $row['membersid']; ?>
               <form id="multiple-files-upload" action="" class="pd_5 form_edit_bai_viet lead emoji-picker-container" style="resize: none;"
               enctype="multipart/form-data">
               <div class="toolbar-container"></div>

                    <div  id="editor-2" class="form-control textarea-control    border border-0 position-relative " rows="10" name="Postcontent">
                         <?php echo $row['title']; ?>
                    </div>
                    <!-- list image da co -->
                    <div>
                         <ul class="row row-cols-lg-5 preview">
                              <?php
                                   $ouput = '';
                                   $image_query = "SELECT *, SUBSTRING(`url`, 48) as url_delete FROM ftree_v1_4_gallery WHERE postid='{$postid}'";

                                   $result_image = mysqli_query($connect, $image_query);
                                                                                
                                   while ($image = mysqli_fetch_array($result_image)){
                                        if ($image['typefile']!="video") {
                                             $ouput .= '
                                             <li class="col pd_5" id="">
                                                   <div class="ic-sing-file  position-relative">
                                                        <img  src="'.$image["url"].'" title="" class="anh_fullscren"/>
                                                        <p data-file="'.$image["url_delete"].'" class="xoa_anh_edit material-icons position-absolute top-0 end-0 pd_5 cursor_p" id="'.$image["id"].'" data-bs-toggle="tooltip" data-placement="top" title="Xóa ảnh">remove_circle_outline</p>
                                                   </div>
                                              </li>';
                                        }
                                        else {
                                             $ouput .='
                                             <li class="col pd_5" id="">
                                                  <div class="ic-sing-file  position-relative">
                                                       <video width="100%" height="100%" controls>
                                                            <source src="'.$image["url"].'" type="video/mp4">
                                                       </video>
                                                       <p data-file="'.$image["url_delete"].'" class="xoa_anh_edit material-icons position-absolute top-0 end-0 pd_5 cursor_p" id="'.$image["id"].'" data-bs-toggle="tooltip" data-placement="top" title="Xóa video">remove_circle_outline</p>
                                                  </div>
                                             </li>';
                                        }
                                       
                                   }   echo $ouput;
                                  
                              
                          ?>
                         </ul>
                    </div>
                    <div class="" id="display_product_list_edit">
                         <ul class="row row-cols-lg-5 preview"></ul>
                    </div>
                    <div class="" id="display_product_list_video_edit">
                         <ul class="row row-cols-lg-5 preview"></ul>
                    </div>



                    <div class="d-flex align-items-center justify-content-end">
                         <div class="fileUpload fileUpload_1 pd_5" data-bs-toggle="tooltip" data-placement="top" title="Thêm Ảnh">
                              <input type="file" class="upload" id="products_uploaded" name="uploadFileimg[]" multiple accept="image/*">
                              <span class="material-icons text-success">
                                   collections
                              </span>
                         </div>
                         <div class="fileUpload fileUpload_1 pd_5" data-bs-toggle="tooltip" data-placement="top" title="Thêm Video">
                              <input type="file" class="upload" id="products_uploadedvideo" name="uploadFilevideo[]" multiple accept="video/*">
                              <span class="material-icons text-danger">
                                   video_call
                              </span>
                         </div>


                    </div>

                    <div class="modal-footer">
                         <input type="hidden" id="postedit" name="postid" value="<?php echo $postid ?>">
                         <button type="button" class="btn btn-outline-danger cancel_post" data-bs-dismiss="modal">Cancel</button>
                         <button class="btn btn-outline-info edit" id="UdatePost">
                              Update
                         </button>
                    </div>
               </form>


<?php  }}  ?>


<script>
     function Loadstatuspost_edit() {
          var loadstatuspost = {
               method: 'loaddata',
               page:1,
               membersid:<?php echo $membersid;?>

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
                         time_ago();
                         $.ajax({
                              url : "fetch_anh_daidien_son.php",
                              method : "POST",
                              type: 'JSON',
                              cache: false,
                              data:{'membersid':<?php echo $membersid;?>},
                              success:function(data){
                              $(".gallery_dd_s").html(data);
                              }

                          });
                    }
               
               }
          })
         
     }


     $(function () {
     var input_file = document.getElementById('products_uploaded');
     var input_file_video = document.getElementById('products_uploadedvideo');
     var remove_products_ids = [];
     var product_dynamic_id = 0;
     var remove_products_ids_video = [];
     var product_dynamic_video = 0;
     $("#products_uploaded").change(function (event) {
          var len = input_file.files.length;
          $('#display_product_list_edit ul').html("");

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
          $('#display_product_list_edit ul').append("<li class='liimage col pd_5' id='" + product_dynamic_id + "'><div class='ic-sing-file  position-relative'><img id='" + product_dynamic_id + "' src='" + src + "' title='" + name + "' class='anh_fullscren'><p class='close material-icons position-absolute top-0 end-0 pd_5 cursor_p' id='" + product_dynamic_id + "' data-bs-toggle='tooltip'data-placement='top' title='Xóa ảnh'>remove_circle_outline</p></div></li>")
          product_dynamic_id++;
          }
     });
     $("#products_uploadedvideo").change(function (event) {
          var len_video = input_file_video.files.length;
          $('#display_product_list_video_edit ul').html("");

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
          $('#display_product_list_video_edit ul').append("<li class='livideo col pd_5' id='" + product_dynamic_video + "'><div class='ic-sing-file  position-relative'><video width='150' height='150' controls><source id='" + product_dynamic_video + "' src='" + src + "' title='" + name + "'type='video/mp4'></video><p class='close_video material-icons position-absolute top-0 end-0 pd_5 cursor_p' id='" +  product_dynamic_video + "' data-bs-toggle='tooltip'data-placement='top' title='Xóa video'>remove_circle_outline</p></div></li>")
          product_dynamic_video++;
          }
     });
     $(document).on('click', 'p.close', function () {
          var id = $(this).attr('id');
          $click1 = $(this);
          remove_products_ids.push(id);
          $(this).parent().parent().remove();
          if ((".liimage").length == 0) document.getElementById('products_uploaded').value = "";
          console.log(remove_products_ids_video);
     });
     $(document).on('click', 'p.close_video', function () {
          var id = $(this).attr('id');
          $click = $(this);
          remove_products_ids_video.push(id);
          $(this).parent().parent().remove();
          if ((".livideo").length == 0) document.getElementById('products_uploadedvideo').value = "";
          console.log(remove_products_ids_video);
     });
     $("form#multiple-files-upload").submit(function (e) {
          e.preventDefault();
          var formData = new FormData(this);
          
          $(function () {
               var Postcontent2 = editor.getData();
                    formData.append("Postcontent", Postcontent2);
                    $.ajax({
                         url: '../Process/edit-post.php',
                         type: 'POST',
                         data: formData,
                         processData: false,
                         contentType: false,
                         beforeSend: function () {
                              $('#UdatePost').text("Đang cập nhật");
                         },
                         success: function (data) {
                              
                            
                              $('#editor-2').html('');
                              $('#editor-2').val('');
                              $('#chinh_sua_bai_viet').modal('hide');
                              $('#multiple-files-upload').val("");
                              
                            
                              $('#postedit').val("");
                                                            
                              addcomment();
                              $('#UdatePost').text("Update");
                              $(".load_sussce").show().delay(5000).fadeOut(); 
                              $.ajax({
                                   url : "../index/fetch_anh_daidien_son.php",
                                   method : "POST",
                                   type: 'JSON',
                                   cache: false,
                                   data:{'membersid':<?php echo $membersid;?>},
                                   success:function(data){
                                   $(".gallery_dd_s").html(data);
                                   }
                               });
                               Loadstatuspost_edit() 
                         },
                         error: function (e) {
                         
                              
                         }
                    });
                });
               if(input_file.files.length > 0 ){
                        
                         formData.append("remove_products_ids", remove_products_ids);
                         formData.append("type", "normal_photo");
                         formData.append("membersid", <?php echo $membersid;?> );
                         $.ajax({
                                        url: '../amazon_s3/upload_multiple_image.php',
                                        type: 'POST',
                                        data: formData,
                                        processData: false,
                                        contentType: false,

                                        success: function (data) {
                                                     $('#products_uploaded').val(""); 
                                        },
                                        error: function (e) {
                                             $('#display_product_list_edit ul').html("<li class='text-danger'>Something wrong! Please try again.</li>");
                                        }
                                   });
                          
               }
              
               if(input_file_video.files.length > 0 ){
                         
                              formData.append("remove_products_ids_video", remove_products_ids_video);
                              formData.append("type", 'video');
                              formData.append("membersid", <?php echo $membersid;?> );
                              $.ajax({
                                                       url: '../amazon_s3/upload_multiple_video.php',
                                                       type: 'POST',
                                                       data: formData,
                                                       processData: false,
                                                       contentType: false,

                                   success: function (data) {
                                                             $('#products_uploadedvideo').val("");
                                   },
                                                       error: function (e) {
                                                            $('#display_product_list_video_edit ul').html("<li class='text-danger'>Something wrong! Please try again.</li>");
                                                       }
                              });
                         
               }

          });
          e.stopImmediatePropagation(); // to prevent more than once submission
            return false
     });;

//   xoa anh edit
  $(".xoa_anh_edit").click(function () {
                var data_file = $(this).attr('data-file');
                var id  = $(this).attr('id');
                $click = $(this)
                $.ajax({
                url: '../Process/delete_gioi_thieu.php',
                type: 'GET',
                data: {
                    'delete_anh1': 1,
                    'id': id,
                },
                    success: function(data) {
                        $click.parent().parent().remove();
                    }
                });
                $.ajax({
                url: '../amazon_s3/delete_file_s3.php',
                type: 'GET',
                data: {
                    'delete_awss3': 1,
                    'deletefile': data_file,
                },
                success: function(response) {
                    
                }
            });
    });


  
</script>
<script>
    
    DecoupledEditor
			
			.create( document.querySelector( '#editor-2' ), {
				// language: 'vi'
                placeholder: 'Hãy viết cái bạn cần sửa',
                // cloudServices: {
                //     tokenUrl: 'https://example.com/cs-token-endpoint',
                //     uploadUrl: 'https://your-organization-id.cke-cs.com/easyimage/upload/'
                //  }
                ckfinder: {
                    uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
                },
			} )
           
			.then( editor => {
				const toolbarContainer = document.querySelector( '.form_edit_bai_viet .toolbar-container' );
	
				toolbarContainer.prepend( editor.ui.view.toolbar.element );
	
				window.editor = editor;
			} )
			.catch( err => {
				console.error( err.stack );
			} );
            document.querySelector( '#PushPost' ).addEventListener( 'click', () => {
            const editorData = editor.getData();
        } );
</script>