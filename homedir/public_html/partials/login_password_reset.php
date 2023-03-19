<!-- Modal View Member  -->
<div class="modal fade" id="resetM" tabindex="-1" role="dialog" aria-labelledby="ResetMLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="send-reset-password" class="pt-mnewmember">
				<div class="modal-header">
					<h5 class="modal-title"><?= $lang['resetpage']['title1'] ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<label class="link-u">
						<i class="fas fa-lock"></i>
						<input type="text" class="form-control" name="reset_email" placeholder="<?= $lang['resetpage']['email'] ?>">
					</label>
				</div>
				<div class="d-flex justify-content-center" >
					<div class="spinner-border text-success" role="status" id="spinResetPassword">
						<span class="sr-only">Loading...</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="btnResetPassword"><?= $lang['site']['submit'] ?></button>
				</div>
				<p class="text-center font-weight-light">Bạn hãy vào email sau khi bấm [gửi đi] mật khẩu!</p>
				

			</form>
		</div>
	</div>
</div>