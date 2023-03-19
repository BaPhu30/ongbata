<?php
/*=======================================================/
    | Craeted By: Khalid puerto
    | URL: www.puertokhalid.com
    | Facebook: www.facebook.com/prof.puertokhalid
    | Instagram: www.instagram.com/khalidpuerto
    | Whatsapp: +212 654 211 360
 /======================================================*/

include __DIR__.'/configs/config.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $lang['lang']; ?>">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo $lang['site']['title']; ?></title>

	<!-- Google Fonts -->
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,900%7CGentium+Basic:400italic&subset=latin,latin">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,300,700">
	<link href="//fonts.googleapis.com/css?family=Coda+Caption:800|Poppins|Squada+One|Sriracha&display=swap" rel="stylesheet">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?php echo path; ?>/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo path; ?>/css/all.min.css">
	<link rel="stylesheet" href="<?php echo path; ?>/css/jquery-confirm.min.css">
	<link rel="stylesheet" href="<?php echo path; ?>/css/datepicker.min.css">
	<link rel="stylesheet" href="<?php echo path; ?>/css/lightbox.css" />
	<link rel="stylesheet" href="<?php echo path; ?>/css/fileinput.css" />
	<link rel="stylesheet" href="<?php echo path; ?>/js/minified/themes/default.min.css" />
	<link rel="stylesheet" href="<?php echo path; ?>/css/fontawesome-iconpicker.min.css" />
	<link rel="stylesheet" href="<?php echo path; ?>/css/spectrum.css" />

	<!-- Main CSS -->
	<link rel="stylesheet" href="<?php echo path; ?>/css/style.css">
</head>

<body class="pt-page<?php echo str_replace('-', '', page); ?>">
	<?php

    if (us_level == 6) {
        ?>
		<div class="pt-wrapper">
			<div class="pt-admin-nav">
				<div class="pt-logo"></div>
				<ul>
					<li><a href="<?php echo path; ?>/index.php"><i class="fas fa-home"></i><b></b></a></li>
					<li<?php echo $pg == '' ? ' class="pt-active"' : ''; ?>><a href="<?php echo path; ?>/dashboard.php"><i class="fas fa-tachometer-alt"></i><b></b></a></li>
						<li<?php echo $pg == 'users' ? ' class="pt-active"' : ''; ?>>
							<a href="<?php echo path; ?>/dashboard.php?pg=users"><i class="fas fa-users"></i>
								<?php echo db_rows('users WHERE status != 0') ? '<b class="noti">'.db_rows('users WHERE status != 0').'</b>' : ''; ?>
							</a>
							</li>
							<li<?php echo $pg == 'families' ? ' class="pt-active"' : ''; ?>><a href="<?php echo path; ?>/dashboard.php?pg=families"><i class="fas fa-sitemap"></i><b></b></a></li>
								<li<?php echo $pg == 'pages' ? ' class="pt-active"' : ''; ?>><a href="<?php echo path; ?>/dashboard.php?pg=pages"><i class="fas fa-copy"></i><b></b></a></li>
									<li<?php echo $pg == 'plans' ? ' class="pt-active"' : ''; ?>><a href="<?php echo path; ?>/dashboard.php?pg=plans"><i class="fas fa-trophy"></i><b></b></a></li>
										<li<?php echo $pg == 'payments' ? ' class="pt-active"' : ''; ?>><a href="<?php echo path; ?>/dashboard.php?pg=payments"><i class="fas fa-money-bill-wave"></i><b></b></a></li>
											<li<?php echo $pg == 'languages' ? ' class="pt-active"' : ''; ?>><a href="<?php echo path; ?>/dashboard.php?pg=languages"><i class="fas fa-language"></i><b></b></a></li>
												<li<?php echo $pg == 'setting' ? ' class="pt-active"' : ''; ?>><a href="<?php echo path; ?>/dashboard.php?pg=setting"><i class="fas fa-cogs"></i><b></b></a></li>
													<li><a href="#" class="logout"><i class="fas fa-power-off"></i><b></b></a></li>
				</ul>
			</div>
			<div class="pt-admin-body">
				<div class="pt-welcome">
					<h3><?php echo $lang['dashboard']['hello']; ?> <?php echo us_name; ?>!</h3>
					<p><?php echo $lang['dashboard']['welcome']; ?></p>
					<span><i class="fas fa-chart-line"></i></span>
				</div>
				<div class="pt-stats">
					<ul>
						<li><span><i class="fas fa-poll"></i></span><b><?php echo $lang['dashboard']['families']; ?></b> <em><?php echo db_rows('families'); ?></em></li>
						<li><span><i class="fas fa-users"></i></span><b><?php echo $lang['dashboard']['users']; ?></b> <em><?php echo db_rows('users'); ?></em></li>
						<li><span><i class="fas fa-hand-holding-heart"></i></span><b><?php echo $lang['dashboard']['responses']; ?></b> <em><?php echo db_rows('members'); ?></em></li>
						<li><span><i class="far fa-question-circle"></i></span><b><?php echo $lang['dashboard']['questions']; ?></b> <em><?php echo db_rows('images'); ?></em></li>
					</ul>
				</div>



				<?php if (!$pg) { ?>
					<div class="row">
						<div class="col-6">
							<div class="pt-charts">
								<div class="pt-adminstatslinks pt-adminlines">
									<a href="#daily" rel="1"><?php echo $lang['dashboard']['days']; ?></a>
									<a href="#monthly" rel="1"><?php echo $lang['dashboard']['months']; ?></a>
								</div>
								<div class="pt-adminstats">
									<canvas id="line-chart" width="800" height="450"></canvas>
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="pt-charts">
								<div class="pt-adminstatslinks pt-adminbars">
									<a href="#daily" rel="1"><?php echo $lang['dashboard']['days']; ?></a>
									<a href="#monthly" rel="1"><?php echo $lang['dashboard']['months']; ?></a>
								</div>
								<div class="pt-adminstats">
									<canvas id="bar-chart" width="800" height="450"></canvas>
								</div>

							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="pt-admin-box">
								<h5><i class="far fa-user"></i> <?php echo $lang['dashboard']['new_u']; ?></h5>
								<div class="pt-content pt-scroll">
									<ul>
										<?php
                                        $sql = $db->query('SELECT * FROM '.prefix."users WHERE date >= '".(time() - 3600 * 24)."' ORDER BY id DESC") or exit($db->error);
                                        if ($sql->num_rows) {
                                            while ($rs = $sql->fetch_assoc()) {
                                                ?>
												<li>
													<div class="media">
														<div class="media-left">
															<div class="pt-thumb"><img src="<?php echo path.'/'.$rs['photo']; ?>" onerror="this.src='<?php echo nophoto; ?>'" /></div>
														</div>
														<div class="media-body">
															<?php echo $rs['username']; ?>
															<p>
																<span><i class="far fa-clock"></i> <?php echo fh_ago($rs['date']); ?></span>
																<span><i class="fas fa-poll"></i> <?php echo db_rows("families WHERE author = '{$rs['id']}'"); ?> <?php echo $lang['dashboard']['surveys']; ?></span>
															</p>
														</div>
													</div>
												</li>
										<?php
                                            }
                                        } else {
                                            echo '<li>'.fh_alerts($lang['alerts']['no-data'], 'info').'</li>';
                                        }
                                        $sql->close();
                                        ?>
									</ul>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="pt-admin-box">
								<h5><i class="fas fa-sitemap"></i> <?php echo $lang['dashboard']['latest_f']; ?></h5>
								<div class="pt-content">
									<ul>
										<?php
                                        $sql = $db->query('SELECT * FROM '.prefix."families WHERE date >= '".(time() - 3600 * 24)."' ORDER BY id DESC") or exit($db->error);
                                        if ($sql->num_rows) {
                                            while ($rs = $sql->fetch_assoc()) {
                                                ?>
												<li>
													<div class="media">
														<div class="media-left">
															<div class="pt-thumb"><img src="<?php echo path.'/'.db_get('members', 'photo', $rs['id'], 'family', "and parent ='0'"); ?>" onerror="this.src='<?php echo nophoto; ?>'" /></div>
														</div>
														<div class="media-body">
															<?php echo $rs['name']; ?>
															<p>
																<span><i class="far fa-clock"></i> <?php echo fh_ago($rs['date']); ?></span>
															</p>
														</div>
													</div>
												</li>
										<?php
                                            }
                                        } else {
                                            echo '<li>'.fh_alerts($lang['alerts']['no-data'], 'info').'</li>';
                                        }
                                        $sql->close();
                                        ?>
									</ul>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="pt-admin-box">
								<h5><i class="fas fa-users"></i> <?php echo $lang['dashboard']['latest_m']; ?></h5>
								<div class="pt-content pt-scroll">
									<ul>
										<?php
                                        $sql = $db->query('SELECT * FROM '.prefix."members WHERE date >= '".(time() - 3600 * 24)."' ORDER BY id DESC") or exit($db->error);
                                        if ($sql->num_rows) {
                                            while ($rs = $sql->fetch_assoc()) {
                                                ?>
												<li>
													<div class="media">
														<div class="media-left">
															<div class="pt-thumb"><img src="<?php echo path.'/'.$rs['photo']; ?>" onerror="this.src='<?php echo nophoto; ?>'" /></div>
														</div>
														<div class="media-body">
															<?php echo $rs['firstname']; ?>
															<p>
																<span><i class="far fa-clock"></i> <?php echo fh_ago($rs['date']); ?></span>
																<span><i class="far fa-sitemap"></i> <?php echo db_get('families', 'name', $rs['family']); ?></span>
															</p>
														</div>
													</div>
												</li>
										<?php
                                            }
                                        } else {
                                            echo '<li>'.fh_alerts($lang['alerts']['no-data'], 'info').'</li>';
                                        }
                                        $sql->close();
                                        ?>
									</ul>
								</div>
							</div>
						</div>
					</div>





				<?php } elseif ($pg == 'plans') { ?>

					<div class="pt-body">
						<div class="pt-plans">
							<div class="pt-title">
								<h3><?php echo $lang['header']['plans']; ?></h3>
							</div>

							<form id="sendplans">
								<div class="pt-box">
									<input class="tgl tgl-light" id="cb1" value="1" name="site_plans" type="checkbox" <?php echo site_plans ? ' checked' : ''; ?> />
									<label class="tgl-btn" for="cb1"></label>
									<label><?php echo $lang['dash']['p_disacticate']; ?></label>
								</div>
								<div class="row">
									<?php
                                    $sql = $db->query('SELECT * FROM '.prefix.'plans');
                                    while ($rs = $sql->fetch_assoc()) {
                                        ?>
										<div class="col-4">
											<div class="pt-box">
												<?php foreach ($rs as $key => $value) { ?>
													<?php if (!in_array($key, ['id', 'created_at', 'backgound', 'statistics', 'export_statistics', 'show_ads', 'integrations', 'support'])) { ?>
														<label class="mb-2"> <?php if (in_array($key, ['quizzes', 'takers', 'questions'])) { ?>
																<b>
																	<?php if ($key == 'quizzes') { ?>
																		Families
																	<?php } elseif ($key == 'takers') { ?>
																		Members
																	<?php } else { ?>
																		Private Famillies
																	<?php } ?>
																</b>
															<?php } ?>
															<input type="text" name="<?php echo $key; ?>[<?php echo $rs['id']; ?>]" placeholder="plan <?php echo $key; ?>" value="<?php echo $value; ?>">
														</label>
													<?php } ?>
													<?php if (in_array($key, ['backgound', 'statistics', 'export_statistics', 'show_ads', 'integrations', 'support'])) { ?>
														<div class="mb-3">
															<input class="tgl tgl-light" id="<?php echo $key.$rs['id']; ?>" value="1" type="checkbox" name="<?php echo $key; ?>[<?php echo $rs['id']; ?>]" <?php echo $value == 1 ? 'checked' : ''; ?> />
															<label class="tgl-btn" for="<?php echo $key.$rs['id']; ?>"></label>
															<label><label>
																	<?php if ($key == 'export_statistics') { ?>
																		PDF Export
																	<?php } elseif ($key == 'backgound') { ?>
																		Enable to heritate families
																	<?php } elseif ($key == 'integrations') { ?>
																		Enable to create albums
																	<?php } else { ?>
																		<?php echo str_replace('_', ' ', $key); ?>
																	<?php } ?>

																</label></label>
														</div>

													<?php } ?>
												<?php } ?>
											</div>
										</div>
									<?php
                                    }
                                    $sql->close();
                                    ?>
								</div>
								<div class="p-3">
									<button type="submit" class="btn btn-success">
										<span><?php echo $lang['dashboard']['save']; ?> <i class="fas fa-arrow-circle-right"></i></span>
									</button>
								</div>
							</form>
						</div>


					</div>



				<?php } elseif ($pg == 'families') { ?>
					<div class="pt-body">
						<div class="pt-title">
							<h3><?php echo $lang['dashboard']['surveys']; ?></h3>
						</div>
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th scope="col"><?php echo $lang['dashboard']['status']; ?></th>
										<th scope="col"><?php echo $lang['dashboard']['name']; ?></th>
										<th scope="col"><?php echo $lang['dashboard']['public']; ?></th>
										<th scope="col"><?php echo $lang['dashboard']['members']; ?></th>
										<th scope="col"><?php echo $lang['dashboard']['moderators']; ?></th>
										<th scope="col"><?php echo $lang['dashboard']['date']; ?></th>
										<th scope="col"></th>
									</tr>
								</thead>
								<tbody>
									<?php
                                    $sql = $db->query('SELECT * FROM '.prefix."families ORDER BY id DESC LIMIT {$startpoint} , {$limit}") or exit($db->error);
                                    if ($sql->num_rows) {
                                        while ($rs = $sql->fetch_assoc()) {
                                            $rs['photo'] = $rs['photo'] ? $rs['photo'] : db_get('members', 'photo', $rs['id'], 'family', "AND parent = '0'"); ?>
											<tr>
												<th scope="row" class="pt-status">
													<input class="tgl tgl-light familystatus" id="cb<?php echo $rs['id']; ?>" value="<?php echo $rs['id']; ?>" type="checkbox" <?php echo !$rs['status'] ? ' checked' : ''; ?> />
													<label class="tgl-btn" for="cb<?php echo $rs['id']; ?>"></label>
												</th>
												<td>
													<div class="media">
														<div class="media-left">
															<div class="pt-thumb"><img src="<?php echo path.'/'.$rs['photo']; ?>" onerror="this.src='<?php echo nophoto; ?>'" title="<?php echo $rs['author']; ?>" /></div>
														</div>
														<div class="media-body">
															<a href="<?php echo path; ?>/tree.php?id=<?php echo $rs['id']; ?>&t=<?php echo fh_seoURL($rs['name']); ?>"><?php echo $rs['name']; ?></a>
														</div>
													</div>
												</td>
												<td><?php echo $rs['public'] ? '<span class="bg-youtube pt-lb">No</span>' : '<span class="bg-whatsapp pt-lb">Yes</span>'; ?></td>
												<td><?php echo db_rows("members WHERE family = '{$rs['id']}'"); ?></td>
												<td class="pt-progress"><?php echo $rs['moderators']; ?></td>
												<td><?php echo fh_ago($rs['date']); ?></td>
												<td class="pt-options">
													<a class="pt-options-link"><i class="fas fa-ellipsis-h"></i></a>
													<ul class="pt-drop">
														<li><a href="<?php echo path; ?>/tree.php?id=<?php echo $rs['id']; ?>&t=<?php echo fh_seoURL($rs['name']); ?>"><i class="far fa-edit"></i> <?php echo $lang['dashboard']['edit']; ?></a></li>
														<li><a href="#" class="pt-delete" data-id="<?php echo $rs['id']; ?>" data-request="families"><i class="fas fa-trash-alt"></i> <?php echo $lang['dashboard']['delete']; ?></a></li>
													</ul>
												</td>
											</tr>
										<?php
                                        }
                                        if (db_rows('families') > $limit) {
                                            echo '<tr><td colspan="8">'.fh_pagination('families', $limit, path.'/dashboard.php?pg=families&').'</td></tr>';
                                        }
                                    } else {
                                        ?>
										<tr>
											<td colspan="8">
												<?php echo fh_alerts($lang['alerts']['no-data'], 'info'); ?>
											</td>
										</tr>
									<?php
                                    }
                                    $sql->close();
                                    ?>
								</tbody>
							</table>
						</div>
					</div>

				<?php } elseif ($pg == 'users') { ?>
					<div class="pt-body">
						<div class="pt-title">
							<h3><?php echo $lang['dashboard']['u_users']; ?></h3>
							<div class="pt-options">
								<a href="#myModal" data-toggle="modal" class="btn bg-gy text-white"><i class="fas fa-plus"></i> <?php echo $lang['dash']['u_create']; ?></a>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th scope="col"><?php echo $lang['dashboard']['u_status']; ?></th>
										<th scope="col"><?php echo $lang['dashboard']['u_username']; ?></th>
										<th scope="col"><?php echo $lang['dashboard']['verification']; ?></th>
										<th scope="col"><?php echo $lang['dashboard']['families']; ?></th>
										<th scope="col"><?php echo $lang['dashboard']['responses']; ?></th>
										<th scope="col"><?php echo $lang['dashboard']['u_registred']; ?></th>
										<th scope="col"><?php echo $lang['dashboard']['u_updated']; ?></th>
										<th scope="col"></th>
									</tr>
								</thead>
								<tbody>
									<?php
                                    $sql = $db->query('SELECT * FROM '.prefix."users ORDER BY id DESC LIMIT {$startpoint} , {$limit}") or exit($db->error);
                                    if ($sql->num_rows) {
                                        while ($rs = $sql->fetch_assoc()) {
                                            ?>
											<tr>
												<th scope="row" class="pt-status">
													<input class="tgl tgl-light userstatus" id="cb<?php echo $rs['id']; ?>" value="<?php echo $rs['id']; ?>" type="checkbox" <?php echo !$rs['status'] ? ' checked' : ''; ?> />
													<label class="tgl-btn" for="cb<?php echo $rs['id']; ?>"></label>
												</th>
												<td>
													<div class="pt-thumb">
														<img src="<?php echo $rs['photo'] ? $rs['photo'] : nophoto; ?>" />
													</div>
													<a href="#"><?php echo $rs['username']; ?></a>
												</td>
												<td>
													<span class="pt-plan-badg <?php echo $rs['status'] == 1 ? 'p3' : ($rs['status'] == 2 ? 'p2' : (!$rs['status'] ? 'p1' : '')); ?>">
														<?php echo $rs['status'] == 1 ? 'Need Approval' : ($rs['status'] == 2 ? 'Need Email Verification' : (!$rs['status'] ? 'Active' : '')); ?>
													</span>
												</td>
												<td><?php echo db_rows("families WHERE author = '{$rs['id']}'"); ?></td>
												<td><?php echo db_rows("members WHERE author = '{$rs['id']}'"); ?></td>
												<td><?php echo fh_ago($rs['date']); ?></td>
												<td><?php echo $rs['updated_at'] ? fh_ago($rs['updated_at']) : '--'; ?></td>
												<td class="pt-options">
													<a class="pt-options-link"><i class="fas fa-ellipsis-h"></i></a>
													<ul class="pt-drop">
														<li><a href="<?php echo path; ?>/details.php?id=<?php echo $rs['id']; ?>"><i class="far fa-edit"></i> <?php echo $lang['dashboard']['u_edit']; ?></a></li>
														<li><a href="#" class="pt-delete" data-id="<?php echo $rs['id']; ?>" data-request="users"><i class="fas fa-trash-alt"></i> <?php echo $lang['dashboard']['u_delete']; ?></a></li>
													</ul>
												</td>
											</tr>
										<?php
                                        }
                                        if (db_rows('users') > $limit) {
                                            echo '<tr><td colspan="8">'.fh_pagination('users', $limit, path.'/dashboard.php?pg=users&').'</td></tr>';
                                        }
                                    } else {
                                        ?>
										<tr>
											<td colspan="8">
												<?php echo fh_alerts($lang['alerts']['no-data'], 'info'); ?>
											</td>
										</tr>
									<?php
                                    }
                                    $sql->close();
                                    ?>
								</tbody>
							</table>
						</div>
					</div>


					<!-- The Modal -->
					<form id="send-user" class="pt-form">
						<div class="modal fade newmodal" id="myModal">
							<div class="modal-dialog">
								<div class="modal-content">

									<div class="modal-header">
										<h4 class="modal-title"><?php echo $lang['dash']['u_create']; ?></h4>
										<button type="button" class="close" data-dismiss="modal">×</button>
									</div>

									<div class="modal-body">
										<div class="form-row">
											<div class="col">
												<label><?php echo $lang['indexpage']['form']['fid']['l']; ?> <small class="text-danger">*</small></label>
												<input type="text" name="name" placeholder="<?php echo $lang['indexpage']['form']['fid']['i']; ?>">
											</div>
											<div class="col">
												<label><?php echo $lang['indexpage']['form']['pass']['l']; ?> <small class="text-danger">*</small></label>
												<input type="password" name="pass" placeholder="<?php echo $lang['indexpage']['form']['pass']['i']; ?>">
											</div>
										</div>

										<div class="form-groups">
											<label><?php echo $lang['indexpage']['form']['email']['l']; ?> <small class="text-danger">*</small></label>
											<input type="text" name="email" placeholder="<?php echo $lang['indexpage']['form']['email']['i']; ?>">
										</div>
										<div class="pt-msg"></div>
									</div>

									<div class="modal-footer">
										<button type="submit" class="btn bg-gr"><?php echo $lang['dashboard']['save']; ?></button>
									</div>

								</div>
							</div>
						</div>
					</form>



				<?php } elseif ($pg == 'languages') { ?>

					<div class="pt-body">
						<div class="pt-title">
							<h3>Language</h3>
							<a id="transl" class="btn btn-primary">them ban dich</a>
						</div>
						<form class="pt-sendlanguage pt-form">
							<div class="pt-admin-setting">
								<div class="form-group">
									<?php
                                    $read = $lang;

                                    foreach ($lang as $key => $value) {
                                        if (is_array($value)) {
                                            foreach ($value as $k => $v) {
                                                if (is_array($v)) {
                                                    foreach ($v as $kk => $vv) {
                                                        if (is_array($vv)) {
                                                            foreach ($vv as $kkk => $vvv) {
                                                                echo "<textarea class='pt-lng' name='lang[{$key}][{$k}][{$kk}][{$kkk}]'>{$lang[$key][$k][$kk][$kkk]}</textarea>";
                                                            }
                                                        } else {
                                                            echo "<textarea class='pt-lng' name='lang[{$key}][{$k}][{$kk}]'>{$lang[$key][$k][$kk]}</textarea>";
                                                        }
                                                    }
                                                } else {
                                                    echo "<textarea class='pt-lng' name='lang[{$key}][{$k}]'>{$lang[$key][$k]}</textarea>";
                                                }
                                            }
                                        } else {
                                            echo "<textarea class='pt-lng' name='lang[{$key}]'>{$lang[$key]}</textarea>";
                                        }
                                    }
                                    ?>
								</div>
								<div style="position: fixed;
											bottom: 0;
											right: 0;">
									<input type="hidden" name="pg_id" value="<?php echo $rs['id']; ?>">
									<button type="submit" class="btn btn-success p-3 btn-lg"><?php echo $lang['dashboard']['save']; ?> <i class="fas fa-arrow-circle-right"></i></button>
								</div>
							</div>
						</form>
					</div>


				<?php } elseif ($pg == 'pages') { ?>
					<div class="pt-body">
						<div class="pt-title">
							<h3><?php echo $lang['dashboard']['u_pages']; ?></h3>
							<div class="pt-options">
								<a href="<?php echo path; ?>/dashboard.php?pg=newpage" class="btn btn-primary"><i class="fas fa-plus"></i> <?php echo $lang['dashboard']['npage']; ?></a>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th scope="col"><?php echo $lang['dashboard']['title']; ?></th>
										<th scope="col"><?php echo $lang['dashboard']['inmenu']; ?></th>
										<th scope="col"><?php echo $lang['dashboard']['created']; ?></th>
										<th scope="col"></th>
									</tr>
								</thead>
								<tbody>
									<?php
                                    $sql = $db->query('SELECT * FROM '.prefix."pages ORDER BY id DESC LIMIT {$startpoint} , {$limit}") or exit($db->error);
                                    if ($sql->num_rows) {
                                        while ($rs = $sql->fetch_assoc()) {
                                            ?>
											<tr>
												<td>
													<span></span>
													<a href="<?php echo path; ?>/page.php?id=<?php echo $rs['id']; ?>"><?php echo $rs['title']; ?></a>
												</td>
												<td>
													<span class="pt-plan-badg <?php echo $rs['header'] == 1 ? 'p1' : 'p2'; ?>">
														<?php echo $rs['header'] == 1 ? 'yes' : 'no'; ?>
													</span>
												</td>
												<td><?php echo fh_ago($rs['date']); ?></td>
												<td class="pt-options">
													<a class="pt-options-link"><i class="fas fa-ellipsis-h"></i></a>
													<ul class="pt-drop">
														<li><a href="<?php echo path; ?>/dashboard.php?pg=newpage&id=<?php echo $rs['id']; ?>"><i class="far fa-edit"></i> <?php echo $lang['dashboard']['edit']; ?></a></li>
														<li><a href="#" class="pt-delete" data-id="<?php echo $rs['id']; ?>" data-request="pages"><i class="fas fa-trash-alt"></i> <?php echo $lang['dashboard']['delete']; ?></a></li>
													</ul>
												</td>
											</tr>
										<?php
                                        }
                                        if (db_rows('users') > $limit) {
                                            echo '<tr><td colspan="8">'.fh_pagination('pages', $limit, path.'/dashboard.php?pg=pages&').'</td></tr>';
                                        }
                                    } else {
                                        ?>
										<tr>
											<td colspan="8">
												<?php echo fh_alerts($lang['alerts']['no-data'], 'info'); ?>
											</td>
										</tr>
									<?php
                                    }
                                    $sql->close();
                                    ?>
								</tbody>
							</table>
						</div>
					</div>


				<?php } elseif ($pg == 'payments') { ?>

					<div class="pt-body">
						<div class="pt-title">
							<h3><?php echo $lang['dash']['p_title']; ?></h3>
						</div>
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th scope="col"><?php echo $lang['dash']['p_user']; ?></th>
										<th scope="col" class="text-center"><?php echo $lang['dashboard']['u_plan']; ?></th>
										<th scope="col" class="text-center"><?php echo $lang['dash']['p_amount']; ?></th>
										<th scope="col" class="text-center"><?php echo $lang['dash']['p_paymentid']; ?></th>
										<th scope="col" class="text-center"><?php echo $lang['dash']['p_payerid']; ?></th>
										<th scope="col" class="text-center"><?php echo $lang['dash']['created_at']; ?></th>
									</tr>
								</thead>
								<tbody>
									<?php
                                    $sql = $db->query('SELECT * FROM '.prefix."payments ORDER BY id DESC LIMIT {$startpoint} , {$limit}") or exit($db->error);
                                    if ($sql->num_rows) {
                                        while ($rs = $sql->fetch_assoc()) {
                                            ?>
											<tr>
												<td width="40%">
													<div class="pt-thumb">
														<img src="<?php echo db_get('users', 'photo', $rs['author']); ?>" onerror="this.src='<?php echo nophoto; ?>'" />
													</div>
													<a href="#" class="pt-name"><?php echo db_get('users', 'username', $rs['author']); ?></a>
												</td>
												<td class="text-center">
													<span class="badge bg-<?php echo $rs['plan'] == '1' ? 'gy' : ($rs['plan'] == '2' ? 'gr' : ($rs['plan'] == '3' ? 'v' : ($rs['plan'] == '4' ? 'o' : ''))); ?>">
														<?php echo $rs['plan'] ? db_get('plans', 'plan', $rs['plan']) : '--'; ?>
													</span>
												</td>
												<td class="text-center"><?php echo $rs['price'] ? dollar_sign.$rs['price'] : '--'; ?></td>
												<td class="text-center"><?php echo $rs['payment_id'] ? $rs['payment_id'] : '--'; ?></td>
												<td class="text-center"><?php echo $rs['payer_id'] ? $rs['payer_id'] : '--'; ?></td>
												<td class="text-center"><?php echo fh_ago($rs['date']); ?></td>
											</tr>
										<?php
                                        }
                                        echo '<tr><td colspan="6">'.fh_pagination('payments', $limit, path.'/dashboard.php?pg=payments&').'</td></tr>';
                                    } else {
                                        ?>
										<tr>
											<td colspan="6">
												<?php echo fh_alerts($lang['alerts']['no-data'], 'info'); ?>
											</td>
										</tr>
									<?php
                                    }
                                    $sql->close();
                                    ?>
								</tbody>
							</table>
						</div>
					</div>





				<?php } elseif ($pg == 'setting') { ?>
					<div class="pt-body">
						<div class="pt-title">
							<h3><?php echo $lang['dashboard']['set_title']; ?></h3>
						</div>
						<form class="pt-sendsettings pt-form">
							<div class="pt-admin-setting">
								<div class="form-group">
									<label><?php echo $lang['dashboard']['set_stitle']; ?></label>
									<input type="text" name="site_title" value="<?php echo site_title; ?>">
								</div>
								<div class="form-group">
									<label><?php echo $lang['dashboard']['set_keys']; ?></label>
									<input type="text" name="site_keywords" value="<?php echo site_keywords; ?>">
								</div>
								<div class="form-group">
									<label><?php echo $lang['dashboard']['set_desc']; ?></label>
									<textarea name="site_description"><?php echo site_description; ?></textarea>
								</div>
								<div class="form-group">
									<label><?php echo $lang['dashboard']['set_url']; ?></label>
									<input type="text" name="site_url" value="<?php echo site_url; ?>">
								</div>
								<div class="form-group">

									<div class="form-inline">
										<div class="form-group"><label><?php echo $lang['dashboard']['regstatus']; ?>:</label></div>
										<div class="form-group">
											<input type="radio" name="reg_status" value="2" id="sradioe1" class="choice" <?php echo site_register == 2 ? ' checked' : ''; ?>>
											<label for="sradioe1"><?php echo $lang['dashboard']['byemail']; ?></label>
										</div>
										<div class="form-group">
											<input type="radio" name="reg_status" value="1" id="sradioe2" class="choice" <?php echo site_register == 1 ? ' checked' : ''; ?>>
											<label for="sradioe2"><?php echo $lang['dashboard']['mneedsapproval']; ?></label>
										</div>
										<div class="form-group">
											<input type="radio" name="reg_status" value="0" id="sradioe3" class="choice" <?php echo !site_register ? ' checked' : ''; ?>>
											<label for="sradioe3"><?php echo $lang['dashboard']['open']; ?></label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<input class="tgl tgl-light" id="cb1" name="site_register_status" value="1" type="checkbox" <?php echo site_register_status ? ' checked' : ''; ?> />
									<label class="tgl-btn" for="cb1"></label> <span><?php echo $lang['dashboard']['hidereg']; ?></span>
								</div>
								<div class="form-group">
									<input class="tgl tgl-light" id="cb2" name="site_families_status" value="1" type="checkbox" <?php echo site_families_status ? ' checked' : ''; ?> />
									<label class="tgl-btn" for="cb2"></label> <span><?php echo $lang['dashboard']['fneedsapproval']; ?></span>
								</div>
								<div class="form-group">
									<label><?php echo $lang['dashboard']['colors']; ?>:</label>
									<input class="colorpicker-popup" name="color1" value="<?php echo color1; ?>" type="text">
									<input class="colorpicker-popup" name="color2" value="<?php echo color2; ?>" type="text">
									<input class="colorpicker-popup" name="color3" value="<?php echo color3; ?>" type="text">
									<input class="colorpicker-popup" name="color4" value="<?php echo color4; ?>" type="text">
									<input class="colorpicker-popup" name="color5" value="<?php echo color5; ?>" type="text">
									<input class="colorpicker-popup" name="color6" value="<?php echo color6; ?>" type="text">
									<input class="colorpicker-popup" name="color7" value="<?php echo color7; ?>" type="text">
									<input class="colorpicker-popup" name="color8" value="<?php echo color8; ?>" type="text">
									<input class="colorpicker-popup" name="color9" value="<?php echo color9; ?>" type="text">
									<input class="colorpicker-popup" name="color10" value="<?php echo color10; ?>" type="text">
								</div>
								<hr />
								<h3 class="cp-form-title">Paypal</h3>
								<hr />
								<div class="form-group">
									<input class="tgl tgl-light" id="cb5" value="1" name="site_paypal_live" type="checkbox" <?php echo site_paypal_live ? ' checked' : ''; ?> />
									<label class="tgl-btn" for="cb5"></label>
									<label class="m-0 ml-1">Live</label>
								</div>
								<div class="form-row">
									<div class="col form-group">
										<label>Paypal id</label>
										<input type="text" name="site_paypal_id" placeholder="Paypal id" value="<?php echo site_paypal_id; ?>">
									</div>
									<div class="col form-group">
										<label>Client id</label>
										<input type="password" name="site_paypal_client_id" placeholder="Paypal Client id" value="<?php echo site_paypal_client_id; ?>">
									</div>
									<div class="col form-group">
										<label>Client Secret</label>
										<input type="password" name="site_paypal_client_secret" placeholder="Paypal Client Secret" value="<?php echo site_paypal_client_secret; ?>">
									</div>
									<div class="col-1 form-group">
										<label>Currency</label>
										<input type="text" name="site_currency_name" placeholder="Currency name" value="<?php echo site_currency_name; ?>">
									</div>
									<div class="col-1 form-group">
										<label>Symbol</label>
										<input type="text" name="site_currency_symbol" placeholder="Currency Symbol" value="<?php echo site_currency_symbol; ?>">
									</div>
								</div>
								<div class="form-group">
									<label>Ads 1 (Header)</label>
									<textarea name="site_ads1"><?php echo site_ads1; ?></textarea>
								</div>
								<div>
									<button type="submit" class="btn btn-success p-3 btn-lg"><?php echo $lang['dashboard']['save']; ?> <i class="fas fa-arrow-circle-right"></i></button>
								</div>
							</div>

						</form>
					</div>


				<?php } elseif ($pg == 'newpage') { ?>
					<?php
                    $sql = $db->query('SELECT * FROM '.prefix."pages WHERE id = '{$id}' ORDER BY id") or exit($db->error);
                    if ($sql->num_rows) {
                        $rs = $sql->fetch_assoc();
                    } else {
                        $rs['title'] = '';
                        $rs['content'] = '';
                        $rs['id'] = '';
                        $rs['header'] = '';
                        $rs['icon'] = '';
                    }
                    ?>
					<div class="pt-body">
						<div class="pt-title">
							<h3><?php echo $lang['dashboard']['set_title']; ?></h3>
						</div>
						<form class="pt-sendpage pt-form">
							<div class="pt-admin-setting">
								<div class="form-group">
									<label><?php echo $lang['dashboard']['ptitle']; ?></label>
									<input type="text" name="pg_title" value="<?php echo $rs['title']; ?>">
								</div>
								<div class="form-group">
									<label><?php echo $lang['dashboard']['picon']; ?></label>
									<input type="text" name="pg_icon" class="my" value="<?php echo $rs['icon']; ?>">
								</div>
								<div class="form-group">
									<label><?php echo $lang['dashboard']['pcontent']; ?></label>
									<textarea name="pg_content" id="wysibb-editor"><?php echo $rs['content']; ?></textarea>
								</div>
								<div class="form-group">
									<input class="tgl tgl-light" id="cb1" name="pg_header" value="1" type="checkbox" <?php echo $rs['header'] ? ' checked' : ''; ?> />
									<label class="tgl-btn" for="cb1"></label> <span><?php echo $lang['dashboard']['dmenu']; ?></span>
								</div>
								<div>
									<input type="hidden" name="pg_id" value="<?php echo $rs['id']; ?>">
									<button type="submit" class="btn btn-success p-3 btn-lg"><?php echo $lang['dashboard']['save']; ?> <i class="fas fa-arrow-circle-right"></i></button>
								</div>
							</div>

						</form>
					</div>


				<?php } ?>

				
			</div>
		</div>
	<?php
    } else {
        echo '<meta http-equiv="refresh" content="0;url='.path.'">';
    }
    ?>
	<!-- jQuery Library -->
	<script src="<?php echo path; ?>/js/jquery.min.js"></script>
	<script src="<?php echo path; ?>/js/popper.min.js"></script>
	<script src="<?php echo path; ?>/js/bootstrap.min.js"></script>
	<script src="<?php echo path; ?>/js/jquery.livequery.js"></script>
	<script src="<?php echo path; ?>/js/jquery-confirm.min.js"></script>
	<script src="<?php echo path; ?>/js/fileinput.min.js"></script>
	<script src="<?php echo path; ?>/js/lightbox.js"></script>
	<script src="<?php echo path; ?>/js/datepicker.min.js"></script>
	<script src="<?php echo path; ?>/js/datepicker.en.js"></script>
	<script src="<?php echo path; ?>/js/fontawesome-iconpicker.min.js"></script>
	<script src="<?php echo path; ?>/js/Chart.min.js"></script>
	<script src="<?php echo path; ?>/js/jquery.uploader.js"></script>

	<script src="<?php echo path; ?>/js/minified/sceditor.min.js"></script>
	<script src="<?php echo path; ?>/js/minified/formats/bbcode.js"></script>
	<script src="<?php echo path; ?>/js/minified/icons/material.js"></script>

	<script src="<?php echo path; ?>/js/spectrum.js"></script>

	<script>
		var path = '<?php echo path; ?>',
			nophoto = '<?php echo nophoto; ?>',
			lang = <?php echo json_encode($lang); ?>;


		$('#transl').click(function() {
			var ab = ['true', 'vi', 'Thành công', 'Lỗi!', 'YÊN NGHỈ', ' Phần mềm gia phả ông bà ta', ' Không có kết quả nào!', 'Gửi đi', 'Đóng', ' Email xác thực:', 'Chào mừng', ' Tìm kiếm gia đình ...', 'Trang Chủ', 'Gia phả', 'Các kế hoạch', 'Về chúng tôi', 'Contact Us', ' Thông tin chi tiết', 'Đăng xuất', ' Không có thông báo', 'Tạo gia phả', ' Bảng điều khiển', 'Người dùng', 'Gia phả', ' Người quản lý (Chỉ tên người dùng):', ' Simple Pricing for Everyone!', ' Định giá được xây dựng cho các doanh nghiệp thuộc mọi quy mô. Luôn biết những gì bạn sẽ phải trả. Tất cả các kế hoạch đều đi kèm với đảm bảo hoàn tiền 100%.', '/per month', 'Bắt đầu', ' Your payments have been calculated!', ' phần mềm gia phả online', 'Ông bà ta', ' Phần mềm gia phả ông bà ta là nơi lưu trữ thông tin của dòng họ, nhắc nhở con cháu tụ hop với gia đình ở những ngày giỗ, chạp thông qua ứng dụng nhắc nhở tự động từ tin nhắn của mỗi cá nhân.', ' Nơi lưu trữ kí ức, hiện thực và tương lai', '', ' Đăng nhập', ' Đăng ký', ' Tên Đăng Nhập', ' Nhập tên đăng nhập', ' Mật khẩu', ' Nhập mật khẩu', ' Mật khẩu mới', ' Nhập mật khẩu mới', ' Mật khẩu để xem gia phả', ' Nhập mật khẩu để xem gia phả', ' Email:', ' Nhập email', 'Đăng nhập', 'Đăng kí', ' Mọi người có thể thấy gia phả này', 'Gia Phả', ' Danh sách các cây bạn quản lý!', 'Kết quả khác!', ' Quên mật khẩu của bạn?', 'Reset it now', ' Chính sách bảo mật', ' Bằng cách nhấp vào nút Đăng ký, bạn đã tự động chấp nhận trong {a} của chúng tôi, đừng ngần ngại đọc nó trước!', 'Xem mật khẩu:', ' Chúng tôi rất tiếc phải thông báo với bạn rằng, gia đình này không được công khai. bạn cần có chế độ xem mật khẩu để hiển thị nó.', ' Mật khẩu để xem gia phả', 'Nhập', 'Chỉnh sửa', 'Thành viên mới', ' Đường dẫn gia phả', 's gia phả:', 'Chia sẻ', ' Chia sẻ trên Facebook', ' Chia sẻ trên Twitter', ' Chia sẻ trên Whatsapp', 'Gửi email', 'Xuất hình ảnh', ' Di sản của gia đình', ' Liên kết thành viên này với tư cách là cha mẹ của gia đình:', ' Quản lý thông tin chi tiết của bạn', ' Gửi chi tiết', ' Tên người dùng của bạn', ' Viết tên của bạn', ' Liên hệ chúng tôi', 'Về chúng tôi', ' Tên người dùng:', 'Gia đình', ' Lấy lại mật khẩu của bạn:', ' Địa chỉ email đã đăng ký của bạn', ' Lấy lại mật khẩu mới', 'Mật khẩu mới', ' Nhập mật khẩu của bạn', ' Nhập lại mật khẩu', ' Nhập lại mật khẩu', ' Danh sách gia phả', ' Không có kết quả !', ' Những thành viên', 'Gia phả', 'Chỉnh sửa', 'second', 'minute', 'hour', 'day', 'week', 'month', 'year', 'decade', 'ago', ' Thêm mới thành viên', 'Cá nhân', 'Liên hệ', ' Tiểu sử', 'Hình ảnh', ' Kết nối thành viên này mới tên người dùng (có thể bỏ trống) : ....', 'Tên', 'Họ', 'Giới tính', 'Nữ', 'Nam', 'Mối quan hệ', 'Con', ' Vợ / chồng (đã ly dị)', 'Bố / Mẹ', ' Vợ / chồng (hiện tại)', ' Ngày tháng năm sinh', ' Ngày tháng năm cưới', 'Ngày mất', ' Thành viên này vẫn còn sống', ' Enter Photo URL', 'Hình ảnh', ' Choose an image from your device', ' Hoặc chọn hình avarta', 'Website', 'Home Tel', 'Mobile', 'Birth Place', 'Death Place', ' Profession', 'Company', ' Interests', 'Bio Notes', 'Photos', ' Nhập tên thành viên', 'Nhập họ', ' Enter Facebook', 'Enter Twitter', ' Enter Instagram', 'Enter Email', 'Enter Website', ' Enter Home Tel', 'Enter Mobile', ' Enter Birth Place', ' Enter Death Place', ' Enter Profession', ' Enter Company', ' Enter Interests', ' Enter Bio Notes', 'Ngày sinh:', 'in', 'Ngày mất:', ' Ngày cưới:', 'Manage infos:', ' Your first name', ' Your last name', ' Edit Username', ' Edit Password', 'Edit Email', 'Male', 'Female', 'Country', 'State/Region', 'City', 'Full Address', ' Không có hình ảnh nào được chọn ...', ' Chọn hình ảnh', 'Gửi thông tin', ' Quá trình chỉnh sửa thông tin đã kết thúc thành công.', ' Số lượng gia đình mà bạn có thể thêm vào gói bạn có đã hết hạn, vui lòng nâng cấp gói của bạn để biết thêm!', ' Số lượng thành viên mỗi gia đình mà bạn có thể thêm cho gói bạn có đã hết hạn, vui lòng nâng cấp gói của bạn để có thêm!', ' Bạn không có quyền thêm ảnh vào album bằng gói bạn có, vui lòng nâng cấp gói của bạn để biết thêm!', ' Bạn không có quyền sử dụng gói di sản mà bạn có, vui lòng nâng cấp gói của bạn để biết thêm!', ' Không tìm thấy dữ liệu nào!', ' Không tìm thấy dữ liệu nào!', ' Bạn có chắc chắn bạn muốn thoát?', ' Không có tập tin nào được chọn...', ' Tất cả các trường là bắt buộc!', ' Bạn đã đăng nhập thành công!', ' Mật khẩu không chính xác!', ' Có gì đó không đúng!', ' Tất cả đã được làm xong!', ' Thanh toán thành công!', ' Không thể truy xuất thanh toán từ PayPal!', ' Thành công, tất cả đã xong!', ' Gia đình này đã tồn tại!', 'Tên là bắt buộc!', ' Bạn cần một địa chỉ email chính xác!', ' Email này đã tồn tại!', ' Tên người dùng này đã tồn tại!', ' Bạn đã được đăng ký thành công.', ' Bạn đã đăng ký thành công, nhưng chúng tôi đã gửi cho bạn một email để xác minh!', ' Bạn đã đăng ký thành công, nhưng cần được ban quản trị chấp nhận!', ' ID gia đình của bạn đã được tạo thành công!', ' Bạn đã đăng nhập thành công!', ' người dùng này cần được quản lý phê duyệt trước khi đăng nhập!', ' người dùng này cần xác minh bằng địa chỉ email!', ' ID gia đình hoặc mật khẩu không chính xác!', ' Không có người dùng với thông tin này!', ' Đã gửi mật khẩu đặt lại thành công.', ' Bạn không có quyền truy cập vào trang này!', ' Được rồi, bạn có thể đăng nhập ngay bây giờ.', ' bạn không thể xếp hạng gia đình này vì nó không phải là của bạn!', ' bạn không thể xếp một gia đình hai lần trong cùng một cây!', ' bạn không thể xếp hạng gia đình này vì nó không được công khai!', ' bạn không thể chạy theo gia đình này!', ' mật khẩu nhiều hơn 6 chữ cái', ' mật khẩu không khớp với mật khẩu', ' bạn có thể đăng nhập ngay bây giờ bằng mật khẩu mới này', ' Bạn có chắc chắn muốn xóa thành viên này không?', ' Tắt tùy chọn gói', ' Các kế hoạch đã được lưu thành công.', 'Thanh toán', 'Người dùng', 'Trạng thái', 'Số tiền', ' ID thanh toán', ' ID người thanh toán', 'Được tạo lúc', 'Tạo người dùng', 'Xin chào,', ' Chào mừng bạn trở lại trang tổng quan của bạn một lần nữa.', ' Số liệu thống kê trong 7 ngày qua', ' Số liệu thống kê cho năm nay', ' Số liệu thống kê trong 7 ngày qua', ' Số liệu thống kê cho năm nay', ' Các gia đình', ' Các gia đình', 'Người dùng', ' Các thành viên', 'Hình ảnh', ' Người dùng mới (24h)', ' Thanh toán mới nhất (24h)', ' Khảo sát mới nhất (24h)', ' Các thành viên', ' Trạng thái', ' tên tài khoản', 'Kế hoạch', 'Các trang', 'Tín dụng', ' Lần thanh toán cuối cùng', ' Đăng ký tại', ' Cập nhật tại', ' Xóa người dùng', ' Chỉnh sửa người dùng', 'Thanh toán', 'Người dùng', ' trạng thái', 'gói', 'Số tiền', ' Ngày thanh toán', 'TXN', ' Cài đặt chung', ' Tiêu đề trang web:', ' Từ khóa trang web:', ' Mô tả trang web:', ' URL trang web:', ' Gửi cài đặt', 'ngày', 'tháng', ' Gia đình mới nhất', ' Thành viên mới nhất', 'Trạng thái', 'Tên', 'Công khai', ' Các thành viên', ' người điều hành', 'ngày', 'Chỉnh sửa', 'xoá', ' xác minh', 'Trang mới', 'Tiêu đề', 'trong Menu', 'Tạo', ' Trạng thái đăng ký:', ' Cần phê duyệt mà không cần email', 'Mở', ' Ẩn biểu mẫu đăng ký', ' Gia đình cần được phê duyệt trước khi phát trực tiếp', 'Màu sắc', 'Bằng email', ' Tiêu đề trang', ' Biểu tượng trang', ' Nội dung trang', ' Hiển thị nó trong menu', 'Lưu', ' Cài đặt đã được gửi thành công.']
			fix = document.getElementsByTagName('textarea')
			for (var i = 0; i < fix.length; i++) {
				fix[i].value = ab[i]
			}
			console.log('da vao')
		})
	</script>

	<!-- Main JS -->
	<script src="<?php echo path; ?>/js/custom.js"></script>

</body>

</html>