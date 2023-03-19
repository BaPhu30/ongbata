<?php
include '../connectserve/connect.php'; 
if(!empty($_POST))  
{  
    date_default_timezone_set('Asia/Ho_Chi_Minh'); 
    $commentId = mysqli_real_escape_string($connect, $_POST["comment_id"]);
    $comment = mysqli_real_escape_string($connect, $_POST["comment"]);
    $commentSenderName = mysqli_real_escape_string($connect, $_POST["name"]);
    $post_id = mysqli_real_escape_string($connect, $_POST["post_id"]);
    $date = date('Y-m-d H:i:s');
    $query = "INSERT INTO ftree_v1_4_comment (authorid,postid,comment,parent_comment_id,date) VALUES ('$commentSenderName','$post_id','$comment','$commentId','$date')";
    mysqli_query($connect, $query); 
    

  
    $demcomment = "SELECT COUNT(comment_id)AS numcomment FROM ftree_v1_4_comment WHERE postid ='".$_POST['post_id']."' ";
    $ketqua = mysqli_query($connect, $demcomment);
  while ($dem = mysqli_fetch_array($ketqua)){
    $numcommet_s= $dem['numcomment'];
  }
  echo $numcommet_s;

}
?>


