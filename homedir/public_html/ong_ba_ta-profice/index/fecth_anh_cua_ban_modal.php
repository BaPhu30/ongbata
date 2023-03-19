<?php
require_once('../connectserve/connect.php');
//use session get id userlogin
// $membersid = $_POST['iduser'];
$membersid =$_POST['membersid'];



$query = "SELECT *, @rank :=  @rank + 1 AS rank_av FROM ftree_v1_4_gallery g, (SELECT  @rank := 0) r where membersid  = '{$membersid}' and typefile = 'normal_photo' ORDER BY g.id DESC;";

            $result = mysqli_query($connect, $query);
                                                            
            while ($row = mysqli_fetch_array($result)){?>

<div class="carousel-item " id="<?php echo 'active_acuaban', $row['rank_av']; ?>">
    <img src="<?php echo $row['url'] ?>" class="rounded-3" alt="">
</div>

<?php  }  ?>



<!-- <script type='text/javascript' src="../javascript/jquery.js"></script> -->

<script>
        $(document).ready(function() {
            $(this).find("#active_acuaban1").addClass("active");
        });
</script>