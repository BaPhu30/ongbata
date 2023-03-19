<?php
define("IMAGE_URL","https://s3.ap-southeast-1.amazonaws.com/datdia/");
include '../connectserve/connect.php';
require 'vendor/autoload.php';
if (isset($_FILES['uploadFilevideo'])) {

    $userid = $_POST['membersid'];;
    $posid = $_POST['postid'];
    $type = $_POST['type'];
    date_default_timezone_set('Asia/Ho_Chi_Minh'); 
    $date = date('Y-m-d H:i:s');
     
        try {
          // You may need to change the region. It will say in the URL when the bucket is open
          // and on creation.
           $s3 = new Aws\S3\S3Client([
        'region'  => 'ap-southeast-1',
        'version' => '2006-03-01',
        'credentials' => [
            'key'    => "AKIAVJH5OBNALLPJXXNB",
            'secret' => "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",
        ]
    ]);	
      } catch (Exception $e) {
          // We use a die, so if this fails. It stops here. Typically this is a REST call so this would
          // return a json object.
          die("Error: " . $e->getMessage());
      }
    
      $remove_products_ids_video = array();
      if(isset($_POST['remove_products_ids_video']) && !empty($_POST['remove_products_ids_videoo'])) {
        $remove_products_ids_video = explode(",", $_POST['remove_products_ids']);
      }
      for($i=0; $i<count($_FILES['uploadFilevideo']['name']); $i++) {    
        if(!in_array($i, $remove_products_ids_video)) {
          $pathToFileSingle = $_FILES['uploadFilevideo']['tmp_name'][$i];
          $destFilePath     = 'ongbata_pf/' . $_FILES['uploadFilevideo']['name'][$i];
          $pathsql = 'https://s3.ap-southeast-1.amazonaws.com/datdia/ongbata_pf/'. $_FILES['uploadFilevideo']['name'][$i];
    
        
          $s3->putObject(
              array(
                  'Bucket'=> 'datdia',
                  'Key' =>  $destFilePath,
                  'SourceFile' => $pathToFileSingle,
                  'ACL'           => 'public-read',

              )
          );
          $query = "INSERT INTO `ftree_v1_4_gallery`(`postid`,`membersid`,`url`, `datecreate`, `typefile`) VALUES ('{$posid}','{$userid}','{$pathsql}','{$date}','{$type}')";
          mysqli_query($connect, $query);
        }
      }

}



?>