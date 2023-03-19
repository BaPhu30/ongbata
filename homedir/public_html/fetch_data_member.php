<?php 
include __DIR__ . '/configs/config.php';
$pg = empty($_GET['pg'])?'':$_GET['pg'];
?>
<?php if($pg=='fetch_mm'):?>
<?php $id = $_POST['id'];?>
<?php if (db_count("members WHERE family = '{$id}'")) { ?>
					<ul>
						<?php
						$sql_m = $db->query("SELECT * FROM ftree_v1_4_members WHERE family = '{$id}' && parent = 0");
						while ($rs_m = $sql_m->fetch_assoc()) {
							echo get_child($rs_m['id'],$_POST['user_id']);
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
<?php endif ?>