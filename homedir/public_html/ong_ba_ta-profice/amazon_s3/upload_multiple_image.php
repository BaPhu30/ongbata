<?php
 define("IMAGE_URL","https://s3.ap-southeast-1.amazonaws.com/datdia/");
 include '../connectserve/connect.php';
require 'vendor/autoload.php';



if (isset($_FILES['uploadFileimg'])) {
 

    $userid = $_POST['membersid'];
    $posid = $_POST['postid'];
    $type = $_POST['type'];
    date_default_timezone_set('Asia/Ho_Chi_Minh'); 
    $date = date('Y-m-d H:i:s');
  $s3 = new Aws\S3\S3Client([
        'region'  => 'ap-southeast-1',
        'version' => '2006-03-01',
        'credentials' => [
            'key'    => "AKIAVJH5OBNALLPJXXNB",
            'secret' => "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",
        ]
    ]);		

  $remove_products_ids = array();
  if(isset($_POST['remove_products_ids']) && !empty($_POST['remove_products_ids'])) {
    $remove_products_ids = explode(",", $_POST['remove_products_ids']);
  }
  for($i=0; $i<count($_FILES['uploadFileimg']['name']); $i++) {
    if(!in_array($i, $remove_products_ids)) { 
        $pathToFileSingle = $_FILES['uploadFileimg']['tmp_name'][$i];
        $destFilePath     = 'ongbata_pf/' . $_FILES['uploadFileimg']['name'][$i];
        $pathsql = 'https://s3.ap-southeast-1.amazonaws.com/datdia/ongbata_pf/'. $_FILES['uploadFileimg']['name'][$i];
         $file_type = $_FILES['uploadFileimg']['type']; /*file type*/
        $s3->putObject([
			'Bucket'=> 'datdia',
                'Key' => $destFilePath,
                'SourceFile' => $pathToFileSingle,
                'ACL'           => 'public-read',
					'StorageClass' => 'REDUCED_REDUNDANCY'
		]);
        
        $query = "INSERT INTO `ftree_v1_4_gallery`(`postid`,`membersid`,`url`, `datecreate`, `typefile`) VALUES ('{$posid}','{$userid}','{$pathsql}','{$date}','{$type}')";
        mysqli_query($connect, $query);
        if ($type=='avatar') {
            $query = "UPDATE ftree_v1_4_members SET photo = '{$pathsql}' WHERE ID ='{$userid}'";
            mysqli_query($connect, $query);
        }
        
    }
  }
  

}

?>
