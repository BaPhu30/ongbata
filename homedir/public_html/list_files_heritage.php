<?php 
include __DIR__ . '/header.php';

$idFam = $_GET['id_fam'];
$idUser = us_id;

$getdata = new Getdata;

$message = $_SESSION['message'] ?? "";
$_SESSION['message'] = "";

$action  =  false;

$column =  " gallery.id, gallery.url, gallery.typefile";
$join = " JOIN ftree_v1_4_members member ON member.id = gallery.membersid";
$condition = " where member.family = " . $idFam;
$galleryList = $getdata->select_join('`ftree_v1_4_gallery` gallery', $column, $join, $condition, $db);

$condition = " family = " . $idFam;
$memberList = $getdata->select_column("ftree_v1_4_members", "id, firstname, lastname, user", $condition, $db);

if ((us_id || us_mobile || us_email || us_name) && $idFam) {
    $moderatorsData = db_get("families", "moderators", $idFam);
    $moderators = $moderatorsData ? explode(",", $moderatorsData) : [];
    $authorFamily = db_get("families", "author", $idFam);
    if (($authorFamily == $idUser) 
    || in_array(us_name, $moderators) 
    || in_array(us_mobile, $moderators) 
    || in_array(us_email, $moderators) 
    || in_array(us_name, $moderators)
    || (us_level == 6)) {
       $action = true;
    }
}

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" href="./css/profile-ongbata.css?v1.02">
<link rel="stylesheet" href="./css/profile_ongbata_reponsive.css">
<div class="container">
    <div class="content-app">
        <?php if($message) :?>
            <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
                <strong>Thông báo!</strong> <?= $message ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif ?>
        <div class="content-tab current-content-tab" id="tab-3">
            <div class="bg-white shadow-sm border border_raidus_07 pd_10 mb_20 section_right-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>
                        <a href="#" class="fz_20 a_hv_black"><b>Ảnh</b></a>
                    </h3>
                    <?php if($action) : ?>
                        <div class="btn btn-light up-file text-info" data-event = "normal_photo">
                            Thêm ảnh
                        </div>
                    <?php endif ?>
                </div>
                <div class=" firts_display tabcontent_2  pd_10">
                    <div class="row row-cols-lg-5 md-flex" id="gallery_dd_tab3">
                        <?php foreach($galleryList as $image) :?>
                            <?php if ($image['typefile'] != 'video') :?>
                                <div class="col pd_5 md-width_50">
                                    <div class="position-relative height_100">
                                        <div class="sreen-item">
                                            <img src="<?= $image['url'] ?>" class="rounded-3 height_100" alt="image"
                                                style="height: 250px;">
                                        </div>
                                        <?php if($action) : ?>
                                            <div class=" d-flex align-items-center position-absolute top-0 end-0 rounded-circle pd_5 button_edit mg_5">
                                                <span class="material-icons delete-file" data-id = "<?= $image['id'] ?>">
                                                    delete
                                                </span>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php endif ?>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow-sm border border_raidus_07 pd_10 mb_20 section_right-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>
                        <a href="#" class="fz_20 a_hv_black"><b>Video</b></a>
                    </h3>
                    <?php if($action) : ?>
                        <div class="btn btn-light up-file text-info" data-event = "video">
                            Thêm video
                        </div>
                    <?php endif ?>
                </div>
                <div class="row pd_10 md-flex" id="video">
                    <?php foreach($galleryList as $image) :?>
                        <?php if ($image['typefile'] == 'video') :?>
                            <div class="col-md-6 pd_5 md-width_50 video_tab3">
                                <div class="position-relative height_100 video_tab3_son">
                                    <div class="media-wrapper">
                                        <video id="player1" style="max-width:100%; height: 200px;" class="video"
                                            poster="https://ongbata.vn/wp-content/uploads/2021/06/ezgif.com-gif-maker-1.png" preload="none" controls
                                            playsinline webkit-playsinline>
                                            <source src="<?= $image['url'] ?>" type="video/mp4">
                                        </video>
                                    </div>
                                    <?php if($action) : ?>
                                        <div class="d-flex align-items-center position-absolute top-0 end-0 rounded-circle pd_5 button_edit mg_5">
                                            <span class="material-icons delete-file" data-id = "<?= $image['id'] ?>">
                                                delete
                                            </span>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <?php if($action) : ?>
            <!-- Modal delete file-->
            <div class="modal fade" id="modal-delete-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Bạn có chắc có muốn xóa file không ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">không</button>
                            <a href="" id = "link-file-delete" class="btn btn-danger">xóa</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal up file-->
            <div class="modal fade" id="modal-upload-files" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="ajax.php?pg=upload_file_user" class="modal-content" method='POST' enctype="multipart/form-data">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title" id="exampleModalLabel">Tải files lên hệ thống</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="file" class="d-none" name="files[]" id="files" accept = "" multiple>
                            <div class = "d-flex justify-content-between">
                                <button type="button" class="btn btn-warning" id = "btn-choose-file" onclick = "document.getElementById('files').click()">
                                    Chọn tệp 
                                </button>
                                <select class="selectpicker" data-live-search="true" name="mem_id">
                                    <option disabled selected>Thành viên sở hữu</option>
                                    <?php foreach ($memberList as $mem) : ?>
                                        <option value = "<?= $mem['id'] ?>" <?php echo $mem['user'] ? "selected" : "" ?>>
                                            <?= $mem['firstname'] . " " . $mem['lastname'] ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="type_file" value="" id="type-file">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                            <button type="submit" class="btn btn-success">Tải lên</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>
<?php include __DIR__ . '/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>
<script>
$('.selectpicker').selectpicker();

$( ".sreen-item" ).click(function() {
  $(this).toggleClass( "full-sreen-item", 1000);
});
</script>