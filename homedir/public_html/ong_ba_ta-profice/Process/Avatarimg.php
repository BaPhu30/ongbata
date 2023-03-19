<?php

include '../connectserve/connect.php';
$path = "../images/";
$idtypegallery = '9';

//use session get id userlogin
$userid = '1';

if (isset($_POST['method'])) {
    $method = $_POST['method'];
    switch ($method) {
        case "Uploadimgavatar":
            if (isset($_FILES['multipleFile3'])) {
                if (isset($_POST['id'])) {$lastidimg = $_POST['id'];}
                foreach ($_FILES['multipleFile3']['name'] as $key => $val) {
                    // File upload path
                    $fileNameimg = $_FILES['multipleFile3']['name'][$key];
                    // echo $fileName;
                    $sqlinsertimgpost = "INSERT INTO `ftree_v1_4_gallery`(`postid`, `url`, `datecreate`, `typefile`) VALUES ('{$lastidimg}','{$fileNameimg}',unix_timestamp(),'{$idtypegallery}')";
                    $connect->query($sqlinsertimgpost);
                    move_uploaded_file($_FILES['multipleFile3']['tmp_name'][$key], $path . $fileNameimg);
                    $query = "UPDATE members SET photo='{$fileNameimg}'  WHERE ID='{$userid}'";
                    $connect->query($query);

                }
            }
            break;
    }
}

?>
