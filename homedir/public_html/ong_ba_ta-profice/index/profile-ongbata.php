<?php
session_start();
include  '../../header.php';
include '../connectserve/connect.php';
$_SESSION["user_id"]=$usr;
include '../Process/Post.php';
//use session get id userlogin
$membersid= $_GET['id'];
$userid= $usr;

// $userid= empty($_GET['idvistor'])?"1":$_GET['idvistor'];
// var_dump($userid);
// id cua khach tham
// $userid = "1";
// function select 



$sql = "SELECT * FROM ftree_v1_4_members m
left join ftree_v1_4_post p on m.ID = p.membersid
left join ftree_v1_4_gallery g on p.ID = g.postID
where m.ID = '{$membersid}'";
$result = $connect->query($sql);
if (!empty($result) && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        
        $birthdate = $row['birthdate'];
        $death=$row['death'];
        $deathdate= $row['deathdate'];
        $birthplace =$row['birthplace'];
        $deathplace =$row['deathplace'];
        $profession=$row['profession'];
        $company = $row['company'];
        $interests= $row['interests'];
        $bionotes= $row['bio'];
        $gender = $row['gender'];
        $numberphone = $row['mobile'];
        $family = $row['family'];
        $mariagedate = $row['mariagedate'];
        $parent = $row['parent'];
        $type = $row['type'];
        $facebook = $row['facebook'];
        $instagram = $row['instagram'];
        $twitter = $row['twitter'];
        $hometel = $row['tel'];



        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $imgavatar = $row['url'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $authorid = $row['author'];
        $longitude_check = $row['longitude'].$row['longitude'];
        $nam_pr =$row['firstname'];
        if (($userid <= 0) or ($userid != $authorid)) {
            $delete="xoa_dulieu";
        }
        else {
            $delete=" ";
        }
       
       
    }
}
if ($gender=='1') {
    $name_gender='Nữ';
    $icon_gender = 'fa fa-venus';
}
elseif($gender=='2'){
    $name_gender='Nam';
    $icon_gender = 'fa fa-mars';
}


// select vi tri trong toc

?>
<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
    <link rel="icon" href="1419255.png" type="image/png" sizes="20x20">
    <title>Ông bà ta Profile</title>
    <link rel="stylesheet" href="../css/profile-ongbata.css" type="text/css">
    <link rel="stylesheet" href="../css/profile_ongbata_reponsive.css" type="text/css">
    <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.css" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/thu_vien_video.css" type="text/css">

    <link rel="stylesheet" href="../mediaelement-mediaelement-3b02c78/build/mediaelementplayer.css" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700">
    <!--- mapbox->
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.4.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.4.1/mapbox-gl.js"></script>
    <!-- Geocoder plugin -->
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.css" type="text/css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">





    <!-- <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.css"
        integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="../lib/css/emoji.css" rel="stylesheet">

    <script type='text/javascript' src="../javascript/jquery.js"></script>
    <script type="text/javascript" src="../javascript/crud_post.js"></script>



</head>
<script>
    $('.add_tree_g').attr('href', '../../tree.php');
    var href = $(this).attr('href');

    // search
    $("input[name=search]").on("keyup keydown change", function() {
        var th = $(this);
        var vl = $(this).val();

        $.post("../../ajax.php?pg=search", {
            search: vl
        }, function(puerto) {
            $(".sresults").html(puerto);
            th.parent().find("ul").addClass("open");
        });
    });
    $("body").click(function() {

        $(".pt-drop").removeClass("open");

    });






    function addcomment() {
        $(document).on('submit','.frm-comment', function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            var ud = $(this).attr("data-commemt");
            var membersid = $('.input-field').val();
            $.ajax({
                url: "../Process/comment-add.php",
                method: "POST",
                data: form_data,
                success: function(data) {

                    $('.frm-comment')[0].reset();
                    $('.comment').html('');
                    $('.submitButton').val("Publish");
                    $(".comment_message_" + ud).show().delay(5000).fadeOut();
                    $(".commentId_" + ud).val('0');
                    $('.comment' + ud).attr("placeholder", "Viết  bình luận");
                    $(".nummbercomment_" + ud).html(data);
                    $.ajax({
                        url: "fetch_comments.php",
                        method: "POST",
                        type: 'JSON',
                        cache: false,
                        data: {
                            'postid': ud,
                            'idvistor': membersid,
                        },
                        success: function(data) {
                            $(".output_" + ud).html(data);
                            time_ago();
                        }
                    });



                }
            })
            event.stopImmediatePropagation(); // to prevent more than once submission
            return false
        });
        $(document).on('click', '.reply', function() {

            id = $(this).parent().attr('data-comment')
            var comment_id = $(this).attr("id");
            $('.comment_nt_click .commentId_' + id).val(comment_id);
            $('.comment' + id).focus();
            $('.comment' + id).attr("placeholder", "Phản hồi bình luận");
            $('.submitButton').val("Reply");


        });




        $(".commmen_click,.cancel").click(function() {
            $('.submitButton').val("Publish");
            $('.commentId').val('');
            $('.comment').html('');
            $('.comment').attr("placeholder", "Viết bình luận");
        });
        // $('.comment').focusout(function () {
        //     $('.submitButton').val("Publish");
        //     $('.commentId').val('');
        //     $('.comment').html('');
        // });
        $(".commmen_click,.click_show").click(function() {
            var click = $(this).val();
            var idvisit = $(this).attr('data-vistor');
            $.ajax({
                url: "../index/fetch_comments.php",
                method: "POST",
                type: 'JSON',
                cache: false,
                data: {
                    'postid': click,
                    'idvistor': idvisit,
                },
                success: function(data) {
                    $(".output_" + click).html(data);
                    time_ago();
                }

            });

        });
        $(".click_show,.bt_close_sm-media").click(function() {
            $(this).fadeOut(function() {
                $(this).parent().parent().parent().toggleClass("show_comment");
            })
        });
    };
</script>
<script>
    var myVar;

    function myFunction() {
        myVar = setTimeout(showPage, 3000);

    }

    function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("myDiv").style.display = "block";
    }
</script>
<script>
    function fetchanh() {
        $.ajax({
            url: "fetch_anh_dai_dien_big.php",
            method: "POST",
            type: 'JSON',
            data: {
                'membersid': <?php echo $membersid;?>
            },
            cache: false,
            success: function(data) {
                $(".gallery_dd_big").html(data);
            }
        });
        $.ajax({
            url: "fetch_anh_daidien_son.php",
            method: "POST",
            type: 'JSON',
            cache: false,
            data: {
                'membersid': <?php echo $membersid;?>
            },
            success: function(data) {
                $(".gallery_dd_s").html(data);
            }
        });
        $.ajax({
            url: "fetch_anh_modal_tab1.php",
            method: "POST",
            type: 'JSON',
            data: {
                'membersid': <?php echo $membersid;?>
            },
            cache: false,
            success: function(data) {
                $("#anh_nho_tab1").html(data);
            }
        });

    }
    fetchanh();
</script>
<style>
    #myDiv h3 {
        border-bottom: unset;
        margin: unset;
        padding: unset;
    }

    /* Center the loader */
    #loader {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 1;
        width: 120px;
        height: 120px;
        margin: -76px 0 0 -76px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Add animation to "page content" */
    .animate-bottom {
        position: relative;
        -webkit-animation-name: animatebottom;
        -webkit-animation-duration: 1s;
        animation-name: animatebottom;
        animation-duration: 1s
    }

    @-webkit-keyframes animatebottom {
        from {
            bottom: -100px;
            opacity: 0
        }

        to {
            bottom: 0px;
            opacity: 1
        }
    }

    @keyframes animatebottom {
        from {
            bottom: -100px;
            opacity: 0
        }

        to {
            bottom: 0;
            opacity: 1
        }
    }

    #myDiv {
        display: none;
        text-align: center;
    }
</style>



<body onload="myFunction()" style="margin:0;">
    <div id="loader"></div>
    <div style="display:none;" id="myDiv" class="animate-bottom">

        <header class="container">
            <div class="bacground_profile-dad">
                <div class="bacground_profile cursor_p gallery_bia">
                </div>
                <button class="<?php echo $delete ?> btn btn-success d-flex align-items-center bt_header_bk  ">
                    <form class="fileUpload fileUpload_1 d-flex align-items-center " method='POST'
                        data-user='<?php echo $userid;?>' data-member='<?php echo $membersid;?>'
                        enctype="multipart/form-data">
                        <input type="file" class="upload" name="multipleFile3[]" id="multipleFile3" required=""
                            accept="image/*">
                        <span class="material-icons text-white">
                            photo_camera
                        </span>
                        <span class="text-white">
                            Thêm ảnh bìa
                        </span>
                    </form>

                </button>

            </div>
            <script>
            function toggleFullscreen(elem) {
                elem = elem || document.documentElement;
                if (!document.fullscreenElement && !document.mozFullScreenElement &&
                    !document.webkitFullscreenElement && !document.msFullscreenElement) {
                    // if (elem.requestFullscreen) {
                    //     elem.requestFullscreen();
                    // } 
                    // else if (elem.msRequestFullscreen) {
                    //     elem.msRequestFullscreen();} 
                    if (elem.mozRequestFullScreen) {
                        elem.mozRequestFullScreen();
                    } else if (elem.webkitRequestFullscreen) {
                        elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                    }
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.msExitFullscreen) {
                        document.msExitFullscreen();
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                    } else if (document.webkitExitFullscreen) {
                        document.webkitExitFullscreen();
                    }
                }
            }
            </script>
            <center class="position-relative">
                <div class="avatar_dad   start-50 translate-middle">
                    <div class="avatar_son position-relative hover01">
                        <div class="avtar_img figure rounded-circle border gallery_dd_big">

                        </div>
                        <button
                            class="<?php echo $delete ?> btn btn-secondary d-flex align-items-center rounded-circle position-absolute bt_avatar">
                            <form class="fileUpload fileUpload_1 d-flex align-items-center" method='POST'
                                data-user='<?php echo $userid;?>' data-member='<?php echo $membersid;?>'
                                enctype="multipart/form-data">
                                <input type="file" class="upload" type="file" name="multipleFile2" id="multipleFile2"
                                    accept="image/*">
                                <span class="material-icons text-white">
                                    photo_camera
                                </span>
                            </form>

                        </button>
                    </div>
                </div>
                <h1 class="name_profile">
                    <?php echo $lastname  . " " . $firstname;?>
                    <?php if($death==0):?>
                    <i> <span class="fz_12">(Đã yên nghỉ)</span></i>
                    <?php endif?>
                    <br>
                    <b>
                       <?php echo  check_name_me($membersid,$usr) ?>
                    </b>
                </h1>
            </center>

        </header>
      
        <section>


            <div id="container" class="bg-light body_pr">

                <nav class="nav-tab nav-tab_dad shadow-sm bg-white position-sticky">
                    <!-- select family -->
                    <?php
                        $sql_family = "SELECT * FROM `ftree_v1_4_families` WHERE id=".$family;
                        $result_family = $connect->query($sql_family );
                        while ($row_family = $result_family->fetch_assoc()) {
                           $name_family = $row_family['name'];
                        }
                    ?>
                    <div class="container d-flex align-items-center">
                        <div class="bottomMenu hide md-display_none" id="scoll_sh">
                            <a href="<?php echo substr_replace(path, "",-23) ?>tree.php?id=<?php echo $family,'&t=',fh_seoURL($name_family)?>">
        
                                <button class=" btn col d-flex align-items-center rounded-3 ">

                                    <div class="avatar avatar-sm rounded-circle gallery_dd_s" id="gallery_bar">

                                    </div>
                                    <div class="fz_14 pd_5">
                                        <b>Trở về  gia phả</b>
                                    </div>

                                </button>
                            </a>
                        </div>

                        <ul id="scroll_ul" class=" ul_tab  row scroll_ul width_100 md-flex md-pd_0">

                            <li class="li_tab col md-width_30 "><button data-tab="tab-1"
                                    data-user="<?php echo $membersid; ?>" data-vistor="<?php echo $userid; ?>"
                                    class=" button_tab a-hv-text-udl tab_home"><span>Bài viết
                                    </span></button></li>
                            <li class="li_tab col md-width_40"><button data-tab="tab-2"
                                    class=" button_tab a-hv-text-udl  "><span>Giới thiệu
                                    </span>
                                </button></li>
                            <li class="li_tab col-md-4 md-width_30"><button data-tab="tab-3"
                                    data-author="<?php echo $authorid; ?>" data-user="<?php echo $membersid; ?>"
                                    data-vistor="<?php echo $userid; ?>"
                                    class="button_tab a-hv-text-udl tab_3"><span>Ảnh</span></button></li>

                        </ul>
                    </div>
                    <script>
                    // scroll show div
                    myID = document.getElementById("scroll_ul");

                    var myScrollFunc = function() {
                        var y = window.scrollY;
                        if (y >= 400) {
                            myID.className = "scroll_ul width_90"
                        } else {
                            myID.className = "scroll_ul width_100"
                        }
                    };

                    window.addEventListener("scroll", myScrollFunc);
                    </script>
                    <script>
                    // scroll show div
                    myID = document.getElementById("scoll_sh");

                    var myScrollFunc = function() {
                        var y = window.scrollY;
                        if (y >= 400) {
                            myID.className = "bottomMenu show_av"
                        } else {
                            myID.className = "bottomMenu hide"
                        }
                    };

                    window.addEventListener("scroll", myScrollFunc);
                    </script>
                </nav>
                <div class="container ">

                    <!-- FIRST SECTION -->
                    <div class="content-tab" id="tab-1">


                        <div class="row">
                            <div class="col-md-4 md-mb_20 tab_1_left_dad">
                                <div class="position-sticky top_100 tab_1_left" id="leftcontent_tab">
                                    <div
                                        class="bg-white shadow-sm border border_raidus_07 pd_10 mb_20 section_left-1  ">
                                        <h3 class="fz_20">
                                            <b>Giới thiệu</b>
                                        </h3>
                                        <div>

                                            <?php if(!empty($birthplace)):?>
                                            <div class="d-flex  flex-wrap align-items-center mb_10">
                                                <span class="material-icons">
                                                    cottage
                                                </span>
                                                <span>
                                                    Nơi sinh:
                                                </span>
                                                <a href="#" class="">
                                                    <b> <span> <?php echo $birthplace ?></span></b>
                                                </a>
                                            </div>
                                            <?php endif?>
                                            <?php if(!empty($profession)):?>
                                            <div class="d-flex flex-wrap align-items-center mb_10">
                                                <span class="material-icons">
                                                    work
                                                </span>
                                                <span>
                                                    Nghề nghiệp:
                                                </span>

                                                <b> <span> <?php echo $profession ?></span></b>

                                            </div>
                                            <?php endif?>
                                            <?php if ($gender!=0):?>
                                            <div class="d-flex  align-items-center mb_10">
                                                <i class="<?php echo $icon_gender ?>">
                                                </i>
                                                <b> <span> <?php echo $name_gender?></span></b>

                                            </div>
                                            <?php endif ?>
                                            <?php if(!empty($deathplace)):?>
                                            <div class="d-flex  flex-wrap align-items-center mb_10">
                                                <span class="material-icons">
                                                    sentiment_dissatisfied
                                                </span>
                                                <span>
                                                    Đã yên nghỉ tại
                                                </span>

                                                <b> <span> <?php echo $deathplace ?></span></b>

                                            </div>
                                            <?php endif?>

                                            <?php if (($gender==0) && empty($deathplace)&& empty($birthplace) && empty($profession)):?>
                                          
                                                <center> 
                                                    <b> <i> <?php echo $firstname ?> chưa có thông tin gì </i></b>
                                                </center>
                                            <?php endif ?>
                                        </div>
                                        <div>
                                            <center class="">
                                                <div id="qrcode" style="width:100px; height:100px;"></div>
                                                <input id="link_code" type="hidden"
                                                    value="<?php echo path ?>/profile-ongbata.php?id=<?php echo $membersid;?> "
                                                    style="width:80%" /><br />
                                                <b><i>Mã QR của <?php echo $firstname ?></i></b>
                                            </center>
                                        </div>
                                        <!-- ban do da dinh vi -->
                                        <div class="d-grid ">
                                            <center>
                                                <h3 class="fz_20">
                                                    <b> Địa điểm đã định vị của
                                                        <?php echo  $lastname  . " " . $firstname;?></b>
                                                </h3>
                                            </center>

                                            <?php 
                                            
                                            $query_m = "SELECT   * FROM  ftree_v1_4_mapbox  where membersid = $membersid  ORDER BY id DESC  LIMIT  1 ";

                                             $result_m = mysqli_query($connect, $query_m);
                                             
                                            ?>
                                            <?php if(mysqli_num_rows($result_m)>0):?>
                                            <form action="./map.php" target="_blank" method="POST"
                                                class="d-flex justify-content-end">
                                                <input type="hidden" name="vima" value="<?php echo $membersid; ?>">
                                                <input type="hidden" name="vimaVisit" value="<?php echo $userid; ?>">
                                                <button type="submit"
                                                    class=" btn btn-light button_tab fz_17 a_hv_bg tab_3  text-info mb_5">
                                                    Xem tất cả
                                                </button>
                                            </form>
                                            <div class="position-relative map_dad">
                                                <div id="map1"
                                                    class="rounded-3 ">
                                                    <div style="height: 100vh; position: relative;">
                                                        <div id="geocoder" class="geocoder"></div>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <?php else: ?>
                                             <center
                                                    class="">
                                                    <i>Chưa có địa điểm nào </i></center>
                                             <?php endif?>
                                            
                                            <!-- <div id="map_2" class="rounded-3"></div> -->
                                            <!-- cua google map -->
                                        </div>
                                    </div>
                                    <div
                                        class="bg-white shadow-sm border border_raidus_07  pd_10 mb_20  section_left-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h3>
                                                <span class="fz_20 "><b>Ảnh</b></span>
                                            </h3>
                                            <div class="nav-tab ">
                                                <div class="ul_tab ">
                                                    <div class="li_tab ">
                                                        <a href="#" class="button_tab fz_17 a_hv_bg tab_3"
                                                            data-tab="tab-3">
                                                            <span>Xem tất cả</span>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="row pd_15" id="gallery_border">
                                            <?php
                                                    $query = "SELECT *, @rank :=  @rank + 1 AS rank FROM ftree_v1_4_gallery g,(SELECT  @rank := 0) r where membersid = '{$membersid}' and typefile  IN ('cover_image','avatar','normal_photo') ORDER BY  g.id DESC LIMIT 9";

                                                    $result = mysqli_query($connect, $query);
                                                                                                    
                                                    while ($row = mysqli_fetch_array($result)){?>

                                                        <div class="col-4 pd_0" data-bs-target="#carousetab1"
                                                            data-bs-slide-to="<?php echo $row['rank'] - 1; ?>" aria-current="true"
                                                            aria-label="Slide <?php echo $row['rank'] ?>">
                                                            <div class="pd_2" data-bs-toggle="modal"
                                                                data-bs-target="#modal_anh_nho_tab1">
                                                                <img src="<?php echo $row['url'] ?>" alt=""
                                                                    class="<?php echo 'border_raidus', $row['rank']; ?>"
                                                                    style="height: 105px;">
                                                            </div>

                                                        </div>
                                            <?php $anh = $row['url'];?>

                                            <?php  }  ?>
                                            <div class="<?php echo(empty($anh)?"block":"xoa_dulieu")?>">
                                                <center> <b> <i> <?php echo $firstname ?> chưa có ảnh nào </i></b>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                  

                                    <div class="footer md-display_none">
                                        <ul class="d-flex flex-wrap">
    
                                            <li>
                                                <a href="https://giapha.ongbata.vn">Phần mềm gia phả Ông Bà Ta</a>
                                            </li>
                                            <li>
                                                
                                                    <span>Đã đăng ký Bản quyền</span>
                                             
                                            </li>
                                           
                                            <li>

                                                <span>Copyright © 2021  </span>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div
                                    class="bg-white shadow-sm border border_raidus_07 pd_10 mb_20 section_right-1 <?php echo $delete ?>">
                                    <div class="row section_right_open_form-1 d-flex align-items-center">
                                        <div class="col-md-1 md-width_20 gallery_dd_s">

                                        </div>
                                        <button
                                            class="btn col-11 bg-light text-dark rounded-pill d-flex justify-content-start section_right-1_button1 bt_them_bai_viet"
                                            data-bs-toggle="modal" data-bs-target="#them_bai_viet">
                                            <?php echo $firstname; ?> ơi, bạn đang nghĩ gì thế?
                                        </button>
                                    </div>
                                    <div class="row md-flex">
                                        <div
                                            class="col-md-4 d-flex justify-content-center align-items-center md-width_35">
                                            <button class="btn  d-flex justify-content-center align-items-center fz_14"
                                                onclick="document.getElementById('uploadFilevideo').click()" id="upload-video-redirect">
                                                <div class="fileUpload fileUpload_1 d-flex align-items-center">

                                                    <span class="material-icons text-danger">
                                                        video_call
                                                    </span>
                                                </div>
                                                <span>
                                                    Video
                                                </span>
                                            </button>
                                        </div>
                                        <div
                                            class="col-md-4 d-flex justify-content-center align-items-center md-width_30">
                                            <button class="btn d-flex justify-content-center align-items-center fz_14"
                                                onclick="document.getElementById('uploadFileimg').click()">

                                                <div class="fileUpload fileUpload_1 d-flex align-items-center">
                                                    <span class="material-icons text-success">
                                                        collections
                                                    </span>
                                                </div>
                                                <span>
                                                    Ảnh
                                                </span>
                                            </button>
                                        </div>
                                        <div
                                            class="col-md-4 d-flex justify-content-center align-items-center md-width_35">
                                            <button class="btn d-flex justify-content-center align-items-center fz_14"
                                                onclick="getLocation()">
                                                <span class="material-icons text-info">
                                                    assistant_photo
                                                </span>
                                                <span>
                                                    Checkin
                                                </span>

                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white shadow-sm border border_raidus_07 pd_10 mb_20 section_right-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h3>
                                            <a href="#" class="fz_20 a_hv_black"><b>Bài viết</b></a>
                                        </h3>
                                        <button class="btn btn-light d-flex justify-content-between align-items-center">
                                            <!-- data-bs-toggle="modal" data-bs-target="#bo_loc" -->
                                            <span class="material-icons pd_5">
                                                tune
                                            </span>
                                            <!-- <span>
                                            Bộ lọc
                                        </span> -->
                                            <span class="" style="margin: 0 5px;">
                                                <?php echo $nam_pr," ","có"," ";?>
                                            </span>
                                            <span class="count_post">
                                                <?php
                                                        $query_count_p = "SELECT COUNT(id) as number_post FROM ftree_v1_4_post WHERE membersid=$membersid" ;
                                                        $result_count_p = mysqli_query($connect, $query_count_p);
                                                        
                                                        while ($post_count = mysqli_fetch_array($result_count_p)){
                                                            $contion_p = $post_count['number_post']; 
                                                            echo $post_count['number_post']," "," bài viết";
                                                        }
                                            ?>

                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <div class="posts" id="list_posts">
                                    <h5 class="<?php if ($contion_p!='0') {echo "xoa_dulieu";}?>">
                                        <b> <i>
                                                <center>Chưa có bài viết nào</center>
                                            </i></b>
                                    </h5>
                                </div>
                                <!-- khu script tab 1 -->
                                <div class="<?php if ($contion_p==0 &&$userid != $authorid) {echo "xoa_dulieu";} ?>">
                                    <button id="load_more" class=" btn btn-primary"
                                        style="<?php if($contion_p<=3){echo "display: none;";} ?>">Xem thêm </button>
                                    <script type="text/javascript">
                                    var idedit;
                                    var fileimgpost;
                                    var filename;
                                    var filedata;
                                    var select_id;
                                    var pagereload = 1;
                                    var fi;

                                    function reload() {
                                        $.ajax({
                                            url: "../Process/Post.php",
                                            type: "GET",
                                            data: {
                                                author: <?php echo $authorid;?>,
                                                userid: <?php echo $userid?>,
                                                membersid: <?php echo $membersid;?>,
                                                page: pagereload,
                                                method: 'loaddata'
                                            },
                                            cache: false,
                                            success: function(data) {
                                                $(".add_add9").addClass(
                                                    "rounded-circle  border border-3 border-success");
                                                $(".add_add9").parent().addClass(
                                                    "bg-light bg-gradient pd_15 d-flex justify-content-center"
                                                    );
                                                $('#list_posts').prepend(data);
                                                $('.anh_fullscren').click(function() {
                                                    toggleFullscreen(this);
                                                });
                                                $("img[src='']").parent().parent().remove()
                                                $("source[src='']").parent().parent().remove()
                                                addcomment();
                                                fetchanh();


                                            }
                                        });

                                    }
                                    reload();

                                    function checkfileimg(e) {
                                        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
                                        for (var i = 0; i < e.files.length; i++) {
                                            if ($.inArray(e.files.item(i).name.split('.').pop().toLowerCase(),
                                                    fileExtension) ==
                                                '-1') {
                                                return false;

                                            } else {
                                                return true;
                                            }
                                        }
                                    }
                                    //view data
                                    //js pagenation
                                    var pagereload = 1
                                    var cout_page = 4;
                                    // Khi kéo scroll thì xử lý
                                    $('#load_more').click(function() {
                                        pagereload++;
                                        cout_page++;
                                        $.ajax({
                                            url: "../Process/Post.php",
                                            method: "GET",
                                            type: "json",
                                            data: {
                                                author: <?php echo $authorid;?>,
                                                userid: <?php echo $userid?>,
                                                membersid: <?php echo $membersid;?>,
                                                page: pagereload,
                                                method: 'loaddata'
                                            },
                                            cache: false,
                                            beforeSend: function() {
                                                $("#wait").css("display", "block");
                                            },

                                            success: function(data) {

                                                if (data != null) {

                                                    $(document).ready(function() {

                                                        $('#list_posts').append(data);

                                                        // if (!$.trim(data)){   
                                                        //     $('#load_more').css("display", "none");
                                                        // }
                                                        if (<?php echo $contion_p; ?> /
                                                            cout_page <= 1) {
                                                            $('#load_more').css("display",
                                                                "none");
                                                        }

                                                        //    

                                                        //    console.log(data)
                                                        $('.anh_fullscren').click(
                                                    function() {
                                                            toggleFullscreen(this);
                                                        });





                                                        emoi1();
                                                        loadlibraryson();
                                                        time_ago();



                                                        fetchanh();
                                                        // $(".check_anh8,.check_video7,.check_video9,.check_video10").remove();
                                                        loadlibrary();
                                                        loadlibraryson();
                                                        $("#wait").css("display", "none");
                                                        loadlink();


                                                        $(".xoa_dulieu").remove();
                                                        $("img[src='']").parent().parent()
                                                            .remove()
                                                        $("source[src='']").parent()
                                                        .parent().remove()
                                                        addcomment();




                                                    })
                                                } else {
                                                    pagereload = pagereload - 1
                                                }
                                            }
                                        });

                                    });

                                    $(document).ready(function() {
                                        // check file type img
                                        $("#uploadFileimg").change(function() {
                                            fi = document.getElementById('uploadFileimg');
                                            filedata = new FormData();
                                            if (checkfileimg(fi)) {
                                                for (var i = 0; i < fi.files.length; i++) {
                                                    filedata.append("files[]", fi.files.item(i))
                                                };
                                            } else {
                                                alert("Only formats are allowed : " + fileExtension
                                                    .join(', '));
                                                $("#uploadFileimg").val('');
                                            }
                                        })

                                    })
                                    </script>

                                    <div class="d-flex justify-content-center">
                                        <div id="wait" style="display:none; z-index: 888;"><img
                                                src='https://s3.ap-southeast-1.amazonaws.com/datdia/ongbata_pf/giphy (1).gif'
                                                width="50" height="50" /></div>

                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                    <script src='../javascript/fontanswerkit.js' crossorigin='anonymous'></script>
                    <!-- Second SECTION -->
                    <div class="content-tab" id="tab-2">

                        <div
                            class="row bg-white shadow-sm border border_raidus_07 pd_10 mb_20 section_tab_2-1 md-mg_0 ">
                            <div class="  col-md-4 d-grid md-pb_10 md-mb_20 section_tab_2-1_son">
                                <h3>
                                    <a href="#" class="fz_20 a_hv_black"><b>Giới thiệu</b></a>
                                </h3>
                                <ul class="nav nav-tabs  nav-tabs_section2 d-grid border-0 nav_control1">
                                    <li class=""><a data-bs-toggle="tab" href="#home"
                                            class=" active fz_14  fw-bolder pd_5  rounded-3">Tổng quan</a></li>
                                    <li class=""><a data-bs-toggle="tab" href="#menu1"
                                            class="fz_14  fw-bolder pd_5 rounded-3">Công việc và học vấn</a>
                                    </li>
                                    <li class=""><a data-bs-toggle="tab" href="#menu2"
                                            class="fz_14  fw-bolder pd_5 rounded-3">Nơi từng sống</a></li>
                                    <li class=""><a data-bs-toggle="tab" href="#menu3"
                                            class="fz_14  fw-bolder pd_5 rounded-3">Thông tin liên hệ và cơ
                                            bản</a></li>
                                    <li class=""><a data-bs-toggle="tab" href="#menu4"
                                            class="fz_14  fw-bolder pd_5 rounded-3">Chi tiết về
                                            <?php echo $nam_pr; ?></a></li>
                                   
                                </ul>
                            </div>


                            <div class="tab-content tab-content_section2 col-md-8">
                                <script src='../javascript/fontanswerkit.js' crossorigin='anonymous'></script>
                                <div id="home" class="tab-pane fade in active show">
                                    <?php if(!empty($company)):?>
                                    <div class="d-flex  align-items-center mb_20">
                                        <span class="material-icons text-black-50 pd_2">
                                            work
                                        </span>
                                        <div>
                                            Làm việc tại
                                            <b> <?php echo $company ?></b>
                                        </div>
                                    </div>
                                    <?php endif ?>
                                    <?php if(!empty($birthplace)):?>
                                    <div class="d-flex  align-items-center mb_20">
                                        <span class="material-icons text-black-50 pd_2">
                                            location_on
                                        </span>
                                        <div>
                                            Sinh ra tại
                                            <b> <?php echo $birthplace ?></b>
                                        </div>
                                    </div>
                                    <?php endif ?>
                                    <?php if(!empty($deathplace)):?>
                                    <div class="d-flex  align-items-center mb_20">
                                        <span class="material-icons text-black-50 pd_2">
                                             sentiment_very_dissatisfied
                                        </span>
                                        <div>
                                            Mất tại 
                                            <b> <?php echo $deathplace ?></b>
                                        </div>
                                    </div>
                                    <?php endif ?>
                                    <?php if(empty($birthplace) && empty($company) && empty($deathplace)):?>
                                        <center><?php echo $firstname; ?> Chưa có thông tin gì</center>
                                    <?php endif ?>
                                </div>
                                <div id="menu1" class="tab-pane fade">
                                    <div class="">
                                        <h3 class="fz_17"><b><span>Công việc</span></b></h3>

                                        <?php if(empty($company) && empty($profession)):?>
                                            <center>Chưa có thông tin gì</center>
                                        <?php endif ?>

                                        <?php if(!empty($company)):?>
                                        <div class="  d-flex  align-items-center justify-content-between">

                                            <div class=" d-flex  align-items-center">
                                                
                                            <i class="fas fa-briefcase "style=" font-size: 28px;color: #20c997;margin-right: 5px;"></i>
                                                

                                                <div class="">
                                                    Làm viêc tại công ty
                                                    <b id="data_person1">
                                                        <?php echo $company; ?>
                                                    </b>

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center <?php echo $delete ?>">
                                                <div class=" dropdown-toggle button_dr_afet " type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="true">

                                                    <span class="material-icons text-black-50 cursor_p">
                                                        edit
                                                    </span>
                                                </div>
                                                <ul class="dropdown-menu  z_index_0">
                                                    <li>
                                                        <button
                                                            class="edit_data_person  btn d-flex align-items-center fz_12 justify-content-between edit_data" data-column = "<?php echo $company; ?>"

                                                            name="company" data-id_data="#data_person1">
                                                            <span class="material-icons fz_12 text-black-50">
                                                                drive_file_rename_outline
                                                            </span>
                                                            <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button
                                                            class=" delete_data_person delete delete_jq btn d-flex align-items-center  justify-content-between" 
                                                             name="company">
                                                            <span class="material-icons fz_12 text-black-50">
                                                                delete
                                                            </span>
                                                            <b><span class="fz_12"> Xóa sự kiện</span></b>
                                                        </button>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <?php endif?>
                                        <?php if(!empty($profession)):?>
                                        <div class=" d-flex justify-content-between  align-items-center" ?>

                                            <div class="d-flex  align-items-center">
                                               
                                                <i class="fas fa-user-tie"style=" font-size: 28px;color: #20c997;margin-right: 5px;"></i>
                                             
                                                <div class="">
                                                    Nghề nghiệp:
                                                    <b id="data_person2">
                                                        <?php echo $profession; ?>
                                                    </b>

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center <?php echo $delete ?>">
                                                <div class=" dropdown-toggle button_dr_afet " type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="true">

                                                    <span class="material-icons text-black-50 cursor_p">
                                                        edit
                                                    </span>
                                                </div>
                                                <ul class="dropdown-menu  z_index_0">
                                                    <li>
                                                        <button data-column = "<?php echo $profession; ?>" name="profession" data-id_data="#data_person2"
                                                            class="edit_data_person btn d-flex align-items-center fz_12 justify-content-between edit_data ">
                                                            <span class="material-icons fz_12 text-black-50">
                                                                drive_file_rename_outline
                                                            </span>
                                                            <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button name="profession"
                                                            class="delete_data_person delete_jq btn d-flex align-items-center  justify-content-between"
                                                            data-id=<?php  ?>>
                                                            <span class="material-icons fz_12 text-black-50">
                                                                delete
                                                            </span>
                                                            <b><span class="fz_12"> Xóa sự kiện</span></b>
                                                        </button>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <?php endif?>
                                    </div>
                                </div>
                                <div id="menu2" class="tab-pane fade">
                                    <h3 class="fz_17"><b><span>Nơi từng sống</span></b></h3>

                                    <?php if(empty($birthplace)):?>
                                            <center>Chưa có thông tin gì</center>
                                        <?php endif ?>

                                    <?php if(!empty($birthplace)):?>
                                    <div class="d-flex  align-items-center justify-content-between">

                                        <div class="d-flex  align-items-start">
                                            <div class="" style="margin-right: 5px;">
                                                <i class="fas fa-home" style=" font-size: 28px;color: #20c997;"></i>
                                            </div>

                                            <div class="">
                                                <div id="data_person3">
                                                    <?php echo $birthplace ?>
                                                </div>
                                                <span class="fz_12 text-black-50 ">
                                                    Quê quán
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex align-items-center <?php echo $delete ?>">
                                            <div class=" dropdown-toggle button_dr_afet " type="button"
                                                data-bs-toggle="dropdown" aria-expanded="true">

                                                <span class="material-icons text-black-50 cursor_p">
                                                    edit
                                                </span>
                                            </div>
                                            <ul class="dropdown-menu  z_index_0">
                                                <li>
                                                    <button data-column = "<?php echo $birthplace; ?>" name="birthplace" data-id_data="#data_person3"
                                                        class="edit_data_person btn d-flex align-items-center fz_12 justify-content-between edit_data ">
                                                        <span class="material-icons fz_12 text-black-50">
                                                            drive_file_rename_outline
                                                        </span>
                                                        <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button name="birthplace"
                                                        class="delete_data_person delete_jq btn d-flex align-items-center  justify-content-between"
                                                        data-id=<?php ?>>
                                                        <span class="material-icons fz_12 text-black-50">
                                                            delete
                                                        </span>
                                                        <b><span class="fz_12"> Xóa sự kiện</span></b>
                                                    </button>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                    <?php endif?>
                                </div>
                                <div id="menu3" class="tab-pane fade">
                                    <div class="thong-tin-lien-he">
                                        <h3 class="fz_17"><b><span>Thông tin liên hệ</span></b></h3>

                                        <?php if(empty($email) && empty($numberphone) && empty($twitter) && empty($facebook) && empty($instagram) &&empty($hometel)):?>
                                            <center>Chưa có thông tin gì</center>
                                        <?php endif ?>

                                        <link rel="stylesheet"
                                            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

                                        <?php if(!empty($email)):?>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex  align-items-start">

                                                <div class="" style="margin-right: 5px;">
                                                    <i class="fas fa-envelope" style=" font-size: 28px;color: #20c997;"></i>
                                                </div>

                                                <div class="text-start">
                                                    <div id="data_person4">
                                                        <?php echo $email ?>
                                                    </div>
                                                    <span class="fz_12 text-black-50 ">
                                                        Email
                                                    </span>

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center <?php echo $delete ?>">
                                                    <div class=" dropdown-toggle button_dr_afet " type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="true">

                                                        <span class="material-icons text-black-50 cursor_p">
                                                            edit
                                                        </span>
                                                    </div>
                                                    <ul class="dropdown-menu  z_index_0">
                                                        <li>
                                                            <button data-column = "<?php echo $email; ?>" name="email" data-id_data="#data_person4"
                                                                class="edit_data_person btn d-flex align-items-center fz_12 justify-content-between edit_data "
                                                                >
                                                                <span class="material-icons fz_12 text-black-50">
                                                                    drive_file_rename_outline
                                                                </span>
                                                                <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button name="email"
                                                                class="delete_data_person delete_jq btn d-flex align-items-center  justify-content-between">
                                                                <span class="material-icons fz_12 text-black-50">
                                                                    delete
                                                                </span>
                                                                <b><span class="fz_12"> Xóa sự kiện</span></b>
                                                            </button>
                                                        </li>

                                                    </ul>
                                            </div>
                                            
                                        </div>
                                        <?php endif?>
                                        <?php if(!empty($numberphone)):?>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex  align-items-start">

                                                <div class="" style="margin-right: 5px;">
                                                    <i class="fas fa-mobile-alt" style=" font-size: 28px;color: #20c997;"></i>
                                                </div>

                                                <div class="text-start">
                                                    <div id="data_person5">
                                                        <?php echo $numberphone ?>
                                                    </div>
                                                    <span class="fz_12 text-black-50 ">
                                                        Số điện thoại di động
                                                    </span>

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center <?php echo $delete ?>">
                                                    <div class=" dropdown-toggle button_dr_afet " type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="true">

                                                        <span class="material-icons text-black-50 cursor_p">
                                                            edit
                                                        </span>
                                                    </div>
                                                    <ul class="dropdown-menu  z_index_0">
                                                        <li>
                                                            <button data-column = "<?php echo $numberphone; ?>" name="mobile" data-id_data="#data_person5"
                                                                class="edit_data_person btn d-flex align-items-center fz_12 justify-content-between edit_data ">
                                                                <span class="material-icons fz_12 text-black-50">
                                                                    drive_file_rename_outline
                                                                </span>
                                                                <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button name="mobile"
                                                                class="delete_data_person delete_jq btn d-flex align-items-center  justify-content-between">
                                                                <span class="material-icons fz_12 text-black-50">
                                                                    delete
                                                                </span>
                                                                <b><span class="fz_12"> Xóa sự kiện</span></b>
                                                            </button>
                                                        </li>

                                                    </ul>
                                            </div>
                                            
                                        </div>
                                        <?php endif?>
                                        <?php if(!empty($twitter)):?>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex  align-items-start">

                                                <div class="" style="margin-right: 5px;">
                                                    <i class="fab fa-twitter" style=" font-size: 28px;color: #20c997;"></i>
                                                </div>

                                                <div class="text-start">
                                                    <div id="data_person6">
                                                        <?php echo $twitter ?>
                                                    </div>
                                                    <span class="fz_12 text-black-50 ">
                                                        Twiter
                                                    </span>

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center <?php echo $delete ?>">
                                                    <div class=" dropdown-toggle button_dr_afet " type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="true">

                                                        <span class="material-icons text-black-50 cursor_p">
                                                            edit
                                                        </span>
                                                    </div>
                                                    <ul class="dropdown-menu  z_index_0">
                                                        <li>
                                                            <button data-column = "<?php echo $twitter; ?>" name="twitter" data-id_data="#data_person6"
                                                                class=" edit_data_person btn d-flex align-items-center fz_12 justify-content-between edit_data ">
                                                                <span class="material-icons fz_12 text-black-50">
                                                                    drive_file_rename_outline
                                                                </span>
                                                                <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button name="twitter"
                                                                class="delete_data_person delete_jq btn d-flex align-items-center  justify-content-between"
                                                                data-id=<?php  ?>>
                                                                <span class="material-icons fz_12 text-black-50">
                                                                    delete
                                                                </span>
                                                                <b><span class="fz_12"> Xóa sự kiện</span></b>
                                                            </button>
                                                        </li>

                                                    </ul>
                                            </div>
                                        </div>
                                        <?php endif?>
                                        <?php if(!empty($facebook)):?>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex  align-items-start">

                                                <div class="" style="margin-right: 5px;">
                                                    <i class="fab fa-facebook" style=" font-size: 28px;color: #20c997;"></i>
                                                </div>

                                                <div class="text-start">
                                                    <div id="data_person7">
                                                        <?php echo $facebook ?>
                                                    </div>
                                                    <span class="fz_12 text-black-50 ">
                                                        Facebook
                                                    </span>

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center <?php echo $delete ?>">
                                                    <div class=" dropdown-toggle button_dr_afet " type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="true">

                                                        <span class="material-icons text-black-50 cursor_p">
                                                            edit
                                                        </span>
                                                    </div>
                                                    <ul class="dropdown-menu  z_index_0">
                                                        <li>
                                                            <button data-column = "<?php echo $facebook; ?>" name="facebook" data-id_data="#data_person7"
                                                                class="edit_data_person btn d-flex align-items-center fz_12 justify-content-between edit_data ">
                                                                <span class="material-icons fz_12 text-black-50">
                                                                    drive_file_rename_outline
                                                                </span>
                                                                <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button name="facebook"
                                                                class="delete_data_person delete_jq btn d-flex align-items-center  justify-content-between"
                                                                data-id=<?php  ?>>
                                                                <span class="material-icons fz_12 text-black-50">
                                                                    delete
                                                                </span>
                                                                <b><span class="fz_12"> Xóa sự kiện</span></b>
                                                            </button>
                                                        </li>

                                                    </ul>
                                            </div>
                                            
                                        </div>
                                        <?php endif?>
                                        <?php if(!empty($instagram)):?>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex  align-items-start">

                                                <div class="" style="margin-right: 5px;">
                                                    <i class="fab fa-instagram" style=" font-size: 28px;color: #20c997;"></i>
                                                </div>

                                                <div class="text-start">
                                                    <div id="data_person8">
                                                        <?php echo $instagram ?>
                                                    </div>
                                                    <span class="fz_12 text-black-50 ">
                                                        Instagram
                                                    </span>

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center <?php echo $delete ?>">
                                                    <div class=" dropdown-toggle button_dr_afet " type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="true">

                                                        <span class="material-icons text-black-50 cursor_p">
                                                            edit
                                                        </span>
                                                    </div>
                                                    <ul class="dropdown-menu  z_index_0">
                                                        <li>
                                                            <button data-column = "<?php echo $instagram; ?>" name="instagram" data-id_data="#data_person8"
                                                                class="edit_data_person btn d-flex align-items-center fz_12 justify-content-between edit_data ">
                                                                <span class="material-icons fz_12 text-black-50">
                                                                    drive_file_rename_outline
                                                                </span>
                                                                <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button name="instagram"
                                                                class="delete_data_person delete_jq btn d-flex align-items-center  justify-content-between"
                                                                >
                                                                <span class="material-icons fz_12 text-black-50">
                                                                    delete
                                                                </span>
                                                                <b><span class="fz_12"> Xóa sự kiện</span></b>
                                                            </button>
                                                        </li>

                                                    </ul>
                                            </div>
                                            
                                        </div>
                                        <?php endif?>
                                        <?php if(!empty($hometel)):?>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex  align-items-start">

                                                <div class="" style="margin-right: 5px;">
                                                    <i class="fas fa-phone-square" style=" font-size: 28px;color: #20c997;"></i>
                                                </div>
                                            
                                                <div class="text-start">
                                                    <div id="data_person9">
                                                        <?php echo $hometel ?>
                                                    </div>
                                                    <span class="fz_12 text-black-50 ">
                                                        Số điện thoại nhà
                                                    </span>

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center <?php echo $delete ?>">
                                                    <div class=" dropdown-toggle button_dr_afet " type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="true">

                                                        <span class="material-icons text-black-50 cursor_p">
                                                            edit
                                                        </span>
                                                    </div>
                                                    <ul class="dropdown-menu  z_index_0">
                                                        <li>
                                                            <button data-column = "<?php echo $hometel; ?>" name="tel" data-id_data="#data_person9"
                                                                class="edit_data_person btn d-flex align-items-center fz_12 justify-content-between edit_data ">
                                                                <span class="material-icons fz_12 text-black-50">
                                                                    drive_file_rename_outline
                                                                </span>
                                                                <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button name='tel'
                                                                class="delete_data_person delete_jq btn d-flex align-items-center  justify-content-between">
                                                                <span class="material-icons fz_12 text-black-50">
                                                                    delete
                                                                </span>
                                                                <b><span class="fz_12"> Xóa sự kiện</span></b>
                                                            </button>
                                                        </li>

                                                    </ul>
                                            </div>
                                        </div>
                                        <?php endif?>
                                        

                                    </div>
                                    <div class="thong_tin_co_ban">
                                        <h3 class="fz_17"><b><span>Thông tin Cơ bản</span></b></h3>
                                    
                                        <?php if($gender==0 && empty($deathdate) && empty($deathdate)):?>
                                            <center>Chưa có thông tin gì</center>
                                        <?php endif ?>
                                        <?php if($gender!=0): ?>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex  align-items-start">
                                                <?php if ($gender=='1') {?>
                                                <div class="" style="margin-right: 5px;">
                                                    <i class="fa fa-venus class_icon_edit" style=" font-size: 28px;color: #20c997;"
                                                        aria-hidden="true"></i>
                                                </div>
                                                <div class="">
                                                    <div id="data_person10" >
                                                        Nữ
                                                    </div>
                                                    <span class="fz_12 text-black-50 ">
                                                        Giới tính</span>

                                                </div>
                                                <?php }elseif($gender=='2'){?>
                                                <div class="" style="margin-right: 5px;">
                                                    <i class="fa   fa-mars class_icon_edit" style=" font-size: 28px;color: #20c997;"
                                                        aria-hidden="true"></i>
                                                </div>
                                                <div class="">
                                                    <div id="data_person10">
                                                        Nam
                                                    </div>
                                                    <span class="fz_12 text-black-50 ">
                                                        Giới tính</span>

                                                </div>
                                            <?php }?>
                                            </div>
                                            <div class="d-flex align-items-center <?php echo $delete ?>">
                                                <div class=" dropdown-toggle button_dr_afet " type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="true">

                                                    <span class="material-icons text-black-50 cursor_p">
                                                        edit
                                                    </span>
                                                </div>
                                                <ul class="dropdown-menu  z_index_0">
                                                    <li>
                                                        <button  data-column = "<?php echo $gender; ?>" name="gender" data-id_data="#data_person10"
                                                            class="edit_data2_person btn d-flex align-items-center fz_12 justify-content-between edit_data">
                                                            <span class="material-icons fz_12 text-black-50">
                                                                drive_file_rename_outline
                                                            </span>
                                                            <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button  name="gender"
                                                            class="delete_data_person delete_jq btn d-flex align-items-center  justify-content-between"
                                                            data-id=<?php ?>>
                                                            <span class="material-icons fz_12 text-black-50">
                                                                delete
                                                            </span>
                                                            <b><span class="fz_12"> Xóa sự kiện</span></b>
                                                        </button>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <?php endif?>
                                        <?php if(!empty($birthdate)):?>
                                        <div class="d-flex justify-content-between">

                                           <div class="d-flex  align-items-start">
                                                <div class="" style="margin-right: 5px;">
                                                        <i class=" fa fa-birthday-cake "
                                                            style=" font-size: 28px;color: #20c997;"></i>
                                                    </div>

                                                    <div class="text-start">
                                                        <div id="data_person11">
                                                            <?php echo date("d-m-Y ",  $birthdate) ?>
                                                        </div>
                                                        <span class="fz_12 text-black-50 ">
                                                            Ngày sinh
                                                        </span>

                                                    </div>
                                           </div>
                                            <div class="d-flex align-items-center <?php echo $delete ?>">
                                                <div class=" dropdown-toggle button_dr_afet " type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="true">

                                                    <span class="material-icons text-black-50 cursor_p">
                                                        edit
                                                    </span>
                                                </div>
                                                <ul class="dropdown-menu  z_index_0">
                                                    <li>
                                                        <button data-column = "<?php echo date("Y-m-d",  $birthdate) ?>" name="birthdate" data-id_data="#data_person11"
                                                            class="edit_data3_person btn d-flex align-items-center fz_12 justify-content-between edit_data ">
                                                            <span class="material-icons fz_12 text-black-50">
                                                                drive_file_rename_outline
                                                            </span>
                                                            <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button name="birthdate"
                                                            class="delete_data_person delete_jq btn d-flex align-items-center  justify-content-between">
                                                            <span class="material-icons fz_12 text-black-50">
                                                                delete
                                                            </span>
                                                            <b><span class="fz_12"> Xóa sự kiện</span></b>
                                                        </button>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <?php endif?>
                                        <?php if(!empty($deathdate)):?>
                                        <div class="d-flex justify-content-between">

                                            <div class="d-flex  align-items-start">
                                                <div class="" style="margin-right: 5px;">
                                                    <!-- <i class=" fa fa-birthday-cake "
                                                                style=" font-size: 28px;color: #20c997;"></i> -->
                                                </div>

                                                <div class="text-start">
                                                    <div id="data_person12">
                                                        <?php echo date("d-m-Y",  $deathdate) ?>
                                                    </div>
                                                    <span class="fz_12 text-black-50 ">
                                                        Ngày mất
                                                    </span>

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center <?php echo $delete ?>">
                                                <div class=" dropdown-toggle button_dr_afet " type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="true">

                                                    <span class="material-icons text-black-50 cursor_p">
                                                        edit
                                                    </span>
                                                </div>
                                                <ul class="dropdown-menu  z_index_0">
                                                    <li>
                                                        <button data-column = "<?php echo date("Y-m-d",  $deathdate) ?>" name="deathdate" data-id_data="#data_person12"
                                                            class="edit_data3_person btn d-flex align-items-center fz_12 justify-content-between edit_data ">
                                                            <span class="material-icons fz_12 text-black-50">
                                                                drive_file_rename_outline
                                                            </span>
                                                            <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button name="deathdate"
                                                            class="delete_data_person delete_jq btn d-flex align-items-center  justify-content-between">
                                                            <span class="material-icons fz_12 text-black-50">
                                                                delete
                                                            </span>
                                                            <b><span class="fz_12"> Xóa sự kiện</span></b>
                                                        </button>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <?php endif?>
                                    </div>
                                </div>
                                <div id="menu4" class="tab-pane fade">
                                    <div class="">
                                        <h3 class="fz_17"><b><span>Giới thiệu về <?php echo $nam_pr; ?></span></b></h3>


                                        <?php if(empty($interests) && empty($bionotes)):?>
                                            <center>Chưa có thông tin gì</center>
                                        <?php endif ?>
                                        <?php if(!empty($interests)):?>
                                        <div class="d-flex justify-content-between">

                                            <div class="d-flex  align-items-start">
                                                <div class="avatar-sm pd_2">
                                                    <img src="https://www.storyuk.com/themes/story/images/story-logo-horizontal.png"
                                                        alt="" class="rounded-circle">
                                                </div>

                                                <div class="text-start">
                                                    <div class="data_person13">
                                                        <?php echo $interests ?>
                                                    </div>
                                                    <span class="fz_12 text-black-50 ">
                                                        Sở thích
                                                    </span>

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center <?php echo $delete ?>">
                                                <div class=" dropdown-toggle button_dr_afet " type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="true">

                                                    <span class="material-icons text-black-50 cursor_p">
                                                        edit
                                                    </span>
                                                </div>
                                                <ul class="dropdown-menu  z_index_0">
                                                    <li>
                                                        <button data-column = "<?php echo $interests; ?>" name="interests" data-id_data="#data_person13"
                                                            class="edit_data_person btn d-flex align-items-center fz_12 justify-content-between edit_data ">
                                                            <span class="material-icons fz_12 text-black-50">
                                                                drive_file_rename_outline
                                                            </span>
                                                            <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button name="interests"
                                                            class="delete_data_person delete_jq btn d-flex align-items-center  justify-content-between"
                                                            data-id=<?php  ?>>
                                                            <span class="material-icons fz_12 text-black-50">
                                                                delete
                                                            </span>
                                                            <b><span class="fz_12"> Xóa sự kiện</span></b>
                                                        </button>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <?php endif?>
                                        <?php if(!empty($bionotes)):?>
                                        <div class="position-relative">
                                            <div class="">
                                                
                                                    <span class="fz_14 text-center">
                                                            <b>Chi tiết tiểu sử</b>
                                                        </span>
                                                    <div id="data_person14">
                                                        <?php echo $bionotes ?>
                                                    </div>
                                            </div>
                                            <div class="d-flex align-items-center position-absolute bottom-0 start-0 <?php echo $delete ?>">
                                                <div class=" dropdown-toggle button_dr_afet " type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="true">

                                                    <span class="material-icons text-black-50 cursor_p">
                                                        edit
                                                    </span>
                                                </div>
                                                <ul class="dropdown-menu  z_index_0">
                                                    <li>
                                                        <button  name="bio" data-id_data="#data_person14"
                                                            class="edit_data4_person btn d-flex align-items-center fz_12 justify-content-between edit_data ">
                                                            <span class="material-icons fz_12 text-black-50">
                                                                drive_file_rename_outline
                                                            </span>
                                                            <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button name="bio"
                                                            class="delete_data_person delete_jq btn d-flex align-items-center  justify-content-between">
                                                            <span class="material-icons fz_12 text-black-50">
                                                                delete
                                                            </span>
                                                            <b><span class="fz_12"> Xóa sự kiện</span></b>
                                                        </button>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <?php endif?>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                    <!-- third SECTION -->
                    <div class="content-tab" id="tab-3">
                        <div class="bg-white shadow-sm border border_raidus_07 pd_10 mb_20 section_right-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3>
                                    <a href="#" class="fz_20 a_hv_black"><b>Ảnh</b></a>
                                </h3>

                                <div
                                    class=" btn btn-light d-flex justify-content-between align-items-center <?php echo $delete ?>">
                                    <form class="fileUpload" method='POST' enctype="multipart/form-data"
                                        data-user="<?php echo $userid ?>" data-member="<?php echo $membersid?>">
                                        <input type="file" class="upload" name="multipleFile_tab3"
                                            id="multipleFile_tab3" accept="image/*" required="" multiple />
                                        <span>Thêm ảnh</span>
                                    </form>

                                </div>


                            </div>


                            <div class="tab_2 mb_10">
                                <button class="tablinks fz_14 rounded-3 active_2" data-author="<?php echo $authorid; ?>"
                                    data-user="<?php echo $membersid; ?>" data-vistor="<?php echo $userid; ?>"
                                    onclick="openTabson(event, 'Anh_dai_dien')">Ảnh đại diện</button>
                                <button class="tablinks fz_14 rounded-3  fetch_anh"
                                    data-author="<?php echo $authorid; ?>" data-user="<?php echo $membersid; ?>"
                                    data-vistor="<?php echo $userid; ?>" onclick="openTabson(event, 'anh_cua_ban')">Ảnh
                                    của <?php echo $nam_pr ?></button>
                                <button class="tablinks fz_14 rounded-3 fetch_anh3"
                                    data-author="<?php echo $authorid; ?>" data-user="<?php echo $membersid; ?>"
                                    data-vistor="<?php echo $userid; ?>" onclick="openTabson(event, 'anh_bia_tab')">Ảnh
                                    bìa</button>
                            </div>

                            <div id="Anh_dai_dien" class=" firts_display tabcontent_2  pd_10">
                                <div class="row row-cols-lg-5 md-flex" id="gallery_dd_tab3">



                                </div>
                            </div>


                            <div id="anh_cua_ban" class="tabcontent_2  pd_10">
                                <div class="row row-cols-lg-5 md-flex" id="anh_cua_ban_tab3">

                                </div>
                            </div>

                            <div id="anh_bia_tab" class="tabcontent_2  pd_10">
                                <div class="row row-cols-lg-5 md-flex " id="anh_bia_tab3">


                                </div>
                            </div>


                        </div>
                        <div class="bg-white shadow-sm border border_raidus_07 pd_10 mb_20 section_right-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3>
                                    <a href="#" class="fz_20 a_hv_black"><b>Video</b></a>
                                </h3>

                                <div
                                    class=" <?php echo $delete ?> btn btn-light d-flex justify-content-between align-items-center">
                                    <div class="fileUpload" data-user="<?php echo $userid ?>"
                                        data-member="<?php echo $membersid?>">
                                        <input type="file" class="upload" id="multipleVideo" name="multipleVideo[]"
                                            accept="video/*" required="" multiple />
                                        <span>Thêm video</span>
                                    </div>
                                </div>

                            </div>

                            <div class="row  pd_10 md-flex" id="video">

                            </div>


                        </div>

                    </div>

                </div>
                <!-- khu vuc de du lieu modal -->

                <div class="container">
                    <!-- khu anh -->
                    <div>
                        <!-- tab 1 -->
                        <div class="anh_tu_bai_viet modal fade" id="modal_anh_nho_tab1" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <!-- Modal body -->
                                    <div class="modal-body pd_10">
                                        <div id="carousetab1" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner" id="anh_nho_tab1">

                                            </div>
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carousetab1" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carousetab1" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>



                                    </div>
                                    <div class="modal-footer pd_10">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- tab 3 -->
                        <div class="anh_tu_bai_viet modal fade" id="myModal1" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <!-- Modal body -->
                                    <div class="modal-body pd_10">
                                        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner" id="anh_cua_ban_modal">

                                            </div>
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>



                                    </div>
                                    <div class="modal-footer pd_10">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="modal anh_dai_dien fade" id="myModal2" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog  modal-lg">
                                <div class="modal-content">
                                    <!-- Modal body -->
                                    <div class="modal-body pd_10">
                                        <div id="carouselExampleCaptions2" class="carousel slide"
                                            data-bs-ride="carousel">

                                            <div class="carousel-inner" id="anh_dai_dien_modal">

                                            </div>
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carouselExampleCaptions2" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselExampleCaptions2" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>



                                    </div>
                                    <div class="modal-footer pd_10">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal anh_bia modal fade" id="myModal3" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <!-- Modal body -->
                                    <div class="modal-body pd_10">
                                        <div id="carouselExampleCaptions3" class="carousel slide"
                                            data-bs-ride="carousel">

                                            <div class="carousel-inner" id="anh_bia_modal">

                                            </div>
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carouselExampleCaptions3" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselExampleCaptions3" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="modal-footer pd_10">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <!-- tab 2 -->

                    </div>
                    <!-- add location -->
                    <div class="modal fade  " id="them_vi_tri">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <form method="post" id="insert_form_location">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Thêm ví trí địa điểm</h4>
                                        <button type="button" class=" btn close rounded-circle btn-light"
                                            data-bs-dismiss="modal">&times;</button>

                                    </div>
                                    <div class="modal-body">

                                        <div class=" d-flex justify-content-between align-items-center mb_10">
                                            <div class="  d-flex align-items-center rounded-3 ">

                                                <div class="avatar avatar-sm rounded-circle gallery_dd_s">
                                                </div>
                                                <div class="fz_14 pd_5 d-grid">
                                                    <span><b> <?php echo $firstname;?></b></span>

                                                </div>

                                            </div>

                                        </div>


                                        <div id="location_dad">
                                            <div clas="d-flex">
                                                <div class="d-flex">
                                                    <label for="location "><b>Vĩ độ:</b> </label>
                                                    <input type="text" name="latitude" id="location"
                                                        class="border-0 location ">
                                                </div>

                                                <div class="d-flex">
                                                    <label for="location2"><b>kinh độ :</b> </label>
                                                    <input type="text" name="longitude" id="location2"
                                                        class="border-0 location ">
                                                </div>

                                            </div>



                                            <div class="d-flex  justify-content-between">
                                                <div class="location_son">
                                                    <label for="nhap_ten-diadiem"><b>Nhập tên địa điểm:</b></label>
                                                    <input type="text" id="nhap_ten-diadiem" name="nhap_ten-diadiem"
                                                        required
                                                        class="border border-success rounded location width_100">
                                                </div>
                                                <div class="location_son">
                                                    <label for="nhap_mota-diadiem"> <b>Nhập mô tả chi tiết địa điểm:
                                                        </b></label>
                                                    <input type="text" id="nhap_mota-diadiem" name="nhap_mota-diadiem"
                                                        class="border border-success rounded location width_100">
                                                </div>

                                            </div>


                                        </div>
                                        <!-- </form> -->

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger close"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <input type="hidden" name="userid" id="user" value="<?php echo $membersid?>" />
                                        <input type="hidden" name="location_id" id="location_id" class="value_0" />
                                        <input type="submit" name="insert_lc" id="insert_lc" value="Insert"
                                            class="btn btn-success" />
                                    </div>
                                </form>
                                <div class=" mb_20 d-flex justify-content-center align-items-center">
                                    <span class="material-icons btn-outline-info" onclick="getLocation()" type="button"
                                        class="" data-bs-toggle="tooltip" data-bs-placement="top" title="Định vị lại">
                                        gps_fixed
                                    </span>
                                    <button class="btn btn-warning " id="address">
                                        xem trước ví trí trên bản đồ
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- khu video -->

                    <!-- khu ban dang nghi gi or them bai viet -->
                    <div>
                        <div class="modal fade " id="them_bai_viet" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tạo bài viết</h4>
                                        <button type="button" class=" btn close rounded-circle btn-light"
                                            data-bs-dismiss="modal">&times;</button>

                                    </div>
                                    <div class="modal-body">

                                        <div class=" d-flex justify-content-between align-items-center">
                                            <div class="  d-flex align-items-center rounded-3 ">

                                                <div class="avatar avatar-sm rounded-circle gallery_dd_s">
                                                </div>
                                                <div class="fz_14 pd_5 d-grid">
                                                    <span><b> <?php echo $firstname;?></b></span>

                                                </div>

                                            </div>
                                            <div class="">
                                                <label for="che_do  " class="fz_12"><b>Chọn chế độ:</b></label>
                                                <select id="che_do " class="fz_12">
                                                    <option value="volvo" selected>Công khai</option>
                                                    <!-- <option value="saab">Chỉ mình tôi</option>
                                                <option value="vw">Bạn bè của bạn</option>
                                                <option value="audi">Bạn bè củ thể</option> -->
                                                </select>
                                            </div>

                                        </div>
                                        <form id="AddPost" data-user-p="<?php echo $userid ?>"
                                            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                                            class="pd_5 form_add_bai_viet lead emoji-picker-container"
                                            style="resize: none;" enctype="multipart/form-data">
                                            <div class="toolbar-container"></div>

                                            <div class="form-control textarea-control    border border-0 position-relative editor"
                                                rows="10" name="Postcontent">

                                            </div>

                                            <div class="" id="display_product_list">
                                                <ul class="row row-cols-lg-5 preview"></ul>
                                            </div>
                                            <div class="" id="display_product_list_video">
                                                <ul class="row row-cols-lg-5 preview"></ul>
                                            </div>



                                            <div class="d-flex align-items-center justify-content-end">
                                                <div class="fileUpload fileUpload_1 pd_5" data-bs-toggle="tooltip"
                                                    data-placement="top" title="Thêm Ảnh">
                                                    <input type="file" class="upload up-anh upload-File"
                                                        id="uploadFileimg" name="uploadFileimg[]" accept="image/*"
                                                        multiple>
                                                    <span class="material-icons text-success">
                                                        collections
                                                    </span>
                                                </div>
                                                <div class="fileUpload fileUpload_1 pd_5" data-bs-toggle="tooltip"
                                                    data-placement="top" title="Thêm Video">
                                                    <input type="file" class="upload upload-File" id="uploadFilevideo"
                                                        accept="video/*" name="uploadFilevideo[]" multiple>
                                                    <span class="material-icons text-danger">
                                                        video_call
                                                    </span>
                                                </div>


                                            </div>

                                            <div class="modal-footer">
                                                <input type="hidden" class="data_member" name="membersid"
                                                    value="<?php echo $membersid ?>">
                                                <button type="button" class="btn btn-danger cancel_post"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button class="btn btn-success" id="PushPost">
                                                    POST
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal fade " id="chinh_sua_bai_viet" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Chỉnh sửa bài viết</h4>
                                        <button type="button" class=" btn close rounded-circle btn-light"
                                            data-bs-dismiss="modal">&times;</button>

                                    </div>
                                    <div class="modal-body">

                                        <div class=" d-flex justify-content-between align-items-center">
                                            <div class="  d-flex align-items-center rounded-3 ">

                                                <div class="avatar avatar-sm rounded-circle gallery_dd_s">
                                                </div>
                                                <div class="fz_14 pd_5 d-grid">
                                                    <span><b> <?php echo $firstname;?></b></span>

                                                </div>

                                            </div>
                                            <div class="">
                                                <label for="che_do  " class="fz_12"><b>Chọn chế độ:</b></label>
                                                <select id="che_do " class="fz_12">
                                                    <option value="volvo" selected>Công khai</option>
                                                    <!-- <option value="saab">Chỉ mình tôi</option>
                                                <option value="vw">Bạn bè của bạn</option>
                                                <option value="audi">Bạn bè củ thể</option> -->
                                                </select>
                                            </div>

                                        </div>
                                        <div id="fect_edit">

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- khu bo loc -->
                    <div>
                        <div class="modal fade  " id="bo_loc" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center position-relative">
                                        <h4 class="modal-title text-center">Bộ lọc bài viết</h4>
                                        <button type="button"
                                            class=" btn close rounded-circle btn-light position-absolute top-0 end-0 mg_5"
                                            data-bs-dismiss="modal">&times;</button>

                                    </div>
                                    <div class="modal-body">

                                        <div class="">
                                            <div class="  d-grid  ">
                                                <span class="fz_16"> <b>Dùng bộ lọc để tìm bài viết trên dòng
                                                        thời gian
                                                        của bạn.</b></span>
                                                <span class="fz_14"> Mọi người vẫn nhìn thấy dòng thời gian của
                                                    bạn như
                                                    bình thường.</span>

                                            </div>

                                            <div class="d-flex justify-content-between select_modal_boloc mb_10">
                                                <label for="che_do  " class="fz_14"><b>Đi đến:</b></label>
                                                <select id="che_do " class="fz_14">
                                                    <option value="volvo" selected>Năm</option>
                                                    <option value="saab">2021</option>
                                                    <option value="vw">2020</option>
                                                    <option value="audi">2019</option>
                                                </select>
                                            </div>
                                            <div class="d-flex justify-content-between select_modal_boloc mb_10">
                                                <label for="che_do  " class="fz_14"><b> Người đăng:</b></label>
                                                <select id="che_do " class="fz_14">
                                                    <option value="volvo" selected>Bất kỳ ai</option>
                                                    <option value="saab">Bạn</option>
                                                    <option value="vw">Người khác</option>

                                                </select>
                                            </div>
                                            <div class="d-flex justify-content-between select_modal_boloc mb_10">
                                                <label for="che_do  " class="fz_14"><b>Quyền riêng
                                                        tư:</b></label>
                                                <select id="che_do " class="fz_14">
                                                    <option value="volvo" selected>Tất cả bài viêt</option>
                                                    <option value="saab">Công khai</option>
                                                    <option value="vw">Chỉ mình tôi</option>
                                                    <option value="audi">Bạn bè của bạn </option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger">Xóa </button>
                                        <button class="btn btn-outline-primary">
                                            Xong
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- khu tab 2 gioi thieu -->
                    <div>


                        <div class="modal fade  " id="Update_info_modal">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <form method="post" id="Update_info_form">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Chỉnh sửa thông tin</h4>
                                            <button type="button" class=" btn close  rounded-circle btn-light"
                                                data-bs-dismiss="modal">&times;</button>

                                        </div>
                                        <div class="modal-body">
                                            <input type="text" id="input_info" name=""
                                                placeholder="Nhập nơi làm việc hoặc nơi học tập"
                                                class="width_100 border_raidus_07 border  border-success up_cv height_40"
                                                required>
                                            <div class="select_info">
                                                <label for="select_info">Chọn giới tính:</label>
                                                <select id="select_info" class="fz_14">
                                                        <option value="2">Nam</option>
                                                        <option value="1">Nữ</option>
                                                </select>
                                            </div>
                                            
                                            <!-- </form> -->
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="userid" iclass="member_idif"
                                                value="<?php echo $membersid?>" />
                                            <input type="submit" name="Update_info" id="Update_info" value="Lưu"
                                                class="btn btn-success" />
                                                <input type="submit" name="Update_info" id="Update_info3" value="Lưu"
                                                class="btn btn-success" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade  " id="Update_info_modal2">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <form method="post" id="Update_info_form2">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Chỉnh sửa thông tin</h4>
                                            <button type="button" class=" btn close  rounded-circle btn-light"
                                                data-bs-dismiss="modal">&times;</button>

                                        </div>
                                        <div class="modal-body">
                                            <input type="date" id="input_infor_date" 
                                            class="width_100 border_raidus_07 border  border-success up_cv height_40" 
                                            name=""value="2018-07-22">
                                            <!-- </form> -->
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="userid" class="member_idif"
                                                value="<?php echo $membersid?>" />
                                            <input type="submit" name="Update_info" id="Update_info2" value="Lưu"
                                                class="btn btn-success" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade  " id="Update_story">
                            <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <form method="post" id="Update_info_form2">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Chỉnh sửa tiểu sử </h4>
                                            <button type="button" class=" btn close  rounded-circle btn-light"
                                                data-bs-dismiss="modal">&times;</button>

                                        </div>
                                        <div class="modal-body" id="story_show">
                                            
                                            <!-- </form> -->
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="userid" class="member_idif"
                                                value="<?php echo $membersid?>" />
                                            <input type="submit" name="Update_story" id="Update_story_p" value="Lưu"
                                                class="btn btn-success" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                   
                    <!-- modal login -->
                    <div id="Modal_login" class="modal_login <?php if($userid!="0"){ echo "xoa_dulieu";}?> ">

                        <!-- Modal content -->
                        <div class="modal_content-login">

                            <div class="modal_body-login pd_10">
                                <span class="close-login fa fa-close"></span>
                                <div class="fz_20"><b> Bạn cần phải đăng nhập để thực hiện chức năng này</b></div>
                                <a class=" btn btn-outline-warning btn-sm" href="<?php echo substr_replace(path, "",-23); ?>">Đăng nhập nào</a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!-- chuc nang cua video -->
            <div style="opacity: 0;">
                <form action="#" method="get" style="opacity: 0;">
                    <label><select name="lang">


                        </select>
                    </label>
                    <label>)<select name="stretching">

                            <option value="fill" selected>Fill</option>
                        </select>
                    </label>
                </form>
            </div>



            <!-- chuc nang zoom anh -->
            <svg style=display:none>
                <!-- Icons adapted from those made by https://www.flaticon.com/authors/freepik off https://www.flaticon.com/ -->
                <symbol id="icon-fullScreen-open" viewBox="0 0 96 96">
                    <path
                        d="M0 62l12 12 19-19 10 10-19 19 12 12H0V62zm96 34H62l12-12-19-19 10-10 19 19 12-12v34zM34 0L22 12l19 19-10 10-19-19L0 34V0h34zm62 0v34L84 22 65 41 55 31l19-19L62 0h34H0h96z" />
                </symbol>
                <symbol id="icon-fullScreen-exit" viewBox="0 0 96 96">
                    <path
                        d="M96 60L82 74l14 13-8 9-14-14-14 14V60h36zm-60 0v36L22 82 8 96l-8-9 14-13L0 60h36zM0 36h36V0L22 14 9 0 0 9l14 13L0 36zm60 0h36L82 22 96 9l-9-9-13 14L60 0v36z" />
                </symbol>
            </svg>




        </section>
    </div>
</body>


<link rel="stylesheet" href="../css/croppie.css" type="text/css">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="../bootstrap-5.0.2-dist/js/bootstrap.js"></script>

<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
<script src="https://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script src="https://api.tiles.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js">
</script>
<!-- <script type="text/javascript" src="../javascript/comment.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
<script src="../mediaelement-mediaelement-3b02c78/build/mediaelement-and-player.js"></script>

<script type="text/javascript" src="../javascript/qrcode.js"></script>

<script src="../lib/js/config.js"></script>
<script src="../lib/js/emoji-picker.js"></script>
<script src="../lib/js/jquery.emojiarea.js"></script>
<script src="../lib/js/util.js"></script>
<script src="../javascript/share.js"></script>
<script src="../javascript/thu_vien_timeago.js"></script>
<script src="../ckeditor5/ckeditor5-build-decoupled-document/ckeditor.js"></script>


<script type="text/javascript" src="../javascript/edit_post.js"></script>

<script type="text/javascript" src="../javascript/up_video_tab3.js"></script>
<script type="text/javascript" src="../javascript/up_location.js"></script>
<!-- 
 -->
<script type="text/javascript" src="../javascript/upload_anh_tab_3.js"></script>
<script src="../javascript/thu_vien_video.js"></script>
<script src="../javascript/profile-ongbata.js"></script>
<script src="../javascript/crud_imgcover.js"></script>
<script src="../javascript/crud_imgavatar.js"></script>
<script src="../javascript/fetch_data.js"></script>
<script type="text/javascript" src="../javascript/upload_gioi_thieu.js"> </script>


<!-- <script src="../../js/custom.js"></script> -->
<!--  -->
<!-- map -->
<script src="../javascript/thu-vien-map-box.js"></script>

<!-- <script src="../javascript/custom.js"></script> -->
<?php if($usr == 0) :?>
    <?php include '../../modal_login.php'; ?>
    <script src="<?php if(strpos(path, 'ong_ba_ta-profice') == true) {echo '../..';} else {echo path;} ?>/js/firebase.js"></script>
<?php endif ?>
<!-- khu script  -->
<!-- qr code -->
<script>
var qrcode = new QRCode(document.getElementById("qrcode"), {
    width: 100,
    height: 100
});

function makeCode() {
    var elText = document.getElementById("link_code");

    if (!elText.value) {
        alert("Input a text");
        elText.focus();
        return;
    }

    qrcode.makeCode(elText.value);
}

makeCode();

$("#link_code").
on("blur", function() {
    makeCode();
}).
on("keydown", function(e) {
    if (e.keyCode == 13) {
        makeCode();
    }
});
</script>
<!-- emoij -->
<script>
function emoi1() {
    $(function() {
        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
            emojiable_selector: '[data-emojiable=true]',
            assetsPath: '../lib/img/',
            popupButtonClasses: 'fa fa-smile-o'
        });
        // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // It can be called as many times as necessary; previously converted input fields will not be converted again
        window.emojiPicker.discover();
    });
}
</script>
<!--  -->
<script>


</script>
<!-- location google map -->
<script>
// var JSONID = 0;

// // Create a JSON Object Array
// var geoLocJSON = new Array();

// var x = document.getElementById("location");

// function getLocation() {
//     if (navigator.geolocation) {
//         navigator.geolocation.watchPosition(showPosition);
//     } else {
//         x.innerHTML = "Geolocation is not supported by this browser.";
//     }
// }

// function showPosition(position) {
//     x.value = +position.coords.latitude +
//         ", " + position.coords.longitude;

//     var myJSON = {
//         "id": JSONID,
//         "geoLoc": {
//             "latitude": position.coords.latitude,
//             "longtitute": position.coords.longitude
//         }
//     };

//     // Increments the JSONID
//     JSONID++;
//     geoLocJSON.push(myJSON);

//     // Google intatercive map
//     lat = position.coords.latitude;
//     lon = position.coords.longitude;
//     latlon = new google.maps.LatLng(lat, lon)
//     mapholder = document.getElementById('mapholder')
//     mapholder.style.height = '340px';
//     mapholder.style.width = '100%';

//     var myOptions = {
//         center: latlon,
//         zoom: 20,
//         mapTypeId: google.maps.MapTypeId.ROADMAP,
//         mapTypeControl: false,
//         navigationControlOptions: {
//             style: google.maps.NavigationControlStyle.SMALL
//         }
//     }

//     var map = new google.maps.Map(document.getElementById("mapholder"), myOptions);
//     var marker = new google.maps.Marker({
//         position: latlon,
//         map: map,
//         title: "You are here!"
//     });
// }

// // If error
// function showError(error) {
//     switch (error.code) {
//         case error.PERMISSION_DENIED:
//             x.innerHTML = "User denied the request for Geolocation."
//             break;

//         case error.POSITION_UNAVAILABLE:
//             x.innerHTML = "Location information is unavailable."
//             break;

//         case error.TIMEOUT:
//             x.innerHTML = "The request to get user location timed out."
//             break;

//         case error.UNKNOWN_ERROR:
//             x.innerHTML = "An unknown error occurred."
//             break;
//     }
// }
</script>
<!-- location new -->
<script>
 
    
// day len la x
// y la demo 
var z = document.getElementById("location");
var y = document.getElementById("address");
var x = document.getElementById("location2");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
        y.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {

    x.value = +position.coords.latitude;
    z.value = +position.coords.longitude;
    y.value = +position.coords.latitude +
        ", " + position.coords.longitude;
    $('#them_vi_tri').modal('show');
    $("#address").each(function() {
        var address = $(this).val().replace(/\,/g, ' '); // get rid of commas
        var url = address.replace(/\ /g, '%20'); // convert address into approprite URI for google maps

        $(this).wrap('<a href="http://maps.google.com/maps?q=' + url + '" target="_blank"></a>');

    });
}
</script>

<!-- // ckeditor -->
<script>
DecoupledEditor

    .create(document.querySelector('.editor'), {
        // language: 'vi'
        placeholder: 'Bạn đang nghĩ gì?',
        // cloudServices: {
        //     tokenUrl: 'https://example.com/cs-token-endpoint',
        //     uploadUrl: 'https://your-organization-id.cke-cs.com/easyimage/upload/'
        //  }
        ckfinder: {
            uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
        },
    })

    .then(editor1 => {
        const toolbarContainer = document.querySelector('.form_add_bai_viet .toolbar-container');

        toolbarContainer.prepend(editor1.ui.view.toolbar.element);

        window.editor1 = editor1;
    })
    .catch(err => {
        console.error(err.stack);
    });
    document.querySelector('#PushPost').addEventListener('click', () => {
        var Postcontent = editor1.getData();
    });



</script>

<!-- LOCATIONED google map -->
<!-- <script>
                    var locations = [
                        ['<b>England Branch,</b><br> International city', 16.041131355778706,108.22196289561334, 2, "https://maps.google.com/mapfiles/ms/micons/blue.png"],
                        ['<b>Greec Branch,</b><br> International city', 16.07472878038142, 108.21038338400398, 1, "https://maps.google.com/mapfiles/ms/micons/green.png"]
                    ];
                    var map = new google.maps.Map(document.getElementById('map_2'), {
                        zoom: 10,
                        center: new google.maps.LatLng(16.07472878038142, 108.21038338400398),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });
                    var infowindow = new google.maps.InfoWindow();
                    var marker, i;
                    for (i = 0; i < locations.length; i++) {
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                            icon: locations[i][4],
                            map: map
                        });
                        google.maps.event.addListener(marker, 'click', (function (marker, i) {
                            return function () {
                                infowindow.setContent(locations[i][0]);
                                infowindow.open(map, marker);
                            }
                        })(marker, i));
                    }
            </script> -->
<?php
        $query = "SELECT   * FROM  ftree_v1_4_mapbox  where membersid = $membersid  ORDER BY id DESC  LIMIT  1 ";

        $result = mysqli_query($connect, $query);
      
        while ($row = mysqli_fetch_array($result)) {

            $latitude = $row['latitude'];
            $longitude = $row['longitude'];
            $title = $row['title'];
            $paragraph = $row['description'];

        }?>
<!-- mapbox -->
<script>

    mapboxgl.accessToken = 'pk.eyJ1IjoiZ2lhcDE1IiwiYSI6ImNrcmFuenhrZDFqN2MycGxwa3J6OHA4cDgifQ.1G6kupnoC6sI2dA5SfEBbA';

    var map = new mapboxgl.Map({
        container: 'map1', // HTML container id
        style: 'mapbox://styles/mapbox/streets-v11', // style
        center: [
        <?php echo (empty($latitude)?"0":$latitude); echo ',',  (empty($longitude)?"0":$longitude);?>], // starting position as [lng, lat]
        zoom: 13
    });
    map.addControl(
        new mapboxgl.FullscreenControl()
    );
    map.addControl(
        new mapboxgl.NavigationControl()
    );
    const geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        mapboxgl: mapboxgl
    });
    document.getElementById('geocoder').appendChild(geocoder.onAdd(map));


    var popup = new mapboxgl.Popup().setHTML(
        '<h3 class="fz_16"><?php echo(empty($title)?"":$title) ?></h3><p class="fz_14"><?php echo (empty($paragraph)?"":$paragraph); ?> </p>'
    );
    var marker = new mapboxgl.Marker()
        .setLngLat([<?php echo (empty($latitude)?"0":$latitude); echo ',', (empty($longitude)?"0":$longitude); ?>])
        .setPopup(popup)
        .addTo(map);


</script>





<!-- khu ajax -->

<script>
/*use this js if your element width is unlimited an you want to scroll in a 
    constant speed. else, you dont need this js code*/
var elemWidth = document.getElementById("scroll-element").offsetWidth;
var time = elemWidth / 40; /* 30 = scrolling speed (44px/s)*/
document.getElementById("scroll-element").style.cssText =
    "animation: scroll " + time + "s linear infinite;";


$("#enterEmail").click(function() {
    var xsug = $('.amsify-suggestags-input')
    xsug.accessKey = 'enter'

})
</script>






<script type="text/javascript">
$(document).ready(function() {


    fetchanh()
    $.ajax({
        url: "fetch_anh_dai_dien_big.php",
        method: "POST",
        type: 'JSON',
        data: {
            'membersid': <?php echo $membersid;?>
        },
        cache: false,
        success: function(data) {
            $(".gallery_dd_big").html(data);
        }
    });
    $.ajax({
        url: "fet_anh_bia-big.php",
        method: "POST",
        type: 'JSON',
        data: {
            'membersid': <?php echo $membersid;?>
        },
        cache: false,
        success: function(data) {
            $(".gallery_bia").html(data);
        }
    });
    // togglefuscren
    $('.anh_fullscren').click(function() {
        toggleFullscreen(this);
    });


    $(document).on('click', '.delete', function() {
        var id = $(this).data('id');
        $clicked_btn = $(this);
        $.ajax({
            url: '../Process/delete_gioi_thieu.php',
            type: 'GET',
            data: {
                'delete': 1,
                'id': id,
            },
            success: function(data) {
                // remove the deleted comment
                // $(this).parent().parent().parent().parent().remove();
                //   $("xoa").parent(response)
                //   $('#name').val('');
                //   $('#comment').val('');
                //   $('.input-js').val('');
            }
        });
    });



    // xoa phan them noi song
    $(document).on('click', '.delete_2', function() {
        var id = $(this).data('id');
        $clicked_btn = $(this);
        $.ajax({
            url: '../Process/delete_gioi_thieu.php',
            type: 'GET',
            data: {
                'delete_2': 1,
                'id': id,
            },
            success: function(response) {
                // remove the deleted comment
                // $clicked_btn.parent().remove();
                //   $("xoa").parent(response)
                //   $('#name').val('');
                //   $('#comment').val('');
                //   $('.input-js').val('');
            }
        });
    });

    // thong tin lien he
    // xoa phan them noi song
    $(document).on('click', '.delete_3', function() {
        var id = $(this).data('id');
        $clicked_btn = $(this);
        $.ajax({
            url: '../Process/delete_gioi_thieu.php',
            type: 'GET',
            data: {
                'delete_3': 1,
                'id': id,
            },
            success: function(response) {
                // remove the deleted comment
                // $clicked_btn.parent().remove();
                //   $("xoa").parent(response)
                //   $('#name').val('');
                //   $('#comment').val('');
                //   $('.input-js').val('');
            }
        });
    });

    // thong tin lien he
    // xoa phan them noi song
    $(document).on('click', '.delete_4', function() {
        var id = $(this).data('id');
        $clicked_btn = $(this);
        $.ajax({
            url: '../Process/delete_gioi_thieu.php',
            type: 'GET',
            data: {
                'delete_4': 1,
                'id': id,
            },
            success: function(response) {
                // remove the deleted comment
                // $clicked_btn.parent().remove();
                //   $("xoa").parent(response)
                //   $('#name').val('');
                //   $('#comment').val('');
                //   $('.input-js').val('');
            }
        });
    });
    // thong tin lien he
    // xoa phan them noi song
    $(document).on('click', '.delete_5', function() {
        var id = $(this).data('id');
        $clicked_btn = $(this);
        $.ajax({
            url: '../Process/delete_gioi_thieu.php',
            type: 'GET',
            data: {
                'delete_5': 1,
                'id': id,
            },
            success: function(response) {
                // remove the deleted comment
                // $clicked_btn.parent().remove();
                //   $("xoa").parent(response)
                //   $('#name').val('');
                //   $('#comment').val('');
                //   $('.input-js').val('');
            }
        });
    });
    // thong tin lien he
    // xoa phan them noi song
    $(document).on('click', '.delete_6', function() {
        var id = $(this).data('id');
        $clicked_btn = $(this);
        $.ajax({
            url: '../Process/delete_gioi_thieu.php',
            type: 'GET',
            data: {
                'delete_6': 1,
                'id': id,
            },
            success: function(response) {
                // remove the deleted comment
                // $clicked_btn.parent().remove();
                //   $("xoa").parent(response)
                //   $('#name').val('');
                //   $('#comment').val('');
                //   $('.input-js').val('');
            }
        });
    });

    // xoa anh dai dien



    $(document).on('click', '.delete_anh3', function() {
        var id = $(this).data('id');
        $clicked_btn = $(this);
        var data_file = $(this).attr('data-file');
        $.ajax({
            url: '../Process/delete_gioi_thieu.php',
            type: 'GET',
            data: {
                'delete_anh3': 1,
                'id': id,
            },
            success: function(response) {
                // remove the deleted comment
                // $clicked_btn.parent().remove();
                //   $("xoa").parent(response)
                //   $('#name').val('');
                //   $('#comment').val('');
                //   $('.input-js').val('');
            }
        });
        $.ajax({
            url: '../amazon_s3/delete_file_s3.php',
            type: 'GET',
            data: {
                'delete_awss3': 1,
                'deletefile': data_file,
            },
            success: function(response) {

            }
        });
    });
    $(document).on('click', '.delete_video', function() {

        var inputs = $(this);
        for (var i = 0; i < inputs.length; i++) {

            var id_vao = inputs[i].id
        }
        var data_file = $(this).attr('data-file');
        $clicked_btn = $(this);
        $.ajax({
            url: '../Process/delete_gioi_thieu.php',
            type: 'GET',
            data: {
                'delete_video': 1,
                'id': id_vao,
            },
            success: function(response) {
                $clicked_btn.parent().parent().parent().parent().parent().parent().remove();
            }
        });
        $.ajax({
            url: '../amazon_s3/delete_file_s3.php',
            type: 'GET',
            data: {
                'delete_awss3': 1,
                'deletefile': data_file,
            },
            success: function(response) {

            }
        });


    });



    $(this).find("#imagetab1").addClass("active");
    $(this).find(".itemdd1").addClass("active");
    $(this).find(".itembia1").addClass("active");
    // xoa
    $(".delete_jq").click(function() {
        $(this).parent().parent().parent().parent().remove();
    });
    $(".delete_jqa").click(function() {
        $(this).parent().parent().parent().parent().parent().parent().remove();
    });

    // Fetch Data from Database


    // onchange value
    $(document).on('change', '.upload-File', function() {
        $('#them_bai_viet').modal('show');
    });

    // check file emty
    $("img[src='']").parent().parent().remove()
    $("source[src='']").parent().parent().remove()
    $(".read-m").click(function() {
        $(this).parent().parent().toggleClass("pr_da");
    });


    time_ago();
    emoi1();

    // delete scroll
    // $('.scroll-box').remove()



});

function loadlink() {


    // $(this).find(".image_post5").parent().append("<span class='see_more fz_20 position-absolute top-50 start-50 translate-middle text-center' data-bs-toggle='modal' data-bs-target='#post_sm_3'><b>Xem thêm 2 ảnh nữa </b></span>");
    // $(this).find(".image_post5").css("display", "none");



}
loadlink();





// This will run on page load
// setInterval(function(){
//     loadlink() // this will run after every 5 seconds
// }, 5000);
</script>



</html>