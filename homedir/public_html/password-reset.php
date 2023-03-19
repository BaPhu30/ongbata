<?php
/*=======================================================/
	| Craeted By: Khalid puerto
	| URL: www.puertokhalid.com
	| Facebook: www.facebook.com/prof.puertokhalid
	| Instagram: www.instagram.com/khalidpuerto
	| Whatsapp: +212 654 211 360
 /======================================================*/

include __DIR__.'/config.php';

# Header Page
include __DIR__.'/header.php';

if(db_get('reset_passwords', 'date', $token, 'token') < (time()-3600*24) || db_get('reset_passwords', 'status', $token, 'token') != 0){
	echo fh_alerts('Đường dẫn lấy lại mật khẩu đã hết hạn (chỉ có hiệu lực trong 30 phút), vui lòng lặp lại thao tác lấy lại mật khẩu ở trang chủ');
	$sidebar = false;
	include __DIR__.'/footer.php';
	exit;
}

# Main Page
if(!us_level):
?>
<div class="pt-box">
	<h3><i class="fas fa-lock"></i> <?=$lang['resetpage']['title']?></h3>

	<form class="pt-form" id="password-reset">
		<div class="row">
			<div class="col-6">
				<label>
					<?=$lang['resetpage']['npass']?> <b class="red">*</b>
					<input type="password" name="reg_pass" placeholder="<?=$lang['resetpage']['npass_l']?>">
				</label>
			</div>
			<div class="col-6">
				<label>
					<?=$lang['resetpage']['rpass']?> <b class="red">*</b>
					<input type="password" name="reg_repass" placeholder="<?=$lang['resetpage']['rpass_l']?>">
				</label>
			</div>
		</div>
		<hr/>
		<input type="hidden" name="token" value="<?=$token?>">
		<input type="hidden" name="t" value="<?=$t?>">
		<button type="submit" class="btn"><?=$lang['site']['submit']?> <i class="fas fa-arrow-circle-right"></i></button>
	</form>

</div>

<?php
else:
	echo fh_alerts($lang['alerts']['permission']);
	$sidebar = false;
endif;
# Footer Page
include __DIR__.'/footer.php';
