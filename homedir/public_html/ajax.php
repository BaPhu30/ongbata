<?php
/*=======================================================/
	| Craeted By: Khalid puerto
	| URL: www.puertokhalid.com
	| Facebook: www.facebook.com/prof.puertokhalid
	| Instagram: www.instagram.com/khalidpuerto
	| Whatsapp: +212 654 211 360
 /======================================================*/

include __DIR__ . '/configs/config.php';
require_once './vendor/autoload.php';




if ($pg == 'search') {
	$searsh = sc_sec($_POST["search"]);
	$sql = $db->query("SELECT id, name FROM " . prefix . "families WHERE name LIKE '{$searsh}%'");
	
	$result_print = array();
	if (!empty($searsh)) {
		if ($sql->num_rows) {
			while ($rs = $sql->fetch_assoc()) {
				$array_search = array(
					'id'=>$rs['id'],
					'name'=>$rs['name'],
					'url'=>fh_seoURL($rs['name'])
				);
				array_push($result_print,$array_search);
			}
		} else {
			array_push($result_print,$lang['site']['no-result']);
		}
	} else {
		array_push($result_print,$lang['site']['no-result']);
	}
	echo json_encode($result_print);
}

#############################
####                     ####
####    1) Tree Page     ####
####                     ####
#############################

// ** Edit Tree Member --

elseif ($pg == 'tree-edit') {
	$sql = $db->query("SELECT * FROM " . prefix . "members WHERE id = '{$id}'");
	$rs = $sql->fetch_assoc();
	$rs['birthdate'] = $rs['birthdate'] ? date("d/m/Y", $rs['birthdate']) : '';
	$rs['mariagedate'] = $rs['mariagedate'] ? date("d/m/Y", $rs['mariagedate']) : '';
	$rs['deathdate'] = $rs['deathdate'] ? date("d/m/Y", $rs['deathdate']) : '';
	$rs['useredit'] = $rs['user'] != us_name ? true : false;
	
	$rs['photos'] = '';
	$sql_i = $db->query("SELECT * FROM " . prefix . "gallery WHERE membersid = '{$id}' and 	typefile = 'normal_photo'");
	if ($sql_i->num_rows) {
		while ($rs_i = $sql_i->fetch_assoc()) {
			$rs['photos'] .= '<a href="'  . $rs_i['url'] . '" data-lightbox="image-' . $rs_i['id'] . '" data-alt="images-' . $rs_i['membersid'] . '" class="pt-images">
					<img src="' . $rs_i['url'] . '" onerror="this.src=\'' . nophoto . '\'" />
				</a>';
		}
	}
	
	$rs['videos'] = '';
	$sql_i = $db->query("SELECT * FROM " . prefix . "gallery WHERE membersid = '{$id}' and 	typefile = 'video'");
	if ($sql_i->num_rows) {
		while ($rs_i = $sql_i->fetch_assoc()) {
			$rs['videos'] .= '<div class ="image-preview">
									<video controls>
										<source src="' . $rs_i['url'] . '" type="video/mp4">
									</video>
							  </div>';
		}
	}
	
	echo json_encode($rs);
}
elseif($pg=='get_me'){
	echo json_encode(db_get("users", "email", $_GET['id']));
}
// ** Edit Family Details --

elseif ($pg == 'family-edit') {
	$sql = $db->query("SELECT * FROM " . prefix . "families WHERE id = '{$id}'");
	if ($sql->num_rows) {
		$rs = $sql->fetch_assoc();
		// if ($rs['author'] != $lg) {
		// 	$rs = [];
		// }
	}
	echo json_encode($rs);
}

// ** vPass Send --

elseif ($pg == 'vpass-send') {
	$id  = (int)($_POST['id']);
	$vpass  = sc_sec($_POST['vpass']);

	if (empty($vpass)) {
		$alert = ["type" => "danger", "msg" => fh_alerts($lang['alerts']['required'])];
	} else {
		$sql = db_select([
			'table'  => 'families',
			'where'  => 'id = "' . $id . '" && vpassword = "' . sc_pass($vpass) . '"'
		]);
		if ($sql->num_rows) {
			$rs = $sql->fetch_assoc();
			$_SESSION['vpass']  = $rs['id'];
			$alert = ["id" => $rs['id'], "type" => "success", "msg" => fh_alerts($lang['alerts']['login'], "success")];
		} else {
			$alert = ["type" => "danger", "msg" => fh_alerts($lang['alerts']['viewp'])];
		}
	}
	echo json_encode($alert);
}

// ** Heritage Send --

elseif ($pg == 'newheritage') {
	$family  = (int)($_POST['family']);
	$member  = (int)($_POST['member']);
	$heritage  = sc_sec($_POST['heritage']);

	if (!$family || !$member || empty($heritage)) {
		$alert = ["type" => "danger", "msg" => fh_alerts($lang['alerts']['required'])];
	} else {

		$ex_user = explode(',', $heritage);
		foreach ($ex_user as $key => $value) {
			$value = reset(array_filter(preg_split("/\D+/", $value)));
			$value = (int)($value);
			if ($family == $value) {
				$alert = ["type" => "danger", "msg" => fh_alerts("you can herirate the same family!")];
			} elseif (!db_rows("families WHERE id = '{$value}' && author = '" . us_id . "'")) {
				$alert = ["type" => "danger", "msg" => fh_alerts($lang['alerts']['her_1'])];
			} elseif (db_rows("heritage WHERE heritage = '{$value}' && family = '{$family}'")) {
				$alert = ["type" => "danger", "msg" => fh_alerts($lang['alerts']['her_2'])];
			} elseif (db_rows("families WHERE id = '{$value}' && author = '" . us_id . "' && public = '1'")) {
				$alert = ["type" => "danger", "msg" => fh_alerts($lang['alerts']['her_3'])];
			} elseif (db_rows("heritage WHERE heritage = '{$family}' && family = '{$value}'")) {
				$alert = ["type" => "danger", "msg" => fh_alerts($lang['alerts']['her_4'])];
			} else {
				$data = [
					"family"   => "'{$family}'",
					"member"   => "'{$member}'",
					"date"     => "'" . time() . "'",
					"author"   => "'" . us_id . "'",
					"heritage" => "'{$value}'"
				];
				db_insert('heritage', $data);
				$alert = ["type" => "success", "msg" => $lang['alerts']['done']];
			}
		}
	}
	echo json_encode($alert);
}


// ** Delete Tree Member

elseif ($pg == "tree-delete") {
	if ($lg == db_get("members", "author", $id)) {
		db_delete("post", $id, 'membersid');
		db_delete("mapbox", $id, 'membersid');
		db_delete("gallery", $id, 'membersid');
		db_delete("members", $id);
		db_delete("members", $id, "parent");
	}
}


// ** New Member

elseif ($pg == 'send-newmember') {

	include __DIR__ . '/configs/class.upload.php';

	$id = (int)($_POST['id']);
	$nid = (int)($_POST['nid']);
	$photo = sc_sec($_POST['photo']);


	$poll_imgurl = '';

// 	$dir_dest = 'uploads';
// 	$handle = new Upload($_FILES['poll_file']);
// 	if ($handle->uploaded) {

// 		$handle->file_safe_name = true;
// 		$fileNewName = base64_encode($handle->file_src_name_body) . "_" . time();
// 		$handle->file_new_name_body = $fileNewName;

// 		$handle->image_resize          = true;
// 		$handle->image_ratio_crop      = true;
// 		$handle->image_y               = 250;
// 		$handle->image_x               = 250;

// 		$handle->Process($dir_dest);
// 		if ($handle->processed) {
// 			$poll_imgurl = $dir_dest . '/' . $handle->file_dst_name;
// 		} else {
// 			$alert = ["type" => "danger", "msg" => fh_alerts('File not uploaded to the wanted location<br />Error: ' . $handle->error)];
// 		}

// 		$handle->Clean();
// 	} else {
// 		$alert = ["type" => "danger", "msg" => fh_alerts('File not uploaded on the server<br />Error: ' . $handle->error)];
// 	}

	$resultUpload = '';
	if ($_FILES['poll_file']['name']) {
		$infoFile = getimagesize($_FILES['poll_file']['tmp_name']);
		if ($infoFile && ($infoFile['mime'] !== 'image/gif') && ($infoFile['mime'] !== 'image/jpeg') && ($infoFile['mime'] !== 'image/png') && ($infoFile['mime'] !== 'image/jpg')) {
			$alert = ["type" => "danger", "msg" => fh_alerts('File not a gif/jpeg/png/jpg<br />Error: ')];
		} else {
			$handle = $aws3->upload($_FILES['poll_file'], 'avatar-obt');
			$resultUpload = $aws3->getUrl($_FILES['poll_file']['name'], 'avatar-obt');
		}
	}
	
	$photo = ($resultUpload) ? $resultUpload : $photo;

	function fh_strtotime($d)
	{
		return strtotime(str_replace("/", "-", $d));
	}


	$gender      = (isset($_POST['gender']) ? (int)($_POST['gender']) : 0);
	$type        = (isset($_POST['type']) ? (int)($_POST['type']) : 0);
	$death       = (isset($_POST['death']) ? 1 : 0);

	$firstname   = isset($_POST['firstname']) ? sc_sec($_POST['firstname']) : '';
	$lastname    = isset($_POST['lastname']) ? sc_sec($_POST['lastname']) : '';
	$birthdate   = isset($_POST['birthdate']) ? (int)(fh_strtotime(sc_sec($_POST['birthdate']))) : 0;
	$mariagedate = isset($_POST['mariagedate']) ? (int)(fh_strtotime(sc_sec($_POST['mariagedate']))) : 0;
	$deathdate   = isset($_POST['deathdate']) ? (int)(fh_strtotime(sc_sec($_POST['deathdate']))) : 0;
	$longitude    = isset($_POST['longitude']) ? sc_sec($_POST['longitude']) : '';
	$latitude    = isset($_POST['latitude']) ? sc_sec($_POST['latitude']) : '';
	$photo       = isset($photo) ? $photo : '';
	$facebook    = isset($_POST['facebook']) ? sc_sec($_POST['facebook']) : '';
	$instagram   = isset($_POST['instagram']) ? sc_sec($_POST['instagram']) : '';
	$twitter     = isset($_POST['twitter']) ? sc_sec($_POST['twitter']) : '';
	$email       = isset($_POST['email']) ? sc_sec($_POST['email']) : '';
	$site        = isset($_POST['site']) ? sc_sec($_POST['site']) : '';
	$tel         = isset($_POST['tel']) ? sc_sec($_POST['tel']) : '';
	$mobile      = isset($_POST['mobile']) ? sc_sec($_POST['mobile']) : '';
	$birthplace  = isset($_POST['birthplace']) ? sc_sec($_POST['birthplace']) : '';
	$deathplace  = isset($_POST['deathplace']) ? sc_sec($_POST['deathplace']) : '';
	$profession  = isset($_POST['profession']) ? sc_sec($_POST['profession']) : '';
	$company     = isset($_POST['company']) ? sc_sec($_POST['company']) : '';
	$interests   = isset($_POST['interests']) ? sc_sec($_POST['interests']) : '';
	$bio         = isset($_POST['bio']) ? sc_sec($_POST['bio']) : '';
	$muser       = isset($_POST['user']) ? sc_sec($_POST['user']) : '';
	$avatar      = isset($_POST['avatar']) ? sc_sec($_POST['avatar']) : '';
	$ex_user = explode(',', $muser);
	$mm = '';
	foreach ($ex_user as $key => $value) {
		if (db_rows("users WHERE username = '" . sc_sec($value) . "'")) {
			$mm = sc_sec($value);
		}
	}

	$navatar = '';
	if (!empty($avatar)) $navatar = $avatar ? "images/avatar/{$avatar}.jpg" : '';
	if (!empty($photo)) $photo  = $navatar  ? $navatar : $photo;

	$photo  = $navatar  ? $navatar : $photo;


	$data = [
		"firstname"  => "'" . $firstname . "'",
		"lastname"   => "'" . $lastname . "'",
		"gender"     => "'" . $gender . "'",
		"birthdate"  => "'" . $birthdate . "'",
		"mariagedate" => "'" . $mariagedate . "'",
		"deathdate"  => "'" . $deathdate . "'",
		"longitude"  => "'" . $longitude . "'",
		"latitude"  => "'" . $latitude . "'",
		"type"       => "'" . $type . "'",
		"death"      => "'" . $death . "'",
		"photo"      => "'" . $photo . "'",
		"facebook"   => "'" . $facebook . "'",
		"instagram"  => "'" . $instagram . "'",
		"twitter"    => "'" . $twitter . "'",
		"email"      => "'" . $email . "'",
		"site"       => "'" . $site . "'",
		"tel"        => "'" . $tel . "'",
		"mobile"     => "'" . $mobile . "'",
		"birthplace" => "'" . $birthplace . "'",
		"deathplace" => "'" . $deathplace . "'",
		"profession" => "'" . $profession . "'",
		"company"    => "'" . $company . "'",
		"interests"  => "'" . $interests . "'",
		"bio"        => "'" . $bio . "'"
	];



	if ($id) {
		if (db_get('members', 'user', $id) != us_name) {
			$data["user"] = "'" . $mm . "'";
		}
		db_update('members', $data, $id);
	} else {
		$data["user"] = "'" . $mm . "'";
		$get_parent = (int)($_POST['parent']);
		$get_family = db_get('members', 'family', $get_parent);
		$data["parent"] = ($nid ? "'0'" : "'" . $get_parent . "'");
		$data["family"] = ($nid ? "'" . $get_parent . "'" : "'" . $get_family . "'");
		$data["author"] = "'" . $lg . "'";
		$data["date"] = "'" . time() . "'";

		$data["parent"] = ($type == 4 ? (!db_get('members', 'parent', $get_parent) ? 0 : 1) : $data["parent"]);

		db_insert('members', $data);
		echo print_r($data, true);

		if ($type == 4) {
			if (!db_get('members', 'parent', $get_parent)) {
				db_update('members', ['type' => 1, 'parent' => "'" . db_get("members", "id", $firstname, 'firstname', 'ORDER BY id DESC LIMIT 1') . "'"], str_replace("'", '', $get_parent));
			}
		}
	}

	foreach ($ex_user as $key => $value) {
		if (db_rows("users WHERE username = '" . sc_sec($value) . "'")) {
			$nuser = db_get("users", "id", sc_sec($value), "username");
			$item = $id ? $id : db_get("members", "id", $firstname, "firstname", "&& family = '{$get_family}'");
			if (!db_rows("notifications WHERE user = '{$nuser}' && item = '{$item}'"))
				db_insert('notifications', ['author' => "'{$lg}'", 'user' => "'{$nuser}'", 'date' => "'" . time() . "'", 'item' => "'{$item}'", 'type' => "'member'"]);
		}
	}

	if (isset($_POST['images_tmp'])) {
		echo print_r($_POST['images_tmp'], true);
		foreach ($_POST['images_tmp'] as $key => $val) {
			$ff = sc_sec($val);
			if (file_exists(__DIR__ . '/' . $ff)) {
				$answer_i_rename = 'uploads/users/' . sc_folderName(us_name) . str_replace('uploads-temp', '', $ff);
				newImgFolder(__DIR__ . '/uploads/users/' . sc_folderName(us_name));
				rename($ff, $answer_i_rename);
				$mma = ($id ? $id : db_get("members", "id", $get_family, 'family', 'ORDER BY id DESC LIMIT 1'));
				db_insert('images', [
					"family" => "'" . (int)($get_family) . "'",
					"date"   => "'" . time() . "'",
					"member" => "'" . $mma . "'",
					"url"    => "'" . $answer_i_rename . "'"
				]);
			}
		}
	}
	
		//update 08/2022
	if (isset($_FILES['images_member'])) {
		$removeImage = ($_POST['image_remove'] != "") ? explode(",", $_POST['image_remove']) : [];
		$memberId = ($id ? $id : db_get("members", "id", $get_family, 'family', 'ORDER BY id DESC LIMIT 1'));
		$lenghtImage = count($_FILES['images_member']['name']);

		$post = db_insert('post', [
			"membersid " => $memberId,
			"title"   => "'Thêm " . $lenghtImage . " ảnh mới '",
		]);
		
		$idPost = mysqli_insert_id($db);

		for ($i=0; $i < $lenghtImage; $i++) {
			if (!in_array($i, $removeImage)) {
				$pathFile = 'ongbata_pf/' . $_FILES['images_member']['name'][$i];
				$handle = $aws3->uploadWithTmpFile($_FILES['images_member']['tmp_name'][$i], $pathFile);
				
				if ($handle === true) {
					$resultUpload = $aws3->getUrl($_FILES['images_member']['name'][$i], "ongbata_pf");

					db_insert('gallery', [
						"postid" => $idPost,
						"membersid "   => $memberId,
						"url" => "'" . $resultUpload . "'",
						"typefile"    => "'normal_photo'",
					]);
				}
			}
		}
	}

	//end update 08/2022
	
	$ror = '';
	if (!empty($muser)) {
		if (db_count("members WHERE user = '{$muser}'")>0) {
			$ror ='error_me';
		}else{
			$user_up = new Updata;
			$table_name =  prefix."members";
			$column_user = 'user ="'.$muser.'"';
			$condition_update = ' Where id='.$id;
			$user_up->updatedata($table_name, $column_user,$condition_update,$db);
		}
		
	}
	echo $ror;
    // 	test thế hệ
  
    
    	find_parent($_POST['id_fam'],$db,new Getdata,new Updata);
	
}

// ** Family Details

elseif ($pg == 'family-details') {

	$name   = sc_sec($_POST['name']);
	$email = (isset($_POST['email']) ? sc_sec($_POST['email']) : '');
	$vpass  = (isset($_POST['vpass']) ? sc_sec($_POST['vpass']) : '');
	$moderators  = sc_sec($_POST['planets']);
	$check  = (isset($_POST['check']) ? 0 : 0);
	$public = (!fh_access('private') ? 0 : $check);
	$famid  = (isset($_POST['famid']) ? (int)($_POST['famid']) : 0);

	if (empty($name)) {
		$alert = ["type" => "danger", "msg" => $lang['alerts']['name']];
	} elseif (db_rows("families WHERE name = '{$name}'") && !$famid) {
		$alert = ["type" => "danger", "msg" => $lang['alerts']['famexist']];
	} elseif ($famid && !db_rows("families WHERE id = '{$famid}' ")) {
		$alert = ["type" => "danger", "msg" => $lang['alerts']['wrong']];
	} else {

		$ex_mod = explode(',', $moderators);
		$mm = [];
		foreach ($ex_mod as $key => $value) {
			// if (db_rows("users WHERE email = '" . sc_sec($value) . "'")) {
				$mm[] = sc_sec($value);
			// }
		}

		$data = [
			"name"       => "'{$name}'",
			"moderators" => "'" . implode(',', $mm) . "'",
			"public"     => "'" . $public . "'"
		];

		if ($vpass) {
			$data['vpassword'] = "'" . sc_pass($vpass) . "'";
		}

		if ($famid) {
			db_update('families', $data, $famid);
			
			require_once './vendor/autoload.php';


			$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
					->setUsername('toidayhoc@datdia.com')
					->setPassword('foaymnejscmzaqwq');
			
				// Create the Mailer using your created Transport
				$mailer = new Swift_Mailer($transport);
			
				// Create a message
				$message = new Swift_Message();
			
			$message->setSubject('Thư mời email dùng gia phả Ongbata');

			// Set the "From address"
			$message->setFrom(['toidayhoc@datdia.com' => 'Phần mềm gia phả Ongbata']);

			// Set the "To address" [Use setTo method for multiple recipients, argument should be array]
			$message->addTo('toidayhoc@datdia.com', 'recipient name');

			// Add "CC" address [Use setCc method for multiple recipients, argument should be array]
			// $message->addCc('toidayhoc', 'recipient name');

			// Add "BCC" address [Use setBcc method for multiple recipients, argument should be array]
			// $message->addBcc('', 'recipient name');

			// Add an "Attachment" (Also, the dynamic data can be attached)
			// $attachment = Swift_Attachment::fromPath('example.xls');
			// $attachment->setFilename('report.xls');
			// $message->attach($attachment);

			// // Add inline "Image"
			// $inline_attachment = Swift_Image::fromPath('nature.jpg');
			// $cid = $message->embed($inline_attachment);

			// Set the plain-text "Body"
			$listemail = json_encode($mm);
			$body_mail = '
					'. $name .', '. $email .', Danh sách mail cần gửi mời dùng gia phả
					'. $listemail .'
					
					';
			$html    = "{$body_mail}";
			$message->setBody($html, 'text/html');

			// Set a "Body"

			// Send the message
			$result = $mailer->send($message);
			$alert = ["type" => "success", "msg" => $lang['alerts']['done']];
		} else {
			$data['date'] = "'" . time() . "'";
			$data['author'] = "'" . $lg . "'";
			db_insert('families', $data);
			
			

		}

		foreach ($ex_mod as $key => $value) {
			if (db_rows("users WHERE username = '" . sc_sec($value) . "'")) {
				$nuser = db_get("users", "id", sc_sec($value), "username");
				$item = $famid ? $famid : db_get("families", "id", $name, "name");
				if (!db_rows("notifications WHERE user = '{$nuser}' && item = '{$item}'"))
					db_insert('notifications', ['author' => "'{$lg}'", 'user' => "'{$nuser}'", 'date' => "'" . time() . "'", 'item' => "'{$item}'", 'type' => "'moderator'"]);
			}
		}

		$alert = ["type" => "success", "msg" => $lang['alerts']['done']];
	}
	echo json_encode($alert);
}


// ** Upload photos

elseif ($pg == "upload") {

	include __DIR__ . '/configs/class.upload.php';

	$output = [];

	if (isset($_FILES['images'])) {
		$files = [];
		foreach ($_FILES['images'] as $k => $l) {
			foreach ($l as $i => $v) {
				if (!array_key_exists($i, $files))
					$files[$i] = array();
				$files[$i][$k] = $v;
			}
		}

		$paths = [];
		$file_output = [];
		$i = 0;
		foreach ($files as $file) {
			$handle = new Upload($file);
			if ($handle->uploaded) {
				$handle->allowed            = array('image/jpeg', 'image/jpg', 'image/gif', 'image/png', 'image/bmp');
				$handle->file_new_name_body = md5(uniqid());
				$handle->Process(__DIR__ . '/uploads-temp/');
				if ($handle->processed) {
					$file_output[$i]['message'] = 'OK';
					$file_output[$i]['success'] = true;
					$file_output[$i]['path']    = "uploads-temp" . DIRECTORY_SEPARATOR . $handle->file_dst_name;
					$file_output[$i]['name']    = $handle->file_src_name_body;
					$paths[]               = "uploads-temp" . DIRECTORY_SEPARATOR . $handle->file_dst_name;
				} else {
					$output[$i]['message'] = 'Error: ' . $handle->error;
					$output[$i]['success'] = false;
					$output[$i]['path']    = '';
					$output[$i]['name']    = '';
				}
			} else {
				$output[$i]['message'] = 'Error: ' . $handle->error;
				$output[$i]['success'] = false;
				$output[$i]['path']    = '';
				$output[$i]['name']    = '';
			}
			unset($handle);
			$i++;
		}
	}

	$output['file_output'] = $file_output;
	$output['paths'] = $paths;
	echo json_encode($output);
}





#############################
####                     ####
####    2) User Page     ####
####                     ####
#############################

// ** Send User Registration --

elseif ($pg == 'user-send') {
	$name  = sc_sec($_POST['name']);
	$pass  = sc_sec($_POST['pass']);
	$email = sc_sec(strtolower($_POST['email']));
// 	$mobile  = sc_sec($_POST['mobile']);

if (empty($name) || empty($pass) || empty($email)) {
	$alert = ["type" => "danger", "msg" => $lang['alerts']['required']];
} elseif (!check_email($email)) {
	$alert = ["type" => "danger", "msg" => $lang['alerts']['correctemail']];
} elseif (db_rows("users WHERE email = '{$email}'")) {
	$alert = ["type" => "danger", "msg" => $lang['alerts']['existemail']];
} elseif (db_rows("users WHERE username = '{$name}'")) {
	$alert = ["type" => "danger", "msg" => $lang['alerts']['existusername']];
} 
// 	elseif (db_rows("users WHERE mobile = '{$mobile}'")) {
	// 		$alert = ["type" => "danger", "msg" => 'Số điện thoại đã tồn tại, hãy bấm vào mục quên mật khẩu'];
	// 	}
	else {
		
		$token     = bin2hex(openssl_random_pseudo_bytes(16));
		$reset_url = path . "/email-verification.php?action=reset&token=" . $token . "&t=" . sha1($email);

		$data = [
			"username"     => "'" . sc_sec($_POST['name']) . "'",
			"password" => "'" . sc_pass(sc_sec($_POST['pass'])) . "'",
			"date"     => "'" . time() . "'",
			"status"     => "'" . site_register . "'",
			"token"     => "'{$token}'",
			"email"    => "'" . sc_sec(strtolower($_POST['email'])) . "'",
			"email"    => "'" . sc_sec(strtolower($_POST['email'])) . "'",
			"blood_id"    => "'" . 0 . "'",
			"number_submissions_blood"    => "'" . 0 . "'",
			"longitude"    => "''",
			"latitude"    => "''",
			// 			"mobile"     => "'" . sc_sec($_POST['mobile']) . "'"
		];
		
		if (!db_rows("users")) {
			$data['level'] = "'6'";
		}

		if (!site_register) {
			$alert = ["type" => "success", "msg" => $lang['alerts']['regsuccess']];
		} elseif (site_register == 2) {
			include __DIR__ . '/configs/mail.php';

			$to      = $email;
			$from    = do_not_reply;
			$subject = "Email Verification";
			$body    = "";
			$html    = fh_email_tmp($name, $to, $reset_url);
			$mail    = new Mail($to, $from, $subject, $body, $html);

			if ($mail->send()) {
				$alert = ["type" => "success", "msg" => $lang['alerts']['regsuccess1']];
			}
		} else {
			$alert = ["type" => "success", "msg" => $lang['alerts']['regsuccess2']];
		}

		db_insert('users', $data);
	}
	echo json_encode($alert);
}

// ** Send User Edit Details --

elseif ($pg == 'user-send-details') {
	$name  = sc_sec($_POST['name']);
	$pass  = sc_sec($_POST['pass']);
	$email = sc_sec(strtolower($_POST['email']));
	$photo = sc_sec($_POST['reg_photo']);
	$mobile = sc_sec($_POST['mobile']);
	$plan = sc_sec($_POST['plan']);
	$reg_uid = sc_sec($_POST['reg_id']);
	var_dump($_POST);

	$u_id = ($reg_uid && us_level == 6 ? $reg_uid : us_id);

	$u_name = ($reg_uid && us_level == 6 ? $name : us_name);
	$u_email = ($reg_uid && us_level == 6 ? $email : us_email);
	$u_mobile = ($reg_uid && us_level == 6 ? $mobile : us_mobile);
	$u_plan = ($reg_uid && us_level == 6 ? $plan : us_plan);


	if (empty($name) || empty($email)) {
		$alert = ["type" => "danger", "msg" => $lang['alerts']['required']];
	} elseif (!check_email($email)) {
		$alert = ["type" => "danger", "msg" => $lang['alerts']['correctemail']];
	} elseif ($u_email != $email && db_rows("users WHERE email = '{$email}'")) {
		$alert = ["type" => "danger", "msg" => $lang['alerts']['existemail']];
	} elseif ($u_name != $name && db_rows("users WHERE username = '{$name}'")) {
		$alert = ["type" => "danger", "msg" => $lang['alerts']['existusername']];
	} else {
		$data = [
			"username" => "'" . sc_sec($_POST['name']) . "'",
			"updated_at" => "'" . time() . "'",
			"photo"     => "'{$photo}'",
			"email"    => "'" . sc_sec(strtolower($_POST['email'])) . "'",
			"mobile"    => "'" . sc_sec($_POST['mobile']) . "'",
			"plan"    => "'" . sc_sec($_POST['plan']) . "'",
		];
		if ($pass) {
			$data['password'] = "'" . sc_pass(sc_sec($_POST['pass'])) . "'";
		}
		db_update('users', $data, $u_id);
		$alert = ["type" => "success", "msg" => $lang['alerts']['famsuccess']];
	}
	echo json_encode($alert);
}


// ** Login

elseif ($pg == 'login-send') {
    $nameuser  = sc_sec($_POST['name']);
// 	$phoneuser = sc_sec($_POST['numberphone']);
	if(!empty($nameuser))
	{
		$name = $nameuser;
	}
// 	else{
// 		$name = $phoneuser;
// 	}
	$pass  = sc_sec($_POST['pass']);

	if (empty($name) || empty($pass)) {
		$alert = ["type" => "danger", "msg" => "All fields are required!"];
	} else {
		if (db_rows('users WHERE username = "' . $name . '" || email = "' . $name . '" || mobile = "' . $name . '"')) {
			$sql = db_select([
				'table'  => 'users',
				'where'  => '(username = "' . $name . '" || email = "' . $name . '" || mobile = "' . $name . '") && password = "' . sc_pass($pass) . '"'
			]);
			if ($sql->num_rows) {
				$rs = $sql->fetch_assoc();
				if ($rs['status'] == 0) {
				    // 	$_SESSION['login']  = $rs['id'];
				    setcookie('login', $rs['id'], time() + (86400 * 3600), "/");
				    setcookie('pass', $rs['password'], time() + (86400 * 3600), "/");
					$alert = ["id" => $rs['id'], "type" => "success", "msg" => $lang['alerts']['logsuccess']];
				} elseif ($rs['status'] == 1) {
					$alert = ["id" => $rs['id'], "type" => "success", "msg" => $lang['alerts']['logapprov']];
				} else {
					$alert = ["id" => $rs['id'], "type" => "success", "msg" => $lang['alerts']['logverif']];
				}
			} else {
				$alert = ["type" => "danger", "msg" => $lang['alerts']['logerror']];
			}
		} else {
			$alert = ["type" => "danger", "msg" => $lang['alerts']['logerror']];
		}
	}
	echo json_encode($alert);
}

// ** login facebook 
elseif($pg == 'send-facebook-login'){
	$userData = json_decode($_POST['checkuser']); 
	$lastname  = $userData->last_name;
	$fistname  = $userData->first_name;
	$email = $userData->email;
	$id_app  = $userData->id;

	if (empty($lastname&&$fistname) || empty($email)) {
		$alert = ["type" => "danger", "msg" => "All fields are required!"];
	} else {
		if (db_rows('users WHERE username = "' . $lastname .$fistname. '" || email = "' . $email. '"')) {
			$sql = db_select([
				'table'  => 'users',
				'where'  => '(username = "' . $lastname .$fistname. '" || email = "' . $email . '")'
			]);
			if ($sql->num_rows) {
				$rs = $sql->fetch_assoc();
				if ($rs['status'] == 0) {
				    // 	$_SESSION['login']  = $rs['id'];
				    setcookie('login', $rs['id'], time() + (86400 * 3600), "/");
				    setcookie('pass', $rs['password'], time() + (86400 * 3600), "/");
					$alert = ["id" => $rs['id'], "type" => "success", "msg" => $lang['alerts']['logsuccess']];
				} 
				elseif ($rs['status'] == 1) {
					$alert = ["id" => $rs['id'], "type" => "success", "msg" => $lang['alerts']['logapprov']];
				} else {
					$alert = ["id" => $rs['id'], "type" => "success", "msg" => $lang['alerts']['logverif']];
				}
			} else {
				$alert = ["type" => "danger", "msg" => $lang['alerts']['logerror']];
			}
		} else {
			$alert = ["type" => "danger", "msg" => $lang['alerts']['logerror']];
		}
	}
	echo json_encode($alert);
}




// ** login google
elseif($pg == 'send-google-login'){
		$userDataGoogle = json_decode($_POST['checkdatagoogle']); 
		$first_name = $userDataGoogle->given_name;
		$last_name  = $userDataGoogle->family_name;
		$email      = $userDataGoogle->email;
// 		$oauth_uid  = $_POST['id_google'];
		
	if (empty($last_name&&$first_name) || empty($email)) {
		$alert = ["type" => "danger", "msg" => "All fields are required!"];
	} else {
		if (db_rows('users WHERE username = "'.$last_name.$first_name.'" || email = "'.$email.'"')) {
			$sql = db_select([
				'table'  => 'users',
				'where'  => '(username = "'.$last_name.$first_name.'" || email = "'.$email.'")'
			]);
		
			if ($sql->num_rows) {
				$rs = $sql->fetch_assoc();
				if ($rs['status'] == 0) {
				    // 	$_SESSION['login']  = $rs['id'];
				    setcookie('login', $rs['id'], time() + (86400 * 3600), "/");
				    setcookie('pass', $rs['password'], time() + (86400 * 3600), "/");
					$alert = ["id" => $rs['id'], "type" => "success", "msg" => $lang['alerts']['logsuccess']];
				} 
				elseif ($rs['status'] == 1) {
					$alert = ["id" => $rs['id'], "type" => "success", "msg" => $lang['alerts']['logapprov']];
				} else {
					$alert = ["id" => $rs['id'], "type" => "success", "msg" => $lang['alerts']['logverif']];
				}
			} else {
				$alert = ["type" => "danger", "msg" => $lang['alerts']['logerror']];
				
			}
		} else {
			$alert = ["type" => "danger", "msg" => $lang['alerts']['logerror']];
		}
	}
	echo json_encode($alert);
}

// ** login numberphone otp
elseif ($pg == 'login-numberphone') {
	$numberphone = sc_sec($_POST['numberphone']);
	if (empty($numberphone)) {
		// $alert = ["type" => "danger", "msg" => "All fields are required!"];
	} else {
		if (db_rows('users WHERE  mobile = "'.$numberphone.'"')) {
			$sql = db_select([
				'table'  => 'users',
				'where'  => 'mobile = "'.$numberphone.'"'
			]);
			if ($sql->num_rows) {
				$rs = $sql->fetch_assoc();
				if ($rs['status'] == 0) {
				    // 	$_SESSION['login']  = $rs['id'];
				    setcookie('login', $rs['id'], time() + (86400 * 3600), "/");
				    setcookie('pass', $rs['password'], time() + (86400 * 3600), "/");
					$alert = ["id" => $rs['id'], "type" => "success", "msg" => $lang['alerts']['logsuccess']];
				} elseif ($rs['status'] == 1) {
					$alert = ["id" => $rs['id'], "type" => "success", "msg" => $lang['alerts']['logapprov']];
				} else {
					$alert = ["id" => $rs['id'], "type" => "success", "msg" => $lang['alerts']['logverif']];
				}
			} else {
				$alert = ["type" => "danger", "msg" => $lang['alerts']['logerror']];
			}
		} else {
			$alert = ["type" => "danger", "msg" => $lang['alerts']['logerror']];
		}
	}
	echo json_encode($alert);
}

// ** Logout

elseif ($pg == "logout") {
    setcookie('login', '', -1, '/');
    setcookie('pass', '', -1, '/');
// 	session_unset();
// 	session_destroy();
}

// ** Uplaod Image User Details

elseif ($pg == 'imageupload') {
	if (us_level) {
		include __DIR__ . '/configs/class.upload.php';
		$imgurl = '';
		$dir_dest = 'uploads';

		$handle = new Upload($_FILES['file']);
		if ($handle->uploaded) {
			$handle->file_safe_name = true;
			$fileNewName = base64_encode($handle->file_src_name_body) . "_" . time();
			$handle->file_new_name_body = $fileNewName;

			$handle->image_resize          = true;
			$handle->image_ratio_crop      = true;
			$handle->image_y               = 250;
			$handle->image_x               = 250;

			$handle->process($dir_dest);
			if ($handle->processed) {
				$imgurl = $dir_dest . '/' . $handle->file_dst_name;
			} else {
			}
			$handle->clean();
		}

		echo path . "/" . $imgurl;
	}
}




#############################
####                     ####
####    2) Admin Page    ####
####                     ####
#############################

elseif ($pg == 'adminstats') {
	if (us_level == 6) {
		$aa = [];
		if ($request == "daily") {
			$start = new DateTime('now');
			$end = new DateTime('- 7 day');
			$diff = $end->diff($start);
			$interval = DateInterval::createFromDateString('-1 day');
			$period = new DatePeriod($start, $interval, $diff->days);

			foreach ($period as $date) {
				$aa['data'][] = db_rows("families WHERE FROM_UNIXTIME(date,'%m-%d-%Y') = '" . $date->format('m-d-Y') . "'");
				$aa['labels'][] = $date->format('M d');
			}

			$aa['data'] = array_reverse($aa['data']);
			$aa['labels'] = array_reverse($aa['labels']);
			$aa['title'] = "Families " . $lang['dashboard']['stats_line_d'];
		} elseif ($request == "monthly") {
			$aa = [];
			for ($i = 1; $i <= 12; $i++) {
				$aa['data'][] = db_rows("families WHERE MONTH(FROM_UNIXTIME(date)) = '{$i}'");
				$aa['labels'][] = date('F', mktime(0, 0, 0, $i, 10));
			}
			$aa['title'] = "Families " . $lang['dashboard']['stats_line_m'];
		}
		echo json_encode($aa);
	}
} elseif ($pg == 'adminstatsbars') {
	if (us_level == 6) {
		$aa = [];
		if ($request == "daily") {
			$start = new DateTime('now');
			$end = new DateTime('- 7 day');
			$diff = $end->diff($start);
			$interval = DateInterval::createFromDateString('-1 day');
			$period = new DatePeriod($start, $interval, $diff->days);

			foreach ($period as $date) {
				$aa['data'][] = db_rows("users WHERE FROM_UNIXTIME(date,'%m-%d-%Y') = '" . $date->format('m-d-Y') . "'");
				$aa['labels'][] = $date->format('M d');
				$colors = randomColor();
				$aa['colors'][] = "#" . $colors['hex'];
			}

			$aa['data'] = array_reverse($aa['data']);
			$aa['labels'] = array_reverse($aa['labels']);
			$aa['title'] = "Users " . $lang['dashboard']['stats_line_d'];
		} elseif ($request == "monthly") {
			$aa = [];
			for ($i = 1; $i <= 12; $i++) {
				$aa['data'][] = db_rows("users WHERE MONTH(FROM_UNIXTIME(date)) = '{$i}'");
				$aa['labels'][] = date('F', mktime(0, 0, 0, $i, 10));
				$colors = randomColor();
				$aa['colors'][] = "#" . $colors['hex'];
			}
			$aa['title'] = "Users " . $lang['dashboard']['stats_line_m'];
		}
		echo json_encode($aa);
	}
} elseif ($pg == 'tree-addpar') {
	$id_fam_mem = db_get("members", "family", $id);
	if ($id_fam_mem == $_GET['id_fam']) {
		echo db_get("members", "parent", $id);
	}else{
		echo '';
	}
} elseif ($pg == 'sendlanguage') {

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && us_level == 6) {

		$pg_lang = $_POST['lang'];

		$langs   = $lang;
		$lang    = $pg_lang;
		$langsec = [];

		function _ff($str)
		{
			$str = str_replace("'", "&apos;", $str);
			return $str;
		}

		$i = 0;
		foreach ($langs as $key => $value) {
			if (is_array($value)) {

				foreach ($value as $k => $v) {
					if (is_array($v)) {
						foreach ($v as $kk => $vv) {
							if (is_array($vv)) {
								foreach ($vv as $kkk => $vvv) {
									$langsec[$key][$k][$kk][$kkk] = sc_sec(_ff($lang[$key][$k][$kk][$kkk]));
								}
							} else {
								$langsec[$key][$k][$kk] = sc_sec(_ff($lang[$key][$k][$kk]));
							}
						}
					} else {
						$langsec[$key][$k] = sc_sec(_ff($lang[$key][$k]));
					}
				}
			} else {
				$langsec[$key] = sc_sec(_ff($lang[$key]));
			}
		}


		db_update_global('site_language', json_encode($langsec, JSON_UNESCAPED_UNICODE));


		$alert = [
			'type'  => 'success',
			'alert' => ($lang['dashboard']['alert']['success'])
		];


		echo json_encode($alert);
	}
} elseif ($pg == 'sendsettings') {

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && us_level == 6) {

		$pg_title         = sc_sec($_POST['site_title']);
		$pg_description   = sc_sec($_POST['site_description']);
		$pg_keywords      = sc_sec($_POST['site_keywords']);
		$pg_url           = sc_sec($_POST['site_url']);
		$pg_reg_status    = isset($_POST['reg_status']) ? (int)($_POST['reg_status']) : 0;
		$pg_site_r_status = isset($_POST['site_register_status']) ? (int)($_POST['site_register_status']) : 0;
		$pg_site_f_status = isset($_POST['site_families_status']) ? (int)($_POST['site_families_status']) : 0;
		$pg_color1           = sc_sec($_POST['color1']);
		$pg_color2           = sc_sec($_POST['color2']);
		$pg_color2           = sc_sec($_POST['color2']);
		$pg_color3           = sc_sec($_POST['color3']);
		$pg_color4           = sc_sec($_POST['color4']);
		$pg_color5           = sc_sec($_POST['color5']);
		$pg_color6           = sc_sec($_POST['color6']);
		$pg_color7           = sc_sec($_POST['color7']);
		$pg_color9           = sc_sec($_POST['color9']);
		$pg_color8           = sc_sec($_POST['color8']);
		$pg_color10           = sc_sec($_POST['color10']);
		$site_ads1           = $db->real_escape_string($_POST['site_ads1']);


		$site_paypal_live          = isset($_POST['site_paypal_live']) ? (int)($_POST['site_paypal_live']) : 0;
		$site_paypal_id            = sc_sec($_POST['site_paypal_id']);
		$site_paypal_client_id     = sc_sec($_POST['site_paypal_client_id']);
		$site_paypal_client_secret = sc_sec($_POST['site_paypal_client_secret']);
		$site_currency_name        = sc_sec($_POST['site_currency_name']);
		$site_currency_symbol      = sc_sec($_POST['site_currency_symbol']);

		if (empty($pg_title)) {
			$alert = [
				'type'  => 'danger',
				'alert' => 'title is required'
			];
		} else {
			db_update_global('site_title', $pg_title);
			db_update_global('site_description', $pg_description);
			db_update_global('site_keywords', $pg_keywords);
			db_update_global('site_url', $pg_url);
			db_update_global('site_register', $pg_reg_status);
			db_update_global('site_register_status', $pg_site_r_status);
			db_update_global('site_families_status', $pg_site_f_status);
			db_update_global('color1', $pg_color1);
			db_update_global('color2', $pg_color2);
			db_update_global('color2', $pg_color2);
			db_update_global('color3', $pg_color3);
			db_update_global('color4', $pg_color4);
			db_update_global('color5', $pg_color5);
			db_update_global('color6', $pg_color6);
			db_update_global('color7', $pg_color7);
			db_update_global('color9', $pg_color9);
			db_update_global('color8', $pg_color8);
			db_update_global('color10', $pg_color10);
			db_update_global('site_ads1', $site_ads1);


			db_update_global('site_paypal_live', $site_paypal_live);
			db_update_global('site_paypal_id', $site_paypal_id);
			db_update_global('site_paypal_client_id', $site_paypal_client_id);
			db_update_global('site_paypal_client_secret', $site_paypal_client_secret);
			db_update_global('site_currency_name', $site_currency_name);
			db_update_global('site_currency_symbol', $site_currency_symbol);

			$alert = [
				'type'  => 'success',
				'alert' => ($lang['dashboard']['alert']['success'])
			];
		}
		echo json_encode($alert);
	}
} elseif ($pg == 'sendplans') {

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && us_level == 6) {
		$site_plans = isset($_POST['site_plans']) ? 1 : 0;

		for ($x = 1; $x <= 4; $x++) {
			$sql = $db->query("DESCRIBE " . prefix . "plans");
			while ($row = $sql->fetch_array()) {
				if ($row['Field'] != 'id') {
					if ($row['Type'] == "tinyint(1)") {
						$vv = isset($_POST[$row['Field']][$x]) ? 1 : 0;
					} elseif ($row['Type'] == "int(11)") {
						$vv = isset($_POST[$row['Field']][$x]) ? (int)($_POST[$row['Field']][$x]) : 0;
					} else {
						$vv = isset($_POST[$row['Field']][$x]) ? sc_sec($_POST[$row['Field']][$x]) : '';
					}
					db_update("plans", ["{$row['Field']}" => "'$vv'"], $x);
				}
			}
		}

		db_update_global('site_plans', $site_plans);

		$alert = [
			'type'  => 'success',
			'alert' => ($lang['dash']['planalert'])
		];

		echo json_encode($alert);
	}
} elseif ($pg == 'sendpage') {

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && us_level == 6) {

		$pg_title     = sc_sec($_POST['pg_title']);
		$pg_content   = sc_sec($_POST['pg_content']);
		$pg_icon      = sc_sec($_POST['pg_icon']);
		$pg_header    = isset($_POST['pg_header']) ? 1 : 0;
		$pg_id    = isset($_POST['pg_id']) ? (int)($_POST['pg_id']) : 0;

		if (empty($pg_title) || empty($pg_content)) {
			$alert = [
				'type'  => 'danger',
				'alert' => 'title and content are required'
			];
		} else {
			$data = [
				'icon' => "'{$pg_icon}'",
				'title' => "'{$pg_title}'",
				'content' => "'{$pg_content}'",
				'header' => "'{$pg_header}'",
				'date'  => "'" . time() . "'"
			];
			if ($pg_id) {
				db_update('pages', $data, $pg_id);
			} else {
				db_insert('pages', $data);
			}


			$alert = [
				'type'  => 'success',
				'alert' => $lang['alerts']['done']
			];
		}
		echo json_encode($alert);
	}
} elseif ($pg == 'sendpaypalplan') {

	include __DIR__ . '/sendpaypalplan.php';
} elseif ($pg == 'userstatus') {

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && us_level == 6) {

		$pg_user     = sc_sec($_POST['value']);
		$pg_status   = sc_sec($_POST['status']);

		if (!db_rows("users WHERE id = '{$pg_user}'")) {
			$alert = [
				'type'  => 'danger',
				'alert' => 'this user isnt exist'
			];
		} else {

			$status = $pg_status == 'true' ? 0 : 1;

			db_update('users', ["status" => "'{$status}'"], $pg_user);


			$alert = [
				'type'  => 'success',
				'alert' => $lang['alerts']['done']
			];
		}
		echo json_encode($alert);
	}
} elseif ($pg == 'familystatus') {

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && us_level == 6) {

		$pg_user     = sc_sec($_POST['value']);
		$pg_status   = sc_sec($_POST['status']);

		if (!db_rows("families WHERE id = '{$pg_user}'")) {
			$alert = [
				'type'  => 'danger',
				'alert' => 'this family isnt exist'
			];
		} else {

			$status = $pg_status == 'true' ? 0 : 1;

			db_update('families', ["status" => "'{$status}'"], $pg_user);


			$alert = [
				'type'  => 'success',
				'alert' => $lang['alerts']['done']
			];
		}
		echo json_encode($alert);
	}
} elseif ($pg == 'delete') {

	if (us_level == 6) {
		db_delete($request, $id);
		if ($request == "families")
			db_delete("members", $id, "family");
	}
} elseif ($pg == 'read-not') {

	if (us_level) {
		if (db_rows("notifications WHERE user = '{$lg}' && id = '{$id}' && nread = '0'"))
			db_update("notifications", ["nread" => "'1'"], $id);
	}
} elseif ($pg == 'resetpassword') {

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (!us_level) {
			$reg_email   = sc_sec($_POST['reset_email']);

			if (empty($reg_email)) {
				$alert = [
					'type'  => 'danger',
					'alert' => $lang['alerts']['required']
				];
			} elseif (!db_rows("users WHERE email = '" . $reg_email . "'")) {
				$alert = [
					'type'  => 'danger',
					'alert' => $lang['alerts']['reseterror']
				];
			} else {

				require_once './vendor/autoload.php';
                
                
                $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                        ->setUsername('toidayhoc@datdia.com')
                        ->setPassword('foaymnejscmzaqwq');
             
                // Create the Mailer using your created Transport
                $mailer = new Swift_Mailer($transport);
             
                // Create a message
                $message = new Swift_Message();

				$message->setSubject('Thư đổi mật khẩu Ongbata');

				// Set the "From address"
				$message->setFrom(['toidayhoc@datdia.com' => 'Phần mềm gia phả Ongbata']);

				// Set the "To address" [Use setTo method for multiple recipients, argument should be array]
				$message->addTo($reg_email, 'recipient name');

				// Add "CC" address [Use setCc method for multiple recipients, argument should be array]
				$message->addCc('toidayhoc@datdia.com', 'recipient name');

				// Add "BCC" address [Use setBcc method for multiple recipients, argument should be array]
				$message->addBcc('nhantin41@gmail.com', 'recipient name');

				// Add an "Attachment" (Also, the dynamic data can be attached)
				// $attachment = Swift_Attachment::fromPath('example.xls');
				// $attachment->setFilename('report.xls');
				// $message->attach($attachment);

				// // Add inline "Image"
				// $inline_attachment = Swift_Image::fromPath('nature.jpg');
				// $cid = $message->embed($inline_attachment);

				// Set the plain-text "Body"
				$login     = db_get('users', 'username', $reg_email, 'email');
				$token     = bin2hex(openssl_random_pseudo_bytes(16));
				$reset_url = path . "/password-reset.php?action=reset&token=" . $token . "&t=" . sha1($reg_email);
				$body_mail = fh_reset_tmp($login, $to, $reset_url);
				$html    = "{$body_mail}";
				$message->setBody($html, 'text/html');

				// Set a "Body"

				// Send the message
				$result = $mailer->send($message);


				
				


				// $to      = $reg_email;
				// $from    = do_not_reply;
				// $subject = "Password Reset";
				// $body    = "";
				
				// $mail    = new Mail($to, $from, $subject, $body, $html);

				if ($mailer->send($message)) {
					$data = [
						'email' => "'{$reg_email}'",
						'token' => "'{$token}'",
						'date'  => "'" . time() . "'"
					];
					db_insert('reset_passwords', $data);

					$alert = [
						'type'  => 'success',
						'alert' => $lang['alerts']['resetsuccess']
					];
				} else {
					$alert = [
						'type'  => 'danger',
						'alert' => $lang['alerts']['wrong']
					];
				}
			}

			echo json_encode($alert);
		}
	}
} elseif ($pg == 'sendpassword') {

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (!us_level) {
			$reg_token  = sc_sec($_POST['token']);
			$reg_t      = sc_sec($_POST['t']);
			$reg_pass   = sc_sec($_POST['reg_pass']);
			$reg_repass = sc_sec($_POST['reg_repass']);

			$reg_email   = db_get('users', 'email', $reg_t, 'sha1(email)');
			$token_email = db_get('reset_passwords', 'email', $reg_token, 'token');

			if (!$reg_email || $reg_email != $token_email) {
				$alert = [
					'type'  => 'danger',
					'alert' => $lang['alerts']['wrong']
				];
			} elseif (empty($reg_pass) || empty($reg_repass)) {
				$alert = [
					'type'  => 'danger',
					'alert' => $lang['alerts']['required']
				];
			} elseif (strlen($reg_pass) < 6 || strlen($reg_pass) > 32) {
				$alert = [
					'type'  => 'danger',
					'alert' => $lang['alerts']['pass1']
				];
			} elseif ($reg_pass != $reg_repass) {
				$alert = [
					'type'  => 'danger',
					'alert' => $lang['alerts']['pass2']
				];
			} else {

				db_update('reset_passwords', ['status' => '1'], $reg_token, 'token');
				db_update('users', ['password' => "'" . sc_pass($reg_pass) . "'"], $reg_email, 'email');

				$alert = [
					'type'  => 'success',
					'alert' => $lang['alerts']['pass3']
				];
			}

			echo json_encode($alert);
		}
	}
}

// select ten cac nhom mau 
elseif($pg=='select_data_blood'){
	$data = new Getdata;
    $data_bl = $data->select('ftree_v1_4_blood','',$db);
	echo json_encode($data_bl);
}
// select user  cac nhom mau
elseif($pg=='select_data_user_blood')
{
    $data= new Getdata;
	// select theo nhom mau
	if ($_POST['condition']!=0) {
		$condition =" Where ftree_v1_4_blood.id='".$_POST['condition']."'";
	}
	else {
		$condition =' ';
	}
	$column = " *, ftree_v1_4_users.id as id_user,REPLACE(username,LEFT(username,4),'****') as name_humman ";
	$join =" JOIN ftree_v1_4_blood on ftree_v1_4_blood.id =  ftree_v1_4_users.blood_id  ";
	$data_get = $data->select_join('ftree_v1_4_users',$column,$join,$condition,$db); 
	$check = json_encode($data_get,JSON_INVALID_UTF8_SUBSTITUTE);
	echo $check ;
        // check loi json	
	 switch (json_last_error()) {
        case JSON_ERROR_NONE:
        break;
        case JSON_ERROR_DEPTH:
            echo ' - Maximum stack depth exceeded';
        break;
        case JSON_ERROR_STATE_MISMATCH:
            echo ' - Underflow or the modes mismatch';
        break;
        case JSON_ERROR_CTRL_CHAR:
            echo ' - Unexpected control character found';
        break;
        case JSON_ERROR_SYNTAX:
            echo ' - Syntax error, malformed JSON';
        break;
        case JSON_ERROR_UTF8:
            echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
        break;
        default:
            echo ' - Unknown error';
        break;
        }

}
// up nhom mau user
elseif($pg=='up_data_user_blood')
{
		$data=new Updata;
		$longitude = $_POST['longitude'];
		$latitude = $_POST['latitude'];
		$id = $_POST['id_user'];
		if (empty($longitude)|| empty($latitude) || empty($_POST['blood'])) {
			$data_s ="error";
		}else{

		
			if (!empty($_POST['blood_another'])) {
				$name_blood = $_POST['blood_another'];
				$condition =' where name_lood="'.$name_blood.'"';
				$check_blood = new Getdata;
				$data_ck =  $check_blood->select('ftree_v1_4_blood',$condition,$db);
				if (empty($data_ck)) {
					
					$insert_data = array(
						'name_lood'     =>     $db->real_escape_string($name_blood),  
					'status'          =>    $db->real_escape_string('1') 
					);
					$up_blood = $data->insert('ftree_v1_4_blood', $insert_data,$db);
					$id_blood = $up_blood;
				}
				else{
					foreach($data_ck  as $ck){}
					$id_blood = $ck['id'];
				}	
			}
			else {
				$id_blood = $_POST['blood'];
			}
			$row_update =" blood_id='".$id_blood."', longitude='".$longitude."' ,latitude='".$latitude."'";
			$condition_data =' WHERE id='.$id;
			if($data->updatedata('ftree_v1_4_users', $row_update,$condition_data,$db))  
			{  
				$json= new Getdata;
				$condition =" Where ftree_v1_4_users.id='".$id."'";
				$column = " * ";
				$join =" JOIN ftree_v1_4_blood on ftree_v1_4_blood.id =  ftree_v1_4_users.blood_id";
				$data_s = $json->select_join('ftree_v1_4_users',$column,$join,$condition,$db);  
			}  
		}
		echo json_encode($data_s);
}
// send  email help blood 
elseif ($pg=='send_help_blood') {
	$data= new Getdata;
	$up_data = new Updata;
	$email =$_POST['email_user'];
	if (!empty($_POST['descrition'])) {
		$descrition = "
		<div><i><b>Mô tả:</b></i></div>
		<div>".$_POST['descrition']."</div>
		";
	}
	else
	{
		$descrition ="";
	}

	$condition_up = ' Where id='.$_POST['user_need'];
	$data_check = $data->select('ftree_v1_4_users ',$condition_up,$db);
	foreach($data_check  as $dk){}
	if ($dk['number_submissions_blood']>=10) {
		$data_help =  array(
            'data_send' => "limit",
        );
	}else {
		if (!check_email($email) || !detect_number($_POST['mobile_help'])) {
			$data_help =  array(
				'data_send' => "error",
			);
		}else {
				
				
				$row_update =' number_submissions_blood='.$dk['number_submissions_blood']+1;
				$up_data->updatedata('ftree_v1_4_users', $row_update,$condition_up,$db);
				$table_name =  prefix .'users';
				$column =  prefix .'users.id, '.prefix .'token_user.token, '.prefix .'users.email, '.prefix .'users.username';
				$join = ' INNER JOIN '.prefix .'blood on '.prefix.'blood.id = '.prefix.'users.blood_id';
				$join .= ' LEFT JOIN '.prefix .'token_user on '.prefix.'token_user.userid = '.prefix.'users.id';
				$condition_join = ' WHERE  '.prefix.'users.id='.$_POST['id_user'];
				$data_s = $data->select_join($table_name,$column,$join,$condition_join,$db);
				foreach($data_s  as $dt){
				}
				$setSubject ='Xin nhóm máu';
				$from_send = $email;
				$to_send = $dt['email'];
				$body = "
				<h3> Xin chào ".$dt['username']."</h3>
				<div>Chúng tôi đến từ trang ongbata</div>
				</div>Anh(chị): ".$_POST['name_help']." đang cần nhóm máu <b>".$_POST['blood_name']." </b> như bạn </div>
				<div>".$descrition."</div>
				<div> <a href='http://maps.google.com/maps?q=".$_POST['my_location_send']."'>Dẫn đường tới ví trí người cần</a>
				</br>
				<div>Rất mong nhận được sự phản hồi sớm từ bạn </div>
				<center><b>Thông tin liên hệ với người cần máu </b></center>
				<div> Số điện thoại: <b>".$_POST['mobile_help']."</b></div>
				<div> Email: <b>".$email."</b></div>
				<div><b><i>Cảm ơn bạn đã đọc tin </i></b></div>
				";
				if (!empty($from_send) && !empty($to_send) && !empty($_POST['blood_name'])) {
						send_email($setSubject,$from_send,$to_send,$body);
						$data_help =  array(
							'data_send' => "Sussess",
						);
				}
				else {
					$data_help =  array(
						'data_send' => "error",
					);
				}
				
				// send with notification
				$body_noti='Anh(chị): '.$_POST['name_help'].' đang cần nhóm máu '.$_POST['blood_name'];
				$token_send = [];
				foreach ($data_s as $gtk) {
						array_push($token_send,$gtk['token']);	
				}
				if (!empty($token_send)) {
					$notification_t = array(
						'title' => 'Xin nhóm máu',
						'body' => $body_noti,
						'icon' => 'https://ongbata.vn/wp-content/uploads/2021/02/logo-300x300.png',
						'sound' => 1,
						'click_action' => 'https://giapha.ongbata.vn/map_blood.php'
					);
					 sendNotif($token_send, $notification_t);
					$token_send = [];
				}
		}
	}
	echo  json_encode($data_help);
}
// croll job blood
elseif($pg=='croll_job_blood'){
	$data=new Updata;
	$row_update = ' number_submissions_blood =0';
	$condition_data = ' WHERE number_submissions_blood >0 ';
	$data->updatedata('ftree_v1_4_users', $row_update,$condition_data,$db);
}

// upload loaction tomb
elseif($pg=='update_locationtomb'){
	$data=new Updata;
	if (empty($_POST['latitude']) or empty($_POST['longitude'])) {
		$message = 'Kinh độ hoặc vĩ độ bị thiếu';
	}
	else {
		$condition_data =" Where id=".$_POST['location_id'];
		$longitude =  $_POST['longitude'];
		$latitude = $_POST['latitude'];
		$row_update =" longitude='".$longitude."' ,latitude='".$latitude."'";
		$thu = 	$data->updatedata('ftree_v1_4_members', $row_update,$condition_data,$db);
		$message = '';
	}
	
	echo json_encode($message);
	
}
// fet member in connect me
elseif($pg=='fet_mem'){
	$data= new Getdata;
	$table_name =  prefix . "members";
	$condition = " family =".$_GET['id'];
	$column = " *,  from_unixtime(birthdate,'%d/%m/%Y') as birth_day";
	$slect_me=$data->select_column($table_name,$column,$condition,$db);
	echo json_encode($slect_me);
}
// choose me 
elseif($pg=='connect_me'){
	if (empty($_POST['id_user']) || empty($_POST['id_choose'])) {
		$message = 'Người này không có trong gia phả hoặc trường đang trống';
	}elseif(!empty(db_get('members', 'user', $_POST['id_choose']))){
		$message = 'Thành Viên này đã có người chọn';
	}
	else {
		$data= new Updata;
		$table_name =  prefix."members";
		$row_update = 'user ="'.$_POST['id_user'].'"';
		$condition_data = ' Where id='.$_POST['id_choose'];
		$data->updatedata($table_name , $row_update,$condition_data,$db);
		$message = '';
	}
	echo json_encode($message);
}
// search me
if ($pg=='find_me') {
	$data= new Getdata;
	if (!empty($_POST['query'])) {
		$table_name =  prefix . "users";
		$condition = " email  LIKE '{$_POST['query']}%' OR mobile LIKE '{$_POST['query']}%' LIMIT 11";
		$slect_me =$data->select_column($table_name,'',$condition,$db);
		echo json_encode($slect_me);  
	}
}
// send help blood notification firebase
elseif($pg=='up_token_user'){
	$data= new Updata;
	$token_user = $_POST['token'];
	$id_user = $_POST['userid'];
	if (!empty($token_user) && !empty($id_user)) {
		$insert_data = array(
			'userid'     =>     $db->real_escape_string($id_user),  
			'token'          =>    $db->real_escape_string($token_user) 
		);
		if (db_count("token_user WHERE token = '{$token_user}' && userid = '{$id_user}'")==0) {
			$up_blood = $data->insert(prefix .'token_user', $insert_data,$db);
		}
	}
}
// test_notification
elseif($pg == 'test_notification'){	
	$data = new Getdata;
	$id= $_POST['id'];
	$table_name = prefix .'token_user';
	$column = 'token';
	if ($_POST['id']=='Tất cả') {
		$condition = '';
	}else {
		
		$condition = ' userid IN ('.$id.')';
	}
	$get_token_noti = $data->select_column($table_name,$column,$condition,$db);
	if (!empty($get_token_noti)) {
		foreach ($get_token_noti as $gtk) {
			$tokens_t = $gtk['token'];
			$notification_t = array(
				'title' => $_POST['title'],
				'body' =>  $_POST['body'],
				'icon' =>  $_POST['link_img'],
				'sound' => 1,
				'click_action' =>  $_POST['click_action']
			);
			sendNotif_single($tokens_t, $notification_t);
		}
	}

}
// get mem had token
elseif($pg == 'get_mem_had_token'){
	$data = new Getdata;
	$table_name =  prefix .'users';
	$column =  prefix .'users.id, '.prefix .'users.username';
	$join = ' Join '.prefix .'token_user on '.prefix.'token_user.userid = '.prefix.'users.id';
	$condition = ' GROUP BY id';
	$get_token_noti = $data->select_join($table_name,$column,$join,$condition,$db);
	echo json_encode($get_token_noti);
}
// serach member of map tomb
elseif ($pg=='search_mem_map') {
	$data= new Getdata;
	$vl= $_POST['search'];
	$fam_id = $_POST['family'];
	if (!empty($vl) && !empty($fam_id)) {
		$column = 'id,firstname,lastname,deathdate';
		$table_name =  prefix . "members";
		$condition = " family = {$fam_id} and death=0 and (longitude ='' or latitude ='') and lower(concat_ws(' ', lastname, firstname)) like lower('%{$vl}%')";
		$slect_me =$data->select_column($table_name,$column,$condition,$db);
		echo json_encode($slect_me);  
	}
}

// search famyli of admin 
elseif( $pg == 'search_admin') {
	$data = new Getdata;
	$keyword = $_GET['keyword'];
	$table_name =  prefix . "families";
	$column = 'id, name';
	$condition = ' name like "' . $keyword . '%"';
	$search_result = [];
	if ($keyword) {
		$search = $data->select_column($table_name, $column, $condition, $db);
		foreach ($search as $value) {
			array_push($search_result, 
			[
			'url' => fh_seoURL($value['name']),
			'name' => $value['name'],
			'id' => $value['id'],
			]);
		}
	}
	echo json_encode($search_result);
}

// upload video of memeber 
elseif($pg == 'upload_video' && isset($_FILES['videos_member']) && isset($_POST['video_remove'])) {
    sleep(10);
	$removeImage = ($_POST['video_remove'] != "") ? explode(",", $_POST['video_remove']) : [];
	$memberId = $_GET['id_mem'];
	$lenghtImage = count($_FILES['videos_member']['name']);
	if ($_FILES['videos_member']['size'] <= 20000000 || $_FILES['videos_member']['size'] > 0) {
		$post = db_insert('post', [
			"membersid " => $memberId,
			"title"   => "'Thêm " . $lenghtImage . " video mới '",
		]);

        $idPost = mysqli_insert_id($db);
        
		for ($i=0; $i < $lenghtImage; $i++) {
			if (!in_array($i, $removeImage)) {
			    $nameFile = preg_replace('/\s+/', '-', iconv('utf-8','us-ascii//IGNORE', $_FILES['videos_member']['name'][$i]));
			    
				$pathFile = 'ongbata_pf/' . $nameFile ;
				$handle = $aws3->uploadWithTmpFile($_FILES['videos_member']['tmp_name'][$i], $pathFile);
				
				if ($handle === true) {
					$resultUpload = $aws3->getUrl($nameFile , "ongbata_pf");

					db_insert('gallery', [
						"postid" => $idPost,
						"membersid "   => $memberId,
						"url" => "'" . $resultUpload . "'",
						"typefile"    => "'video'",
					]);
				}
			}
		}

		$_SESSION["success"] = "Tải lên video thành công, sau vài giây tab này sẽ đóng";
	} else {
		$_SESSION["error"] = "Video rỗng hoặc kích thước video quá 20 MB. Bạn vui lòng up lại video phù hợp.";
	}

	return header('Location: ' . $_SERVER['HTTP_REFERER']);
}

// upload files by user  
if ($pg == "upload_file_user") {
	$typeFile = $_POST['type_file'];
	$file = $_FILES['files'] ?? "";
	$idMem = $_POST['mem_id'] ?? "";
	$lenghtImage = count($file['name']);

	if (!$idMem || !$file["size"][0]) {
		$_SESSION["message"] = "Lỗi không thể tải lên!";
		return header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	$post = db_insert('post', [
		"membersid " => $idMem,
		"title"   => "'Thêm " . $lenghtImage . ($typeFile == "video" ? 'video ' : "ảnh "). "mới '",
	]);

	$idPost = mysqli_insert_id($db);
	
	for ($i=0; $i < $lenghtImage; $i++) { 
		$nameFile = preg_replace('/\s+/', '-', iconv('utf-8','us-ascii//IGNORE', $file['name'][$i])); 
		$pathFile = 'ongbata_pf/' . $nameFile ;
		$handle = $aws3->uploadWithTmpFile($file['tmp_name'][$i], $pathFile);

		if ($handle === true) {
			$resultUpload = $aws3->getUrl($nameFile , "ongbata_pf");

			db_insert('gallery', [
				"postid" => $idPost,
				"membersid "   => $idMem,
				"url" => "'" . $resultUpload . "'",
				"typefile"    => "'" . $typeFile . "'",
			]);
		}
	}

	$_SESSION["message"] = "Chúc mừng, bạn đã tải lên thành công!";
	return header('Location: ' . $_SERVER['HTTP_REFERER']);
}

// delete file by user 
if ($pg == "delete_file") {
	$idFile = $_GET['id'] ?? "";
	$idUser = us_id ?? "";
	$message = "Chúc mừng bạn đã xóa file thành công!";
	$getdata = new Getdata;

	$join = "JOIN ftree_v1_4_members member on member.id = gallery.membersid ";
	$join .= "JOIN ftree_v1_4_users user on user.id = member.author ";
	$condition = " where gallery.id = " . $idFile . " And member.author = " . $idUser;
	$resultCount = $getdata->select_join('`ftree_v1_4_gallery` gallery ', "COUNT(*)", $join, $condition, $db);

	if (!$idFile || !$idUser || !$resultCount) {
		$message = "Có lỗi nào đó, bạn không thể xóa file này";
	} else {
		db_delete("gallery", $idFile);
	}

	$_SESSION["message"] = $message;
	return header('Location: ' . $_SERVER['HTTP_REFERER']);
}

