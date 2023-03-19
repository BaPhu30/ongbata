<?php
// require_once ("Connect.php");
include '../connectserve/connect.php';
$commentId = $_POST['comment_id'];
$totalLikes = "No ";
$likeQuery = "SELECT sum(like_unlike) AS likesCount FROM ftree_v1_4_reactcomment where comment_id=".$commentId;
$resultLikeQuery = mysqli_query($connect,$likeQuery);
$fetchLikes = mysqli_fetch_array($resultLikeQuery,MYSQLI_ASSOC);
if(isset($fetchLikes['likesCount'])) {
    $totalLikes = $fetchLikes['likesCount'];
}

echo $totalLikes;
?>
