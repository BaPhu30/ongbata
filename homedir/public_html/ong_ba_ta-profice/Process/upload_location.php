<?php 
 include '../connectserve/connect.php';  
if(!empty($_POST))  
{ 
    $longitude = mysqli_real_escape_string($connect, $_POST["longitude"]);
    $latitude = mysqli_real_escape_string($connect, $_POST["latitude"]);
    $userid = mysqli_real_escape_string($connect, $_POST["userid"]); 
    $ten_mo =  mysqli_real_escape_string($connect, $_POST["nhap_ten-diadiem"]);
    $chi_tiet_mo = mysqli_real_escape_string($connect, $_POST["nhap_mota-diadiem"]);
    $query = "INSERT INTO ftree_v1_4_mapbox (longitude,latitude,title,description, membersid )  VALUES('{$longitude}','{$latitude}','{$ten_mo}','{$chi_tiet_mo}','{$userid}')  ";  
    mysqli_query($connect, $query); 
      $query = "UPDATE  ftree_v1_4_members set  longitude ='{$longitude}', latitude='{$latitude}',title_map='{$ten_mo}',description_map='{$chi_tiet_mo}'  where id = '{$userid}'";  
    mysqli_query($connect, $query);  
}


?>
 