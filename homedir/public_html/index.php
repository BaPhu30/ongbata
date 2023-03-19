<?php
/*=======================================================/
	| Craeted By: Khalid puerto
	| URL: www.puertokhalid.com
	| Facebook: www.facebook.com/prof.puertokhalid
	| Instagram: www.instagram.com/khalidpuerto
	| Whatsapp: +212 654 211 360
 /======================================================*/
include __DIR__ . "/header.php";
#settimeout session





if (time() - $_SESSION["time"] > 604800) {
	session_unset();     // unset $_SESSION variable for the run-time 
	session_destroy();
}
?>

<div class="row form_mobile">
	<div class="col-md-6">
		<div class="pt-index-left">
			<h4><?= $lang['indexpage']['h4'] ?></h4>
			<h2><?= $lang['indexpage']['h2'] ?></h2>
			<p><?= $lang['indexpage']['p'] ?></p>
			<div class="pt-thumb">
				<img src="https://ongbata.vn/wp-content/uploads/2021/06/ezgif.com-gif-maker-1.png" />
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="pt-index-right">
			<?php if ($lg) : ?>
				<h3>
					<b><?= $lang['indexpage']['my'] ?></b>
					<span><?= $lang['indexpage']['list'] ?></span>
					<a href="#" class="btn btn-primary text-light <?php if (db_count("families WHERE author =" . us_id) == 0) {
																		echo 'show-modal-add-newtree';
																	} ?>" data-toggle="modal" data-target="#addnewtree"><i class="fas fa-plus-circle"></i> <?= $lang['header']['newtree'] ?></a>
				</h3>
				<div class="pt-form-content">
					<div class="pt-form pt-flist">
						<?php
						$sql = $db->query("SELECT * FROM " . prefix . "families WHERE author = '{$lg}' OR FIND_IN_SET('" . us_email . "', moderators) > 0 OR FIND_IN_SET('" . $getmobile . "', `moderators`) > 0 LIMIT 10") or die($db->error);
						if ($sql->num_rows) :

							while ($rs = $sql->fetch_assoc()) :
								$rs['photo'] = $rs['photo'] ? $rs['photo'] : db_get("members", "photo", $rs['id'], 'family', "AND parent = '0'");
						?>
								<div class="pt-list-item">
									<div class="media">
										<div class="media-left">
											<div class="pt-thumb"><img src="<?= $rs['photo'] ?>" alt="<?= $rs['name'] ?>" onerror="this.src='<?= nophoto ?>'"></div>
										</div>
										<div class="media-body">
											<h3><a href="<?= path ?>/tree.php?id=<?= $rs['id'] ?>&t=<?= fh_seoURL($rs['name']) ?>"><?= $rs['name'] ?></a></h3>
											<p>
												<i class="fas fa-clock"></i> <span><?= fh_ago($rs['date']) ?> </span>
												<i class="fas fa-users"></i> <span><b><?= db_count("members WHERE family = '{$rs['id']}'") ?></b> <?= $lang['listpage']['members'] ?></span>
											</p>
										</div>
									</div>
								</div>
							<?php
							endwhile;
							$sql->close();
							echo '<a href="' . path . '/list.php?pg=my" class="more"><i class="fas fa-arrow-alt-circle-left"></i> ' . $lang['indexpage']['more'] . '</a>';
						else :
							?>
							<div class="pt-no-result"><i class="far fa-surprise"></i> <?= $lang['listpage']['no-result'] ?></div>
						<?php
						endif;
						?>
					</div>
				</div>
			<?php else : ?>
				<h3>
					<b><?= $lang['indexpage']['form']['b'] ?></b>
					<span><?= $lang['indexpage']['form']['s'] ?></span>
					<div>
						<a href="#" class="active login-link"><?= $lang['indexpage']['form']['login'] ?></a>
						<?php if (!site_register_status) : ?>
							<a href="#" class="register-link"><?= $lang['indexpage']['form']['register'] ?></a>
						<?php endif; ?>
					</div>
				</h3>

				<div class="pt-form-content" id='form-login-wb'>

					<form class="pt-form form_login" id="send-login">
						<div class=" text-center">
							<div class="btn change_method_lg text-white" id="change_phone"> Đăng nhập bằng số điện thoại</div>
						</div>
						<div class="login_name">
							<label><?= $lang['indexpage']['form']['fid']['l'] ?></label>
							<div class="pt-input">
								<i class="far fa-user"></i>
								<input type="text" name="name" placeholder="<?= $lang['indexpage']['form']['fid']['i'] ?>">
							</div>
						</div>
						<div class="login_phone" style="display:none">
							<center> <i style="font-size: 12px;">(Chỉ Đăng nhập bằng sđt khi bạn đã cập nhật sđt trước đó)</i></center>
							<!-- <div class="pt-input">
								
								<input type="tel" id="phone" name="numberphone"   placeholder="Nhập số điện thoại đăng nhập">
							</div> -->

							<!-- <h3>Single Page App mode:</h3> -->
							<div id="firebaseui-container_index"></div>



						</div>
						<div class="login_with_name">
							<label><?= $lang['indexpage']['form']['pass']['l'] ?></label>
							<div class="pt-input">
								<i class="fas fa-key"></i>
								<input type="password" name="pass" placeholder="<?= $lang['indexpage']['form']['pass']['i'] ?>">
							</div>
							<div class="reset">
								<?= $lang['indexpage']['forget'] ?> <a href="#" data-toggle="modal" data-target="#resetM"><?= $lang['indexpage']['reset'] ?></a>
							</div>
							<hr />
							<button type="submit" class="pt-button bg-0"><i class="fas fa-login-alt"></i> <?= $lang['indexpage']['form']['in'] ?></button>
						</div>
					</form>
					<?php include __DIR__ . "/partials/login_password_reset.php"; ?>
					<?php if (!site_register_status) : ?>
						<form class="pt-form" id="send-user">
							<label><?= $lang['indexpage']['form']['fid']['l'] ?></label>
							<div class="pt-input">
								<i class="far fa-user"></i>
								<input type="text" name="name" placeholder="<?= $lang['indexpage']['form']['fid']['i'] ?>">
							</div>
							<label><?= $lang['indexpage']['form']['pass']['l'] ?></label>
							<div class="pt-input">
								<i class="fas fa-key"></i>
								<input type="password" name="pass" placeholder="<?= $lang['indexpage']['form']['pass']['i'] ?>">
							</div>
							<label><?= $lang['indexpage']['form']['email']['l'] ?></label>
							<div class="pt-input">
								<i class="far fa-envelope"></i>
								<input type="text" name="email" placeholder="<?= $lang['indexpage']['form']['email']['i'] ?>">
							</div>
							<!--<label><?= $lang['newmember']['mobile'] ?></label>-->
							<!--<div class="pt-input">-->
							<!--	<i class="fa fa-phone-square" aria-hidden="true"></i>-->
							<!--	<input type="text" name="mobile" placeholder="<?= $lang['newmember']['mobile'] ?>">-->
							<!--</div>-->
							<div class="reset"><small>
									<?= str_replace("{a}", '<a href="' . path . '/page.php?id=3">' . $lang['indexpage']['pravicy'] . '</a>', $lang['indexpage']['byclick']) ?>
								</small></div>
							<hr />
							<button type="submit" class="pt-button bg-0"><i class="fas fa-sign-in-alt"></i> <?= $lang['indexpage']['form']['up'] ?></button>
						</form>
					<?php endif; ?>

					<center> <span class="or_text"><b>Hoặc</b></span> </center>
					<div align="center" class="">

						<!-- Facebook login or logout button -->
						<div onclick="Facebooklogin()" style="margin-bottom: 14px; display: none;">
							<a href="javascript:void(0);" onclick="fbLogin()" class=" btn btn-primary" id="fbLink">
								<div class="fbLink d-flex align-items-center">
									<div class="logofacebook"> </div>
									<b>Tiếp tục đăng nhập với facebook</b>
								</div>

							</a>
						</div>



						<div id="gSignInWrapper" class="d-inline-block">

							<div id="customBtn" class=" d-flex customGPlusSignIn">
								<span class="icon"></span>
								<div class="buttonText d-flex text-white align-items-center">
									<span class=""><b>Tiếp tục đăng nhập với Google</b></span>
								</div>

							</div>
						</div>
						<div id="name"></div>




						<!-- Display user's profile info -->
						<!-- <div class="ac-data" id="userData"></div> -->

					</div>
				</div>

			<?php endif; ?>

		</div>
	</div>
</div>
</div>

<?php include './MyHeritage/index.php' ?>
<!-- modal register number phone -->
<div class="modal fade" id="register_numberphone_index" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<form class="modal-dialog" id="register_numberphone_form_index" method="post">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Đăng nhập</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
			</div>
			<div class="modal-body">
				<center><b>Số điện thoại này chưa đăng ký tài khoản, nếu bạn chưa đăng ký tài khoản thì bạn vui lòng nhập
						tên và email để tiếp tục</b></center>
				<div class="mb-1">
					<label for="name_user" class="form-label" style=" margin-bottom: 0;">Nhập tên:</label>
					<input type="text" class="form-control " id="name_user" name="name_user" required>
				</div>
				<div class="mb-1">
					<label for="email_user" class="form-label" style=" margin-bottom: 0;">Nhập email:</label>
					<input type="email" class="form-control " id="email_user" name="email_user" required>
					<div id="validationServerUsernameFeedback" class="invalid-feedback" style="display: none;">

					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" name="numberphone_login" id="numberphone_login" value>
				<button type="submit" class="btn btn-primary">Đăng nhập</button>
			</div>
		</div>
	</form>
</div>
<!--sign with google-->
<script>
	//   var  phoneInputField = document.querySelector("#phone");
	//     var  phoneInput = window.intlTelInput(phoneInputField, {
	//         preferredCountries: ["vn", "us", "in", "de"],
	//       utilsScript:
	//         "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
	//     });

	//     var info = document.querySelector(".alert-info");
	//     var  error = document.querySelector(".alert-error");
	function fbLogin() {
		// <!-- script login with facebook -->


		window.fbAsyncInit = function() {
			// FB JavaScript SDK configuration and setup
			FB.init({
				appId: '<?php select_api($db, 'ftree_v1_4_configs', 'variable="Facebook_apilogin_appId"') ?>', // FB App ID
				cookie: true, // enable cookies to allow the server to access the session
				xfbml: true, // parse social plugins on this page
				version: '<?php select_api($db, 'ftree_v1_4_configs', 'variable="Facebook_apilogin_version"') ?>' // use graph api version 2.8
			});

			// Check whether the user already logged in
			FB.getLoginStatus(function(response) {
				if (response.status === 'connected') {
					//display user data
					getFbUserData();
				}
			});
			return false;
		};

		// Load the JavaScript SDK asynchronously
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s);
			js.id = id;
			js.src = "//connect.facebook.net/vi_VN/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

		// Facebook login with JavaScript SDK

		FB.login(function(response) {
			if (response.authResponse) {
				// Get and display the user profile data
				getFbUserData();
			} else {
				document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
			}
		}, {
			scope: 'email'
		});









		// Save user data to the database
		function saveUserData(userData, token) {
			var datacheck = JSON.stringify(userData);
			$.post('user-data_api.php', {
					token: token,
					oauth_provider: 'facebook',
					userData: JSON.stringify(userData)
				},
				function(data) {

					$.post(
						path + "/ajax.php?pg=send-facebook-login", {

							checkuser: datacheck,
						},
						function(puerto) {
							if (puerto.type == "success") {
								setTimeout(function() {
									$(location).attr("href", path + "/index.php");
								}, 2500);
								$.puerto_confirm(lang.success, puerto.msg, "green");
							} else {
								$.puerto_confirm(lang.error, puerto.msg, "red");
							}
						},
						"json"
					);
					return false;
				});
			return false;

		}

		// Fetch the user profile data from facebook
		function getFbUserData() {
			var access_token = FB.getAuthResponse()['accessToken'];

			FB.api('/me', {
					locale: 'vi_VN',
					fields: 'id,first_name,last_name,email,link,gender,locale,picture'
				},
				function(response) {
					//  $('.fbLink').attr("onclick","fbLogout()");
					// Save user data
					saveUserData(response, access_token);
				});
			return false;
		}
	}



	// logout social














	var googleUser = {};
	var startApp = function() {
		gapi.load('auth2', function() {
			// Retrieve the singleton for the GoogleAuth library and set up the client.
			auth2 = gapi.auth2.init({
				client_id: '<?php select_api($db, 'ftree_v1_4_configs', 'variable="google_login_client_id"') ?>',
				cookiepolicy: 'single_host_origin',
				// Request scopes in addition to 'profile' and 'email'
				//scope: 'additional_scope'
			});
			attachSignin(document.getElementById('customBtn'));
		});
	};

	function attachSignin(element) {
		console.log(element.id);
		auth2.attachClickHandler(element, {},
			function(googleUser) {
				var token = gapi.auth2.getAuthInstance().currentUser.get().getAuthResponse().id_token;
				gapi.client.load('oauth2', 'v2', function() {
					var request = gapi.client.oauth2.userinfo.get({
						'userId': 'me'
					});
					request.execute(function(resp) {
						// Display the user details
						console.log(resp);
						saveUserDataG(resp, token);
					});
				});
			},
			function(error) {
				//   alert(JSON.stringify(error, undefined, 2));
			});
	}





	// Save user data to the database
	function saveUserDataG(userDatagoogle, token) {
		var datagoogle = JSON.stringify(userDatagoogle)
		$.post('user-data_api.php', {
				id_google: userDatagoogle.id,
				token: token,
				oauth_provider: 'google',
				userDatagoogle: datagoogle,
			},
			function(data) {

				$.post(
					path + "/ajax.php?pg=send-google-login", {
						id_google: userDatagoogle.id,
						checkdatagoogle: datagoogle,
					},
					function(puerto) {
						if (puerto.type == "success") {
							setTimeout(function() {
								$(location).attr("href", path + "/index.php");
							}, 2500);
							$.puerto_confirm(lang.success, puerto.msg, "green");
						} else {
							$.puerto_confirm(lang.error, puerto.msg, "red");
						}
					},
					"json"
				);


			}
		);


	}
</script>


<?php
include __DIR__ . "/footer.php";
?>
<script>
	startApp();
</script>