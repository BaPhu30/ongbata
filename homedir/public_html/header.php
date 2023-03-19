<meta charset="UTF-8">
<?php
/*=======================================================/
    | Craeted By: Khalid puerto
    | URL: www.puertokhalid.com
    | Facebook: www.facebook.com/prof.puertokhalid
    | Instagram: www.instagram.com/khalidpuerto
    | Whatsapp: +212 654 211 360
 /======================================================*/

include __DIR__ . '/configs/config.php';

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$remobile = ltrim(us_mobile, '0');
$getmobile = (!(us_mobile)?'':$remobile);
// var_dump($getmobile);die;

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


$selectcoutnmem = selectrowmember(us_id);

$_SESSION["time"] = time();
$connect_me = 0;
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
     <meta name="url_get" content="<?php  if(strpos(path, 'ong_ba_ta-profice') == true) {echo '../..';} else {echo path;}?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo site_url; ?>">
    <meta property="og:title" content="<?php echo fh_title(); ?>">
    <meta property="og:description" content="<?php echo site_description; ?>">
    <meta property="og:image" content="<?php echo site_url; ?>">

    <!-- map api -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo site_url; ?>">
    <meta property="twitter:title" content="<?php echo fh_title(); ?>">
    <meta property="twitter:description" content="<?php echo site_description; ?>">
    <meta property="twitter:image" content="<?php echo site_url; ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet"
        href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,900%7CGentium+Basic:400italic&subset=latin,latin">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,300,700">
    <link href="//fonts.googleapis.com/css?family=Coda+Caption:800|Poppins|Squada+One|Sriracha&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

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

    <!-- format number phone -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <!-- lunar calendar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://unpkg.com/moment-lunar@0.0.4/moment-lunar.min.js"></script>

    <!-- zalo sdk -->
    <script src="https://sp.zalo.me/plugins/sdk.js"></script>


    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    <script src="https://apis.google.com/js/api:client.js"></script>
    
    <script>
        !function (w, d, t) {
          w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var i="https://analytics.tiktok.com/i18n/pixel/events.js";ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=i,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};var o=document.createElement("script");o.type="text/javascript",o.async=!0,o.src=i+"?sdkid="+e+"&lib="+t;var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(o,a)};
        
          ttq.load('C8CP8R24VMMHDQEFLI40');
          ttq.page();
        }(window, document, 'ttq');
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4XG74DZDC2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-4XG74DZDC2');
    </script>

    <!-- mapbox -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css" rel="stylesheet" />
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js"></script>

    <!-- notification system -->

    <!-- <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
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
	</script> -->



    <!-- fire base -->

    <script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/ui/5.0.0/firebase-ui-auth__vi.js"></script>
    <div id="config_firebase" apiKey="<?php select_api($db,'ftree_v1_4_configs','variable="firebase_otp_apiKey"') ?>"
        authDomain ="<?php select_api($db,'ftree_v1_4_configs','variable="firebase_otp_authDomain"') ?>"
        projectId="<?php select_api($db,'ftree_v1_4_configs','variable="firebase_otp_projectId"') ?>"
        storageBucket="<?php select_api($db,'ftree_v1_4_configs','variable="firebase_otp_storageBucket"') ?>"
        messagingSenderId="<?php select_api($db,'ftree_v1_4_configs','variable="firebase_otp_messagingSenderId"') ?>"
        appId="<?php select_api($db,'ftree_v1_4_configs','variable="firebase_otp_appId"') ?>"
        measurementId="<?php select_api($db,'ftree_v1_4_configs','variable="firebase_otp_measurementId"') ?>"
    ></div>
   
    <link type="text/css" rel="stylesheet" href="https://www.gstatic.com/firebasejs/ui/5.0.0/firebase-ui-auth.css" />
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo path; ?>/css/style.css?v1.16">
    <!-- mapbox -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet" />
        <!-- Mapbox GL JS -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.4.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.4.1/mapbox-gl.js"></script>
    <!-- Geocoder plugin -->
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.css" type="text/css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
        
    <!-- Turf.js plugin -->
  
    <style>
    .img_scroll{
        width: 10px;
    }
    #search_result{
        display: none;
        padding: 5px;
        list-style: none;
        background-color: rgb(240, 249, 247);
        border: 1px solid rgb(62, 208, 124);
    }
    #search_result li {
        cursor: pointer;
    }
    #search_result li:hover {
        text-decoration: underline;
        font-weight: bold;
        color: rgb(62, 208, 124);
    }
    
     .zalo_send{
        width: 142px;
        position: fixed;
        bottom: 27px;
        left: 5px;
        z-index: 9999;
        cursor: pointer;
        border-radius: 10px;
        display: flex;
        align-items: center;
        border: 1px solid;
        padding: 2px;
        border-color: #c8c8c8;
        background: #e3e3e3;
        font-weight: bold;
        font-style: oblique;
        box-shadow: 0px 0px 1px 0px black;
    }
    .zalo_send_text{
        font-size: 17px;
         width: 80%;
    }
    .zalo_send_img{
            width: 20%;
            background: white;
    }
    .zalo_send::hover{
        margin:50px auto 0;
        -webkit-animation: ring 4s .7s ease-in-out infinite;
        -webkit-transform-origin: 50% 4px;
        -moz-animation: ring 4s .7s ease-in-out infinite;
        -moz-transform-origin: 50% 4px;
        animation: ring 4s .7s ease-in-out infinite;
        transform-origin: 50% 4px;
    }
   .tree-add_grand{
        width: 100%;
        justify-content: center;
        display: flex;
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 99;
    }
    .tree-add_dad {
        height: 20px;
        width: 30px;
        background: white;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        box-shadow: -1px 7px 10px 0px rgb(5 70 12 / 52%);
        cursor: pointer;
	}
    .tree-add_dad:hover{
        background:#f0f9f7
    }
    .tree-add_dad i{
        padding:5px;
    }
    

    @-webkit-keyframes ring {
        0% { -webkit-transform: rotateZ(0); }
        1% { -webkit-transform: rotateZ(30deg); }
        3% { -webkit-transform: rotateZ(-28deg); }
        5% { -webkit-transform: rotateZ(34deg); }
        7% { -webkit-transform: rotateZ(-32deg); }
        9% { -webkit-transform: rotateZ(30deg); }
        11% { -webkit-transform: rotateZ(-28deg); }
        13% { -webkit-transform: rotateZ(26deg); }
        15% { -webkit-transform: rotateZ(-24deg); }
        17% { -webkit-transform: rotateZ(22deg); }
        19% { -webkit-transform: rotateZ(-20deg); }
        21% { -webkit-transform: rotateZ(18deg); }
        23% { -webkit-transform: rotateZ(-16deg); }
        25% { -webkit-transform: rotateZ(14deg); }
        27% { -webkit-transform: rotateZ(-12deg); }
        29% { -webkit-transform: rotateZ(10deg); }
        31% { -webkit-transform: rotateZ(-8deg); }
        33% { -webkit-transform: rotateZ(6deg); }
        35% { -webkit-transform: rotateZ(-4deg); }
        37% { -webkit-transform: rotateZ(2deg); }
        39% { -webkit-transform: rotateZ(-1deg); }
        41% { -webkit-transform: rotateZ(1deg); }

        43% { -webkit-transform: rotateZ(0); }
        100% { -webkit-transform: rotateZ(0); }
    }

    @-moz-keyframes ring {
        0% { -moz-transform: rotate(0); }
        1% { -moz-transform: rotate(30deg); }
        3% { -moz-transform: rotate(-28deg); }
        5% { -moz-transform: rotate(34deg); }
        7% { -moz-transform: rotate(-32deg); }
        9% { -moz-transform: rotate(30deg); }
        11% { -moz-transform: rotate(-28deg); }
        13% { -moz-transform: rotate(26deg); }
        15% { -moz-transform: rotate(-24deg); }
        17% { -moz-transform: rotate(22deg); }
        19% { -moz-transform: rotate(-20deg); }
        21% { -moz-transform: rotate(18deg); }
        23% { -moz-transform: rotate(-16deg); }
        25% { -moz-transform: rotate(14deg); }
        27% { -moz-transform: rotate(-12deg); }
        29% { -moz-transform: rotate(10deg); }
        31% { -moz-transform: rotate(-8deg); }
        33% { -moz-transform: rotate(6deg); }
        35% { -moz-transform: rotate(-4deg); }
        37% { -moz-transform: rotate(2deg); }
        39% { -moz-transform: rotate(-1deg); }
        41% { -moz-transform: rotate(1deg); }

        43% { -moz-transform: rotate(0); }
        100% { -moz-transform: rotate(0); }
    }

    @keyframes ring {
        0% { transform: rotate(0); }
        1% { transform: rotate(30deg); }
        3% { transform: rotate(-28deg); }
        5% { transform: rotate(34deg); }
        7% { transform: rotate(-32deg); }
        9% { transform: rotate(30deg); }
        11% { transform: rotate(-28deg); }
        13% { transform: rotate(26deg); }
        15% { transform: rotate(-24deg); }
        17% { transform: rotate(22deg); }
        19% { transform: rotate(-20deg); }
        21% { transform: rotate(18deg); }
        23% { transform: rotate(-16deg); }
        25% { transform: rotate(14deg); }
        27% { transform: rotate(-12deg); }
        29% { transform: rotate(10deg); }
        31% { transform: rotate(-8deg); }
        33% { transform: rotate(6deg); }
        35% { transform: rotate(-4deg); }
        37% { transform: rotate(2deg); }
        39% { transform: rotate(-1deg); }
        41% { transform: rotate(1deg); }

        43% { transform: rotate(0); }
        100% { transform: rotate(0); }
    }
      .pc-none-mobile-show {
        display: none;
    }
    @media screen and (max-width: 480px) {
        .pc-none-mobile-show 
        {
            display: block;
        }
        .pc-show-mobile-none {
            display: none;
        }
        .zalo_send{
            /* width: 50px; */
            bottom: 107px;
            right: -51px;
            left: unset;
                        transform: rotate(
            90deg);
                -webkit-transform: rotate(
            90deg);
        }
        .form_mobile{
            width: 100%;
            margin:0px !important;
        }
        .pt-form-content{
            margin-bottom: 40px;
        }
    }
    
    
    .tomb_tree{
        font-size: 12px !important;
        padding: 0 10px !important;   

    }

    .pt-sm {
			overflow: hidden;
			box-shadow: 0 0px 20px 8px rgb(0 0 0 / 2%);
			background-image: url(https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/shutterstock_323572316.eps__1_-removebg-preview.png),
				url(https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/image-1-1.png),
				url(https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/1sJyYDBE-image-1.png),
				url(https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/512__1_-removebg-preview.png),
				url(https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/4bNwcG6g-image.png),
				url(https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/GnVMOLKM-image-2.png),
				url('https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $actual_link; ?>&choe=UTF-8')
				;
			background-position: bottom 20px right 20px, top left, bottom right, top right,
				top left, bottom left, top 20px right 20px;
			background-repeat: no-repeat;
			background-size: 7%, 0%, 6%, 6%, 6%, 6%, 7%;
			}
    
    #customBtn {
        display: inline-block;
        background: white;
        color: #444;
        /* width: 190px; */
        border-radius: 2px;
        border: thin solid #888;
        box-shadow: 1px 1px 5px 0px #4285f4;
        white-space: nowrap;

    }

    #customBtn:hover {
        cursor: pointer;
    }

    span.icon {
        margin-right: 5px;
        background: url(https://freepngimg.com/thumb/google/66893-guava-logo-google-plus-suite-png-image-high-quality.png) transparent 5px 50% no-repeat;

        width: 40px;
        height: 40px;
        background-size: cover;
    }

    .buttonText {
        padding: 0 5px;
        background: #4285f4;
    }

    /* login api */
    .or_text {
        z-index: 0 !important;
    }

    .logofacebook {
        width: 30px;
        height: 30px;
        background-image: url(https://s3.ap-southeast-1.amazonaws.com/datdia/ongbata_pf/logoface.png);
        background-size: auto;
        background-repeat: no-repeat;
    }

    .iti--allow-dropdown {
        width: 100% !important;
    }

    .change_method_lg {
        background-color: #2ecc71;
        margin-bottom: 14px;
    }

    div.change_method_lg:hover {
        opacity: 0.5;
        transition: all 0.5s;
    }

    .modal-verticalnumberphone {
        position: fixed;
        z-index: 500000;
        width: 100%;
        text-align: center;
    }

    .modal-verticalnumberphone-body {
        background: #2ecc71;
        box-shadow: 0px 2px 3px #2ecc71;
        border-radius: 10px;
    }

    .btn-verticalnumberphone {
        background: beige;
        color: #333;
    }

    .pt-header-menu .pt-logo,
    .pt-tree h3 span,
    .pt-header-menu .pt-search button,
    .pt-pageplans .alert-success {
        background: <?php echo color1;
        ?>;
    }

    .pt-pageplans .alert-success span {
        color: <?php echo color1;
        ?>;
    }

    .pt-nav-menu,
    .pt-pagination li.pt-active,
    .pt-mnewmember button[type=submit],
    .pt-pageplans .pt-plans .col:nth-of-type(2) .pt-plan,
    .pt-pageplans .pt-plans .pt-plan button {
        background: <?php echo color2;
        ?>;
        border-color: <?php echo color2;
        ?>;
        box-shadow: 4px 1px 6px <?php echo color2;
        ?>45;
    }

    .pt-nav-menu ul li:first-of-type a:hover,
    .pt-nav-menu ul li a:hover {
        background: <?php echo color4;
        ?>;
        color: <?php echo color1;
        ?>;
    }

    .tree ul li a:not([href]):hover,
    .tree ul li a:not([href]):hover .pt-thumb,
    .pt-list .pt-title span {
        box-shadow: 0 0 0 2px <?=color4 ?>, 0 0 0 4px <?=color2 ?>;
    }

    .pt-nav-menu ul li a:hover b,
    .pt-index-right button {
        background: <?php echo color2;
        ?>;
        box-shadow: 0px 0px 7px <?php echo color2;
        ?>45;
    }

    body,
    .pt-sm {
        background: <?php echo color4;
        ?>;
    }

    .pt-tree a.exp {
        background: <?php echo color9;
        ?>;
        border: 1px solid <?php echo color9;
        ?>;
    }

    .pt-tree a.exp .pt-thumb {
        border: 3px solid <?php echo color9;
        ?>;
    }

    .pt-header-menu .pt-list-menu .pt-notifi a.pt-notyshow {
        color: <?php echo color2;
        ?>;
    }

    .pt-nav-menu ul li a,
    .pt-list-item h3 a,
    .pt-index-left h2 {
        color: <?php echo color3;
        ?>;
    }

    #myTree .pt-item-details .pt-item-body .pt-name {
        color: <?php echo color5;
        ?>;
    }

    .or_text {
        font-size: 12px;
        position: relative;
        background-color: white;
        z-index: 4;
        padding: 0 5px;
    }

    .or_text::before {
        content: " ";
        border-bottom: 1px solid #00000054;
        width: 100px;
        top: 50%;
        right: -32px;
        position: absolute;
        z-index: -10;
    }

    #myTree .pt-item-details.female .pt-name {
        color: <?php echo color8;
        ?>;
    }

    .pt-header-menu .pt-list-menu .pt-new-tree a {
        background: <?php echo color6;
        ?>;
        box-shadow: 0 0 0 0 #FFF, 0 0 0 0 <?php echo color6;
        ?>;
    }

    .pt-header-menu .pt-list-menu .pt-new-tree a:hover {
        box-shadow: 0 0 0 2px #FFF, 0 0 0 3px <?php echo color6;
        ?>;
    }

    .pt-header-menu .pt-list-menu .pt-dash a {
        background: <?php echo color7;
        ?>;
        box-shadow: 0 0 0 0 #FFF, 0 0 0 0 <?php echo color7;
        ?>;
    }

    .pt-header-menu .pt-list-menu .pt-dash a:hover {
        box-shadow: 0 0 0 2px #FFF, 0 0 0 3px <?php echo color7;
        ?>;
    }

    .pt-form input[type=text],
    .pt-form input[type=password],
    .pt-form select,
    .amsify-suggestags-area .amsify-suggestags-input-area,
    .pt-index-right #resetM input {
        background: <?php echo color4;
        ?>;
        border-bottom: 2px solid <?php echo color2;
        ?>;
    }

    .pt-form .pt-input i,
    .pt-form .pt-input svg,
    .pt-pagination li,
    .pt-index-left p,
    .pt-index-right .reset a,
    .pt-index-right #resetM label i {
        color: <?php echo color2;
        ?>;
    }

    .bg-0,
    .pt-flist .more {
        background: <?php echo color2;
        ?>;
        box-shadow: 0px 0px 7px <?php echo color2;
        ?>45;
    }

    .pt-list-item {
        border: 1px solid <?php echo color2;
        ?>56;
        box-shadow: 0 0 10px <?php echo color2;
        ?>26;
    }

    .pt-tree h3 {
        background: <?php echo color10;
        ?>;
    }

    .pt-index-right h3 a.active {
        border-bottom: 2px solid <?php echo color2;
        ?>;
        color: <?php echo color2;
        ?>;
    }
    #change_name{
        background-color: rebeccapurple;
    }
    </style>
</head>

<body class="pt-login pt-page<?php echo str_replace('-', '', page); ?>">
    <!--Start of Tawk.to Script-->
  <script type="text/javascript">
// 		var Tawk_API = Tawk_API || {},
// 			Tawk_LoadStart = new Date();
// 		(function() {
// 			var s1 = document.createElement("script"),
// 				s0 = document.getElementsByTagName("script")[0];
// 			s1.async = true;
// 			s1.src = 'https://embed.tawk.to/60b7a904de99a4282a1b04ce/1f76mofol';
// 			s1.charset = 'UTF-8';
// 			s1.setAttribute('crossorigin', '*');
// 			s0.parentNode.insertBefore(s1, s0);
// 		})();
	</script>

    <!--End of Tawk.to Script-->
    <!-- modal send sms -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-sms"></i> Gửi tin nhắn điện
                        thoại</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Số điện thoại:</label>
                        <input type="text" class="form-control" placeholder="Nhập số điện thoại" id="inviteNumberPhone">
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-secondary" data-dismiss="modal">Thoát</a>
                    <a class="btn btn-outline-info" onclick="sendSms('&')"> <i class="fab fa-apple"></i> Gửi bằng
                        Iphone</a>
                    <a class="btn btn-outline-success" onclick="sendSms('?')"> <i class="fab fa-android"></i> Gửi bằng
                        Android</a>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-header">
        <div class="pt-header-menu justify-content-between container logo-ongbata">
            <div class="w-10 logo-ongbata_son">
                <a href="https://giapha.ongbata.vn/"><img src="https://ongbata.vn/wp-content/uploads/2021/02/logo-300x300.png" alt=""></a>
            </div>
            <div class="menu-ongbata">
                <div class="menu-mobile icon_hide_map">
                    <div class="mobile icon_nav_mobile" id="mobile">
                        <i class=" fa fa-bars " aria-hidden="true">

                        </i>
                    </div>
                    

                    <ul class="flex-box primary-menu">
                        <li class="mainmenu ">
                            <a
                                href="<?php if (strpos(path, 'ong_ba_ta-profice') == true) {echo '../..';} else {echo path;};?>/index.php"><i
                                    class="fas fa-home"></i><b class="mr-1"><?= $lang['header']['home'] ?></b><i
                                    class="fa fa-caret-down m-0" aria-hidden="true"></i>
                            </a>
                            <ul class="submenu mobile_fix">
                                <li><a
                                        href="<?php if (strpos(path, 'ong_ba_ta-profice') == true) {echo '../..';} else {echo path;};?>/users.php"><i
                                            class="far fa-user-circle"></i><b><?= $lang['header']['users'] ?></b></a>
                                </li>
                                <?php if ($lg): ?>
                                <li><a
                                        href="<?php if (strpos(path, 'ong_ba_ta-profice') == true) {echo '../..';} else {echo path;};?>/list.php"><i
                                            class="fas fa-sitemap"></i><b><?= $lang['header']['family'] ?></b></a></li>
                                <?php endif ?>
                                <?php if (!site_plans) : ?>
                                <li><a
                                        href="<?php if (strpos(path, 'ong_ba_ta-profice') == true) {echo '../..';} else {echo path;};?>/plans.php"><i
                                            class="fas fa-trophy"></i><b><?= $lang['header']['plans'] ?></b></a></li>
                                <?php endif; ?>
                                <?php if (us_level == 6) : ?>
                                <li class="pt-mobile-dash"><a
                                        href="<?php if (strpos(path, 'ong_ba_ta-profice') == true) {echo '../..';} else {echo path;};?>/dashboard.php"><i
                                            class="fas fa-cog"></i><b><?= $lang['header']['dashboard'] ?></b></a></li>
                                <li class="pt-mobile-dash"><a
                                        href="<?php if (strpos(path, 'ong_ba_ta-profice') == true) {echo '../..';} else {echo path;};?>/test_notification.php?pass=rasmuslerdorf"><i
                                            class="fa fa-paper-plane"></i><b>Gửi thông báo qua firebase</b></a></li>
                                <li class="pt-mobile-dash btn-search" data-toggle="modal" data-target="#modal_search">
                                    <a href="#"><i class="fa fa-search"></i><b>Tìm kiến gia phả</b></a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </li>

                        <li class="mainmenu ">
                            <i class="far fa-flag"></i><b class="mr-1">Ứng dụng</b><i class="fa fa-caret-down m-0"
                                aria-hidden="true"></i>

                            <ul class="submenu mobile_fix">
                                <li>
                                    <i class="fa fa-medkit" aria-hidden="true"></i>
                                   <a
                                        href="<?php if (strpos(path, 'ong_ba_ta-profice') == true) {echo '../..';} else {echo path;};?>/map_blood.php"><b>Bản đồ nhóm máu</b></a>
                                </li>
                                <li> <a
                                        href="<?php if (strpos(path, 'ong_ba_ta-profice') == true) {echo '../..';} else {echo path;};?>/colorpage.php">
                                        <i class="fa fa-paint-brush" aria-hidden="true"></i>
                                        <b>Thêm màu cho ảnh</b>
                                    </a>
                                </li>
                                <li>
                                    <i class="fa fa-binoculars" aria-hidden="true"></i>
                                    <b>Tăng độ phân giải ảnh</b>
                                </li>
                                
                            </ul>
                        </li>
                        <?php
						$sql = $db->query("SELECT * FROM " . prefix . "pages WHERE header = 1 ORDER BY id DESC LIMIT 5") or die($db->error);
						if ($sql->num_rows) :
							while ($rs = $sql->fetch_assoc()) :
						?>
                        <li><a
                                href="<?php if (strpos(path, 'ong_ba_ta-profice') == true) {echo '../..';} else {echo path;};?>/page.php?id=<?= $rs['id'] ?>"><i
                                    class="<?= $rs['icon'] ?>"></i><b><?= $rs['title'] ?></b></a></li>
                        <?php endwhile; ?>
                        <?php endif; ?>
                        <?php $sql->close(); ?>
                        <li class="mainmenu pc-none pc-none-mobile-show">
                                <ul class="submenu mobile_fix">
                                    <?php if ($lg) : ?>
                                        <li>
                                            <a href="<?php if (strpos(path, 'ong_ba_ta-profice') == true) {echo '../..';} else {echo path;};?>/details.php"><i
                                                class="far fa-address-card"></i><b><?= $lang['header']['details'] ?></b></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if ($lg) : ?>
                                        <li>
                                            <a href="#" id="logout" class="logout fbLink"><i
                                                class="fas fa-power-off"></i><b><?= $lang['header']['logout'] ?></b></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                        </li>
                        <!--<li>-->
                        <!--    <div class="pt-search flex-box">-->
                                <!--<input type="text" name="search" placeholder="<?= $lang['header']['search'] ?>" />-->
                        <!--        <div class="sresults"></div>-->
                        <!--    </div>-->
                        <!--</li>-->
                    </ul>
                </div>
                <div class="icon_show_map" style="display:none">
                        <a href="<?php echo getBaseUrl() ?>">
                            <i class="fa fa-home" aria-hidden="true"></i>
                        </a>
                    </div>




            </div>
            <div class="login-account">
                <?php if (us_level) : ?>
                <div class="pt-notifi mainmenu">
                    <a href="#" class="pt-notyshow">
                        <i class="far fa-bell position-relative">
                            <b
                                class="number-notify position-absolute bg-danger rounded-circle overflow-hidden"><?= db_rows("notifications WHERE user = '{$lg}' and nread = 0") ?></b>
                        </i>

                    </a>
                    <ul class="pt-drop submenu">
                        <?php
							$sql_no = $db->query("SELECT * FROM " . prefix . "notifications WHERE user = '{$lg}' ORDER BY id DESC LIMIT 10");
							if ($sql_no->num_rows) :
								while ($rs_no = $sql_no->fetch_assoc()) :
									$usr = db_get("users", "username", $rs_no['author']);
									
							?>
                        <li class="<?= (!$rs_no['nread'] ? 'unread read-notifi' : '') ?>  flex-box"
                            rel="<?= $rs_no['id'] ?>">
                            <div class="pt-thumb rounded-circle overflow-hidden">
                                <img src="<?= db_get("users", "photo", $rs_no['author']) ?>" alt="<?= $usr ?>"
                                    onerror="this.src='<?= nophoto ?>'">
                            </div>
                            <div class="pt-cnt">
                                <?php
											switch ($rs_no['type']) {
												case 'moderator':
													$getfid = $rs_no['item'];
													$getf = db_get("families", "name", $getfid);
													echo "{$usr} have maked you <b>moderator</b> to <a href=\"" . path . "/tree.php?id={$getfid}&t=" . fh_seoURL($getf) . "\">{$getf}</a> family tree.";
													break;
												case 'member':
													$getfid = db_get("members", "family", $rs_no['item']);
													$getf = db_get("families", "name", $getfid);
													echo "{$usr} have linked you to a <a href=\"" . path . "/tree.php?id={$getfid}&t=" . fh_seoURL($getf) . "\">{$getf}</a> family tree <b>member</b>.";
													break;
											}
											?>
                            </div>
                        </li>
                        <?php
								endwhile;
							else :
								echo '<li class="no-not">' . $lang['header']['no-not'] . '</li>';
							endif;
							$sql_no->close();
							?>
                    </ul>
                </div>
                <div class="pt-new-tree">
                    <a class="btn  btn-sm btn-success add_tree_g" href="#" data-toggle="modal" data-target="#addnewtree">
                        <?= $lang['header']['newtree'] ?></a>
                </div>
                <?php endif; ?>
                <div class=" <?= ($lg ? 'mainmenu': '')?> pc-show-mobile-none">
                    <div class="flex-box justify-content-center  login-mobile">
                        <div class="photo-login rounded-circle overflow-hidden">
                            <img class="w-100" src="<?= ($lg ? us_photo : nophoto) ?>"
                                onerror="this.src='<?= nophoto ?>'" />
                        </div>
                        <span><?= ($lg ? us_name : '<a class="btn btn-outline-primary btn-sm p-0 login" href="#" >Đăng nhập</a>') ?></span>
                        <?php $usr = empty(us_id)?0:us_id; ?>
                        <?= ($lg ? '<i class="fa fa-caret-down m-0" aria-hidden="true"></i>': '') ?>
                    </div>
                    <ul class="submenu mobile_fix">
                        <?php if ($lg) : ?>
                            <li>
                                <a href="<?php if (strpos(path, 'ong_ba_ta-profice') == true) {echo '../..';} else {echo path;};?>/details.php"><i
                                    class="far fa-address-card"></i><b><?= $lang['header']['details'] ?></b></a>
                            </li>
                        <?php endif; ?>
                        <?php if ($lg) : ?>
                            <li>
                                <a href="#" id="logout" class="logout fbLink"><i
                                    class="fas fa-power-off"></i><b><?= $lang['header']['logout'] ?></b></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

            </div>
            <?php if(!us_email) : ?>
                <div class="login_mobile login mobile ">
                    <i class="fa fa-user icon_user_login" aria-hidden="true"></i>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div id="status"></div>
    <!-- scroll new -->
    <?php if ($lg) : ?>
    <div class="scroll-box">
        <div class="scroll-container">
            <span id="scroll-element" class="flex-box ">
                <?php
					
					$sql = $db->query("SELECT * FROM " . prefix . "families WHERE author = '{$lg}' || FIND_IN_SET('" . us_email . "', moderators) || FIND_IN_SET('" .$getmobile. "', moderators) > 0 LIMIT 100") or die($db->error);
					if ($sql->num_rows) :

						while ($rs = $sql->fetch_assoc()) :
							$rs['photo'] = $rs['photo'] ? $rs['photo'] : db_get("members", "photo", $rs['id'], 'family', "AND parent = '0'");
					?>

                <div class="pt-thumb img_scroll"><img
                        src="<?php if (strpos($rs['photo'], 'images') !== true) {echo path,'/';}?><?= $rs['photo'] ?>"
                        alt="<?= $rs['name'] ?>" onerror="this.src='<?= nophoto ?>'"></div>
                <span
                    href="<?= path ?>/tree.php?id=<?= $rs['id'] ?>&t=<?= fh_seoURL($rs['name']) ?>"><?= $rs['name'] ?></span>
                <i class="fas fa-clock"></i> <span><?= fh_ago($rs['date']) ?> </span>
                <i class="fas fa-users"></i> <span><b><?= db_count("members WHERE family = '{$rs['id']}'") ?></b>
                    <?= $lang['listpage']['members'] ?></span>
                <?php
							$sql_m = $db->query("SELECT * FROM " . prefix . "members WHERE family = '{$rs['id']}' ");
							while ($rs_m = $sql_m->fetch_assoc()) {
							?>
                <span>| Thành viên <strong>
                        <?= date("d-m-Y", $rs_m['date'])  . ' ' . $rs_m['lastname'] . ' ' . $rs_m['firstname'] ?>
                    </strong> </span>
                <span>Ngày sinh:
                    <?= date("d-m-Y", $rs_m['birthdate'])  . ' SDT ' . $rs_m['mobile'] . '  ' . $rs_m['email'] ?> |
                </span>
                <?php
							}
							$sql_m->close();
						endwhile;
						$sql->close();
					else :
						?>
                <span class="pt-no-result d-none"><i class="far fa-surprise"></i>
                    <?= $lang['listpage']['no-result'] ?></span>
                <?php
					endif;
					?>

            </span>
        </div>
    </div>
    <?php endif; ?>



    <!--id user-->
    <input type="hidden" id="id_user" value="<?php echo $usr ?>">
    <?php if (us_level) { ?>
    <!-- New Tree -->
    <div class="modal fade" id="addnewtree" tabindex="-1" role="dialog" aria-labelledby="addnewtreeLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addnewtreeLabel"><?php echo $lang['header']['fam']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?php if (fh_access('families')) { ?>
                    <form class="pt-form" id="send-family-details">
                        <label>Tên gia phả</label>
                        <div class="pt-input">
                            <i class="far fa-user"></i>
                            <input type="text" name="name"
                                placeholder="<?php echo $lang['indexpage']['form']['fid']['i']; ?>">
                        </div>
                        <label>Mời thành viên vào gia phả (nhập số điện thoại hoặc email và bấm enter )</label>
                        <div class="pt-input">
                            <i class="fas fa-cogs"></i>
                            <input type="text" class="form-control" name="planets" value="">
                        </div>
                        <div class="flex-box">
                            <div class="zalo-share-button btn btn-outline-primary"
                                data-href="https://hovangiap.toidayhoc.com/" data-oaid="579745863508352884"
                                data-layout="1" data-color="blue" data-customize="true"><i class="far fa-comment"></i>
                                Mời qua Zalo </div>
                            <div>
                                <a href="http://www.facebook.com/dialog/send?
											app_id=386385608545861
											&amp;link=https://giapha.ongbata.com/
											&amp;redirect_uri=https://giapha.ongbata.com/" target="_blank" class="btn btn-outline-info"><i
                                        class="fab fa-facebook"></i> Mời bằng tin nhắn Messenger </a>
                            </div>
                            <a class="btn btn-outline-warning" data-toggle="modal" data-toggle="modal"
                                data-target="#exampleModalCenter">
                                <i class="fas fa-sms"></i> Mời bằng tin nhắn
                            </a>

                        </div>
                        <?php if (fh_access('private')) : ?>
                        <div class="pt-input d-none">
                            <label class="small">
                                <input type="checkbox" name="check"
                                    <?php echo db_get('families', 'public', $lg) ? '' : ' checked'; ?>>
                                <?php echo $lang['indexpage']['form']['view']; ?>
                            </label>
                        </div>
                        <label class="d-none"><?php echo $lang['indexpage']['form']['vpass']['l']; ?></label>
                        <div class="pt-input d-none">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="vpass"
                                placeholder="<?php echo $lang['indexpage']['form']['vpass']['i']; ?>">
                        </div>
                        <?php endif; ?>
                        <input type="hidden" name="famid" value="" />
                        <hr />
                        <button type="submit" class="pt-button bg-0"><i class="fas fa-sign-in-alt"></i>
                            <?= $lang['detailspage']['send'] ?> <span class="spinner-border spinner-border-sm"
                                id="loadingSendMail" role="status" aria-hidden="true"></span>
                        </button>

                    </form>
                    <?php } else { ?>
                    <?php echo fh_alerts($lang['alerts']['families']); ?>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
    <?php T_ENDIF; ?>
    <div class="pt-wrapper ">

        <?php if (!fh_access('show_ads')) ?>
        <div class="ads1 d-none"><?php echo site_ads1; ?></div>
        <?php }?>
    <input type="hidden" id="link_qr_path" value="<?php echo $actual_link ?>">

<div class="zalo_send" onclick="window.open('https://zalo.me/0935070243', '', 'width=800, height=600')">
    <div class="zalo_send_text">  Hỗ trợ dịch vụ </div>
    <div class="zalo_send_img">  <img src="https://giapha.ongbata.vn/images/icon-zalo.png" alt=""> </div>
        
</div>
<?php if(us_level == 6): ?>
    <!-- The Modal serach family of admin-->
    <div class="modal" id="modal_search">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal body -->
                    <form id="search-admin" class="p-3 mb-0" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control border border-success" name="keyword" placeholder="Nhập từ khoá để tìm kiếm">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <ul id="result-admin" class="list-group">

                    </ul>
            </div>
        </div>
    </div>
<?php endif; ?>
        
        
