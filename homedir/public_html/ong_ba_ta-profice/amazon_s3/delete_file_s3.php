<?php
    	include '../connectserve/connect.php';
        require 'vendor/autoload.php';
        
if (isset($_GET['delete_awss3'])) {
 
        $keyname = $_GET['deletefile'];



            // AWS Info
            $bucketName = 'datdia';


    // You may need to change the region. It will say in the URL when the bucket is open
              	$s3 = new Aws\S3\S3Client([
			'region'  => 'ap-southeast-1',
			'version' => '2006-03-01',
			'credentials' => [
				'key'    => "AKIAVJH5OBNALLPJXXNB",
				'secret' => "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",
			]
		]);	
		
		$s3->deleteObject(array(
        'Bucket' => $bucketName,
        'Key'    =>  $keyname
    ));
}	
?>