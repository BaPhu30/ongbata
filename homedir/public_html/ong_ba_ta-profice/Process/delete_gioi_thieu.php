<?php
 include '../connectserve/connect.php';
  define('CSSPATH', 'template/css/'); //define css path
  $cssItem = 'profile-ongbata.css'; //css item to display

?>


<!-- anh-->
<?php 
  
  // delete comment fromd database
  if (isset($_GET['delete_anh1'])) {
  	$id = $_GET['id'];
  	$sql = "DELETE FROM ftree_v1_4_gallery WHERE id =" . $id;
  	mysqli_query($connect, $sql);
  	exit();
  }
   // delete comment fromd database
   if (isset($_GET['delete_anh2'])) {
	$id = $_GET['id'];
	$postid =$_GET['postid'];
	$sql = "DELETE FROM ftree_v1_4_gallery WHERE postid =" . $id;
	mysqli_query($connect, $sql);
	$sqldelchildpost = "DELETE  ftree_v1_4_postaction, ftree_v1_4_reactcomment, ftree_v1_4_comment FROM ftree_v1_4_postaction INNER JOIN ftree_v1_4_reactcomment on ftree_v1_4_postaction.postid = ftree_v1_4_reactcomment.postid
    INNER JOIN ftree_v1_4_comment on ftree_v1_4_reactcomment.postid = ftree_v1_4_comment.postid
    WHERE ftree_v1_4_postaction.postid =". $id;
    mysqli_query($connect,  $sqldelchildpost);
    $sqldelpost = "DELETE FROM  ftree_v1_4_post  where id =". $id;
    mysqli_query($connect,  $sqldelpost);
	exit();
	}
	// delete comment fromd database
	if (isset($_GET['delete_anh3'])) {
		$id = $_GET['id'];
		$sql = "DELETE FROM ftree_v1_4_gallery WHERE postid =" . $id;
		mysqli_query($connect, $sql);
		$sqldelchildpost = "DELETE  ftree_v1_4_postaction, ftree_v1_4_reactcomment, ftree_v1_4_comment FROM ftree_v1_4_postaction INNER JOIN ftree_v1_4_reactcomment on ftree_v1_4_postaction.postid = ftree_v1_4_reactcomment.postid
        INNER JOIN ftree_v1_4_comment on ftree_v1_4_reactcomment.postid = ftree_v1_4_comment.postid
        WHERE ftree_v1_4_postaction.postid =". $id;
        mysqli_query($connect,  $sqldelchildpost);
        $sqldelpost = "DELETE FROM  ftree_v1_4_post  where id =". $id;
        mysqli_query($connect,  $sqldelpost);
		exit();
	}
	// delete comment fromd database
	if (isset($_GET['delete_video'])) {
		$id = $_GET['id'];
		$sql = "DELETE FROM ftree_v1_4_gallery WHERE id =" . $id;
		mysqli_query($connect, $sql);
		exit();
	}

	

?>