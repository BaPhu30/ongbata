
<ul> 
    <?php
        require_once('../connectserve/connect.php');
    $userid = $_POST['idvistor'];
 

 





                    
                                        $query = "SELECT u.username,u.photo ,c.* FROM ftree_v1_4_comment c left join ftree_v1_4_users u on c.authorid = u.id where c.parent_comment_id = 0 and  c.postid = '".$_POST['postid']."'  ORDER BY comment_id ASC";
                                        $result = mysqli_query($connect, $query);
                                                                                
                                        while ($row = mysqli_fetch_array($result)){?>
                                                <?php 
                                                    $post_idcm = $row['postid'];
                                            
                                                    $ten = $row["username"];
                                                    $comment_id = $row["comment_id"];
                                                    $ngay_thang = $row["date"] ;
                                                    $conten_comment= $row['comment'];
                                                    $vatar= $row['photo'];
                                                    
                                                    if ($userid == $row['authorid']) {
                                                        $delete="khong_value";

                                                    }
                                                    else {
                                                        $delete="xoa_dulieu";
                                                        
                                                    } 
                                                    $likeQuery = "SELECT sum(like_unlike) AS likesCount ,sum(authorid = '".$userid."') as nummember  FROM ftree_v1_4_reactcomment where comment_id=".$comment_id;
                                                    $resultLikeQuery = mysqli_query($connect,$likeQuery);
                                                    while ($sol = mysqli_fetch_array($resultLikeQuery)){
                                                        $numlikes = $sol['likesCount'];
                                                        $countuser = $sol['nummember'];
                                                    }

                                                ?>
                                                

                                                <li>
                                                    <div class="panel panel-default" >
                                                            <div class="panel-heading">
                                                                <div class="avtar_img_coment">
                                                                    <img src="<?php if($vatar!=null){echo $vatar;}else { echo "http://localhost/main_ongbata/demo-ongbata/sourse-code/images/no_profile_pic.jpg";}?>" alt="" class="rounded-circle border">
                                                                </div>
                                                                 <b style="margin: 0 5px;"><?php echo $ten;?></b> 
                                                                  <time class="timeago" datetime="<?php echo $ngay_thang; ?>"></time>
                                                            </div>
                                                            <div class="panel-body"  align="left"><?php echo  $conten_comment?></div>
                                                            <div class="panel-footer " align="left" data-comment="<?php echo $post_idcm;?>">
                                                                <div class="comment_react d-flex align-items-center" data-react="<?php echo $comment_id ?>">
                                                                                <span  style="display:<?php 
                                                                                    if($countuser>0){
                                                                                            echo "block";
                                                                                        }
                                                                                        else {
                                                                                            echo "none";
                                                                                        }
                                                                                        ?>;" class="<?php if($userid=="0"){ echo "click_login";}?> material-icons  fz_16 text-danger like-unlike unlike_<?php echo $comment_id ?>" onclick="<?php if($userid!="0"){echo "likeOrDislike";} ?>(<?php echo $userid;?>,<?php echo $post_idcm ?>,<?php echo $comment_id ?>,-1)">
                                                                                        favorite
                                                                                </span>
                                                                                <span   style="display:<?php 
                                                                                        if($countuser>0){
                                                                                            echo "none";
                                                                                        }
                                                                                        else {
                                                                                            echo "block";
                                                                                        }
                                                                                        ?>;" class="<?php if($userid=="0"){ echo "click_login";}?> material-icons  fz_16 text-danger like-unlike like_<?php echo $comment_id ?>" onclick="<?php if($userid!="0"){echo "likeOrDislike";} ?>(<?php echo $userid;?>,<?php echo $post_idcm ?>,<?php echo $comment_id ?>,1)">
                                                                                        favorite_border
                                                                                </span>
                                                                                <span class="text-danger fz_12 likes_<?php echo $comment_id ?>"> <?php if ($numlikes > '0') {
                                                                                   echo $numlikes;
                                                                                    }?>  
                                                                                </span>
                                                                <div style="margin: 0 10px;"  data-comment="<?php echo $post_idcm;?>">
                                                                    <a type="button" class="reply fz_12 text-black-50" id="<?php echo $comment_id ?>">Reply</a>
                                                                    <a type="button" class="delete_comment fz_12 text-black-50 <?php echo $delete ?>" id="<?php echo $comment_id ?>">Delete</a>
                                                                </div>
                                                            </div>
                                                    </div></div>
                                                    <ul style="list-style: none;">
                                                        <?php
                                                                
                                                                $son = "SELECT u.username,u.photo ,c.* FROM ftree_v1_4_comment c left join ftree_v1_4_users u on c.authorid = u.id
                                                                where c.parent_comment_id = '".$row['comment_id']."'    ORDER BY comment_id ASC" or die(mySQL_error());
                                                                $ketqua = mysqli_query($connect, $son);
                                                               
                                                                while ($row = mysqli_fetch_array($ketqua)){?>

                                                                    <?php
                                                                        
                                                                        $likeQuery_son = "SELECT sum(like_unlike) AS likesCount ,sum(authorid = '".$userid."') as nummember  FROM ftree_v1_4_reactcomment where comment_id=".$row["comment_id"];
                                                                        $resultLikeQuery_son = mysqli_query($connect,$likeQuery_son);
                                                                        while ($sol_son = mysqli_fetch_array($resultLikeQuery_son)){
                                                                            $son_numlikes = $sol_son['likesCount'];
                                                                            $countuser_son = $sol_son['nummember'];
                                                                        }

                                                                        if ($userid == $row['authorid']) {
                                                                            $delete="khong_value";
                    
                                                                        }
                                                                        else {
                                                                            $delete="xoa_dulieu";
                    
                                                                        } 
                                                                     ?>
                                                                    <li> 
                                                                        <div class="panel panel-default">
                                                                            <div class="panel-heading">
                                                                                <div class="avtar_img_coment">
                                                                                    <img src="<?php if($row["photo"]!=null){echo $row["photo"];}else { echo "http://localhost/main_ongbata/demo-ongbata/sourse-code/images/no_profile_pic.jpg";}?>" alt="" class="rounded-circle border">
                                                                                </div>
                                                                                <b style="margin: 0 5px;"><i><?php echo $row["username"];?></i></b> 
                                                                                <i><time class="timeago" datetime="<?php echo $row["date"];?>"></time></i>
                                                                            </div>
                                                                                
                                                                            <div class="panel-body"  align="left"><?php echo $row["comment"];?></div>
                                                                            <div class="panel-footer d-flex align-items-center" align="left" data-comment="<?php echo $row["postid"]?>">
                                                                                <div class="comment_react d-flex align-items-center" data-react="<?php echo $row["comment_id"];?>">
                                                                                            <span style="display: <?php 
                                                                                        if($countuser_son>0){
                                                                                                echo "block";
                                                                                            }
                                                                                            else {
                                                                                                echo "none";
                                                                                            }
                                                                                            ?>;" class="<?php if($userid=="0"){ echo "click_login";}?> material-icons fz_16 text-danger like-unlike unlike_<?php echo $row["comment_id"];?>" onclick="<?php if($userid!="0"){echo "likeOrDislike";} ?>(<?php echo $userid;?>,<?php  echo $row['postid'] ?>,<?php echo $row['comment_id'];?>,-1)">
                                                                                                favorite
                                                                                            </span>
                                                                                            <span style="display: <?php 
                                                                                        if($countuser_son>0){
                                                                                                echo "none";
                                                                                            }
                                                                                            else {
                                                                                                echo "block";
                                                                                            }
                                                                                            ?>;"  class="<?php if($userid=="0"){ echo "click_login";}?> material-icons fz_16 text-danger like-unlike like_<?php echo $row['comment_id'];?>" onclick="<?php if($userid!="0"){echo "likeOrDislike";} ?>(<?php echo $userid;?>,<?php echo $row['postid'] ?>,<?php echo $row['comment_id'];?>,1)">
                                                                                                favorite_border
                                                                                            </span>
                                                                                            <span class="text-danger fz_12 likes likes_<?php echo $row['comment_id'];?>"> 
                                                                                                <?php if ($son_numlikes > '0') {
                                                                                                    echo $son_numlikes;
                                                                                                    }?> 
                                                                                            </span>
                                                                                </div>
                                                                                <div data-comment="<?php echo $row["postid"]?>">
                                                                                     <a type="button" class="delete_comment_son fz_12 text-black-50 <?php echo $delete ?>" id="<?php echo $row["comment_id"];?>">Delete</a>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </li>
                                                        <?php } ?>
        
                                                    </ul> 
                                                </li>

                                        
    <?php }?>
</ul>


<script src="../javascript/thu_vien_timeago.js"></script>
<script>

$(".comment_react").click(function () {
            
            var commentId = $(this).attr('data-react')
            $.ajax({
                type: 'POST',
                async: false,
                url: '../Process/get-like-unlike-commet.php',
                data: {comment_id: commentId},
                success: function (data)
                {
                    totalLikes = data;
                }

            });

        
    });
    function likeOrDislike(userid,postid,comment_id,like_unlike)
            {
                var userid = userid;
                var postid = postid
                console.log(userid);
                $.ajax({
                    url: '../Process/action-comment.php',
                    async: false,
                    type: 'post',
                    data: {
                        userid:userid,
                        postid:postid,
                        comment_id:comment_id,
                        like_unlike:like_unlike,
                    },
                    dataType: 'json',
                    success: function (data) {
                        
                        $(".likes_"+comment_id).text(data + " liked");
                        
                        if (like_unlike == 1) { 
                            $(".like_" + comment_id).css("display", "none");
                            $(".unlike_" + comment_id).show();
                        }

                        if (like_unlike == -1) {
                            $(".unlike_" + comment_id).css("display", "none");
                            $(".like_" + comment_id).show();
                        }
                        
                    },
                    error: function (data) {
                        alert("error : " + JSON.stringify(data));
                    }
                });
                
            }

            
          
    $(".delete_comment").click(function () {
                var id  = $(this).attr('id');
                $click = $(this)
                var postId = $(this).parent().attr('data-comment');
                $.ajax({
                url: '../Process/delete_comment.php',
                type: 'POST',
                data: {
                    'delete': 'delete_comment',
                    'id': id,
                    'postid': postId,
                },
                    success: function(data) {
                        $click.parent().parent().parent().parent().parent().remove();
                        $(".nummbercomment_"+postId).html(data);
                    }
                });
    });
    $(".delete_comment_son").click(function () {
                var id  = $(this).attr('id');
                $click = $(this);
                var postId = $(this).parent().attr('data-comment');
                $.ajax({
                url: '../Process/delete_comment.php',
                type: 'POST',
                data: {
                    'delete':'delete_comment_son',
                    'id': id,
                    'postid': postId,
                },
                success: function(data) {
                    $click.parent().parent().parent().parent().remove();
                    $(".nummbercomment_"+postId).html(data);
                }
                });
   });
   $(".click_login").click(function () { 
        $('#Modal_login').css("display", "block");
    });
    $(".close-login,.modal-login").click(function () { 
      $('#Modal_login').css("display", "none");
    });
   $(".xoa_dulieu").remove();
</script>
