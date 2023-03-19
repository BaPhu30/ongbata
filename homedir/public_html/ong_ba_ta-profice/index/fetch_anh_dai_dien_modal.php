<?php
require_once('../connectserve/connect.php');
$membersid = $_POST['membersid'];
                                                $query = "SELECT *, @rank :=  @rank + 1 AS rank_av FROM ftree_v1_4_gallery g, (SELECT  @rank := 0) r where membersid  = '{$membersid}' and typefile = 'avatar' ORDER BY g.id DESC";
                                                $result = mysqli_query($connect, $query);

                                                while ($row = mysqli_fetch_array($result)) {?>

                                            <div class="carousel-item " id="<?php echo 'itemdd', $row['rank_av']; ?>">
                                                <img src="<?php echo $row['url'] ?>" class="rounded-3"
                                                    alt="">
                                            </div>

<?php }?>
<script>
        $(document).ready(function() {
            $(this).find("#itemdd1").addClass("active");
        });
</script>