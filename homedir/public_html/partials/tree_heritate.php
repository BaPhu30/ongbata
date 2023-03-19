<!-- Modal View Member  -->
<div class="modal fade" id="heritageM" tabindex="-1" role="dialog" aria-labelledby="heritageMLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="send-newheritage" class="pt-mnewmember">
			<div class="modal-header">
				<h5 class="modal-title"><?=$lang['heritage']['title']?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<?php if ( fh_access('heritage') ): ?>
			<div class="modal-body">
				<label class="link-u">
					<?=$lang['heritage']['link']?>
					<input type="text" class="form-control" name="heritage" value="">
				</label>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?=$lang['site']['close']?></button>
				<button type="submit" class="btn btn-primary"><?=$lang['site']['submit']?></button>
				<input type="hidden" name="member" value="" />
				<input type="hidden" name="family" value="<?=$id?>" />
			</div>
			<?php else: ?>
				<div class="modal-body">
				<?php echo fh_alerts($lang['alerts']['heritage']) ?>
				</div>
			<?php endif; ?>
			</form>
		</div>
	</div>
</div>
