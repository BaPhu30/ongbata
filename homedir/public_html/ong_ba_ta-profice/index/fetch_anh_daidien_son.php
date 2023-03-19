<?php
require_once('../connectserve/connect.php');
$membersid = $_POST['membersid'];;

$query = "SELECT photo FROM ftree_v1_4_members WHERE id ='$membersid'";

            $result = mysqli_query($connect, $query);
                                                            
            while ($row = mysqli_fetch_array($result)){
   $photo_chek = $row['photo'];     
 } 
 
  if (strpos($photo_chek, 'uploads/')  !== false) {
      $photo= '../../'.$photo_chek;
  } 
  elseif(strpos($photo_chek, 'images/')  !== false){
      $photo= '../../'.$photo_chek;
  }
  else {
      $photo = $photo_chek;
  };

?>
<img src="<?php echo (empty($photo)?"../../images/no_profile_pic.jpg":$photo) ;?>" class=" rounded-circle border"  alt="">
