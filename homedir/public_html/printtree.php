<?php
/*=======================================================/
    | Craeted By: Khalid puerto
    | URL: www.puertokhalid.com
    | Facebook: www.facebook.com/prof.puertokhalid
    | Instagram: www.instagram.com/khalidpuerto
    | Whatsapp: +212 654 211 360
 /======================================================*/

include __DIR__ . '/header.php';

$rt = true;
if (!$lg && !$vp) {
	$rt = false;
} elseif ($lg && ($lg != db_get("families", "author", $id) && !in_array(us_email, explode(',', db_get("families", "moderators", $id))))) {
	$rt = false;
} elseif ($vp && ($vp != $id)) {
	$rt = false;
}

?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="./css/printtree.css">
</head>
<body>
	
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


	if (($lg == $rs['author']) || in_array(us_email, explode(',', $rs['moderators'])) || in_array(us_mobile, explode(',', $rs['moderators'])) ||  (us_id && db_rows("members WHERE user = '" . us_name . "' && family = '{$id}'"))) {
		include __DIR__ . '/partials/tree_new_member.php';
		include __DIR__ . '/partials/tree_heritate.php';
	}
?>

	<div class="pt-tree">
		<div class="pt-details">
			<h3 class="m-0 d-sm-none d-md-block tree-title-ongbata"><span><i class="fa fa-users" aria-hidden="true"></i>
				</span> <?= $rs['name'] ?><?= $lang['treepage']['fam'] ?></h3>
			<div class="flex-box mb-2 mt-2 tree-share-ongbata">
				<?php if ($lg == $rs['author'] || (us_id && in_array(us_email, explode(',', $rs['moderators']))) || (us_id && in_array(us_mobile, explode(',', $rs['moderators'])))) : ?>
					<?php if ((us_level && $rs['author'] == $lg) || us_level == 6 || (us_id && in_array(us_email, explode(',', $rs['moderators']))) || (us_id && in_array(us_mobile, explode(',', $rs['moderators'])))) : ?>
						<a class="pt-edit m-0" rel="<?= $rs['id'] ?>"><i class="fas fa-pencil-alt"></i> <span><?= $lang['treepage']['edit'] ?></span></a>
						<?php if (fh_access('pdf')) : ?>
							<!-- <a href="https://dichvu.ongbata.vn/dich-vu-in-gia-pha" data-name="<?= fh_seoURL($rs['name']) ?>" class=" m-0 ml-2 mr-2" target="_blank"><i class="fa fa-download"></i> <?= $lang['treepage']['pdf'] ?></a>
							class print pdf : pdf-download -->
						<?php endif; ?>
					<?php endif; ?>
					<?php if (!db_count("members WHERE family = '{$id}' && parent = 0")) : ?>
						<a title="New" class="n tree-add bg-warning" id="nid<?= $id ?>" rel="<?= $id ?>" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus"></i> <?= $lang['treepage']['new'] ?></a>
					<?php endif; ?>
				<?php endif; ?>
				<div class="pl-share">
					<a href="https://dichvu.ongbata.vn/dich-vu-in-gia-pha" data-name="<?= fh_seoURL($rs['name']) ?>" class=" m-0 ml-2 mr-2" target="_blank"><i class="fa fa-download"></i> <?= $lang['treepage']['pdf'] ?></a>
					<!-- class print pdf : pdf-download -->

					<span class="pl-share-button m-0"><i class="fa fa-share"></i> <b><?php echo $lang['treepage']['share']; ?></b></span>
					<ul class="dropdown">
						<li>
							<a class="bg-facebook" href="//www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>" target="_blank">
								<i class="fab fa-facebook-f"></i> <?php echo $lang['treepage']['share_f']; ?>
							</a>
						</li>
						<li>
							<a class="bg-twitter" href="//twitter.com/home?status=<?php echo $share_url; ?> <?php echo $rs['name']; ?>" target="_blank">
								<i class="fab fa-twitter"></i> <?php echo $lang['treepage']['share_t']; ?>
							</a>
						</li>
						<li>
							<a class="bg-whatsapp" href="whatsapp://send?text=<?php echo $share_url; ?>" target="_blank">
								<i class="fab fa-whatsapp"></i> <?php echo $lang['treepage']['share_w']; ?>
							</a>
						</li>
						<li>
							<a class="bg-youtube" href="mailto:?Subject=<?php echo $rs['name']; ?>&amp;Body=<?php echo $rs['name']; ?> <?php echo $share_url; ?>">
								<i class="fas fa-envelope-open-text"></i> <?php echo $lang['treepage']['share_e']; ?>
							</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="zoom-control">
				<button id="zoomInButton" class="btn btn-info btn-sm mb-1 fit-content"><i class="fas fa-search-plus"></i></button>
				<button id="zoomOutButton" class="btn btn-info btn-sm mb-1 fit-content"><i class="fas fa-search-minus"></i></button>
				<button id="resetButton" class="btn btn-secondary btn-sm mb-1 fit-content"><i class="fas fa-redo"></i></button>
				<!-- <input id="rangeInput" class="range-input" type="range" min="0.1" max="4" step="0.1" value="1"> -->

			</div>
		</div>

		<div class="pt-sm">

			<div class="tree" id="div">
				<?php if (db_count("members WHERE family = '{$rs['id']}'")) { ?>
					<ul>
						<?php
						$sql_m = $db->query('SELECT * FROM ' . prefix . "members WHERE family = '{$rs['id']}' && parent = 0");
						while ($rs_m = $sql_m->fetch_assoc()) {
							echo get_child($rs_m['id']);
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
		</div>
	</div>
</div>

</div>


<?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
