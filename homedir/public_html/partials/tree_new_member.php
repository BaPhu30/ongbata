<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="send-newmember" class="pt-mnewmember">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><?= $lang['newmember']['title'] ?></h4>
				</div>
				<?php if (fh_access('members', $id)) : ?>
					<div class="modal-body">
						<div class="pt-form pt-forms">
							 <div id="accordion" class="tab-content tab-content-tree">
                                <div class="card active" id="home">
                                        <div class="card-header position-relative" id="headingOne" class="mb-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <i  class=" icon-tab fas fa-angle-right transform-icon position-absolute"></i>
        									<h5 class="mb-0 text-center">
        										<?= $lang['newmember']['personal'] ?>
                                            </h5>
                                        </div>
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                            data-parent="#accordion">
                                            <div class="card-body">
                                               	<div class="d-none">
            										<label for="">Mời thành viên tham gia</label>
            										<div class="form-inline">
            											<div class="form-group mb-2 d-md-none d-lg-none d-xl-none">
            												<input type="text" id="phoneinvite" placeholder="Nhập Số điện thoại" class="form-control">
            												<a class="mb-3 btn btn-outline-primary" id="inviteMember">Mời</a>
            											</div>
            											<div class="form-group mb-2">
            												<input type="text" id="emailInvite" placeholder="Nhập Email" class="form-control">
            												<a class="mb-3 btn btn-outline-primary" id="inviteMailMember">Mời</a>
            											</div>
            
            											<div class="form-group mb-2">
            
            											</div>
            											<p id="link"></p>
            									</div>
									</div>
            									<div class="row">
            										<div class="col-md-6">
            											<label>
            												<?= $lang['newmember']['first'] ?>:
            												<input type="text" value="" placeholder="<?= $lang['newmember']['lab1'] ?>" name="firstname" />
            											</label>
            										</div>
            										<div class="col-md-6">
            											<label>
            												<?= $lang['newmember']['last'] ?>:
            												<input type="text" value="" placeholder="<?= $lang['newmember']['lab2'] ?>" name="lastname" />
            											</label>
            										</div>
            									</div>
            									<div class="row">
            										<div class="col">
            											<label><?= $lang['newmember']['gender'] ?>:</label>
            											<label class="pt-inline"><input type="radio" name="gender" value="1" />
            												<?= $lang['newmember']['female'] ?></label>
            											<label class="pt-inline"><input type="radio" name="gender" value="2" />
            												<?= $lang['newmember']['male'] ?></label>
            										</div>
            										<div class="col">
            											<label><?= $lang['newmember']['rtype'] ?>:</label>
            											<select name="type">
            												<option value="1"><?= $lang['newmember']['child'] ?></option>
            												<option value="2"><?= $lang['newmember']['partner'] ?></option>
            												<option value="3"><?= $lang['newmember']['ex'] ?></option>
            												<option value="4"><?= $lang['newmember']['parent'] ?></option>
            											</select>
            										</div>
            									</div>
            
            									<div class="row">
            										<div class="col">
            											<label>
            												<?= $lang['newmember']['bdate'] ?>:<br />
            												<input type="text" name="birthdate" value="" placeholder="00/00/0000" class="datepicker-here" data-language='en' data-position='top left' />
            											</label>
            										</div>
            										<div class="col">
            											<label>
            												<?= $lang['newmember']['mdate'] ?>:<br />
            												<input type="text" name="mariagedate" value="" placeholder="00/00/0000" class="datepicker-here" data-language='en' data-position='top left' />
            											</label>
            										</div>
            									</div>
            									<label><input id="myCheck" type="checkbox" name="death" checked />
            										<?= $lang['newmember']['alive'] ?></label>
            									<div id="inputDeadDate" class="row" style="display: none;">
            										<div class="col">
            											<label>
            												<?= $lang['newmember']['ddate'] ?> (Ngày âm lịch):<br />
            											</label>
            											<div class="form-group">
            												<input id="deadDate" type="text" name="deathdate" value="" placeholder="00/00/0000" class="datepicker-here form-control" data-language='en' data-position='top left' />
            												<label class="d-none">
            													Nhập ngày âm lịch: <span class="d-none" id="printLunar"></span>
            												</label>
            											</div>
            										</div>
            										<div class="col">
            											<h2 for="">Định vị tọa độ mộ ông bà</h2>
            											<div class="form-row">
            												<input class="col-md-6 form-control" type="number" step="any" name="latitude" placeholder="Nhập kinh độ" id="latitude"  max="90">
            												<input class="col-md-6 form-control mb-2" type="number" step="any" name="longitude" placeholder="Nhập vĩ độ" id="longitude">
            												<p class="spinner-border text-warning text-center" id="spinLocate"></p>
            												<p id="longLat"></p>
            												<a id="location" class=" btn btn-warning col-md-6 mb-2">Lấy tọa độ vị trí của
            													bạn (khuyến nghị dùng Chrome)</a>
            												<a class=" btn btn-outline-info col-md-6 mb-2 " href="https://ongbata.vn/doi-song/cach-dinh-vi-toa-do-bang-google-map-tren-dien-thoai-hoac-may-tinh-ban" target="_blank">Nếu định vị không chính xác vào đây</a>
            												<a class=" btn btn-outline-success col-md-12 mb-2" id="watchLongLat">Xem tọa độ đã
            													nhập trên bản đồ</a>
            												<p class="text-end">Hoặc xem hướng dẫn lấy tọa độ <a href="https://www.youtube.com/watch?v=rnglGPGhcgE">tại đây</a> </p>
            
            											</div>
            										</div>
            									</div>
            									<label>
            										<?= $lang['newmember']['photo'] ?>:
            										<input type="text" value="" id="url_avatar" placeholder="<?= $lang['newmember']['photo_url'] ?>" name="photo" />
            									</label>
            									<div class="prt-group">
            										<input type="file" name="poll_file" id="file" class="inputfile" />
            										<label for="file"><i class="fa fa-upload"></i>
            											<?= $lang['newmember']['choose'] ?></label>
            									</div>
            									<div class="form-group">
            									    <label><?= $lang['newmember']['instead'] ?>:</label>
            									     <span class="border rounded-pill text-danger unchecked_avtar border-danger" style="display:none"><b>Bỏ chọn</b></span>
            									 </div>
            									<div class="form-avatar">
            										<div class="form-inline d-flex justify-content-center">
            											<div class="content hideContent d-flex flex-wrap">
            												<?php for ($x = 1; $x <= 37; $x++) : ?>
            													<div class="form-group">
            														<input type="radio" name="avatar" value="<?= $x ?>" id="sradioe<?= $x ?>" class="choice image choose_avarta">
            														<label for="sradioe<?= $x ?>"><b><img src="<?= path ?>/images/avatar/<?= $x ?>.jpg" /></b></label>
            													</div>
            												<?php endfor; ?>
            											</div>
            											<div class="show-more">
            												<a href="#" class="btn btn-outline-info">Xem Thêm</a>
            											</div>
            										</div>
            									</div>
            									 <!-- me -->
                                                <label class="link-u"><?= $lang['newmember']['link'] ?>
                                                    <input type="text" class="form-control" name="user_c" id="live_search" data-id='' autocomplete="off" placeholder="Nhập số điện thoại hoặc email">
                                                    <ul id="search_result"></ul>
                                                    <div id="has_me" class="invalid-feedback">
                                                       
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <div class="card" id="profile">
                                        <div class="card-header position-relative" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            	<i class="icon-tab fas fa-angle-right position-absolute"></i>
                                            <h5 class="mb-0 text-center">
                                                    <?= $lang['newmember']['contact'] ?>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                            data-parent="#accordion">
                                            <div class="card-body">
        										<label>
        											Facebook:
        											<input type="text" value="" placeholder="<?= $lang['newmember']['lab3'] ?>"
        											name="facebook" />
        										</label>
        										<label>
        											Twitter:
        											<input type="text" value="" placeholder="<?= $lang['newmember']['lab4'] ?>"
        												name="twitter" />
        										</label>
        										<label>
        											Instagram:
        											<input type="text" value="" placeholder="<?= $lang['newmember']['lab5'] ?>"
        												name="instagram" />
        										</label>
        										<label>
        											Email:
        											<input type="text" value="" placeholder="<?= $lang['newmember']['lab6'] ?>"
        												name="email" />
        										</label>
        										<label>
        											<?= $lang['newmember']['website'] ?>:
        											<input type="text" value="" placeholder="<?= $lang['newmember']['lab7'] ?>"
        												name="site" />
        										</label>
        										<label>
        											<?= $lang['newmember']['tel'] ?>:
        											<input type="text" value="" placeholder="<?= $lang['newmember']['lab8'] ?>"
        												name="tel" />
        										</label>
        										<label>
        											<?= $lang['newmember']['mobile'] ?>:
        											<input type="text" value="" placeholder="<?= $lang['newmember']['lab9'] ?>"
        												name="mobile" />
        										</label>
                                            </div>
                                        </div>
                                    </div>
                                <div class="card" id="messages">
                                        <div class="card-header position-relative" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <i  class=" icon-tab fas fa-angle-right position-absolute"></i>
        									<h5 class="mb-0 text-center">
                                                    <?= $lang['newmember']['biographical'] ?>
                                            </h5>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                            data-parent="#accordion">
                                            <div class="card-body">
        										<label>
        											<?= $lang['newmember']['bplace'] ?>:
        											<input type="text" value="" placeholder="<?= $lang['newmember']['lab10'] ?>"
        												name="birthplace" />
        										</label>
        										<label>
        											<?= $lang['newmember']['dplace'] ?>:
        											<input type="text" value="" placeholder="<?= $lang['newmember']['lab11'] ?>"
        												name="deathplace" />
        										</label>
        										<label>
        											<?= $lang['newmember']['profession'] ?>:
        											<textarea name="profession"
        												placeholder="<?= $lang['newmember']['lab12'] ?>"></textarea>
        										</label>
        										<label>
        											<?= $lang['newmember']['company'] ?>:
        											<textarea name="company"
        												placeholder="<?= $lang['newmember']['lab13'] ?>"></textarea>
        										</label>
        										<label>
        											<?= $lang['newmember']['interests'] ?>:
        											<textarea name="interests"
        												placeholder="<?= $lang['newmember']['lab14'] ?>"></textarea>
        										</label>
        										<label>
        											<?= $lang['newmember']['bio'] ?>:
        											<textarea name="bio" placeholder="<?= $lang['newmember']['lab15'] ?>"></textarea>
        										</label>
                                            </div>
                                        </div>
                                    </div>
        						<div class="card" id="messages">
                                        <div class="card-header position-relative" id="headingfour" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                            <i  class="icon-tab fas fa-angle-right position-absolute"></i>
        									<h5 class="mb-0 text-center">
                                                    Tải lên hình ảnh hoặc video
                                            </h5>
                                        </div>
                                        <div id="collapsefour" class="collapse" aria-labelledby="headingfour"
                                            data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="mb-3" data-event="images">
                                                    <button type="button" class="btn btn-info mb-3 handle-upload-file">
                                                        <i class="fa fa-cloud-upload"></i>
                                                        <span class="filename" >Tải ảnh lên</span>
                                                    </button>
                                                    <input type="file" class="d-none form-control upload-files-user" name="images_member[]"  multiple accept="image/*" id="upload-image">
                                                    <ul class="preview-image d-flex flex-wrap p-0" id="preview-image">
                                                    </ul>
                                                </div>
                                                <div class="mb-1">
                                                    <a href=""
                                                     target="_blank" class = "btn btn-danger mb-3 rediect-upload-page" rel="noopener noreferrer">
                                                        <i class="fa fa-cloud-upload"></i>
                                                        <span class="filename">Tải video lên</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal"><?= $lang['site']['close'] ?></button>
						<button type="submit" class="btn btn-primary"><?= $lang['site']['submit'] ?></button>
						<input type="hidden" name="parent" value="" />
						<input type="hidden" name="id" id="id_m" value="" />
                        <input type="hidden" name="nid" id="nid_m" value="" />
					</div>
				<?php else : ?>
					<div class="modal-body">
						<?php echo fh_alerts($lang['alerts']['members']) ?>
					</div>
				<?php endif; ?>
			</form>
		</div>
	</div>
</div>