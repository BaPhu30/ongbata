<?php

include '../connectserve/connect.php';
// usre id hoac visitor id
$userId = $_POST['userid'];
$commentId = $_POST['comment_id'];
$postid = $_POST['postid'];
$likeOrUnlike = 0;
if($_POST['like_unlike'] == 1)
{
$likeOrUnlike = $_POST['like_unlike'];
}

$sql = "SELECT * FROM ftree_v1_4_reactcomment WHERE comment_id=" . $commentId . " and authorid=" . $userId;
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

if (! empty($row)) 
{
    $query = "UPDATE ftree_v1_4_reactcomment SET like_unlike = " . $likeOrUnlike . " WHERE  comment_id=" . $commentId . " and authorid=" . $userId;
} else
{
    $query = "INSERT INTO ftree_v1_4_reactcomment(authorid,comment_id,like_unlike,postid) VALUES ('" . $userId . "','" . $commentId . "','" . $likeOrUnlike ."','" . $postid . "')";
}
mysqli_query($connect, $query);

$totalLikes = "No ";
$likeQuery = "SELECT sum(like_unlike) AS likesCount FROM ftree_v1_4_reactcomment WHERE comment_id=".$commentId;
$resultLikeQuery = mysqli_query($connect,$likeQuery);
$fetchLikes = mysqli_fetch_array($resultLikeQuery,MYSQLI_ASSOC);
if(isset($fetchLikes['likesCount'])) {
    $totalLikes = $fetchLikes['likesCount'];
}

echo $totalLikes;
?>