<?php
    require_once ("../connectserve/connect.php");
    if($_POST["Postcontent"] !=' ') { 
        $id = $_POST['postid'];
        $contten= $_POST['Postcontent'];
        $query = "UPDATE ftree_v1_4_post
        SET title = '$contten'
        WHERE id = $id "; 
        mysqli_query($connect, $query);  
       
    } 
?>