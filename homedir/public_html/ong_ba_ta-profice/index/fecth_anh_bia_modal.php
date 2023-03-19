<?php
require_once('../connectserve/connect.php');
$membersid = $_POST['membersid']; 
// $membersid = $_POST['iduser'];  
                        $query = "SELECT *, @rank :=  @rank + 1 AS rank_ab FROM ftree_v1_4_gallery g , (SELECT  @rank := 0) r where membersid  = '{$membersid}' and 	typefile = 'cover_image' ORDER BY g.id DESC";
                        $result = mysqli_query($connect, $query);

                        while ($row = mysqli_fetch_array($result)) {?>

                                            <div class="carousel-item " id="<?php echo 'itembia', $row['rank_ab']; ?>">
                                                <img src="<?php echo $row['url'] ?>"
                                                    class="rounded-3" alt="">
                                            </div>

 <?php }?>
 <script>
        $(document).ready(function() {
            $(this).find("#itembia1").addClass("active");
        });
</script>