
<?php
session_start();



// var_dump($_SESSION["user_id"]);
// // die;
//use session get id userlogin
error_reporting(E_ERROR | E_PARSE);
$membersid = $_GET['membersid'];
$userid = $_SESSION["user_id"];
$authorid = $_GET['author'];
if ($userid == $authorid) {
    $delete="khong_value";
    $nam_pr = "bạn";
}
else {
    $delete="xoa_dulieu";

}
include '../connectserve/connect.php';

$result_data = array();
$limit = 3;
$sql = "SELECT COUNT(id) as number_post FROM ftree_v1_4_post";
$rs_result = mysqli_query($connect, $sql);
$row = mysqli_fetch_row($rs_result);
$total_records = $row[0];
$total_pages = ceil($total_records / $limit);
if (isset($_GET['method'])) {
    $form_data = array();
    $method = $_GET['method'];
    if ($method == 'loaddata') {
        $start_from = (($_GET['page']) - 1) * $limit;
        $sql = "SELECT p.id as pid,p.*,m.*FROM ftree_v1_4_post p left join ftree_v1_4_members m on p.membersid = m.id 
        WHERE m.id = $membersid ORDER BY p.id DESC LIMIT $start_from, $limit";
        $result = $connect->query($sql);
        if (!empty($result) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                
                
                ?>

<div id="postid_<?=$row['pid'];?>" class="bg-white shadow-sm border border_raidus_07  mb_20 section_right-3 postroot">

    <div class=" section_right-2_header d-flex justify-content-between align-items-center pd_10 ">
        <div class="d-flex justify-content-between  align-items-center">
            <div class="avtar_img_section_right_2 gallery_dd_s">
            </div>
            <div class="text-center">
                <h5 class="fz_16">
                    <b>
                        <span>
                            <?=$row['lastname'] . " " . $row['firstname'];?>
                        </span>
                    </b>
                </h5>
                <div class="fz_12 d-flex   align-items-center">
                    <span>
                        
                        <time class="timeago" datetime="<?php echo $row['datecreate'];?>"></time>
                    </span>
                    <span class="material-icons">
                        supervisor_account
                    </span>
                </div>
            </div>
        </div>
        <div class="dropdown <?php echo $delete ?>">
            <button class="btn dropdown-toggle button_dr_afet" type="button" data-bs-toggle="dropdown">

                <span class="material-icons ">
                    more_horiz
                </span>
            </button>
            <ul class="dropdown-menu  z_index_10">
                <li>
                    <button class="edit_post btn d-flex align-items-center fz_12 justify-content-between"  data-edit-post="<?=$row['pid'];?>">
                        <span class="material-icons fz_12 text-black-50">
                            drive_file_rename_outline
                        </span>
                        <b> <span class="fz_12"> Chỉnh sửa bài viết</span></b>
                    </button>
                </li>
                <li>
                    <button class="btn d-flex align-items-center  justify-content-between btn--del"
                        data-id="<?=$row['pid'];?>">
                        <span class="material-icons fz_12 text-black-50">
                            delete
                        </span>
                        <b><span class="fz_12"> Xóa bài viết</span></b>
                    </button>
                </li>
            </ul>
        </div>
    </div>
    <div class="section_right-2_body mb_10">
        <div class="pd_10 ">

            <span><?php echo $row['title'] ?></span>

        </div>
        <div class="d-flex flex-wrap imgs_post position-relative">
            <?php 
                        $query_image = "SELECT *, @rank :=  @rank + 1 AS rank_image FROM ftree_v1_4_gallery, (SELECT  @rank := 0) r WHERE postid =".$row['pid']."  ORDER BY ID DESC limit 4";
                        $result_image = mysqli_query($connect, $query_image);
                                                                                
                        while ($image = mysqli_fetch_array($result_image)){?>
                        <div class="flex_50 image_post1 <?php if($image['typefile']=="video"){echo "align-self-center"; } ?>">
                            <div
                                class="wrapper <?php if ($image['typefile']=='avatar') {echo"bg-light bg-gradient pd_15 d-flex justify-content-center";}?>">
                                <div data-fullScreen class="fullScreen-1 bg-transparent">
                                    <div
                                        class="hv_thu  <?php if ($image['typefile']=='avatar') {echo"rounded-circle border border-3 border-white add_add9";}?>">
                                        <img src="<?php if($image['typefile']!="video" && $image['rank_image'] <5){echo  $image['url'];} ?>"
                                            class="anh_fullscren cursor_p " alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="media-wrapper align-items-center d-flex " height="100%">
                                <video id="player1" width="100%" height="100%" style="max-width:100%;"
                                    poster="https://ongbata.vn/wp-content/uploads/2021/06/ezgif.com-gif-maker-1.png"
                                    preload="none" controls playsinline webkit-playsinline>
                                    <source
                                        src="<?php if($image['typefile']=="video" && $image['rank_image'] <5){echo   $image['url']; } ?>">
                                </video>
                            </div>

                        </div>
            <?php }?>
            <!-- dem file -->
            <?php
                        $query_count_g = "SELECT COUNT(url) as sum_image,COUNT(url)-4 as num_image FROM ftree_v1_4_gallery WHERE postid=".$row['pid'];
                        $result_count_g = mysqli_query($connect, $query_count_g);
                        
                        while ($image_count = mysqli_fetch_array($result_count_g)){
                            $image_num = $image_count['num_image'];
                            $image_sum = $image_count['sum_image'];
                            if($image_sum>4)
                            {
                                echo "<span class='see_more fz_20 position-absolute top-50 start-50 translate-middle text-center' data-bs-toggle='modal' data-bs-target='#post_sm_".$row['pid']."'><b data-bs-target='#carouselExampleControls_see_more_post".$row['pid']." data-bs-slide-to='3' aria-label='Slide 4'>Xem thêm ".$image_num." ảnh nữa </b></span>";
                                 $xoa_dulieu = "";
                            
                            }
                            elseif ($image_sum<=4) {
                                 $xoa_dulieu = "xoa_dulieu";
                            }
                        }
            ?>
        </div>

    </div>

    <div class="section_right-2_footer pd_10 ">
            <div class="d-flex justify-content-between  align-items-center">
                <div class="fz_14 d-flex justify-content-between  align-items-center md-fz_12">
                    <?php
                            $sqlcount = "SELECT postid,count(case when pa.react = 'like' then 1 end) as countlike,
                            count(case when pa.react = 'comment' then 1 end) as countcomment
                                FROM ftree_v1_4_postaction pa where pa.postid = '{$row['pid']}'
                                group by postid";
                                $ccountlike = $ccomment = "";
                                $resultcount = $connect->query($sqlcount);
                                while ($rowcmt = mysqli_fetch_array($resultcount)) {
                                    if (isset($rowcmt['countlike'])) {$ccountlike = $rowcmt['countlike'];}
                                    if (isset($rowcmt['countcomment'])) {$ccomment = $rowcmt['countcomment'];}
                                }
                            

                                $demcomment = "SELECT COUNT(comment_id)
                                FROM ftree_v1_4_comment
                                WHERE postid ='{$row["pid"]}' ";
                                $ketqua = mysqli_query($connect, $demcomment);
                                while ($dem = mysqli_fetch_array($ketqua)){
                                    $numcommet_s= $dem['COUNT(comment_id)'];
                                }
                        ?>
                    <span class="material-icons text-danger">
                        favorite
                    </span>
                    <span class="coutlike">
                        <?php echo $ccountlike; ?>
                    </span>
                </div>

                <div class="fz_14 md-fz_12">
                    <span class="nummbercomment_<?php echo $row['pid']; ?>">
                        <?php echo $numcommet_s; ?>
                    </span>
                    <span>
                        Bình luận
                    </span>
                </div>
            </div>
            <div class="row border-bottom mb_20 md-flex">
                <div class="col-md-4 d-flex align-items-center justify-content-center md-width_30 md-pd_0">
                    <button class="<?php if($userid=="0"){ echo "click_login";}?> btn d-flex align-items-center justify-content-center md-fz_12 fet_data 
                    <?php
                        $sqllikeuser = "SELECT * from ftree_v1_4_postaction where postid = '{$row['pid']}' and authorid = '{$userid}' and react = 'like'";
                        $resultlikeuser = mysqli_query($connect, $sqllikeuser);
                        if ($resultlikeuser) {
                            $rowlikeuser = mysqli_num_rows($resultlikeuser);
                            if ($rowlikeuser > 0) {
                                echo "liked";
                            }
                        }?>" id="like" data-user="<?php echo $userid?>" data-id="<?=$row['pid'];?>" data-user="<?php echo $userid?>"  onclick="<?php if($userid!='0'){echo 'openToggle(this)'; }?>" > 
                        <span class="material-icons text-success">
                            favorite
                        </span>
                        <span class="db_bl_tg">
                            Thích
                        </span>
                        <span class="dp_none_tg">
                            Đã thích
                        </span>
                    </button>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-center md-width_40 md-pd_0">
                    <button class="btn d-flex align-items-center justify-content-center md-fz_12 commmen_click" data-user="<?php echo $membersid; ?>" data-vistor ="<?php echo $userid; ?>"
                        value="<?php echo $row['pid'] ?>" onclick="openCommentdad(this)">
                        <span class="material-icons text-success">
                            add_comment
                        </span>
                        <span>
                            Bình luận
                        </span>
                    </button>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-center md-width_30 md-pd_0 ">
                    <button class="btn d-flex align-items-center justify-content-center md-fz_12 <?php if($userid=="0"){ echo "click_login";}?>" data-bs-toggle="modal"
                        data-bs-target="<?php echo '#sharepost',$row['pid']?>">
                        <span class="material-icons text-success">
                            share
                        </span>
                        <span>
                            Chia sẻ
                        </span>
                    </button>
                </div>
            </div>
            <div class="comment_nt_click position-relative" id="comment">

                <div class="position-absolute bottom-0 width_100">
                    <div style="display:none" class="fz_14 text-center text-success comment-message_<?=$row['pid'];?>">
                        Comments Added Successfully!
                    </div>

                    <div class=" d-flex   align-items-center">
                        <div class="avtar_img_section_right_2 pd_2 gallery_dd_s">

                        </div>

                        <div
                            class="d-flex   align-items-center justify-content-between formcomment_dad comments lead emoji-picker-container">
                            <form action="" class="d-flex  align-items-center frm-comment"
                                data-commemt="<?=$row['pid'];?>">
                                <input type="hidden" name="post_id" class="postid" value="<?=$row['pid'];?>"
                                    placeholder="Name" />
                                <input type="hidden" name="comment_id" class="commentId commentId_<?=$row['pid'];?>"
                                    placeholder="Name" />
                                <input class="input-field name_<?=$row['pid'];?>" type="hidden" name="name" placeholder="Name" value="<?php echo $userid;?>"/>
                                <textarea data-emojiable="true" data-emoji-input="unicode"
                                    class=" py-0 px-1  rounded-pill formcomment border border-0 form-control textarea-control comment comment_<?=$row['pid'];?>"
                                    name="comment" rows="1" placeholder="Viết bình luận..."
                                    style="resize: none;"></textarea>
                                <br>
                                <input type="<?php if($userid=="0"){ echo "button";}else{echo "submit";} ?>" 
                                    class="<?php if($userid=="0"){ echo "click_login";}?> btn-submit submitButton btn btn-outline-info me-md-2 btn-sm submitButton submitButton_<?=$row['pid'];?>"
                                    value="Publish" />
                                <input type="button"
                                    class="btn-submit cancel btn btn-outline-danger btn-sm cancel_<?=$row['pid'];?>"
                                    value="Cancel" />


                            </form>

                        </div>
                    </div>
                </div>


                <div class="output_<?php echo $row['pid']?> output">

                </div>
                <div style="height:40px;">

                </div>

            </div>
    </div>


    <div class="sharepost1 <?php if($userid=="0"){ echo "xoa_dulieu";}?>">
            <div class="modal fade" id="<?php echo "sharepost", $row['pid']?>" >
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content border-0 bg-transparent">

                        <div class="share_dad">
                            <ul class=" d-flex">
                                <li>
                                    <a class="facebook customer share fa fa-facebook"
                                        href="https://www.facebook.com/sharer.php?u=https://ongbata.vn/"
                                        title="Facebook share" target="_blank"></a>
                                </li>

                                <li>
                                    <a class="xing customer share fa fa-linkedin"
                                        href="https://www.xing.com/social_plugins/share?url=https://ongbata.vn/"
                                        title="Xing Share" target="_blank"></a>
                                </li>
                                <li>
                                    <a class="linkedin customer share fa fa-xing"
                                        href="https://www.linkedin.com/shareArticle?mini=https://ongbata.vn/"
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
    





    <!-- khu modal -->
    <!-- khu see more of post -->
    <div class="<?php echo $xoa_dulieu; ?>">
        <div class="modal fade " id="<?php echo 'post_sm_',$row['pid'] ?>" tabindex="-1"aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen-xxl-down modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-body row pd_0 overflow_hidden_pc-none_media-auto">

                        <div class="col-4 media_display position-relative md-width_100 ">
                            <button type="button"
                                class="z_index_10 btn-close d-flex bg-light bt_close_sm-media2  rounded-circle pd_10"
                                data-bs-dismiss="modal" aria-label="Close">
                            </button>


                            <div class="d-grid">
                                <div
                                    class=" section_right-2_header d-flex justify-content-between align-items-center pd_10 ">
                                    <div class="d-flex justify-content-between  align-items-center">
                                        <div class="avtar_img_section_right_2 gallery_dd_s">

                                        </div>
                                        <div class="text-center">
                                            <h5 class="fz_16">
                                                <b>
                                                    <span>

                                                        <?=$row['lastname'] . " " . $row['firstname'];?>

                                                    </span>
                                                </b>
                                            </h5>
                                            <div class="fz_12 d-flex   align-items-center">
                                                <span>
                                                    <time class="timeago" datetime="<?php echo $row['datecreate'];?>"></time>
                                                </span>
                                                <span class="material-icons">
                                                    supervisor_account
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="<?php echo $delete; ?>">
                                        <button class="btn dropdown-toggle button_dr_afet" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">

                                            <span class="material-icons ">
                                                more_horiz
                                            </span>

                                        </button>


                                        <ul class="dropdown-menu  z_index_10 ">
                                            <li>
                                                <button
                                                    class=" edit_post btn d-flex align-items-center fz_12 justify-content-between" data-edit-post="<?=$row['pid'];?>"
                                                   >
                                                    <span class="material-icons fz_12 text-black-50">
                                                        drive_file_rename_outline
                                                    </span>
                                                    <b> <span class="fz_12"> Chỉnh sửa bài viết</span></b>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="btn d-flex align-items-center  justify-content-between">
                                                    <span class="material-icons fz_12 text-black-50">
                                                        delete
                                                    </span>
                                                    <b><span class="fz_12"> Xóa bài viết</span></b>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="pd_10 ">

                                    <span><?php echo $row['title'] ?></span>
                                </div>
                            </div>

                            <div class="section_right-2_footer pd_10 md-pd_0">
                                <div class="d-flex justify-content-between  align-items-center">
                                    <div class="fz_14 d-flex justify-content-between  align-items-center md-fz_12">
                                        <?php
                                                                                $sqlcount = "SELECT postid,count(case when pa.react = 'like' then 1 end) as countlike,
                                                                                count(case when pa.react = 'comment' then 1 end) as countcomment
                                                                                    FROM ftree_v1_4_postaction pa where pa.postid = '{$row['pid']}'
                                                                                    group by postid";
                                                                            $ccountlike = $ccomment = "";
                                                                            $resultcount = $connect->query($sqlcount);
                                                                            while ($rowcmt = mysqli_fetch_array($resultcount)) {
                                                                                if (isset($rowcmt['countlike'])) {$ccountlike = $rowcmt['countlike'];}
                                                                                if (isset($rowcmt['countcomment'])) {$ccomment = $rowcmt['countcomment'];}
                                                                            }
                                                                            ?>
                                        <span class="material-icons text-danger">
                                            favorite
                                        </span>
                                        <span class="coutlike">
                                            <?php echo $ccountlike; ?>
                                        </span>
                                    </div>
                                    <div class="fz_14 md-fz_12">
                                        <span class="nummbercomment_<?php echo $row['pid']; ?>">
                                            <?php echo $numcommet_s; ?>
                                        </span>
                                        <span>
                                            Bình luận
                                        </span>
                                    </div>
                                </div>
                                <div class="row border-bottom mb_20 md-flex">
                                    <div
                                        class="col-md-4 d-flex align-items-center justify-content-center md-width_30 md-pd_0">
                                        <button class="<?php if($userid=="0"){ echo "click_login";}?> btn d-flex align-items-center justify-content-center md-fz_12 fet_data 
                                                                                <?php
                                                                            $sqllikeuser = "SELECT * from ftree_v1_4_postaction where postid = '{$row['pid']}' and authorid = '{$userid}' and react = 'like'";
                                                                            $resultlikeuser = mysqli_query($connect, $sqllikeuser);
                                                                            if ($resultlikeuser) {
                                                                                $rowlikeuser = mysqli_num_rows($resultlikeuser);
                                                                                if ($rowlikeuser > 0) {
                                                                                    echo "liked";
                                                                                }
                                                                            }
                                                                            ?>" id="like" data-user="<?php echo $userid?>"  data-id="<?=$row['pid'];?>" onclick="<?php if($userid!='0'){echo 'openToggle(this)'; }?>"
                                            >
                                            <span class="material-icons text-success">
                                                favorite
                                            </span>
                                            <span class="db_bl_tg">
                                                Thích
                                            </span>
                                            <span class="dp_none_tg">
                                                Đã thích
                                            </span>
                                        </button>
                                    </div>
                                    <div
                                        class="col-md-4 d-flex align-items-center justify-content-center md-width_40 md-pd_0">
                                        <button
                                            class="btn d-flex align-items-center justify-content-center md-fz_12 click_show" data-user="<?php echo $membersid; ?>" data-vistor ="<?php echo $userid; ?>"
                                            value="<?php echo $row['pid'] ?>">
                                            <span class="material-icons text-success">
                                                add_comment
                                            </span>
                                            <span>
                                                Bình luận
                                            </span>
                                        </button>
                                    </div>
                                    <div
                                        class="col-md-4 d-flex align-items-center justify-content-center md-width_30 md-pd_0 ">
                                        <button class="btn d-flex align-items-center justify-content-center md-fz_12 <?php if($userid=="0"){ echo "click_login";}?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="<?php echo '#sharepost',$row['pid']?>">
                                            <span class="material-icons text-success">
                                                share
                                            </span>
                                            <span>
                                                Chia sẻ
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <div class="comment_nt_click comment_tg_click comment_tg_click_media" id="comment">
                                    <div class="colse_comment">

                                        <button type="button"
                                            class="z_index_10 btn-close bg-light bt_close_sm-media  rounded-circle pd_10 media_display"></button>

                                    </div>

                                    <div class=" width_100">
                                        <div style="display:none"
                                            class="fz_14 text-center text-success comment-message_<?=$row['pid'];?>">
                                            Comments Added Successfully!
                                        </div>

                                        <div class=" d-flex   align-items-center">
                                            <div class="avtar_img_section_right_2 pd_2 gallery_dd_s">

                                            </div>

                                            <div
                                                class="d-flex   align-items-center justify-content-between formcomment_dad comments lead emoji-picker-container">
                                                <form action="" class="d-flex  align-items-center frm-comment"
                                                    data-commemt="<?=$row['pid'];?>">
                                                    <input type="hidden" name="post_id" class="postid"
                                                        value="<?=$row['pid'];?>" placeholder="Name" />
                                                    <input type="hidden" name="comment_id"
                                                        class="commentId commentId_<?=$row['pid'];?>"
                                                        placeholder="Name" />
                                                    <input class="input-field name_<?=$row['pid'];?>" type="hidden" name="name"
                                                        placeholder="Name"
                                                        value="<?php echo $userid;?>" />
                                                    <textarea data-emojiable="true" data-emoji-input="unicode"
                                                        class=" py-0 px-1  rounded-pill formcomment border border-0 form-control textarea-control comment comment_<?=$row['pid'];?>"
                                                        name="comment" rows="1" placeholder="Viết bình luận..."
                                                        style="resize: none;"></textarea>
                                                    <br>
                                                    <input type="<?php if($userid=="0"){ echo "button";}else{echo "submit";} ?>" 
                                                        class="<?php if($userid=="0"){ echo "click_login";}?> btn-submit submitButton btn btn-outline-info me-md-2 btn-sm submitButton submitButton_<?=$row['pid'];?>"
                                                        value="Publish" />
                                                    <input type="button"
                                                        class="btn-submit cancel btn btn-outline-danger btn-sm cancel_<?=$row['pid'];?>"
                                                        value="Cancel" />


                                                </form>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="output_<?php echo $row['pid']?> output">

                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="col-8 slide_sm_left md-width_100 md-pd_0">

                            <div id="<?php echo "carouselExampleControls_see_more_post",$row['pid'];?>"
                                class="carousel slide slide_sm_son" data-bs-touch="false" data-bs-interval="false"
                                data-interval="false">
                                <button type="button"
                                    class=" z_index_10 btn-close bg-light bt_close_sm position-absolute top-0 start-0 rounded-circle pd_10 pc_display"
                                    data-bs-dismiss="modal" aria-label="Close">
                                </button>

                                <div class="carousel-inner see_more_of_post">
                                    <?php  
                                      $query_image_sm = "SELECT *, @rank :=  @rank + 1 AS rank_image FROM ftree_v1_4_gallery, (SELECT  @rank := 0) r WHERE postid =".$row['pid']."  ORDER BY ID DESC";
                                      $result_image_sm = mysqli_query($connect, $query_image_sm);
                                      while ($image_sm = mysqli_fetch_array($result_image_sm)){?>
                                                <div class="carousel-item  <?php if ($image_sm['rank_image']=="1") { echo"active";}?>">
                                                    <div
                                                        class="wrapper wrapper_sm  <?php if ($image_sm['typefile']=="avatar") {echo"bg-light bg-gradient pd_15 d-flex justify-content-center";}?>">
                                                        <div data-fullScreen class="fullScreen-1 ">
                                                            <div
                                                                class="see-more_img <?php if ($image_sm['typefile']=="avatar") {echo"rounded-circle border border-3 border-white add_add9";}?>">
                                                                <img src="<?php if($image_sm['typefile']!="video"){echo   $image_sm['url'];} ?>"
                                                                    class="anh_fullscren cursor_p" alt="">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="media-wrapper ">
                                                        <video id="player1" width="100%" height="100%" style="max-width:100%;"
                                                            poster="https://ongbata.vn/wp-content/uploads/2021/06/ezgif.com-gif-maker-1.png"
                                                            preload="none" controls playsinline webkit-playsinline>
                                                            <source
                                                                src="<?php if($image_sm['typefile']=="video" ){echo   $image_sm['url']; } ?>">

                                                        </video>
                                                    </div>
                                                </div>
                                    <?php }?>
                                </div>
                                <button class="carousel-control-prev  slide_prev_sm pc_display" type="button"
                                    data-bs-target="<?php echo "#carouselExampleControls_see_more_post",$row['pid'];?>"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon rounded-circle bg-dark pd_20 "
                                        aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next slide_next_sm pc_display" type="button"
                                    data-bs-target="<?php echo "#carouselExampleControls_see_more_post",$row['pid'];?>"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon rounded-circle bg-dark pd_20 "
                                        aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-4 pc_display">
                            <div class="d-grid">
                                <div
                                    class=" section_right-2_header d-flex justify-content-between align-items-center pd_10 ">
                                    <div class="d-flex justify-content-between  align-items-center">
                                        <div class="avtar_img_section_right_2 gallery_dd_s">

                                        </div>
                                        <div class="text-center">
                                            <h5 class="fz_16">
                                                <b>
                                                    <span>
                                                        <?=$row['lastname'] . " " . $row['firstname'];?>
                                                    </span>
                                                </b>
                                            </h5>
                                            <div class="fz_12 d-flex   align-items-center">
                                                <span>
                                                    <time class="timeago" datetime="<?php echo $row['datecreate'];?>"></time>
                                                </span>
                                                <span class="material-icons">
                                                    supervisor_account
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="<?php echo $delete; ?>">
                                        <button class="btn dropdown-toggle button_dr_afet" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">

                                            <span class="material-icons ">
                                                more_horiz
                                            </span>

                                        </button>


                                        <ul class="dropdown-menu  z_index_10 ">
                                            <li>
                                                <button
                                                    class="edit_post btn d-flex align-items-center fz_12 justify-content-between" data-edit-post="<?=$row['pid'];?>"
                                                    >
                                                    <span class="material-icons fz_12 text-black-50">
                                                        drive_file_rename_outline
                                                    </span>
                                                    <b> <span class="fz_12"> Chỉnh sửa bài viết</span></b>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="btn d-flex align-items-center  justify-content-between">
                                                    <span class="material-icons fz_12 text-black-50">
                                                        delete
                                                    </span>
                                                    <b><span class="fz_12"> Xóa bài viết</span></b>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="pd_10 ">

                                    <span>
                                        <?php echo $row['title'] ?>
                                    </span>

                                </div>
                            </div>

                            <div class="section_right-2_footer pd_10 ">
                                <div class="d-flex justify-content-between  align-items-center">
                                    <div class="fz_14 d-flex justify-content-between  align-items-center md-fz_12">
                                        <?php
                                                                            $sqlcount = "SELECT postid,count(case when pa.react = 'like' then 1 end) as countlike,
                                                                            count(case when pa.react = 'comment' then 1 end) as countcomment
                                                                                FROM ftree_v1_4_postaction pa where pa.postid = '{$row['pid']}'
                                                                                group by postid";
                                                                        $ccountlike = $ccomment = "";
                                                                        $resultcount = $connect->query($sqlcount);
                                                                        while ($rowcmt = mysqli_fetch_array($resultcount)) {
                                                                            if (isset($rowcmt['countlike'])) {$ccountlike = $rowcmt['countlike'];}
                                                                            if (isset($rowcmt['countcomment'])) {$ccomment = $rowcmt['countcomment'];}
                                                                        }
                                                                        ?>
                                        <span class="material-icons text-danger">
                                            favorite
                                        </span>
                                        <span class="coutlike">
                                            <?php echo $ccountlike; ?>
                                        </span>
                                    </div>
                                    <div class="fz_14 md-fz_12">

                                        <span class="nummbercomment_<?php echo $row['pid']; ?>">
                                            <?php echo $numcommet_s; ?>
                                        </span>

                                        <span>
                                            Bình luận
                                        </span>
                                    </div>
                                </div>
                                <div class="row border-bottom mb_20 md-flex">
                                    <div
                                        class="col-md-4 d-flex align-items-center justify-content-center md-width_30 md-pd_0">
                                        <button class="<?php if($userid=="0"){ echo "click_login";}?> btn d-flex align-items-center justify-content-center md-fz_12 fet_data 
                                                                            <?php
                                                                        $sqllikeuser = "SELECT * from ftree_v1_4_postaction where postid = '{$row['pid']}' and authorid = '{$userid}' and react = 'like'";
                                                                        $resultlikeuser = mysqli_query($connect, $sqllikeuser);
                                                                        if ($resultlikeuser) {
                                                                            $rowlikeuser = mysqli_num_rows($resultlikeuser);
                                                                            if ($rowlikeuser > 0) {
                                                                                echo "liked";
                                                                            }
                                                                        }
                                                                        ?>" id="like" data-id="<?=$row['pid'];?>" data-user="<?php echo $userid?>"  onclick="<?php if($userid!='0'){echo 'openToggle(this)'; }?>"
                                            >
                                            <span class="material-icons text-success">
                                                favorite
                                            </span>
                                            <span class="db_bl_tg">
                                                Thích
                                            </span>
                                            <span class="dp_none_tg">
                                                Đã thích
                                            </span>
                                        </button>
                                    </div>
                                    <div
                                        class="col-md-4 d-flex align-items-center justify-content-center md-width_40 md-pd_0">
                                        <button
                                            class="btn d-flex align-items-center justify-content-center md-fz_12 click_show" data-user="<?php echo $membersid; ?>" data-vistor ="<?php echo $userid; ?>"
                                            value="<?php echo $row['pid'] ?>">
                                            <span class="material-icons text-success">
                                                add_comment
                                            </span>
                                            <span>
                                                Bình luận
                                            </span>
                                        </button>
                                    </div>
                                    <div
                                        class="col-md-4 d-flex align-items-center justify-content-center md-width_30 md-pd_0 ">
                                        <button class="btn d-flex align-items-center justify-content-center md-fz_12 <?php if($userid=="0"){ echo "click_login";}?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="<?php echo '#sharepost',$row['pid']?>">
                                            <span class="material-icons text-success">
                                                share
                                            </span>
                                            <span>
                                                Chia sẻ
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <div class="comment_nt_click comment_tg_click " id="comment">

                                    <div class=" width_100">
                                        <div style="display:none"
                                            class="fz_14 text-center text-success comment-message_<?=$row['pid'];?>">
                                            Comments Added Successfully!
                                        </div>

                                        <div class=" d-flex   align-items-center">
                                            <div class="avtar_img_section_right_2 pd_2 gallery_dd_s">

                                            </div>

                                            <div
                                                class="d-flex   align-items-center justify-content-between formcomment_dad comments lead emoji-picker-container">
                                                <form action="" class="d-flex  align-items-center frm-comment"
                                                    data-commemt="<?=$row['pid'];?>">
                                                    <input type="hidden" name="post_id" class="postid"
                                                        value="<?=$row['pid'];?>" placeholder="Name" />
                                                    <input type="hidden" name="comment_id"
                                                        class="commentId commentId_<?=$row['pid'];?>"
                                                        placeholder="Name" />
                                                    <input class="input-field name_<?=$row['pid'];?>" type="hidden" name="name"
                                                         placeholder="Name"
                                                        value="<?php echo $userid;?>" />
                                                    <textarea data-emojiable="true" data-emoji-input="unicode" 
                                                        class=" py-0 px-1  rounded-pill formcomment border border-0 form-control textarea-control comment comment_<?=$row['pid'];?>"
                                                        name="comment" rows="1" placeholder="Viết bình luận..."
                                                        style="resize: none;"></textarea>
                                                    <br>
                                                    <input type="<?php if($userid=="0"){ echo "button";}else{echo "submit";} ?>" 
                                                        class="<?php if($userid=="0"){ echo "click_login";}?> btn-submit submitButton btn btn-outline-info me-md-2 btn-sm submitButton submitButton_<?=$row['pid'];?>"
                                                        value="Publish" />
                                                    <input type="button"
                                                        class="btn-submit cancel btn btn-outline-danger btn-sm cancel_<?=$row['pid'];?>"
                                                        value="Cancel" />


                                                </form>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="max-height-vh60_overflow_auto output_<?php echo $row['pid']?> output">

                                    </div>


                                </div>
                            </div>

                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

    <?php
}
        }
    }
}
function checkdata($data)
{
    $data = trim($data);
    return $data;
}

if (isset($_POST['method'])) {
    $methodadd = $_POST['method'];
    switch ($methodadd) {
        case "createpost":
            $idmember = checkdata($_POST['membersid']);
            $Postcontent = checkdata($_POST['Postcontent']);
            $fileimgpost = checkdata($_POST['fileimgpost']);
            date_default_timezone_set('Asia/Ho_Chi_Minh'); 
            $date = date('Y-m-d H:i:s');

            $sqlinsert = "INSERT INTO `ftree_v1_4_post`(`membersid`, `title`,`datecreate`) VALUES ('{$idmember}','{$Postcontent}','{$date}')";
            if (mysqli_query($connect, $sqlinsert)) {
                $last_id = mysqli_insert_id($connect);
                if ($fileimgpost == 'true') {
                    $result_data['success'] = true;
                    $result_data['lastid'] = $last_id;

                } else {
                    $result_data['success'] = true;
                    $result_data['lastid'] = $last_id;
                }

            } else {
                $result_data['success'] = false;
                $result_data['name'] = $connect->error;
            }
            echo json_encode($result_data);
            break;
        case "deletepost":
            
            $result_data = array();
            $delpostid = checkdata($_POST['delpostid']);
            function deletepost($table,$condition,$connect){
                $connect->query("DELETE FROM ".$table."where".$condition);
            }
            $delpost = "id = '{$delpostid}'";
            deletepost('ftree_v1_4_post',$delpost,$connect);
            
            $postaction = "postid  = '{$delpostid}'";
            deletepost('ftree_v1_4_postaction',$postaction,$connect);
            
            $delcomment = "postid  = '{$delpostid}'";
            deletepost('ftree_v1_4_comment',$delcomment,$connect);
            
            $delreactcomment = "postid  = '{$delpostid}'";
            deletepost('ftree_v1_4_reactcomment',$delreactcomment,$connect);
            
            echo json_encode($result_data);
            break;
        case "likepost":
            $authorid = $_POST['author'];
            $result_data = array();
            $sqllikeuser = $resultlikeuser = $rowlikeuser = 0;
            $likepostid = checkdata($_POST['likepostid']);
            $sqllikeuser = "SELECT * from ftree_v1_4_postaction where postid = '{$likepostid}' and authorid = '{$authorid}' and react = 'like'";
            $resultlikeuser = mysqli_query($connect, $sqllikeuser);
            if ($resultlikeuser) {
                $rowlikeuser = mysqli_num_rows($resultlikeuser);
                if ($rowlikeuser > 0) {
                    $sqlfunctionlike = "DELETE FROM ftree_v1_4_postaction WHERE postid = '{$likepostid}' and authorid = '{$authorid}' and react = 'like'";
                    $sqlresultfunctionlike = mysqli_query($connect, $sqlfunctionlike);
                    if ($sqlresultfunctionlike) {
                        $result_data['success'] = true;
                        $result_data['name'] = 'unlike';
                    } else {
                        $result_data['success'] = false;
                        $result_data['name'] = $connect->error;
                    }
                } else {
                    $sqlfunctionlike = "INSERT INTO `ftree_v1_4_postaction`(`postid`, `authorid`, `react`) VALUES ('{$likepostid}','{$authorid}','like')";
                    $sqlresultfunctionlike = mysqli_query($connect, $sqlfunctionlike);
                    if ($sqlresultfunctionlike) {
                        $result_data['success'] = true;
                        $result_data['name'] = 'like';

                    } else {
                        $result_data['success'] = false;
                        $result_data['name'] = $connect->error;
                    }
                }
            }
            echo json_encode($result_data);
            break;

    }

}





?>


