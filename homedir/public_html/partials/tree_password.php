<div class="pt-box pt-vpass">
	<h4><?=$lang['treepage']['vp']['t']?></h4>
	<p><?=$lang['treepage']['vp']['p']?></p>

	<form class="pt-form" id="send-vpass">
		<div class="pt-input">
			<i class="fas fa-key"></i>
			<input type="password" name="vpass" placeholder="<?=$lang['treepage']['vp']['i']?>">
		</div>
		<hr />
		<button type="submit" class="pt-button bg-0"><i class="fas fa-sign-in-alt"></i> <?=$lang['treepage']['vp']['b']?></button>
		<input type="hidden" name="id" value="<?=$id?>" />
	</form>
</div>
