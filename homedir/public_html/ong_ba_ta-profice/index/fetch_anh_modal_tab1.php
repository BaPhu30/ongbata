<?php
require_once('../connectserve/connect.php');
//use session get id userlogin
$userid = $_POST['membersid'];;


$query = "SELECT *, @rank :=  @rank + 1 AS rank FROM ftree_v1_4_gallery g , (SELECT  @rank := 0) r where membersid  = '{$userid}' and typefile  IN ('cover_image','avatar','normal_photo') ORDER BY  g.id DESC LIMIT 9;";           

            $result = mysqli_query($connect, $query);
                                                            
            while ($row = mysqli_fetch_array($result)){?>

<div class="carousel-item " id="<?php echo 'active', $row['rank']; ?>">
    <img src="<?php echo $row['url'] ?>" class="rounded-3" alt="">
</div>

<?php  }  ?>



<!-- <script type='text/javascript' src="../javascript/jquery.js"></script> -->

<script>
        $(document).ready(function() {
            $(this).find("#active1").addClass("active");
        });
</script>