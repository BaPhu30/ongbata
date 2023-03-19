<?php 
include '../connectserve/connect.php';
if (isset($_GET['edit_infor'])) {
    $memberid = $_POST['memberid'];
    $name = $_POST['name'];
    if ($_POST['name']=='birthdate' or $_POST['name']=='deathdate') {
        $date = $_POST['data'];
        $value =strtotime($date);
    }
    else
    {
        $value = $_POST['data'];
    }
    $connect->query("UPDATE ftree_v1_4_members SET ".$name." = '".$value."'WHERE id =".$memberid);

    echo $value;
}
?>
