<?php
    include 'header.php';
    $user_blood = new  Getdata();
    $me = '';
    if ($usr !=0) {
        $condition = ' Where id='.$usr;
        $select_data= $user_blood->select('ftree_v1_4_users',$condition,$db);
        foreach($select_data as $bl){};
        if (empty($bl['longitude']) || empty($bl['latitude']) || empty($bl['blood_id'])) {
            $me = 'me';
        }
    
    }
?>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>
    .avatar_m {
        width: 50px;
        height: 50px;
    }

    .name_tomb{
        font-size: 12px;
    }
    .tomb_title {
        font-size: 16px;
    }

    .up_location {
        top: 50%;
        right: 20px;
    }

    body {
        color: #404040;
        font: 400 15px/22px 'Source Sans Pro', 'Helvetica Neue', sans-serif;
        margin: 0;
        padding: 0;
        -webkit-font-smoothing: antialiased;
        overflow: hidden;
    }

    * {
        box-sizing: border-box;
    }

    .sidebar {
        position: absolute;
        width: 33.3333%;
        height: 100%;
        top: 35px;
        left: 0;
        overflow: hidden;
        border-right: 1px solid rgba(0, 0, 0, 0.25);
    }

    .map {
        position: absolute;
        left: 33.3333%;
        width: 66.6666%;
        top: 35px;
        bottom: 0;
        overflow: hidden;
    }

    h1 {
        font-size: 22px;
        margin: 0;
        font-weight: 400;
        line-height: 20px;
        padding: 20px 2px;
    }

    a {
        color: #404040;
        text-decoration: none;
    }

    a:hover {
        color: #101010;
    }
    .item b {
        color:red;
    }

    .heading {
        background: #fff;
        border-bottom: 1px solid #eee;
        min-height: 60px;
        line-height: 60px;
        padding: 0 10px;
        background-color: red;
        color: #fff;
    }

    .listings {
        height: 100%;
        overflow: auto;
        padding-bottom: 60px;
    }

    .listings .item {
        display: block;
        border-bottom: 1px solid #eee;
        padding: 10px;
        text-decoration: none;
    }

    .listings .item:last-child {
        border-bottom: none;
    }

    .listings .item .title {
        display: block;
        color: #00853e;
        font-weight: 700;
    }

    .listings .item .title small {
        font-weight: 400;
    }

    .listings .item.active .title,
    .listings .item .title:hover {
        color: #8cc63f;
    }

    .listings .item.active {
        background-color: #f8f8f8;
    }

    ::-webkit-scrollbar {
        width: 3px;
        height: 3px;
        border-left: 0;
        background: rgba(0, 0, 0, 0.1);
    }

    ::-webkit-scrollbar-track {
        background: none;
    }

    ::-webkit-scrollbar-thumb {
        background: #00853e;
        border-radius: 0;
    }

    .marker {
        border: none;
        cursor: pointer;
        height: 40px;
        width: 40px;
        align-items: center;
        justify-content: center;
        display: flex;
        font-size: 21px;
        background: red;
        border-radius: 50%;
        box-shadow: 1px 1px 3px black;
        color: gold;
    }

    /* Marker tweaks */
    .mapboxgl-popup {
        padding-bottom: 50px;
    }

    .mapboxgl-popup-close-button {
        display: block;
    }

    .mapboxgl-popup-content {
        font: 400 15px/22px 'Source Sans Pro', 'Helvetica Neue', sans-serif;
        padding: 0;
        width: 180px;
    }

    .mapboxgl-popup-content h3 {
        background: red;
        color: #fff;
        margin: 0;
        padding: 10px;
        border-radius: 3px 3px 0 0;
        font-weight: 700;
        margin-top: -15px;
    }

    .mapboxgl-popup-content h4 {
        margin: 0;
        padding: 10px;
        font-weight: 400;
    }
    .mapboxgl-popup-anchor-top>.mapboxgl-popup-content {
        margin-top: 15px;
    }

    .mapboxgl-popup-anchor-top>.mapboxgl-popup-tip {
        border-bottom-color: #91c949;
    }
    .media_control {
        display:none;
    }
    .text_up_loaction{
        text-decoration: underline;
        font-weight: bold;
    }
     .back_tree:hover{
        text-decoration: underline;
    }
    .back_tree{
        right: 5;
        top: -15px;
    }
    .Empty_blood {
    font-weight: bold;
    color: #e91e63;
}

.editOption {
    width: 90%;
    height: 24px;
    position: relative;
    top: -30px
}
 /* new */
    .help_blood {
        right: 10px;
        color: white;
        background-color: #e91e63;
        top: 50%;
    }
    .animation_send{
        background: radial-gradient(black, transparent);
        width: 100%;
        height: 100%;
        z-index: 9999;
        top:0;
    }
    .animation_send_son{
        width: 100px;
        height: 100px;
    }
    .scroll-box{
        display: none !important;
    }
    .add_tree_g{
        display: none  !important;
    }
     @media only screen and (max-width: 700px){
        
         .icon_hide_map{
        display: none;
        }
        .icon_show_map{
            display: block !important;
        }
         .login-account{
             width: 35%;
         }
         <?php if ($usr>0): ?>
            .pt-wrapper {
            height: 100vh !important;
              }
        <?php endif; ?>
         .pt-notifi{
             display: none !important;
         }
         .back_tree{
                right: unset;
                left: 5px;
                top: -20px;
                font-size: 12px;
         }
        .media_control{
            top: 58px;
            display:block;
            z-index: 999;
             position: absolute;
             transition: all 0.5s;
         }
         #map{
            <?php if ($usr>0): ?>
            top:0px;
            <?php endif; ?>
            left: 0;
            width: 100%;
            transition: all 0.5s;
             
         }
         .sidebar{
             left: -209px;
             transition: all 0.5s;
             <?php if ($usr>0): ?>
            top:0px;
            <?php endif; ?>
            
         }
         .media_control_t{
              left: 50% !important;
              transition: all 0.5s;
         }
         .sidebar_media{
            
            width: 50% !important;
             transition: all 0.5s;
             left: 0;
         }
         .map_media{
            left: 50% !important;
            width: 50% !important;
            transition: all 0.5s;
         }
         .heading{
                 display: grid !important;
                 padding: 5px;
            }
            .help_blood{
                position: relative !important;
                right: -30px;
            }
            .mapboxgl-ctrl-fullscreen{
                display: none !important;
            }
            .sidebar_media{
                    overflow: hidden;
            }
    }
</style>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="media_control ">
   <span class="btn  btn-danger btn-sm rounded-3 media_control_son">Danh sach nhóm máu</span> 
</div>
<div class="sidebar ">
    <div class="heading position-relative d-flex  justify-content-between align-items-center">
        <h1>Danh sách nhóm máu</h1>
        <?php if(($me == 'me') || ($usr == 0)): ?>
            <div>
                <button class="btn btn-warning btn-sm fa fa-plus up_location" id="add_blood"> 
                    Thêm nhóm máu
                </button>
            </div>
        <?php  endif ?>
    </div>
    <div class="d-flex p-1 justify-content-between align-items-center">
        <label for="location2" class="form-label"><b>Lọc theo nhóm máu:</b> </label>
        <div>
            <select name="blood" id="blood_field" class="form-select blood">
                <option value="0" selected>Tất cả </option>
            </select>
        </div>
    </div>
    <div id="listings" class="listings"></div>
</div>

<div id="map" class="map"></div>
<!-- input get with map  -->
<input type="hidden" name="" id="with_cavan" >
<!-- animation -->
<div class="position-fixed animation_send" style="display: none;"> 
        <div class="position-fixed top-50 start-50 translate-middle animation_send_son">
            <img src="https://s3.ap-southeast-1.amazonaws.com/datdia/ongbata_pf/send_loading.gif" alt="" class="send_load_icon" style="display: none;">
            <img src="https://s3.ap-southeast-1.amazonaws.com/datdia/ongbata_pf/success.gif" alt="" class="send_complete_icon" style="display: none;">
        </div>
</div>


<!-- modal up loaction -->
<!-- add location -->
<div class="modal fade  " id="them_vi_tri">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <form method="post" id="insert_form_location">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm ví trí và nhóm máu</h4>
                    <button type="button" class=" btn close rounded-circle btn-light"
                        data-bs-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                     <center><span><i>(Bạn phải cập nhật ví trí nhóm máu của mình mới xin được nhóm máu)</i></span></center>
                    <div id="location_dad">

                        <div class="mb-2">
                            <label for="location " class="form-label"><b>Vĩ độ:</b> </label>
                            <input type="text" name="latitude" id="location" class=" form-control">
                        </div>

                        <div class="mb-2">
                            <label for="location2" class="form-label"><b>kinh độ :</b> </label>
                            <input type="text" name="longitude" id="location2" class="form-control">
                        </div>
                        <span id="mesessage">

                        </span>
                        <div class="blood_dad">
                            <label for="location2" class="form-label"><b>Nhóm máu:</b> </label>
                            <div>
                                <select name="blood" id="blood" class="form-select blood blood_d">
                                </select>
                            </div>
                            <input class="editOption form-control" name="blood_another" style="display:none;" />
                        </div>

                    </div>
                    <!-- </form> -->

                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div class=" mb-2 d-flex justify-content-center align-items-center">
                        <span class="material-icons btn-outline-info up_location dinh_vi_lai" id="" type="button"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Định vị lại">
                            gps_fixed
                        </span>
                        <button type="button" class="btn btn-warning " id="address">
                            xem trước ví trí trên bản đồ
                        </button>
                    </div>
                    <div>
                        <input type="hidden" name="id_user" id="location_id" value="<?php echo $usr ?>"
                            class="value_0" />
                        <input type="submit" name="update_location" id="update_location" value="Cập nhật"
                            class="btn btn-success" />
                    </div>
                </div>
            </form>

        </div>

    </div>
</div>
<!-- Modal help blood -->
<div class="modal fade" id="help_blood" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" id="send_help_blood_form" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Điền thông tin </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-1">
                        <label for="name_help" class="form-label" style=" margin-bottom: 0;">Nhập tên người yêu
                            cầu:</label>
                        <input type="text" class="form-control" id="name_help" name="name_help" required>
                    </div>
                    <div class="mb-1">
                        <label for="mobile_help" class="form-label" style=" margin-bottom: 0;">Nhập số điện
                            thoại:</label>
                        <input type="tel" class="form-control check_format" pattern="0[0-9]{9,10}" id="mobile_help"
                            name="mobile_help" required>
                    </div>
                    <div class="mb-1">
                        <label for="email_user" class="form-label" style=" margin-bottom: 0;">Nhập email:</label>
                        <input type="email" class="form-control check_format" id="email_user" name="email_user"
                            required>
                        <div id="validationServerUsernameFeedback" class="invalid-feedback" >

                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="descrition" class="form-label" style=" margin-bottom: 0;">Nhập mô tả:</label>
                        <!-- <input type="text" class="form-control " id="name_user" name="name_user" required> -->
                        <textarea class="form-control" name="descrition" id="descrition"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="my_location_send" id="my_location_send" >
                    <input type="hidden" name="blood_name" id="blood_name">
                    <input type="hidden" id="user" name="id_user">
                    <input type="hidden" name="user_need" value='<?php echo $usr ?>'>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success btn-sm">Gửi</button>

                </div>
            </form>
        </div>
    </div>
</div>
<?php if($usr == 0) :?>
    <script src="<?php echo getBaseUrl() ?>/js/firebase.js"></script>
<?php endif ?>
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoiZ2lhcDE1IiwiYSI6ImNrcmFuenhrZDFqN2MycGxwa3J6OHA4cDgifQ.1G6kupnoC6sI2dA5SfEBbA';


getdata(0);

var features_data = [];
var option_lood = [];
$(document).on('change', '#blood_field', function() {
    // let style_ofcavan = $('.mapboxgl-canvas').attr('style')
    // $('#with_cavan').val(style_ofcavan)
    features_data = [];
    $("#listings").html('');
    $("#map").html('')
    let blood_id = $(this).val()
    getdata(blood_id);
     $(".sidebar").toggleClass("sidebar_media");
    $("#map").toggleClass("map_media");
    // $('.media_control').toggleClass("media_control_t")
    // var x = $('.media_control_son').text();

    // if (x === "→") {
    //       $('.media_control_son').text("←");
    // } else {
    //     $('.media_control_son').text("→");
    // }

});

var initialText = $('.editable').val();
$('.editOption').val(initialText);

$('#blood').change(function() {
    var selected = $('option:selected', this).attr('class');
    var optionText = $('.editable').text();

    if (selected == "editable") {
        $('.editOption').show();
        $('.editOption').keyup(function() {
            var editText = $('.editOption').val();
            $('.editable').val(editText);
            $('.editable').html(editText);
        });

    } else {
        $('.editOption').hide();
    }
});
/**
 * Add the map to the page
 */

function getdata(blood_id) {
    $.post("ajax.php?pg=select_data_user_blood",{condition: blood_id},
        function(data) {
         
            var data_blood = JSON.parse(data);
            for (var i = 0; i < data_blood.length; i++) {
                if (data_blood[i]['longitude'] == '' && data_blood[i]['latitude'] == '') {
                    var coordinates = [0, 0];
                } else {
                    var coordinates = [data_blood[i]['longitude'], data_blood[i]['latitude']];
                }
                if (data_blood[i]['photo'] === '' || data_blood[i]['photo'] === null) {
                    var photo =
                        './images/no_profile_pic.jpg'
                } else {
                    var photo = data_blood[i]['photo']
                }
                if (data_blood[i]['id_user'] == <?php echo $usr ?>) {
                    var name_user = 'Bạn';
                } else {
                    var name_user = data_blood[i]['name_humman'];
                }
                const data_get = {
                    'type': 'Feature',
                    'geometry': {
                        'type': 'Point',
                        'coordinates': coordinates
                    },
                    'properties': {
                        'Name_user': name_user,
                        'Blood': data_blood[i]['name_lood'],
                        'avatar': photo,
                        'email': data_blood[i]['email'],
                        'user': data_blood[i]['id_user'],
                    },
                }
                features_data.push(data_get)
            };
            runmap(features_data);
            // $("#map").toggleClass("map_media");
            // $(".sidebar").toggleClass("sidebar_media");
            // $('.media_control').toggleClass("media_control_t")
               
        });
}

function blood_fet() {
    $.post("ajax.php?pg=select_data_blood",
        function(data) {
            var data_blood = JSON.parse(data);
            for (var i = 0; i < data_blood.length; i++) {
                const option_son = '<option value="' + data_blood[i]['id'] + '">' + data_blood[i]['name_lood'] +
                    '</option>';
                option_lood.push(option_son)
            };

            $(".blood").append(option_lood);
            $(".blood_d").append('<option class="editable" value="0">Khác</option>');
        });
}

blood_fet();


function runmap(features_data) {
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [108.2104578, 16.0747396],
        zoom: 3,
        scrollZoom: true
    });
    map.addControl(
        new mapboxgl.FullscreenControl()
    );
    map.addControl(
        new mapboxgl.NavigationControl()
    );



    const stores = {
        'type': 'FeatureCollection',
        'features': features_data
    };




    // check valu null
    if (stores.features.length == 0) {
        const listings_check = document.getElementById('listings');
        var text_loaction = listings_check.appendChild(document.createElement('span'));
        text_loaction.innerHTML = 'Hiện tại nhóm máu này chưa có ';
        text_loaction.className = 'Empty_blood d-flex justify-content-center';
    }


    /**
     * Assign a unique id to each store. You'll use this `id`
     * later to associate each point on the map with a listing
     * in the sidebar.
     */
    stores.features.forEach((store, i) => {
        store.properties.id = i;
    });
    /**
     * Wait until the map loads to make changes to the map.
     */
    map.on('load', () => {
         map.resize();
        /**
         * This is where your '.addLayer()' used to be, instead
         * add only the source without styling a layer
         */
        map.addSource('places', {
            'type': 'geojson',
            'data': stores
        });

        /**
         * Create a new MapboxGeocoder instance.
         */
        const geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl,
            marker: true,
            // bbox: [-77.210763, 38.803367, -76.853675, 39.052643]
        });

        /**
         * Add all the things to the page:
         * - The location listings on the side of the page
         * - The search box (MapboxGeocoder) onto the map
         * - The markers onto the map
         */
        buildLocationList(stores);
        // map.addControl(geocoder, 'top-left');
        addMarkers();

        /**
         * Listen for when a geocoder result is returned. When one is returned:
         * - Calculate distances
         * - Sort stores by distance
         * - Rebuild the listings
         * - Adjust the map camera
         * - Open a popup for the closest store
         * - Highlight the listing for the closest store.
         */
        geocoder.on('result', (event) => {
            /* Get the coordinate of the search result */
            const searchResult = event.result.geometry;

            /**
             * Calculate distances:
             * For each store, use turf.disance to calculate the distance
             * in miles between the searchResult and the store. Assign the
             * calculated value to a property called `distance`.
             */
            const options = {
                units: 'miles'
            };
            for (const store of stores.features) {
                store.properties.distance = turf.distance(
                    searchResult,
                    store.geometry,
                    options
                );
            }

            /**
             * Sort stores by distance from closest to the `searchResult`
             * to furthest.
             */
            stores.features.sort((a, b) => {
                if (a.properties.distance > b.properties.distance) {
                    return 1;
                }
                if (a.properties.distance < b.properties.distance) {
                    return -1;
                }
                return 0; // a must be equal to b
            });

            /**
             * Rebuild the listings:
             * Remove the existing listings and build the location
             * list again using the newly sorted stores.
             */
            const listings = document.getElementById('listings');
            while (listings.firstChild) {
                listings.removeChild(listings.firstChild);
            }
            buildLocationList(stores);

            /* Open a popup for the closest store. */
            createPopUp(stores.features[0]);

            /** Highlight the listing for the closest store. */
            const activeListing = document.getElementById(
                `listing-${stores.features[0].properties.id}`
            );
            activeListing.classList.add('active');

            /**
             * Adjust the map camera:
             * Get a bbox that contains both the geocoder result and
             * the closest store. Fit the bounds to that bbox.
             */
            const bbox = getBbox(stores, 0, searchResult);
            map.fitBounds(bbox, {
                padding: 100
            });
        });
    });

    /**
     * Using the coordinates (lng, lat) for
     * (1) the search result and
     * (2) the closest store
     * construct a bbox that will contain both points
     */
    function getBbox(sortedStores, storeIdentifier, searchResult) {
        const lats = [
            sortedStores.features[storeIdentifier].geometry.coordinates[1],
            searchResult.coordinates[1]
        ];
        const lons = [
            sortedStores.features[storeIdentifier].geometry.coordinates[0],
            searchResult.coordinates[0]
        ];
        const sortedLons = lons.sort((a, b) => {
            if (a > b) {
                return 1;
            }
            if (a.distance < b.distance) {
                return -1;
            }
            return 0;
        });
        const sortedLats = lats.sort((a, b) => {
            if (a > b) {
                return 1;
            }
            if (a.distance < b.distance) {
                return -1;
            }
            return 0;
        });
        return [
            [sortedLons[0], sortedLats[0]],
            [sortedLons[1], sortedLats[1]]
        ];
    }

    /**
     * Add a marker to the map for every store listing.
     **/
    function addMarkers() {
        /* For each feature in the GeoJSON object above: */
        for (const marker of stores.features) {

            /* Create a div element for the marker. */
            const el = document.createElement('div');
            /* Assign a unique `id` to the marker. */
            el.id = `marker-${marker.properties.id}`;
            el.innerHTML = `${marker.properties.Blood}`;
            /* Assign the `marker` class to each marker for styling. */
            el.className = 'marker';
            /**
             * Create a marker using the div element
             * defined above and add it to the map.
             **/
            new mapboxgl.Marker(el, {
                    offset: [0, -23]
                })
                .setLngLat(marker.geometry.coordinates)
                .addTo(map);

            /**
             * Listen to the element and when it is clicked, do three things:
             * 1. Fly to the point
             * 2. Close all other popups and display popup for clicked store
             * 3. Highlight listing in sidebar (and remove highlight for all other listings)
             **/
            el.addEventListener('click', (e) => {
                flyToStore(marker);
                createPopUp(marker);
                const activeItem = document.getElementsByClassName('active');
                e.stopPropagation();
                if (activeItem[0]) {
                    activeItem[0].classList.remove('active');
                }
                const listing = document.getElementById(
                    `listing-${marker.properties.id}`
                );
                listing.classList.add('active');
            });
        }
    }

    /**
     * Add a listing for each store to the sidebar.
     **/
    function buildLocationList(stores) {
        for (const store of stores.features) {
            /* Add a new listing section to the sidebar. */
            const listings = document.getElementById('listings');
            const listing = listings.appendChild(document.createElement('div'));
            /* Assign a unique `id` to the listing. */
            listing.id = `listing-${store.properties.id}`;
            /* Assign the `item` class to each listing for styling. */
            listing.className = 'item position-relative';

            /* Add the link to the individual listing created above. */
            const link = listing.appendChild(document.createElement('a'));
            link.href = '#';
            link.className = 'title';
            link.id = `link-${store.properties.id}`;
            link.innerHTML = `${store.properties.Name_user}`;
            /* Add details to the individual listing. */
            const details = listing.appendChild(document.createElement('div'));
            details.innerHTML = `Nhóm máu: <b>${store.properties.Blood} </b>`;
            // if (store.properties.phone) {
            //     details.innerHTML += ` &middot; ${store.properties.phoneFormatted}`;
            // }
            if (store.properties.distance) {
                const roundedDistance =
                    Math.round(store.properties.distance * 100) / 100;
                details.innerHTML += `<div><strong> Cách ${roundedDistance} dặm</strong></div>`;
            }
            const check_location = `${store.geometry.coordinates}`;
            if (check_location == '0,0') {
                var text_loaction = listing.appendChild(document.createElement('span'));
                text_loaction.innerHTML = 'Chưa cập nhật ví trí';
                text_loaction.className = 'text_up_loaction';

            }
            if (<?php echo  $usr ?> != `${store.properties.user}`) {
                var help_blood = listing.appendChild(document.createElement('button'));
                help_blood.className = 'btn btn-sm position-absolute  help_blood'
                help_blood.innerHTML = 'Xin máu';
                var attr = document.createAttribute("data-blood");
                attr.value = `${store.properties.user}`;
                help_blood.setAttributeNode(attr);
                var attr_n = document.createAttribute("data-blood_name");
                attr_n.value = `${store.properties.Blood}`;
                help_blood.setAttributeNode(attr_n);
            }





            /**
             * Listen to the element and when it is clicked, do four things:
             * 1. Update the `currentFeature` to the store associated with the clicked link
             * 2. Fly to the point
             * 3. Close all other popups and display popup for clicked store
             * 4. Highlight listing in sidebar (and remove highlight for all other listings)
             **/
            if (check_location != '0,0') {
                link.addEventListener('click', function() {
                    for (const feature of stores.features) {
                        if (this.id === `link-${feature.properties.id}`) {
                            flyToStore(feature);
                            createPopUp(feature);
                        }
                    }
                    const activeItem = document.getElementsByClassName('active');
                    if (activeItem[0]) {
                        activeItem[0].classList.remove('active');
                    }
                    this.parentNode.classList.add('active');
                });
            }
            
                $(".sidebar").toggleClass("sidebar_media");
                $("#map").toggleClass("map_media");
                $('.media_control').toggleClass("media_control_t")
                // var x = $('.media_control_son').text();
            
                // if (x === "→") {
                //       $('.media_control_son').text("←");
                // } else {
                //     $('.media_control_son').text("→");
                // }

        }
    }

    /**
     * Use Mapbox GL JS's `flyTo` to move the camera smoothly
     * a given center point.
     **/
    function flyToStore(currentFeature) {
        map.flyTo({
            center: currentFeature.geometry.coordinates,
            zoom: 15
        });

    }

    /**
     * Create a Mapbox GL JS `Popup`.
     **/
    function createPopUp(currentFeature) {
        const popUps = document.getElementsByClassName('mapboxgl-popup');
        if (popUps[0]) popUps[0].remove();
        const popup = new mapboxgl.Popup({
                closeOnClick: false
            })
            .setLngLat(currentFeature.geometry.coordinates)
            .setHTML(
                `<h3 class="tomb_title text-center"><b>${currentFeature.properties.Name_user } </b></h3>
                <div class="d-flex align-items-center justify-content-around" >
                    <div class="avatar_m">
                        <img src="${currentFeature.properties.avatar}" alt="">
                    </div>
                    <div class="name_tomb">
                        <div> Nhóm máu: <b>${currentFeature.properties.Blood}</b></div>
                    </div>
                   
                </div>`
            )
            .addTo(map);
    }
    // let  styele =$('#with_cavan').val()
    // if (styele.length>0) {
    //     setstylemap(styele)
    // }
    // function setstylemap(width_get){
    //      $('.mapboxgl-canvas').css(width_get)
    // }


}

// <!-- location new -->




var allButtons = document.querySelectorAll('.up_location');
for (var i = 0; i < allButtons.length; i++) {
    allButtons[i].addEventListener('click', function() {
        getLocation()
    }, false);
}

var z = document.getElementById("location");
var y = document.getElementById("address");
var x = document.getElementById("location2");


function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
        y.innerHTML = "Geolocation is not supported by this browser.";
    }

}


function showPosition(position) {

    x.value = +position.coords.longitude;
    z.value = +position.coords.latitude;
    y.value = +position.coords.latitude +
        ", " + position.coords.longitude;



    $("#address").each(function() {
        var address = $(this).val().replace(/\,/g, ' '); // get rid of commas
        var url = address.replace(/\ /g,
            '%20'); // convert address into approprite URI for google maps

        $(this).wrap('<a class="preview_map"  href="http://maps.google.com/maps?q=' + url +
            '" data-popup="width=1000,height=1000,scrollbars=yes"></a>');
    });


}

var check_user  = [<?php if ($me =='me') {echo 0;}else {echo 1;}?>];
/* update location blood*/
$(document).on('submit', '#insert_form_location', function(e) {
    e.preventDefault()
    $.post("ajax.php?pg=up_data_user_blood",
        $(this).serialize(),
        function(data) {
            console.log(data)
            if (data != 'error') {

                features_data = [];
                check_user.push(1)
                $("#listings").html('')
                getdata(0)
                $("#add_blood").parent().remove()
                $("#them_vi_tri").remove()
                $('.modal-backdrop').remove();
            } else {
                $("#mesessage").text('Các trường bắt buộc không để trống')


            }

        },
        "json"
    );
    return false;
})


// small window 
$(document).on('click', '.preview_map', function(event) {
    event.preventDefault();
    const $this = $(this)
    const url = $this.attr("href");
    const windowName = "popUp";
    const windowSize = $this.data("popup");
    window.open(url, windowName, windowSize);
});

$(document).on('click', '#add_blood', function() {
    if (<?php echo  $usr ?> == 0) {
        $('#login_modal').modal('show');
    } else {
        $('#them_vi_tri').modal('show');
    }
})

// send email 
$(document).on('click', '.help_blood', function() {
   
    if (<?php echo $usr ?> == 0) {
        $('#login_modal').modal('show');
    }
     else {
        for (var i = 0; i < check_user.length; i++) {
            if (check_user[i]==1) {
              
                const address_send = '<?php echo empty($bl['latitude'])?'0':$bl['latitude']?>,<?php echo  empty($bl['longitude'])?'0':$bl['longitude']?>'.replace(/\,/g, ' ');
                var url_send = address_send.replace(/\ /g, '%20'); // convert address into approprite URI for google maps
                $('#my_location_send').val(url_send);
                $('#help_blood').modal('show');
                $('#user').val($(this).attr('data-blood'));
                $('#blood_name').val($(this).attr('data-blood_name'))
            }
            else{
                $('#them_vi_tri').modal('show');
            }
        }
       
    }

})

// save and send email
$(document).on('submit', '#send_help_blood_form', function(e) {
    e.preventDefault()
    $('.animation_send').show(1000)
     $('.send_load_icon').show(1500)
    $.post("ajax.php?pg=send_help_blood",
        $(this).serialize(),
        function(data) {
            if (data.data_send == 'error') {
                $('.animation_send').hide(1000)
                $('.check_format').addClass("is-invalid")
                $('#validationServerUsernameFeedback').text(
                    'Số điện thoại hoặc  email không đúng vui lòng nhập lại');
                    
                $('#validationServerUsernameFeedback').show();
            } else if (data.data_send == 'limit') {
                $('.animation_send').hide(1000)
                $('#validationServerUsernameFeedback').text(
                    'Bạn đã vượt quá giới hạn xin máu, sau 24h bạn mới có thể xin lại !.');
            } else if (data.data_send == 'Sussess') {
                $('#help_blood').modal('hide');
                $('.send_load_icon').hide()
                $(".send_complete_icon").fadeIn();
                $(".send_complete_icon").fadeOut(3000);
                $('.animation_send').hide(3000)
            }
        },
        "json"
    );
    return false;
})


 
$(document).on('focus', '.check_format', function() {
    $('.check_format').removeClass("is-invalid")
    $('#validationServerUsernameFeedback').hide();
})
$(document).on("click", ".logout", function() {
    if (confirm('Bạn có chắc muốn đăng xuất không')) {
        $.get("ajax.php?pg=logout", function() {
            $(location).attr("href", "index.php");
        });
    }
    return false;
});
$(document).on('click','.media_control', function(){
    $(".sidebar").toggleClass("sidebar_media");
    $("#map").toggleClass("map_media");
    $(this).toggleClass("media_control_t")
    // var x = $('.media_control_son').text();

    // if (x === "→") {
    //       $('.media_control_son').text("←");
    // } else {
    //     $('.media_control_son').text("→");
    // }
  });
// search 
$("input[name=search]").keyup(function() {
    var th = $(this);
    var vl = $(this).val();
    if (vl !="") {
      $.post(path + "/ajax.php?pg=search", { search: vl }, function (puerto) {
      let data = JSON.parse(puerto)
      let ul = $('<ul class="pt-drop">')
      if (data=='Không có kết quả nào!') {
        ul.append('<li><a href="#">Không có kết quả nào!</a></li>')
      }else{
        for (let i = 0; i < data.length; i++) {
          let li = '<li><a href="'+path+'/tree.php?id='+data[i]['id']+'&t='+data[i]['url']+'">'+data[i]['name']+'</a></li>' 
          ul.append(li)
        }
      }
        $(".sresults").html(ul);
        th.parent().find("ul").addClass("open");
      });
    }
  });
$('.scroll-box').remove()
</script>
<?php 
if ($usr==0) {
    include 'modal_login.php';
}

?>
</script>
