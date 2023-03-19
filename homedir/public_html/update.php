<?php
/*=======================================================/
	| Craeted By: Khalid puerto
	| URL: www.puertokhalid.com
	| Facebook: www.facebook.com/prof.puertokhalid
	| Instagram: www.instagram.com/khalidpuerto
	| Whatsapp: +212 654 211 360
 /======================================================*/

include __DIR__.'/configs/connection.php';

?>
<title>Puerto Update</title>
<style>
	body { background: #F7F7F7; }
	.install-box { width:450px;margin:20px auto 0 auto;background: #FFF;font-family:tahoma;font-size:14px;box-shadow:0 0 5px #CCC; }
	.install-box h1 { padding: 24px 20px;margin:0;font-size:18px;color: #555;    border-bottom: 1px solid #F7F7F7; }
	.install-box p { padding:20px;margin:0;color: #777;line-height: 1.6; }
	.install-box ul { padding: 0 20px;font-size: 12px;line-height: 1.4; }
	.install-box .button {font-size:18px;background:#DF4444;color:#FFF;text-decoration:none;display:block;margin-top:20px;text-align:center;padding:10px 0;border-radius: 3px;width: 100%; }
	.input { padding:10px 20px 0px 20px; }
	.input p { padding:0; font-size:12px; }
	label { font-weight:bold; font-size:12px; margin-left:5px; margin-bottom: 6px; color: #555; display:block; }
	input { padding:10px; font-size:12px; border:1px solid #DDD; width:100%;  }
	input[type=submit] { padding:10px; font-size:12px; color:#FFF; border:1px solid #DF4444; background:#DF4444; width:auto;  }
	.p-h, .p-h a {
    inline-block: ;
    padding: 2px 6px;
    background: #EEE;
    border-radius: 3px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    color: #555;
    text-shadow: 0 1px 0 #FFF;
	}
	ul {
		margin:0 24px
	}
	ul li {
		margin: 6px 0;
	}
	.red {
		color: red;
	}
</style>


<?php

$step = (isset($_GET['step']) ? (int)($_GET['step']) : '');

if($step == ''):

?>
<div class="install-box">
	<form method="post" action="update.php?step=1">

	<h1>Welcome to Puerto Family Tree</h1>
	<p>
	Thank you for purchasing Puerto Family Tree Script.<br> if you have any problem or issue with the script or the instraction that I provide please contact me first ASAP in:
	</p>
	<ul>
		<li>my Email: <span class="p-h">el.bouirtou@gmail.com</span></li>
		<li>my Facebook account <span class="p-h"><a href="https://fb.com/prof.puertokhalid">fb.com/prof.puertokhalid</a></span></li>
		<li>on the Instagram <span class="p-h"><a href="https://instagram.com/khalidpuerto">instagram.com/khalidpuerto</a></span></li>
		<li>Codecanyon profile <span class="p-h"><a href="http://codecanyon.net/user/puertokhalid">codecanyon.net/user/puertokhalid</a></span></li>
	</ul>
	<p>
	 and I will back to you with all help you need.<br>
	 Thanks so much!<br><br />
	<button type="submit" class="button">Update Puerto Script</button>
	</p>
		</form>
</div>





<?php

else:



$db->query("ALTER TABLE `".prefix."users` ADD `plan` TINYINT(1) NULL DEFAULT '0' AFTER `twitter`, ADD `lastpayment` INT NULL DEFAULT '0' AFTER `plan`;");


$db->query("
INSERT INTO `".prefix."configs` (`id`, `variable`, `value`) VALUES
(51, 'site_smtp_auth', '1'),
(50, 'site_smtp_port', '587'),
(26, 'site_noreply', 'donotreply@puertokhalid.com'),
(31, 'login_facebook', '1'),
(32, 'login_twitter', '1'),
(33, 'login_google', '1'),
(34, 'login_fbAppId', ''),
(35, 'login_fbAppSecret', ''),
(36, 'login_fbAppVersion', ''),
(37, 'login_twConKey', ''),
(38, 'login_twConSecret', ''),
(39, 'login_ggClientId', ''),
(40, 'login_ggClientSecret', ''),
(41, 'site_paypal_id', ''),
(42, 'site_paypal_live', '0'),
(43, 'site_currency_name', 'USD'),
(44, 'site_currency_symbol', '$'),
(45, 'site_smtp', '0'),
(46, 'site_smtp_host', 'localhost'),
(47, 'site_smtp_username', ''),
(48, 'site_smtp_password', ''),
(49, 'site_smtp_encryption', 'none'),
(52, 'site_favicon', 'assets/img/fav.png'),
(53, 'site_paypal_client_id', ''),
(54, 'site_paypal_client_secret', ''),
(62, 'site_stripe_key', ''),
(63, 'site_stripe_secret', ''),
(65, 'site_ads1', '<a href=\"https://codecanyon.net/item/ifood-multi-restaurant-merchant-hosting-site/27556124\" target=\"_blank\"><img src=\"https://puertokhalid.com/puertosurveys/v1.2/img/ads/728x90cs.jpg\"></a>'),
(66, 'site_ads2', '<img src=\"http://puertokhalid.com/quizy/assets/img/ads/ads2.png\">'),
(67, 'site_ads3', '<img src=\"http://puertokhalid.com/quizy/assets/img/ads/ads3.png\">'),
(68, 'site_ads4', '<img src=\"http://puertokhalid.com/quizy/assets/img/ads/ads3.png\">'),
(69, 'site_ads5', '<img src=\"http://puertokhalid.com/quizy/assets/img/ads/ads2.png\">'),
(70, 'site_ads6', '<img src=\"http://puertokhalid.com/quizy/assets/img/ads/ads2.png\">'),
(71, 'site_language', '{\"rtl\":\"false\",\"lang\":\"en\",\"success\":\"Success!\",\"error\":\"Error!\",\"rip\":\"R.I.P\",\"site\":{\"title\":\"Puerto Family Tree\",\"no-result\":\"No Result Found!\",\"submit\":\"Submit\",\"close\":\"Close\",\"emailver\":\"Email verification:\"},\"header\":{\"welcome\":\"Welcome!\",\"search\":\"Search for family...\",\"home\":\"Home\",\"family\":\"Family Trees\",\"plans\":\"Plans\",\"about\":\"About Us\",\"contact\":\"Contact Us\",\"details\":\"Your Details\",\"logout\":\"Logout!\",\"no-not\":\"No notifications\",\"newtree\":\"Create a tree\",\"dashboard\":\"Dashboard\",\"users\":\"Users\",\"fam\":\"Family Tree\",\"fammanag\":\"Managers (Only Usernames):\"},\"plans\":{\"title\":\"Simple Pricing for Everyone!\",\"desc\":\"Pricing is built for businesses of all sizes. Always know what you will pay. All plans come with a 100% money-back guarantee.\",\"month\":\"/per month\",\"btn\":\"Get Started\",\"alert\":{\"success\":\"Your payments have been calculated!\"}},\"indexpage\":{\"h4\":\"Building Family Tree.\",\"h2\":\"Who are they?\",\"p\":\"Make your family tree live with Puerto Family Tree and do not leave it just a memory hanging. build it with the participation of everyone and make it stretch to infinity.\",\"form\":{\"b\":\"More than just a family tree.\",\"s\":\"A new home for family memories\",\"login\":\"Login\",\"register\":\"Register\",\"fid\":{\"l\":\"Family ID:\",\"i\":\"Write your family ID\"},\"pass\":{\"l\":\"Password:\",\"i\":\"Write your password\"},\"npass\":{\"l\":\"New Password:\",\"i\":\"Write your new password\"},\"vpass\":{\"l\":\"View Password:\",\"i\":\"Write your view password\"},\"email\":{\"l\":\"Email:\",\"i\":\"Write your email\"},\"in\":\"Sign In\",\"up\":\"Sign Up\",\"view\":\"Can everyone see this family (public view)\"},\"my\":\"My Family Tree\",\"list\":\"List Of the trees you manage!\",\"more\":\"More Results!\",\"forget\":\"Forget your password?\",\"reset\":\"Reset it now\",\"pravicy\":\"Pravicy policy\",\"byclick\":\"By clicking in Sign up button you are automaticly accepting in our {a}, dont hasitate to read it first!\"},\"treepage\":{\"vp\":{\"t\":\"View Password :\",\"p\":\"We are sorry to inform you that, this family isnt public view. you need to have password view to show it.\",\"i\":\"Write the view password\",\"b\":\"Submit\"},\"edit\":\"Edit\",\"new\":\"New Member\",\"link\":\"Tree Link\",\"fam\":\"s Family Tree:\",\"share\":\"Share\",\"share_f\":\"Share on Facebook\",\"share_t\":\"Share on Twitter\",\"share_w\":\"Share on Whatsapp\",\"share_e\":\"Send in Email\",\"pdf\":\"Export PDF\"},\"heritage\":{\"title\":\"Heritage a family                     :\",\"link\":\"Link this momber as a parent of family:\"},\"detailspage\":{\"title\":\"Manege your details\",\"send\":\"Send Details\",\"username\":\"Your Username\",\"username_l\":\"Write your username\"},\"contactpage\":{\"title\":\"Contact Us\"},\"aboutpage\":{\"title\":\"About Us\"},\"userspage\":{\"title\":\"Users:\",\"families\":\"families\"},\"resetpage\":{\"title1\":\"Reset your password:\",\"email\":\"Your Registred Email Address\",\"title\":\"Reset new password :\",\"npass\":\"New Password       :\",\"npass_l\":\"type your password\",\"rpass\":\"Re-Password        :\",\"rpass_l\":\"type your re-password\"},\"listpage\":{\"title\":\"Famelie Tree List\",\"no-result\":\"No Result Found!\",\"members\":\"Members\",\"my\":\"My Trees\",\"edit\":\"Edit\"},\"timedate\":{\"time_second\":\"second\",\"time_minute\":\"minute\",\"time_hour\":\"hour\",\"time_day\":\"day\",\"time_week\":\"week\",\"time_month\":\"month\",\"time_year\":\"year\",\"time_decade\":\"decade\",\"time_ago\":\"ago\"},\"newmember\":{\"title\":\"Add New member\",\"personal\":\"Personal\",\"contact\":\"Contact\",\"biographical\":\"Biographical\",\"pictures\":\"Pictures\",\"link\":\"Link this member to a user:\",\"first\":\"First Name:\",\"last\":\"Last Name\",\"gender\":\"Gender\",\"female\":\"Female\",\"male\":\"Male\",\"rtype\":\"Relation Type\",\"child\":\"Child\",\"ex\":\"Ex-Partner\",\"parent\":\"Parent\",\"partner\":\"Partner\",\"bdate\":\"Birth Date\",\"mdate\":\"Mariage Date\",\"ddate\":\"Death Date\",\"alive\":\"This person is alive\",\"photo_url\":\"Enter Photo URL\",\"photo\":\"Photo\",\"choose\":\"Choose an image from your device\",\"instead\":\"Or choose an avatar instead\",\"website\":\"Website\",\"tel\":\"Home Tel\",\"mobile\":\"Mobile\",\"bplace\":\"Birth Place\",\"dplace\":\"Death Place\",\"profession\":\"Profession\",\"company\":\"Company\",\"interests\":\"Interests\",\"bio\":\"Bio Notes\",\"photos\":\"Photos\",\"lab1\":\"Enter first name\",\"lab2\":\"Enter last name\",\"lab3\":\"Enter Facebook\",\"lab4\":\"Enter Twitter\",\"lab5\":\"Enter Instagram\",\"lab6\":\"Enter Email\",\"lab7\":\"Enter Website\",\"lab8\":\"Enter Home Tel\",\"lab9\":\"Enter Mobile\",\"lab10\":\"Enter Birth Place\",\"lab11\":\"Enter Death Place\",\"lab12\":\"Enter Profession\",\"lab13\":\"Enter Company\",\"lab14\":\"Enter Interests\",\"lab15\":\"Enter Bio Notes\",\"bornat\":\"Born at\",\"bornin\":\"in\",\"deadat\":\"Dead at\",\"marriageat\":\"Marriage at\"},\"details\":{\"title\":\"Manage infos:\",\"firstname\":\"Your first name\",\"lastname\":\"Your last name\",\"username\":\"Edit Username\",\"password\":\"Edit Password\",\"email\":\"Edit Email\",\"male\":\"Male\",\"female\":\"Female\",\"country\":\"Country\",\"state\":\"State/Region\",\"city\":\"City\",\"address\":\"Full Address\",\"image_n\":\"No image chosen...\",\"image_c\":\"Choose Image\",\"button\":\"Send info\",\"alert\":{\"success\":\"Edit infos process has ended successfully.\"}},\"alerts\":{\"families\":\"Your number of families that you can add for the plan you have is expired, please upgrade your plan for more!\",\"members\":\"Your number of members per family that you can add for the plan you have is expired, please upgrade your plan for more!\",\"albums\":\"You dont have permission to add photos in albums using the plan you have, please upgrade your plan for more!\",\"heritage\":\"You dont have permission to heritage using the plan you have, please upgrade your plan for more!\",\"no-data\":\"No data found!\",\"nodata\":\"No data found!\",\"logout\":\"Are you sure you want to logout?\",\"nofile\":\"No file chosen...\",\"required\":\"All fields are required!\",\"login\":\"You have login succesfully!\",\"viewp\":\"View password is incorrect!\",\"wrong\":\"something wrong!\",\"done\":\"All done!\",\"payment\":\"Payment success!\",\"payment_f\":\"Failed to retrieve payment from PayPal!\",\"alldone\":\"Success, all done!\",\"famexist\":\"This family is already exist!\",\"name\":\"Name is required!\",\"correctemail\":\"You need a correct email address!\",\"existemail\":\"This Email is already exist!\",\"existusername\":\"This Username is already exist!\",\"regsuccess\":\"Your have being registred succesfuly.\",\"regsuccess1\":\"Your have being registred succesfuly, but we sent you an email for verification!\",\"regsuccess2\":\"Your have being registred succesfuly, but need to be accepted by administration!\",\"famsuccess\":\"Your family ID has created succesfully!\",\"logsuccess\":\"You have login succesfully!\",\"logapprov\":\"this user needs approval by administration before sign in!\",\"logverif\":\"this user needs to verify by email address!\",\"logerror\":\"Family ID or password is incorrect!\",\"reseterror\":\"There is no user with this info!\",\"resetsuccess\":\"The resset password sent succcesfuly.\",\"permission\":\"You have no permission for accessing to this page!\",\"emailver\":\"All right, you can login now.\",\"her_1\":\"you cant herirate this family beacause it isnt yours!\",\"her_2\":\"you cant herirate a family twise in the same tree!\",\"her_3\":\"you cant herirate this family beacause it isnt public!\",\"her_4\":\"you cant herirate this family!\",\"pass1\":\"password more than 6 letters\",\"pass2\":\"password dont match repassword\",\"pass3\":\"you can login now with this new password\",\"de_mem\":\"Are you sure you want to delete this memebr?\"},\"dash\":{\"p_disacticate\":\"Disable plans option\",\"planalert\":\"The plans have been saved successfully.\",\"p_title\":\"Payments\",\"p_user\":\"User\",\"p_status\":\"Status\",\"p_amount\":\"Amount\",\"p_paymentid\":\"Payment ID\",\"p_payerid\":\"Payer ID\",\"created_at\":\"Created At\",\"u_create\":\"Create a User\"},\"dashboard\":{\"hello\":\"Hello,\",\"welcome\":\"Welcome back again to your dashboard.\",\"stats_line_d\":\"Statistics for the last 7 days\",\"stats_line_m\":\"Statistics for this year\",\"stats_bar_d\":\"Statistics for the last 7 days\",\"stats_bar_m\":\"Statistics for this year\",\"surveys\":\"Families\",\"families\":\"Families\",\"users\":\"Users\",\"responses\":\"Members\",\"questions\":\"Images\",\"new_u\":\"New Users (24h)\",\"new_p\":\"Latest Payements (24h)\",\"new_s\":\"Latest Surveys (24h)\",\"u_users\":\"Members\",\"u_status\":\"Status\",\"u_username\":\"Username\",\"u_plan\":\"Plan\",\"u_pages\":\"Pages\",\"u_credits\":\"Credits\",\"u_last_p\":\"Last Payment\",\"u_registred\":\"Registred at\",\"u_updated\":\"Updated at\",\"u_delete\":\"Delete User\",\"u_edit\":\"Edit User\",\"p_title\":\"Payments\",\"p_user\":\"User\",\"p_status\":\"Status\",\"p_plan\":\"Plan\",\"p_amount\":\"Amount\",\"p_date\":\"Payment Date\",\"p_txn\":\"TXN\",\"set_title\":\"General Settings\",\"set_stitle\":\"Site title:\",\"set_keys\":\"Site keywords:\",\"set_desc\":\"Site Description:\",\"set_url\":\"Site URL:\",\"set_btn\":\"Send Settings\",\"days\":\"Days\",\"months\":\"Months\",\"latest_f\":\"Latest Families\",\"latest_m\":\"Latest Members\",\"status\":\"Status\",\"name\":\"name\",\"public\":\"public\",\"members\":\"members\",\"moderators\":\"moderators\",\"date\":\"Date\",\"edit\":\"Edit\",\"delete\":\"Delete\",\"verification\":\"Verification\",\"npage\":\"New Page\",\"title\":\"Title\",\"inmenu\":\"in Menu\",\"created\":\"Created\",\"regstatus\":\"Registration Status:\",\"mneedsapproval\":\"Need Approval Without Email\",\"open\":\"Open\",\"hidereg\":\"Hide registration form\",\"fneedsapproval\":\"Families needs approval before being live\",\"colors\":\"Colors\",\"byemail\":\"By Email\",\"ptitle\":\"Page Title\",\"picon\":\"Page Icon\",\"pcontent\":\"Page Content\",\"dmenu\":\"Display it in menu\",\"save\":\"Save\",\"alert\":{\"success\":\"Setting has sent successfully.\"}}}');
") or die($db->error);



$db->query("
CREATE TABLE `".prefix."payments` (
  `id` int(11) NOT NULL,
  `plan` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_id` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `payer_id` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` float(10,2) DEFAULT NULL,
  `currency` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` int(11) DEFAULT '0',
  `author` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
") or die($db->error);

$db->query("
CREATE TABLE `".prefix."plans` (
	`id` int(11) NOT NULL,
`plan` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
`price` float(10,2) DEFAULT NULL,
`currency` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
`desc1` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
`desc2` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
`desc3` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
`desc4` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
`desc5` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
`desc7` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
`desc8` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
`desc9` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
`created_at` int(11) DEFAULT '0',
`quizzes` int(11) DEFAULT '0',
`takers` int(11) DEFAULT '0',
`questions` int(11) DEFAULT '0',
`export_statistics` tinyint(1) DEFAULT '0',
`backgound` tinyint(1) DEFAULT '0',
`integrations` tinyint(1) DEFAULT '0',
`show_ads` tinyint(1) DEFAULT '0',
`support` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
") or die($db->error);

$db->query("
INSERT INTO `".prefix."plans` (`id`, `plan`, `price`, `currency`, `desc1`, `desc2`, `desc3`, `desc4`, `desc5`, `desc7`, `desc8`, `desc9`, `created_at`, `quizzes`, `takers`, `questions`, `export_statistics`, `backgound`, `integrations`, `show_ads`, `support`) VALUES
(1, 'Free Plan', 0.00, '$', '3 Famillies', '10 Members per family', '1 Private Family', 'Enable to heritate families', 'Enable to create albums', 'PDF Export', 'No advertisements', 'Priority support', 0, 1, 10, 10, 0, 0, 0, 0, 0),
(2, 'Basic Plan', 9.99, '$', '12 Famillies', '50 Members per family', '20 Private Family', 'Enable to heritate families', 'Enable to create albums', 'PDF Export', 'No advertisements', 'Priority support', 0, 12, 50, 20, 0, 1, 0, 0, 0),
(3, 'Regular Plan', 19.99, '$', 'Unlimited Famillies', 'Unlimited Members per family', 'Unlimited Private Family', 'Enable to heritate families', 'Enable to create albums', 'PDF Export', 'No advertisements', 'Priority support', 0, 999999, 999999, 999999, 1, 1, 1, 1, 1);
") or die($db->error);

$db->query("
ALTER TABLE `".prefix."payments` ADD PRIMARY KEY (`id`);
") or die($db->error);

$db->query("
ALTER TABLE `".prefix."plans` ADD PRIMARY KEY (`id`);
") or die($db->error);

$db->query("
ALTER TABLE `".prefix."payments` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
") or die($db->error);

$db->query("
ALTER TABLE `".prefix."plans` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
") or die($db->error);



?>


<div class="install-box">
	<h1>Congratulations...</h1>
	<p>
		Congratulations Puerto Family Tree Script is updated successfully. if you have any problem or issue with the script or the instraction that I provide please contact me first ASAP in:

		</p>
		<ul>
			<li>my Email: <span class="p-h">el.bouirtou@gmail.com</span></li>
			<li>my Facebook account <span class="p-h"><a href="https://fb.com/prof.puertokhalid">fb.com/prof.puertokhalid</a></span></li>
			<li>on the Instagram <span class="p-h"><a href="https://instagram.com/khalidpuerto">instagram.com/khalidpuerto</a></span></li>
			<li>Codecanyon profile <span class="p-h"><a href="http://codecanyon.net/user/puertokhalid">codecanyon.net/user/puertokhalid</a></span></li>
		</ul>
		<p>
		 and I will back to you with all help you need.<br><br>
		<span class="red">Please do not forget to delete the update file 'update.php'.</span><br>
		<a href="index.php" class="button">Go to index</a>
	</p>
</div>

<?php
endif;
