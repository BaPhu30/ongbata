<?php
$bucket="datdia";
require_once('./vendor/autoload.php');

//AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'ACCESS_KEY');
if (!defined('awsSecretKey')) define('awsSecretKey', 'ACCESS_Secret_KEY');

$s3 = new S3(awsAccessKey, awsSecretKey);
$s3->putBucket($bucket, S3::ACL_PUBLIC_READ);

function getExtension($str) 
{
$i = strrpos($str,".");
if (!$i) { return ""; }
$l = strlen($str) - $i;
$ext = substr($str,$i+1,$l);
return $ext;
}
//Here you can add valid file extensions. 
$valid_formats = array("jpg", "png", "gif","bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
$msg='';
if($_SERVER['REQUEST_METHOD'] == "POST")
{
$name = $_FILES['file']['name'];
$size = $_FILES['file']['size'];
$tmp = $_FILES['file']['tmp_name'];
$ext = getExtension($name);

if(strlen($name) > 0)
{
// File format validation
if(in_array($ext,$valid_formats))
{
// File size validation
if($size<(1024*1024))
{
//Rename image name. 
$actual_image_name = time().".".$ext;

if($s3->putObjectFile($tmp, $bucket , $actual_image_name,         S3::ACL_PUBLIC_READ) )
{
$msg = "S3 Upload Successful."; 
$s3file='http://'.$bucket.'.s3.amazonaws.com/'.$actual_image_name;
echo "<img src='$s3file'/>";
echo 'S3 File URL:'.$s3file;
}
else
$msg = "S3 Upload Fail.";

}
else
$msg = "Image size Max 1 MB";

}
else
$msg = "Invalid file, please upload image file.";

}
else
$msg = "Please select image file.";

}
?>

//HTML Code
<form action="" method='post' enctype="multipart/form-data">
Upload image file here
<input type='file' name='file'/> <input type='submit' value='Upload Image'/>
<?php echo $msg; ?>
</form>