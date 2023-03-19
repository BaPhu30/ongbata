<?php 
 include '../connectserve/connect.php';
 if (isset($_POST['delete'])) {

        $method = $_POST['delete'];
        switch($method){
            // delete coment
            case "delete_comment":
                $id = $_POST['id'];
                $sql = "DELETE  ftree_v1_4_reactcomment, ftree_v1_4_comment FROM ftree_v1_4_comment LEFT JOIN ftree_v1_4_reactcomment ON ftree_v1_4_comment.comment_id=ftree_v1_4_reactcomment.comment_id WHERE ftree_v1_4_comment.comment_id ='".$id."'OR ftree_v1_4_comment.parent_comment_id = ".$id;
                mysqli_query($connect, $sql);

                $demcomment = "SELECT COUNT(comment_id)AS numcomment FROM ftree_v1_4_comment WHERE postid ='".$_POST['postid']."' ";
                $ketqua = mysqli_query($connect, $demcomment);
                while ($dem = mysqli_fetch_array($ketqua)){
                    $numcommet_s= $dem['numcomment'];
                }
                echo $numcommet_s;
            break;
                
            case "delete_comment_son":
        
                $id = $_POST['id'];
                $sql = "DELETE  ftree_v1_4_reactcomment, ftree_v1_4_comment FROM ftree_v1_4_comment LEFT JOIN ftree_v1_4_reactcomment ON ftree_v1_4_comment.comment_id=ftree_v1_4_reactcomment.comment_id WHERE ftree_v1_4_comment.comment_id =".$id;
                mysqli_query($connect, $sql);
                // var_dump($sql);

                $demcomment = "SELECT COUNT(comment_id)AS numcomment FROM ftree_v1_4_comment WHERE postid ='".$_POST['postid']."' ";
                $ketqua = mysqli_query($connect, $demcomment);
                while ($dem = mysqli_fetch_array($ketqua)){
                    $numcommet_s= $dem['numcomment'];
                }
                echo $numcommet_s;
            break;   
        
        }
 }
?>