
<?php

	include '../connectserve/connect.php';
	require 'vendor/autoload.php';
	if (isset($_FILES['filetoupload'])) {	
		$userid = $_POST['membersid'];;
        $posid = $_POST['postid'];
        $type = $_POST['type'];
        date_default_timezone_set('Asia/Ho_Chi_Minh'); 
        $date = date('Y-m-d H:i:s');
		// AWS Info
		$bucketName = 'datdia'; 

		

		$s3 = new Aws\S3\S3Client([
			'region'  => 'ap-southeast-1',
			'version' => '2006-03-01',
			'credentials' => [
				'key'    => "AKIAVJH5OBNALLPJXXNB",
				'secret' => "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",
			]
		]);	
	
		$file_name  ='ongbata_pf/' . basename($_FILES["filetoupload"]['name']) ;
		$pathInS3 = 'https://s3.ap-southeast-1.amazonaws.com/' . $bucketName . '/' . $file_name ;

		// Add it to S3
		
			// Uploaded:
			$file = $_FILES["filetoupload"]['tmp_name'];

			$s3->putObject(
				array(
					'Bucket'=>$bucketName,
					'Key' =>  $file_name,
					'SourceFile' => $file,
					'ACL'           => 'public-read',
					'StorageClass' => 'REDUCED_REDUNDANCY'
				)
			);
		
            $query = "INSERT INTO `ftree_v1_4_gallery`(`postid`,`membersid`,`url`, `datecreate`, `typefile`) VALUES ('{$posid}','{$userid}','{$pathInS3}','{$date}','{$type}')";
			mysqli_query($connect, $query);
			if ($type =='avatar') {
               mysqli_query($connect, "UPDATE ftree_v1_4_members SET photo = '{$pathInS3}' WHERE id ='{$userid}'");
            }
	
	}
	
	

?>
