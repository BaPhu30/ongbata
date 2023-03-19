<meta charset="UTF-8">
<?php
/*=======================================================/
    | Craeted By: Khalid puerto
    | URL: www.puertokhalid.com
    | Facebook: www.facebook.com/prof.puertokhalid
    | Instagram: www.instagram.com/khalidpuerto
    | Whatsapp: +212 654 211 360
 /======================================================*/

// include __DIR__.'/configs/config.php';

require_once __DIR__.'/../configs/config.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $lang['lang']; ?>">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo fh_title(); ?></title>

	<meta name="title" content="<?php echo fh_title(); ?>">
	<meta name="description" content="<?php echo site_description; ?>">
	<meta name="keywords" content="<?php echo site_keywords; ?>">

	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?php echo site_url; ?>">
	<meta property="og:title" content="<?php echo fh_title(); ?>">
	<meta property="og:description" content="<?php echo site_description; ?>">
	<meta property="og:image" content="<?php echo site_url; ?>">

	<!-- map api -->
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
	<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="<?php echo site_url; ?>">
	<meta property="twitter:title" content="<?php echo fh_title(); ?>">
	<meta property="twitter:description" content="<?php echo site_description; ?>">
	<meta property="twitter:image" content="<?php echo site_url; ?>">

	<!-- Google Fonts -->
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,900%7CGentium+Basic:400italic&subset=latin,latin">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,300,700">
	<link href="//fonts.googleapis.com/css?family=Coda+Caption:800|Poppins|Squada+One|Sriracha&display=swap" rel="stylesheet">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?php echo path; ?>/css/bootstrap.min.css" />

	<!-- Font Awseome -->
	<link rel="stylesheet" href="<?php echo path; ?>/css/all.min.css">

	<!-- jConfirm plugin -->
	<link rel="stylesheet" href="<?php echo path; ?>/css/jquery-confirm.min.css">

	<!-- jQuery Datepicker plugin -->
	<link rel="stylesheet" href="<?php echo path; ?>/css/datepicker.min.css">

	<!-- jQuery Lightbox plugin -->
	<link rel="stylesheet" href="<?php echo path; ?>/css/lightbox.css" />

	<!-- jQuery File input plugin -->
	<link rel="stylesheet" href="<?php echo path; ?>/css/fileinput.css" />

	<!-- Basic Style for Tags Input -->
	<link rel="stylesheet" href="<?php echo path; ?>/css/amsify.suggestags.css">

	<!-- lunar calendar -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	<script src="https://unpkg.com/moment-lunar@0.0.4/moment-lunar.min.js"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-T9HF4GVZQL"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'G-T9HF4GVZQL');
	</script>

	<!-- mapbox -->
	<link href="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css" rel="stylesheet" />
	<script src="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js"></script>

	<!-- notification system -->

	<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
	<script>
		window.OneSignal = window.OneSignal || [];
		OneSignal.push(function() {
			OneSignal.init({
				appId: "8d05c3ae-f23a-45d3-8227-9015d8647443",
				safari_web_id: "web.onesignal.auto.5cadd501-3597-404f-b8f7-8075876e5307",
				notifyButton: {
					enable: true,
				},
			});
		});
	</script>

	<!-- Main CSS -->
	<link rel="stylesheet" href="<?php echo path; ?>/css/style.css">
	<style>
		.pt-header-menu .pt-logo,
		.pt-tree h3 span,
		.pt-header-menu .pt-search button,
		.pt-pageplans .alert-success {
			background: <?php echo color1; ?>;
		}

		.pt-pageplans .alert-success span {
			color: <?php echo color1; ?>;
		}

		.pt-nav-menu,
		.pt-pagination li.pt-active,
		.pt-mnewmember button[type=submit],
		.pt-pageplans .pt-plans .col:nth-of-type(2) .pt-plan,
		.pt-pageplans .pt-plans .pt-plan button {
			background: <?php echo color2; ?>;
			border-color: <?php echo color2; ?>;
			box-shadow: 4px 1px 6px <?php echo color2; ?>45;
		}

		.pt-nav-menu ul li:first-of-type a:hover,
		.pt-nav-menu ul li a:hover {
			background: <?php echo color4; ?>;
			color: <?php echo color1; ?>;
		}

		.tree ul li a:not([href]):hover,
		.tree ul li a:not([href]):hover .pt-thumb,
		.pt-list .pt-title span,
		.pt-list-item .pt-thumb {
			box-shadow: 0 0 0 2px <?php echo color4; ?>, 0 0 0 4px <?php echo color2; ?>;
		}

		.pt-nav-menu ul li a:hover b,
		.pt-index-right button {
			background: <?php echo color2; ?>;
			box-shadow: 0px 0px 7px <?php echo color2; ?>45;
		}

		body,
		.pt-sm {
			background: <?php echo color4; ?>;
			margin: 10px !important;
		}

		.pt-tree a.exp {
			background: <?php echo color9; ?>;
			border: 1px solid <?php echo color9; ?>;
		}

		.pt-tree a.exp .pt-thumb {
			border: 3px solid <?php echo color9; ?>;
		}

		.pt-header-menu .pt-list-menu .pt-notifi a.pt-notyshow {
			color: <?php echo color2; ?>;
		}

		.pt-nav-menu ul li a,
		.pt-list-item h3 a,
		.pt-index-left h2 {
			color: <?php echo color3; ?>;
		}

		#myTree .pt-item-details .pt-item-body .pt-name {
			color: <?php echo color5; ?>;
		}

		#myTree .pt-item-details.female .pt-name {
			color: <?php echo color8; ?>;
		}

		.pt-header-menu .pt-list-menu .pt-new-tree a {
			background: <?php echo color6; ?>;
			box-shadow: 0 0 0 0 #FFF, 0 0 0 0 <?php echo color6; ?>;
		}

		.pt-header-menu .pt-list-menu .pt-new-tree a:hover {
			box-shadow: 0 0 0 2px #FFF, 0 0 0 3px <?php echo color6; ?>;
		}

		.pt-header-menu .pt-list-menu .pt-dash a {
			background: <?php echo color7; ?>;
			box-shadow: 0 0 0 0 #FFF, 0 0 0 0 <?php echo color7; ?>;
		}

		.pt-header-menu .pt-list-menu .pt-dash a:hover {
			box-shadow: 0 0 0 2px #FFF, 0 0 0 3px <?php echo color7; ?>;
		}

		.pt-form input[type=text],
		.pt-form input[type=password],
		.pt-form select,
		.amsify-suggestags-area .amsify-suggestags-input-area,
		.pt-index-right #resetM input {
			background: <?php echo color4; ?>;
			border-bottom: 2px solid <?php echo color2; ?>;
		}

		.pt-form .pt-input i,
		.pt-form .pt-input svg,
		.pt-pagination li,
		.pt-index-left p,
		.pt-index-right .reset a,
		.pt-index-right #resetM label i {
			color: <?php echo color2; ?>;
		}

		.bg-0,
		.pt-flist .more {
			background: <?php echo color2; ?>;
			box-shadow: 0px 0px 7px <?php echo color2; ?>45;
		}

		.pt-list-item {
			border: 1px solid <?php echo color2; ?>56;
			box-shadow: 0 0 10px <?php echo color2; ?>26;
		}

		.pt-tree h3 {
			background: <?php echo color10; ?>;
		}

		.pt-index-right h3 a.active {
			border-bottom: 2px solid <?php echo color2; ?>;
			color: <?php echo color2; ?>;
		}

		.pt-footer,
		.pt-thumb, 
		.pt-options,
		.pt-shoow > .pt-dead {
			display: none;
		}
		.pt-shoow strong {
			background-color: purple;
		}

		.pt-sm {
			max-height: 85vh ;
			max-width: 100vw ;
		}

		/* .pl-print-button {
			background: #000;
			height: 26px;
			line-height: 26px;
			text-align: center;
			border-radius: 50px;
			color: #FFF;
			font-weight: 700;
			cursor: pointer;
			display: inline-block;
			font-size: 12px;
			padding: 0 12px;
		} */

		@media screen {
			p.bodyText {font-family:verdana, arial, sans-serif;}
		}

		@media print {
			p.bodyText {font-family:georgia, times, serif;}
			.pt-details {
				display: none !important;
			}

			@page
			{
				size: 8.5in 5.5in;
				/* size: portrait; */
				size: landscape;
			}
		}
		@media screen, print {
			p.bodyText {font-size:10pt}
		}
	</style>
</head>
<body>
<?php
/*=======================================================/
    | Craeted By: Khalid puerto
    | URL: www.puertokhalid.com
    | Facebook: www.facebook.com/prof.puertokhalid
    | Instagram: www.instagram.com/khalidpuerto
    | Whatsapp: +212 654 211 360
 /======================================================*/

// include __DIR__.'/header.php';
// include __DIR__.'/configs/config.php';

$rt = true;
if (!$lg && !$vp) {
    $rt = false;
} elseif ($lg && ($lg != db_get('families', 'author', $id) && !in_array(us_name, explode(',', db_get('families', 'moderators', $id))))) {
    $rt = false;
} elseif ($vp && ($vp != $id)) {
    $rt = false;
}

?>

<?php
$id = $_GET['id'];
$sql = $db->query('SELECT * FROM '.prefix."families WHERE id = '{$id}'");

if ($sql->num_rows) {
    $rs = $sql->fetch_assoc();

    $share_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
        'https' : 'http').'://'.$_SERVER['HTTP_HOST'].
        $_SERVER['REQUEST_URI'];

    if (!$rt && $rs['public']) {
        include __DIR__.'/partials/tree_password.php';
        include __DIR__.'/footer.php';
        exit;
    }

    if ($lg == $rs['author'] || (us_id && in_array(us_name, explode(',', $rs['moderators']))) || (us_id && db_rows("members WHERE user = '".us_name."' && family = '{$id}'"))) {
        include __DIR__.'/partials/tree_new_member.php';
        include __DIR__.'/partials/tree_heritate.php';
    } ?>

	<div class="pt-tree">
		<div class="pt-details">
			<h3 class="m-0 d-sm-none d-md-block"><span><i class="fas fa-grin-stars"></i></span> <?php echo $rs['name']; ?><?php echo $lang['treepage']['fam']; ?></h3>
			<div class="flex-box mb-2 mt-2 ">
				<?php if ($lg == $rs['author'] || (us_id && in_array(us_name, explode(',', $rs['moderators'])))) { ?>
					<?php if ((us_level && $rs['author'] == $lg) || us_level == 6) { ?>
						<a class="pt-edit m-0" rel="<?php echo $rs['id']; ?>"><i class="fas fa-pencil-alt"></i> <span><?php echo $lang['treepage']['edit']; ?></span></a>
						<?php if (fh_access('pdf')) { ?>
							<a href="#" data-name="<?php echo fh_seoURL($rs['name']); ?>" class="pdf-download m-0 ml-2 mr-2"><i class="fas fa-link"></i> <?php echo $lang['treepage']['pdf']; ?></a>
						<?php } ?>
					<?php } ?>
					<?php if (!db_count("members WHERE family = '{$id}' && parent = 0")) { ?>
						<a title="New" class="n tree-add bg-warning" id="nid<?php echo $id; ?>" rel="<?php echo $id; ?>" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus"></i> <?php echo $lang['treepage']['new']; ?></a>
					<?php } ?>
				<?php } ?>
				<div class="pl-share">
					<span class="pl-share-button m-0"><i class="fa fa-share"></i> <b><?php echo $lang['treepage']['share']; ?></b></span>
					<span class="pl-print-button m-0"><a class="hide-on-mobile" href="javascript:printPage();"><i class="fa fa-print"></i> Print Page</a></span>
					<ul class="dropdown">
						<li>
							<a class="bg-facebook" href="//www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>" target="_blank">
								<i class="fab fa-facebook-f"></i> <?php echo $lang['treepage']['share_f']; ?>
							</a>
						</li>
						<li>
							<a class="bg-twitter" href="//twitter.com/home?status=<?php echo $share_url; ?> <?php echo $rs['name']; ?>" target="_blank">
								<i class="fab fa-twitter"></i> <?php echo $lang['treepage']['share_t']; ?>
							</a>
						</li>
						<li>
							<a class="bg-whatsapp" href="whatsapp://send?text=<?php echo $share_url; ?>" target="_blank">
								<i class="fab fa-whatsapp"></i> <?php echo $lang['treepage']['share_w']; ?>
							</a>
						</li>
						<li>
							<a class="bg-youtube" href="mailto:?Subject=<?php echo $rs['name']; ?>&amp;Body=<?php echo $rs['name']; ?> <?php echo $share_url; ?>">
								<i class="fas fa-envelope-open-text"></i> <?php echo $lang['treepage']['share_e']; ?>
							</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="zoom-control">
				<button id="zoomInButton" class="btn btn-info btn-sm mb-1 fit-content"><i class="fas fa-search-plus"></i></button>
				<button id="zoomOutButton" class="btn btn-info btn-sm mb-1 fit-content"><i class="fas fa-search-minus"></i></button>
				<button id="resetButton" class="btn btn-secondary btn-sm mb-1 fit-content"><i class="fas fa-redo"></i></button>
				<!-- <input id="rangeInput" class="range-input" type="range" min="0.1" max="4" step="0.1" value="1"> -->

			</div>
		</div>

		<div class="pt-sm">

			<div class="tree" id="div">
				<?php if (db_count("members WHERE family = '{$rs['id']}'")) { ?>
					<ul>
						<?php
                        $sql_m = $db->query('SELECT * FROM '.prefix."members WHERE family = '{$rs['id']}' && parent = 0");
                        while ($rs_m = $sql_m->fetch_assoc()) {
                            echo get_child($rs_m['id']);
                        }
                        $sql_m->close();
                        ?>
					</ul>
				<?php } else { ?>
					<script>
						document.addEventListener('DOMContentLoaded', function() {
							var clickAdd = document.getElementsByClassName('tree-add')[0]
							clickAdd.click()
							console.log(clickAdd)

						});
					</script>
					<div class="pt-no-result"><i class="far fa-surprise"></i> <?php echo $lang['site']['no-result']; ?></div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php
} else { ?>
	<div class="pt-no-result m-4"><i class="far fa-surprise"></i> <?php echo $lang['site']['no-result']; ?></div>
	<meta http-equiv="refresh" content="2;url=<?php echo path; ?>">
<?php
}

$sql->close();
?>


<!-- Modal View Member  -->
<div class="modal fade" id="myTree" tabindex="-1" role="dialog" aria-labelledby="myTreeLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<div class="modal-body"></div>
		</div>
	</div>
</div>
<script>
	function printPage() { window.print(); }
</script>
</body>
</html>
<?php include __DIR__.'/footer.php'; ?>