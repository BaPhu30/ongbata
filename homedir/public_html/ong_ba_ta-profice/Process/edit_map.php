<?php
include '../connectserve/connect.php'; 
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name= $_POST['name_ed'];
    $pr_name= $_POST['pr_name'];
    $query = "UPDATE ftree_v1_4_mapbox
    SET title = '$name', description ='$pr_name'
    WHERE id = $id "; 
    mysqli_query($connect, $query);  
    exit();
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM ftree_v1_4_mapbox WHERE id =" . $id;
    mysqli_query($connect, $query);
  	exit();
}
?>