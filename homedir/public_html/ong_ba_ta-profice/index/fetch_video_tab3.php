<link rel="stylesheet" href="../css/thu_vien_video.css">
<link rel="stylesheet" href="../mediaelement-mediaelement-3b02c78/build/mediaelementplayer.css">
<?php
    error_reporting(E_ERROR | E_PARSE);
    require_once('../connectserve/connect.php');
 //  $membersid = $_POST['iduser'];
//  $visitorsid = $_POST['idvisit'];
$membersid = $_POST['membersid'];
$userid =$_POST['userid'];
$id_khach = $_POST['id_khach'];
if ($userid == $id_khach) {
    $delete="khong_value";

}
else {
    $delete="xoa_dulieu";

} 

                                    $query = "SELECT *, SUBSTRING(`url`, 1, 47), SUBSTRING(`url`, 48), @rank :=  @rank + 1 AS rank_av FROM ftree_v1_4_gallery g , (SELECT  @rank := 0) r where membersid = '{$membersid}' and typefile = 'video' ORDER BY g.id DESC;";

                                            $result = mysqli_query($connect, $query);
                                                                                            
                                            while ($row = mysqli_fetch_array($result)){?>

                                                                                                
                                            <div class="col-md-6 pd_5 md-width_50 video_tab3">
                                                        <div class="position-relative height_100 video_tab3_son">
                                                                                        
                                                                                                        <div class="media-wrapper">
                                                                                                                <video id="player1" style="max-width:100%; height: 200px;" class="video"
                                                                                                                    poster="https://ongbata.vn/wp-content/uploads/2021/06/ezgif.com-gif-maker-1.png"
                                                                                                                    preload="none" controls playsinline webkit-playsinline>
                                                                                                                    <source src="<?php echo $row['url'] ?>" type="video/mp4">
                                                                                                                </video>
                                                                                                            
                                                                                                            
                                                                                                        </div>
                                                                                                        
                                                                                                        <div class="<?php echo $delete ?> d-flex align-items-center position-absolute top-0 end-0 rounded-circle pd_5 button_edit mg_5">
                                                                                                            <div class="dropdown" style="height: 24px;">
                                                                                                                <div class=" dropdown-toggle button_dr_afet" type="button"
                                                                                                                    data-bs-toggle="dropdown" aria-expanded="false">

                                                                                                                    <span class="material-icons ">
                                                                                                                        mode
                                                                                                                    </span>

                                                                                                                </div>


                                                                                                                <ul class="dropdown-menu z_index_10 ">
                                                                                                                    <li>
                                                                                                                        <button data-bs-toggle="modal" data-bs-target="<?php echo "#share_tab3", $row['id']?>"
                                                                                                                            class="btn d-flex align-items-center fz_12 justify-content-between">
                                                                                                                            <span class="material-icons fz_12 text-black-50">
                                                                                                                                send
                                                                                                                            </span>
                                                                                                                            <b> <span class="fz_12"> Chia sẻ ảnh</span></b>
                                                                                                                        </button>
                                                                                                                    </li>
                                                                                                                    <li class="">
                                                                                                                        <button data-file="<?php echo $row['SUBSTRING(`url`, 48)'];?>"
                                                                                                                            class=" delete_video btn d-flex align-items-center  justify-content-between delete_jqa " id="<?php echo $row['id'] ?>">
                                                                                                                            <span class="material-icons fz_12 text-black-50">
                                                                                                                                delete
                                                                                                                            </span>
                                                                                                                            <b><span class="fz_12"> Xóa video</span></b>
                                                                                                                        </button>
                                                                                                                    </li>
                                                                                                                </ul>
                                                                                                            </div>
                                                                                                        </div>
                                                    </div>
                                                    <div class="sharetab3">
                                                        <div class="modal fade" id="<?php echo "share_tab3", $row['id']?>"  >
                                                                                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                                                                                <div class="modal-content border-0 bg-transparent">

                                                                                                    <div class="share_dad">
                                                                                                        <ul class=" d-flex">
                                                                                                            <li>
                                                                                                                <a class="facebook customer share fa fa-facebook"
                                                                                                                    href="https://www.facebook.com/sharer.php?u=<?php echo $row['url']?>"
                                                                                                                    title="Facebook share" target="_blank"></a>
                                                                                                            </li>

                                                                                                            <li>
                                                                                                                <a class="xing customer share fa fa-linkedin"
                                                                                                                    href="https://www.xing.com/social_plugins/share?url=<?php echo $row['url']?>"
                                                                                                                    title="Xing Share" target="_blank"></a>
                                                                                                            </li>
                                                                                                            <li>
                                                                                                                <a class="linkedin customer share fa fa-xing"
                                                                                                                    href="https://www.linkedin.com/shareArticle?mini=<?php echo $row['url']?>"
                                                                                                                    title="linkedin Share" target="_blank"></a>
                                                                                                            </li>
                                                                                                            <li>
                                                                                                                <a href="javascript:;" onclick="window.print()" class="fa fa-printr">
                                                                                                                    <i class="fa fa-print"></i>
                                                                                                                </a>
                                                                                                            </li>
                                                                                                        </ul>
                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>

                                                        </div>
                                                    </div>
                                            </div>
                                         
                                        
 <?php  }  ?>
 <script src="../mediaelement-mediaelement-3b02c78/build/mediaelement-and-player.js"></script>
<script src="../javascript/thu_vien_video.js"></script>
<script>
     $(".xoa_dulieu").remove();
</script>