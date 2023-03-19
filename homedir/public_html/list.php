<?php

/*=======================================================/
	| Craeted By: Khalid puerto
	| URL: www.puertokhalid.com
	| Facebook: www.facebook.com/prof.puertokhalid
	| Instagram: www.instagram.com/khalidpuerto
	| Whatsapp: +212 654 211 360
 /======================================================*/

include __DIR__ . "/header.php";
?>

<div class="pt-list">
	<div class="pt-title">
		<span><i class="fas fa-list"></i></span> <b><?= $lang['listpage']['title'] ?></b>
		<?php if (us_email) : ?>
			<div class="pt-options">
				<a href="<?= path ?>/list.php?pg=my"><i class="fas fa-list"></i> <?= $lang['listpage']['my'] ?> của bạn</a>
			</div>
		<?php endif ?>
	</div>










	<?php
	$results_per_page = 5; // Number of results per page
	$current_page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1; // Current page number

	$start = ($current_page - 1) * $results_per_page; // Starting index of results
	// var_dump($_GET['page'], $current_page, $start);die;

	$trees = (us_name ? "&& (author = '{$lg}' || FIND_IN_SET('" . us_email . "', moderators) > 0) || FIND_IN_SET(" . $getmobile . ", moderators) > 0" : '');
	$trees = (!us_name ? "&& author = 0" : $trees);

	if (!empty(us_email) && !empty(us_name) && !empty(us_mobile)) {
		$pagination = $db->query("SELECT COUNT(*) as total_results FROM " . prefix . "families WHERE author = '{$lg}' OR FIND_IN_SET('" . us_email . "', moderators) > 0 OR FIND_IN_SET(" . $getmobile . ", moderators) > 0") or die($db->error);
		$row = mysqli_fetch_assoc($pagination);
		$total_results = $row['total_results'];
		var_dump($total_results);
		$sql = $db->query("SELECT * FROM " . prefix . "families WHERE author = '{$lg}' OR FIND_IN_SET('" . us_email . "', moderators) > 0 OR FIND_IN_SET(" . $getmobile . ", moderators) > 0 LIMIT $start, $results_per_page") or die($db->error);
	} elseif (!empty(us_email) && !empty(us_name)) {
		$pagination = $db->query("SELECT COUNT(*) as total_results FROM " . prefix . "families WHERE author = '{$lg}' OR FIND_IN_SET('" . us_email . "', moderators) > 0 LIMIT $start, $results_per_page") or die($db->error);
		$row = mysqli_fetch_assoc($pagination);
		$total_results = $row['total_results'];
		var_dump($total_results);

		$sql = $db->query("SELECT * FROM " . prefix . "families WHERE author = '{$lg}' OR FIND_IN_SET('" . us_email . "', moderators) > 0") or die($db->error);
	} else {
		$sql = $db->query("SELECT * FROM " . prefix . "families WHERE status = 0 ORDER BY id DESC LIMIT $start, $results_per_page");
	}
	var_dump($sql->num_rows);
	if ($sql->num_rows) :
		while ($rs = $sql->fetch_assoc()) :
			$rs['photo'] = $rs['photo'] ? $rs['photo'] : db_get("members", "photo", $rs['id'], 'family', "AND parent = '0'");
	?>
			<div class="pt-list-item">
				<div class="media">
					<div class="media-left">
						<div class="pt-thumb"><img src="<?= path . "/" . $rs['photo'] ?>" alt="<?= $rs['name'] ?>" onerror="this.src='<?= nophoto ?>'"></div>
					</div>
					<div class="media-body">
						<h3><a href="<?= path ?>/tree.php?id=<?= $rs['id'] ?>&t=<?= fh_seoURL($rs['name']) ?>"><?= $rs['name'] ?></a></h3>
						<p><?= fh_ago($rs['date']) ?></p>
						<div class="pt-options">
							<?php if ((us_level && $rs['author'] == $lg) || us_level == 6) : ?>
								<a class="pt-edit" rel="<?= $rs['id'] ?>"><i class="fas fa-edit"></i> <span><?= $lang['listpage']['edit'] ?></span></a>
							<?php endif; ?>
							<a class="pt-members"><i class="fas fa-users"></i> <span><b><?= db_count("members WHERE family = '{$rs['id']}'") ?></b> <?= $lang['listpage']['members'] ?></span></a>
						</div>
					</div>
				</div>
			</div>
		<?php
		endwhile;
		if( $total_results>0 ) {
			$total_pages = ceil($total_results / $results_per_page);
			var_dump($total_pages);
			echo "<ul class='pt-pagination'>";
			if ($total_pages > 1) {
				for ($i = 1; $i <= $total_pages; $i++) {
					if ($i == $current_page) {
						echo "<li class='pt-active'><a href='http://localhost/ongbata/homedir/public_html/families/all/page/$i'>$i</a></li>";
					} else {
						echo "<li><a href='http://localhost/ongbata/homedir/public_html/families/all/page/$i'>$i</a></li>";
					}
				}
			}
	
			echo "</ul>";
		}

		$sql->close();
	else :
		?>
		<div class="pt-no-result"><i class="far fa-surprise"></i> <?= $lang['listpage']['no-result'] ?></div>
	<?php
	endif;
	?>
</div>
</div>
<?php
include __DIR__ . "/footer.php";
?>