<?php
include __DIR__ . '/header.php';

$id_mem = $_GET['id_mem'];
$id_user = us_id;

if (!db_count("members WHERE author = '{$id_user}' && id = '{$id_mem}'") && us_level != 6 ) {
    return header("Location: index.php"); 
}

$messageSuccess = "";
$messageError = "";

if ($_SESSION["success"] ?? '') {
    $messageSuccess = $_SESSION["success"];
    $_SESSION["success"] = "";
}

if ($_SESSION["error"] ?? '') {
    $messageError = $_SESSION["error"];
    $_SESSION["error"] = "";
}
?>
<?php if ($messageError) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Lỗi nghiêm trọng!</strong> <?= $messageError ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
<?php endif ?>
<?php if ($messageSuccess) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Chúc mừng!</strong> <?= $messageSuccess ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
<?php endif ?>
<div class="content content-video-upload row justify-content-between align-items-center">
        <div class="col-md-5">
            <h3 class="text-center mb-2">
                <b>
                    Tải video lên hệ thống
                </b>
            </h3>
        </div>
        <div class="col-md-7">
                <form action="ajax.php?pg=upload_video&&id_mem=<?= $id_mem ?>" method="post"
            data-event="videos" class="form-video-upload" enctype="multipart/form-data">
                <button type="button" class="btn btn-danger handle-upload-file">
                    <i class="fa fa-cloud-upload"></i>
                    <span class="filename">Chọn video</span>
                </button>
                <input type="file" class="d-none form-control upload-files-user" name="videos_member[]" multiple
                    accept="video/*" id="upload-video">
                <ul class="preview-image d-flex flex-wrap p-0 mt-2" id="preview-video">
                </ul>
                <input type="hidden" name="video_remove" value="" id="remove-video-preview">
                <button class="btn btn-success btn-upload-video">Lưu</button>
            </form>
        </div>
</div>
<?php if ($messageSuccess) : ?>
    <script>
        setTimeout(function() {
         window.close();
      }, 3000);
    </script>
<?php endif ?>
<?php include __DIR__ . '/footer.php'; ?>