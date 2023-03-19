<?php
/*=======================================================/
	| Craeted By: Khalid puerto
	| URL: www.puertokhalid.com
	| Facebook: www.facebook.com/prof.puertokhalid
	| Instagram: www.instagram.com/khalidpuerto
	| Whatsapp: +212 654 211 360
 /======================================================*/

include __DIR__."/header.php";

$sql = $db->query("SELECT * FROM ".prefix."pages WHERE id = '{$id}'") or die ($db->error);
if($sql->num_rows):
$rs = $sql->fetch_assoc();
?>
<div class="pt-list">
	<div class="pt-title">
		<span><i class="<?=$rs['icon']?>"></i></span> <b><?=$rs['title']?></b>
	</div>
	<div class="pt-list-item"><?=bbcode($rs['content'])?></div>

</div>
</div>
<?php
else:
	echo fh_alerts($lang['alerts']['wrong']);
endif;
$sql->close();
include __DIR__."/footer.php";
?>
