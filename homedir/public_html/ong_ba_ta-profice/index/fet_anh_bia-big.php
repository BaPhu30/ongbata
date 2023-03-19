<?php
require_once('../connectserve/connect.php');
$membersid = $_POST['membersid'];

$query = "SELECT * FROM ftree_v1_4_gallery WHERE membersid = '{$membersid}' and typefile='cover_image' ORDER BY id DESC limit 1";

            $result = mysqli_query($connect, $query);
                                                            
            while ($row = mysqli_fetch_array($result)){
                $url = $row['url'];
              }  ?>
        <img src="<?php echo (empty($url)?'https://s3.ap-southeast-1.amazonaws.com/datdia/ongbata_pf/create-anime-background-style.jpg':$url); ?>" class="rounded-3" id="anh_bia">

<script>
   document.getElementById('anh_bia').addEventListener('click', function() {
    toggleFullscreen(this);
});
</script>
