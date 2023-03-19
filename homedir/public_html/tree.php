<?php
/*=======================================================/
    | Craeted By: Khalid puerto
    | URL: www.puertokhalid.com
    | Facebook: www.facebook.com/prof.puertokhalid
    | Instagram: www.instagram.com/khalidpuerto
    | Whatsapp: +212 654 211 360
 /======================================================*/

include __DIR__ . '/header.php';
$rs['id'] = $_GET['id'];


$rt = true;
if (!$lg && !$vp) {
	$rt = false;
} elseif ($lg && ($lg != db_get("families", "author", $id) && !in_array(us_email, explode(',', db_get("families", "moderators", $id))))) {
	$rt = false;
} elseif ($vp && ($vp != $id)) {
	$rt = false;
}



?>

<?php
$sql = $db->query('SELECT * FROM ' . prefix . "families WHERE id = '{$id}'");

if ($sql->num_rows) {
	$rs = $sql->fetch_assoc();

	$share_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
		'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] .
		$_SERVER['REQUEST_URI'];



	if (!$rt && $rs['public']) {
		include __DIR__ . '/partials/tree_password.php';
		include __DIR__ . "/footer.php";
		exit;
	}

	// khach tham 
	if (($lg == $rs['author']) || in_array(us_email, explode(',', $rs['moderators'])) || in_array(us_mobile, explode(',', $rs['moderators'])) ||  (us_id && db_rows("members WHERE user = '" . us_name . "' && family = '{$id}'")) || (us_level == 6)) {
		include __DIR__ . '/partials/tree_new_member.php';
		include __DIR__ . '/partials/tree_heritate.php';
	}
?>

	<div class="pt-tree">
		<div class="pt-details">
			 <!-- change layout - VL -->
            <h3 class="m-0 d-sm-none d-md-block tree-title-ongbata">
                <?php if ($lg == $rs['author'] || (us_id && in_array(us_email, explode(',', $rs['moderators']))) || (us_id  &&  us_mobile != NULL && $rs['moderators'] != 0 && in_array(us_mobile, explode(',', $rs['moderators'])))) : ?>
                <?php if ((us_level && $rs['author'] == $lg) || us_level == 6 || (us_id && in_array(us_email, explode(',', $rs['moderators']))) || (us_id && in_array(us_mobile, explode(',', $rs['moderators'])))) : ?>
                <a class="pt-edit m-0" rel="<?= $rs['id'] ?>"><i class="fas fa-pencil-alt"></i>
                    <span><?= $lang['treepage']['edit'] ?></span></a>
                <a href="../../list_files_heritage.php?id_fam=<?= $rs['id'] ?>" class="mr-3 mt-0">
					<i class="far fa-folder"></i>
					Ảnh & video
				</a>
                <?php if (fh_access('pdf')) : ?>
                <!-- <a href="https://dichvu.ongbata.vn/dich-vu-in-gia-pha" data-name="<?= fh_seoURL($rs['name']) ?>" class=" m-0 ml-2 mr-2" target="_blank"><i class="fa fa-download"></i> <?= $lang['treepage']['pdf'] ?></a>
    							class print pdf : pdf-download -->
                <?php endif; ?>
                <?php endif; ?>
                <?php if (!db_count("members WHERE family = '{$id}' && parent = 0")) : ?>
                <a title="New" class="n tree-add bg-warning" id="nid<?= $id ?>" rel="<?= $id ?>" data-toggle="modal"
                    data-target="#myModal"><i class="fas fa-plus"></i> <?= $lang['treepage']['new'] ?></a>
                <?php endif; ?>
                <?php endif; ?>
                <?= $rs['name'] ?><?= $lang['treepage']['fam'] ?>
            </h3>
            <div class="flex-box mb-2 mt-2 tree-share-ongbata">
    
                <div class="pl-share">
                    <a href="https://dichvu.ongbata.vn/dich-vu-in-gia-pha" data-name="<?= fh_seoURL($rs['name']) ?>"
                        class=" m-0 ml-2 mr-2" target="_blank"><i class="fa fa-download"></i>
                        <?= $lang['treepage']['pdf'] ?></a>
                    <!-- class print pdf : pdf-download -->
    
                    <span class="pl-share-button m-0"><i class="fa fa-share"></i>
                        <b><?php echo $lang['treepage']['share']; ?></b></span>
                    <ul class="dropdown">
                        <li>
                            <a class="bg-facebook" href="//www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>"
                                target="_blank">
                                <i class="fab fa-facebook-f"></i> <?php echo $lang['treepage']['share_f']; ?>
                            </a>
                        </li>
                        <li>
                            <a class="bg-twitter"
                                href="//twitter.com/home?status=<?php echo $share_url; ?> <?php echo $rs['name']; ?>"
                                target="_blank">
                                <i class="fab fa-twitter"></i> <?php echo $lang['treepage']['share_t']; ?>
                            </a>
                        </li>
                        <li>
                            <a class="bg-whatsapp" href="whatsapp://send?text=<?php echo $share_url; ?>" target="_blank">
                                <i class="fab fa-whatsapp"></i> <?php echo $lang['treepage']['share_w']; ?>
                            </a>
                        </li>
                        <li>
                            <a class="bg-youtube"
                                href="mailto:?Subject=<?php echo $rs['name']; ?>&amp;Body=<?php echo $rs['name']; ?> <?php echo $share_url; ?>">
                                <i class="fas fa-envelope-open-text"></i> <?php echo $lang['treepage']['share_e']; ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

			
		</div>
		<!-- add zoom control button - VL-->
            <button id="zoom-control-open" class="btn btn-info btn-sm mb-1 fit-content"><i
                    class="fas fa-arrow-left"></i></button>
            <div class="zoom-control zoom-control-show">
                <button id="zoomInButton" class="btn btn-info btn-sm mb-1 fit-content"><i
                        class="fas fa-search-plus"></i></button>
                <button id="zoomOutButton" class="btn btn-info btn-sm mb-1 fit-content"><i
                        class="fas fa-search-minus"></i></button>
                <button id="resetButton" class="btn btn-secondary btn-sm mb-1 fit-content"><i
                        class="fas fa-redo"></i></button>
                <!-- <input id="rangeInput" class="range-input" type="range" min="0.1" max="4" step="0.1" value="1"> -->
                <?php 
    					$data = new Getdata();
    					$condition_center =' Where family ='.$rs['id'].' and death=0';
    					$select_center = $data ->select('ftree_v1_4_members', $condition_center ,$db);
    					$ata = json_encode($select_center);
    				?>
                <?php if($ata!='[]'):?>
                <button id="danhsachmo" class="btn btn-info btn-sm mb-1 fit-content tomb_tree" onclick="location.href='<?php echo path ?>/map_tomb.php?family=<?php echo $rs['id']; ?>'">Xem danh sách mộ của gia phả</button>
                <?php endif ?>
            </div>
		<div class="pt-sm">
		    
            <input type="hidden" class="id_fam" id="<?php echo $rs['id']; ?>">
			<div class="tree" id="div">
				<?php if (db_count("members WHERE family = '{$rs['id']}'")) { ?>
					<ul>
						<?php
						$sql_m = $db->query('SELECT * FROM ' . prefix . "members WHERE family = '{$rs['id']}' && parent = 0");
						while ($rs_m = $sql_m->fetch_assoc()) {
							echo get_child($rs_m['id'],$usr);
							
						}
						$sql_m->close();
						?>
					</ul>
				<?php } else { ?>
					<script>
						document.addEventListener('DOMContentLoaded', function() {
							var clickAdd = document.getElementsByClassName('tree-add')[0]
							clickAdd.click()
							console.log(clickAdd)

						});
					</script>
					<div class="pt-no-result"><i class="far fa-surprise"></i> <?php echo $lang['site']['no-result']; ?></div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php
} else { ?>
	<div class="pt-no-result m-4"><i class="far fa-surprise"></i> <?php echo $lang['site']['no-result']; ?></div>
	<meta http-equiv="refresh" content="2;url=<?php echo path; ?>">
<?php
}
$sql->close();
?>

<!-- Modal View Member  -->
<div class="modal fade" id="myTree" tabindex="-1" role="dialog" aria-labelledby="myTreeLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<div class="modal-body"></div>

			<!-- <div class="d-flex">
				<button class="btn btn-info dirlonglat text-light">
					<a href="">Xem chi tiết trang cá nhân</a>
				</button>
				
			</div> -->
            <input type="hidden" id="user_id_visit" value="<?php echo $usr ?>">
		</div>
	</div>
</div>

</div>
<style>

	.img2{
	    z-index: 9999;
		display: none;
		top: 50%;
        left: 50%;
        width: 100px;
        height: 100px;
	}
	.img1_son{
	    top: 50%;
        left: 50%;
         width: 100px;
        height: 100px;
	}
	.img1
	{
    	z-index: 9999;
    	display: none;
        width: 100%;
        height: 100%;
        background-color: #00000082;
        top: 0;
	}
	
</style>


<div class="img1 position-fixed ">
    <div class="img1_son position-fixed">
    	<img  src="/images/b4d657e7ef262b88eb5f7ac021edda87.gif" alt="">
	</div>
</div>
<div class="img2 position-fixed ">
	<img  src="/images/ShyCautiousAfricanpiedkingfisher-max-1mb.gif" alt="">
</div>
<?php if ($usr !=0):?>
        <!-- Modal number phone  -->
    <?php if (!empty(us_id)&& empty(us_mobile) && ($selectcoutnmem>3)):?>
    <div class="modal-verticalnumberphone d-flex justify-content-center" id="modal_upmobile">
		<div class="modal-verticalnumberphone-body  ">
			<div class="modal-verticalnumberphone-title p-3">
				<div>
					<b><?php echo  us_name ;?> ơi, Bạn cần phải xác nhận số điện thoại! mới có thể 
						tiếp tục sử dụng được nhé</b>
				</div>
				<button class=" btn btn-verticalnumberphone" data-user="<?php echo $usr; ?>">Xác nhận số điện thoại</button>
			</div>			
			<div id="container" style="display:none;">
				<div id="firebaseui-container"></div>
            </div>
		</div>
	</div>
    <?php endif; ?>

<?php endif ?>
<!-- modal me -->
<?php
$num_mem = db_count("members WHERE family = '{$rs['id']}'");
$connect_me= db_count("members WHERE user = '{$usr}'");
?>
<?php if((int)$connect_me==0  && $usr >0 && (int)$num_mem>2):?>
<!-- The Modal -->
<div class="modal" id="modal_it_me">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Bạn là ai trong gia phả này ?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
		<form action="" method="post" id="form_add_me">
			<!-- Modal body -->
			<div class="modal-body">
				<div id="error_value_null" class="invalid-feedback">
					
				</div>
				<input list="choose_me" placeholder="Nhấp vào đây để chọn" id="input_choose" required class="form-control">
				<input type="hidden" name="id_choose" id="id_choose">
				<datalist id="choose_me" >

				</datalist>  
			</div>
			
			<!-- Modal footer -->
			<div class="modal-footer justify-content-between">
				<input type="hidden" name="id_user" value="<?php echo $usr; ?>">
				<button type="submit" class="btn btn-info" >Gửi</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Đóng nếu không có bạn</button>
			</div>
		</form>
    </div>
  </div>
</div>
<script>
	setTimeout(function () {
		$('#modal_it_me').modal("show")
    }, 6000);



</script>
<?php endif ?>

<?php include __DIR__ . '/footer.php'; ?>
<?php if($usr == 0):?>
	<?php include 'modal_login.php' ?>
<script>
$(document).ready(function () {
		setTimeout(function () {
			$('#login_modal').modal("show")
		}, 7000);
	})
</script>
<?php endif ?>



