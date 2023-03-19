<?php
/*=======================================================/
	| Craeted By: Khalid puerto
	| URL: www.puertokhalid.com
	| Facebook: www.facebook.com/prof.puertokhalid
	| Instagram: www.instagram.com/khalidpuerto
	| Whatsapp: +212 654 211 360
 /======================================================*/

include __DIR__."/header.php";
?>

<div class="pt-list">
	<div class="pt-title">
		<span><i class="far fa-envelope"></i></span> <b><?=$lang['site']['emailver']?></b>
	</div>

	<div class="pt-list-item">
		<?php
			$sql = $db->query("SELECT * FROM ".prefix."users WHERE status = 2 && token = '".sc_sec($_GET['token'])."' LIMIT 1");
			if($sql->num_rows){
				$rs = $sql->fetch_assoc();
				if(sha1($rs['email']) == sc_sec($_GET['t'])){
					echo fh_alerts($lang['alerts']['emailver'], "success");
					db_update("users", ["status"=>"'0'"], sc_sec($_GET['token']), 'token');
				}
			}
		?>
	</div>
</div>
<?php
include __DIR__."/footer.php";
?>
