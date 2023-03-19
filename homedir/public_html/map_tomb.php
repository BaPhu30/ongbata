<?php
    include 'header.php';
    $check_login = $_SESSION["login"];
    $data = new Getdata();
    $family = $_GET['family'];
    $condition = ' Where family="'.$family.'" and death ="0"';
    $select_data= $data->select('ftree_v1_4_members',$condition,$db);
    $condition_family =' Where id="'.$family.'"';
    $select_family= $data->select('ftree_v1_4_families',$condition_family,$db);
    foreach($select_family as $sf)
    {
    
    }
    
    // get all role data of family
    $condition_of_all_fam  = ' family="'.$family.'"';
    $select_all_data = $data->select_column("ftree_v1_4_members", "user", $condition_of_all_fam, $db);
    $data_comopare = [];
    foreach($select_all_data as $dt_all)
    {
        if ($dt_all['user']) {
            array_push($data_comopare, $dt_all['user']);
        }
    }
    
    if (strcmp(us_name, $sf['moderators'])==0 || strcmp(us_email, $sf['moderators'])== 0 || strcmp(us_mobile, $sf['moderators'])==0 || strcmp(us_id, $sf['author'])==0 || us_level == 6 || in_array(us_id, $data_comopare)) {
     $vistit = 'up';
    }
    
    $num_mem_die = db_count("members WHERE family = '{$family}' &&  death = 0");

?>
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

    .heading {
        background: #fff;
        border-bottom: 1px solid #eee;
        min-height: 60px;
        line-height: 60px;
        padding: 0 10px;
        background-color: #00853e;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .listings {
       max-height: calc(100vh - 138px);
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
    font-size: 12px;
    font-weight: bold;
    background-color: white;
    padding: 0px 5px;
    border-radius: 50px;
    /* height: 56px;
    width: 56px;
    background-size: contain;
    background-image: url(https://ongbata.vn/wp-content/uploads/2021/02/logo-300x300.png); */
}
.marker::after{
    content: '';
    width: 15px;
    height: 15px;
    position: absolute;
    background: white;
    bottom: -11px;
    left: 46%;
    box-shadow: 0px 3px 1px 0px;
    border-radius: 20px;
}

    /* Marker tweaks */
    .mapboxgl-popup {
        padding-bottom: 35px;
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
        background: #91c949;
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
    .add_tree_g{
        display: none  !important;
    }
    
    .search_mem {
        left: 34%;
        top: 61px;
        z-index: 99;
    }
    
    .search_mem_son ul {
        list-style: none;
    }
    .search_customer { 
  position: relative;
  padding: 10px; 
  font-style: italic;
}

.search_customer input { 
   text-indent: 30px;
   font-family:  FontAwesome, sans-serif;
   border: 1px solid #00853e;
   background-color: #00853e;
   width: 100%;
   border-radius: 20px;
    padding: 5px;
}

.search_customer input::placeholder {
  color: white;
  font-weight: bold;
  font-style: italic;

}

.search_customer .fa-search { 
  position: absolute;
  color: white;
  font-size: 18px;
  top: 17px;
  right: 25px;
}

#search_tomb .modal-content  {
    padding: 10px;
}

.search_tomb_group {
    margin-bottom: 15px;
}

#list_result_search {
    list-style: none;
    padding: 0;
    max-height: 500px;
    overflow: auto;
}

#list_result_search li {
        margin-bottom: 10px;
}

#search_input {
    margin-right: 10px;
}
    
     @media only screen and (max-width: 700px){
         <?php if ($usr>0): ?>
            .pt-wrapper {
            height: 100vh !important;
              }
        <?php endif; ?>
         .icon_hide_map{
        display: none;
        }
        .icon_show_map{
            display: block !important;
        }
         .back_tree{
                font-size: 12px;
         }
        .media_control{
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
               <?php if ($usr>0): ?>
            top:0px;
            <?php endif; ?>
             left: -209px;
             transition: all 0.5s;
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
         .mapboxgl-ctrl-fullscreen{
                display: none !important;
        }
        .up_location{
            position: unset !important;
        }
        .search_customer .fa-search {
        left: 20px;
        right: unset;
        }
        
        .heading {
            flex-direction: column-reverse;
        }
        
    }
</style>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="media_control ">
   <span class="btn  btn-danger btn-sm rounded-circle media_control_son">&#8594</span> 
</div>
<?php if($vistit=='up' && $num_mem_die >5):  ?>
<div class="search_mem position-absolute">
    <input class="form-control" type="text" id="search_map" placeholder="Tìm để cập nhật ví trí">
    <div class="search_mem_son bg-white" style="display:none">

    </div>
</div>
<?php endif ?>

<div class="sidebar">
    <div class="heading">
        <h1>Danh sách mộ của gia phả <?php echo $sf['name']; ?></h1>
        <div>
             <a class="text-white back_tree btn btn-outline-dark" href="<?php echo path ?>/tree.php?id=<?php echo $family,'&t=',fh_seoURL($sf['name'])?>"><b><i>Trở về gia phả</i></b></a>
        </div>     
    </div>
    <?php if($num_mem_die >5): ?>
        <div class="search_customer">
            <span <i class="fa fa-search"></span>
            <input placeholder="Tìm mộ người đã mất trong gia phả" id="click_search_tomb">
        </div>
    <?php endif ?>
    <div id="listings" class="listings"></div>
</div>
<div id="map" class="map"></div>



<!-- modal up loaction -->
<!-- add location -->
<div class="modal fade  " id="them_vi_tri">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form method="post" id="insert_form_location">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm ví trí phần mộ</h4>
                    <button type="button" class=" btn close rounded-circle btn-light"
                        data-bs-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="location_dad">
                     
                            <div class="mb-2">
                                <label for="location " class="form-label"><b>Vĩ độ:</b> </label>
                                <input type="text" name="latitude" id="location" class=" form-control" max="90" required>
                            </div>

                            <div class="">
                                <label for="location2" class="form-label"><b>kinh độ :</b> </label>
                                <input type="text" name="longitude" id="location2" class="form-control" required>
                            </div>
                        <span id="mesessage">

                        </span>

                    </div>
                    <!-- </form> -->

                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div class=" mb-2 d-flex justify-content-center align-items-center">
                        <span class="material-icons btn-outline-info up_location dinh_vi_lai" id=""  type="button" 
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Định vị lại">
                            gps_fixed
                        </span>
                        <button type="button" class="btn btn-warning " id="address">
                            xem trước ví trí trên bản đồ
                        </button>
                    </div>
                    <div>
                        <input type="hidden" name="location_id" id="location_id" class="value_0" />
                        <input type="submit" name="update_location" id="update_location" value="Cập nhật" class="btn btn-success" />
                    </div>
                </div>
            </form>

        </div>

    </div>
</div>
<?php if($num_mem_die >5): ?>
<!-- modal search tomb -->
<div class="modal fade" id="search_tomb" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content ">
     <div class="d-flex search_tomb_group">
        <input class="form-control me-2" id="search_input" type="text" placeholder="Nhập để tìm">
       
     </div>
     <ul id="list_result_search">
          
     </ul>
    </div>
  </div>
</div>
<?php endif ?>
<?php if($usr == 0) :?>
    <script src="<?php echo getBaseUrl() ?>/js/firebase.js"></script>
<?php endif ?>
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoiZ2lhcDE1IiwiYSI6ImNrcmFuenhrZDFqN2MycGxwa3J6OHA4cDgifQ.1G6kupnoC6sI2dA5SfEBbA';

/**
 * Add the map to the page
 */
<?php
$condition_center =' Where family = '.$family.' HAVING(longitude)';
$select_center = $data ->select('ftree_v1_4_members', $condition_center ,$db);
foreach($select_center as $ct)
{}?>
const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [<?php echo empty($ct['longitude'])?'108.2104578':$ct['longitude']?>,<?php echo empty($ct['latitude'])?'16.0747396':$ct['latitude']?>],
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
    'features': [
        <?php  foreach($select_data  as $sd) {?>
            {
            'type': 'Feature',
            'geometry': {
                'type': 'Point',
                'coordinates': [<?php echo empty($sd['longitude'])?'0':$sd['longitude'];?>,<?php echo empty($sd['latitude'])?'0':$sd['latitude'];?>],
                'preview_map': [<?php echo empty($sd['latitude'])?'0':$sd['latitude'];?>,
                    <?php echo empty($sd['longitude'])?'0':$sd['longitude'];?>
                ]
            },
            'properties': {
                'deathdate': '<?php if($sd['deathdate'] ==0){ echo $sd['deathdate'] ;}else{ echo  date("d-m-Y",  $sd['deathdate']) ;}?>',
                'avatar': '<?php echo empty($sd['photo'])?'./images/no_profile_pic.jpg':$sd['photo']; ?>',
                'namemember': '<?php echo $sd['lastname'].' '.$sd['firstname']; ?>',
                'id_action': '<?php echo $sd['id']; ?>',
                'yeardeath':'<?php if($sd['deathdate'] ==0){ echo $sd['deathdate'] ;}else{ echo date("Y",  $sd['deathdate']);}?>',

            }
        },
        <?php } ?>
    ]
};

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
        /* Assign the `marker` class to each marker for styling. */
        el.innerHTML = `${marker.properties.namemember}`;
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
        link.innerHTML = `${store.properties.namemember}`;
        /* Add details to the individual listing. */
        if (store.properties.deathdate != 0) {
            const details = listing.appendChild(document.createElement('div'));
            details.innerHTML = `Ngày mất: <b>${store.properties.deathdate} </b>`;
        }
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
            <?php if($vistit=='up'):?>
                var up_location = listing.appendChild(document.createElement('span'));
                up_location.className =
                    'text-dark position-absolute position-absolute  up_location btn btn-outline-warning fa fa-plus';
                up_location.id = `${store.properties.id_action}`;
                up_location.innerHTML = '  Cập nhật ví trí';
            <?php endif ?>
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

        // <!-- location new -->
        var allButtons = document.querySelectorAll('.up_location');
        for (var i = 0; i < allButtons.length; i++) {
            allButtons[i].addEventListener('click', function() {
                getLocation(this.id)
            }, false);
        }

        // var z = document.getElementById("location");
        // var y = document.getElementById("address");
        // var x = document.getElementById("location2");


        // function getLocation(id) {
        //     document.getElementById('location_id').value = id
        //     $('.dinh_vi_lai').attr("id",id);
        //     if (navigator.geolocation) {
        //         navigator.geolocation.getCurrentPosition(showPosition);
        //     } else {
        //         x.innerHTML = "Geolocation is not supported by this browser.";
        //         y.innerHTML = "Geolocation is not supported by this browser.";
        //     }
        // }


        // function showPosition(position) {

        //     x.value = +position.coords.longitude;
        //     z.value = +position.coords.latitude;
        //     y.value = +position.coords.latitude +
        //         ", " + position.coords.longitude;

        //     $('#them_vi_tri').modal('show');

        //     $("#address").each(function() {
        //         var address = $(this).val().replace(/\,/g, ' '); // get rid of commas
        //         var url = address.replace(/\ /g, '%20'); // convert address into approprite URI for google maps

        //         $(this).wrap('<a class="preview_map" href="http://maps.google.com/maps?q=' + url + '"  data-popup="width=1000,height=1000,scrollbars=yes"></a>');
        //     });
        // }
    }
}

$(document).on('keyup', '#search_input', function() {
    let valu = $('#search_input').val()
    let result = []
    if(valu !=''){
        for (const key of stores.features ) {
            if (key.properties.namemember.indexOf(valu) > -1) {
                let location = key.geometry.coordinates
                let click_fly
                if (location == '0,0') {
                    location  = '<div class="text_up_loaction">Chưa cập nhật ví trí</div>'
                    click_fly = '' 
                }
                else {
                    location  = ''
                    click_fly = 'click_fly'
                }
                if(key.properties.deathdate != 0 ){
                    var datedie =  '<div>Ngày mất: <b>' + key.properties.deathdate +'</b></div>'
                }
                else {
                    var datedie =  ' '
                }
                let list = '<li>'+
                '<a href="#" class="title '+click_fly +'" id="link-'+key.properties.id+'">'+key.properties.namemember+'</a>'+
                datedie + location +
                '</li>'
                result.push(list);
            }
        }
        if (result != '') {
            $('#list_result_search').html(result)
        }
        else {
            $('#list_result_search').html('<li>Không có kết quả</li>')
        }
    }
})
$(document).on('click', '.click_fly', function() {
    let id = $(this).attr('id')
    for (const feature of stores.features) {
        if (id === `link-${feature.properties.id}`) {
            flyToStore(feature);
            createPopUp(feature);
        }
    }
    $('#search_tomb').modal('hide')
})
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
    var url = `${currentFeature.geometry.preview_map}`.replace(/\ /g, '%20'); 
    if (popUps[0]) popUps[0].remove();
    if (currentFeature.properties.yeardeath != 0) {
        var yeardeath = `<div> Năm mất: <b>${currentFeature.properties.yeardeath}</b></div>`
    } else {
        var yeardeath = '';
    }

    const popup = new mapboxgl.Popup({
            closeOnClick: false
        })
        .setLngLat(currentFeature.geometry.coordinates)
        .setHTML(
            `<h3 class="tomb_title text-center">Mộ</h3>
                <div class="d-flex align-items-center justify-content-around" >
                    <div class="avatar_m">
                        <img src="${currentFeature.properties.avatar}" alt="">
                    </div>
                    <div class="name_tomb">
                         <div><b>${currentFeature.properties.namemember} </b></div>
                            ${yeardeath}
                         <a class="preview_map  text-info text-center" href="http://maps.google.com/maps?q=${url}" data-popup="width=1000,height=1000,scrollbars=yes">Dẫn đường</a>
                    </div>
                </div>`
        )
        .addTo(map);
}
const path = jQuery('meta[name="url_get"]').attr('content')
// add new location
var z = document.getElementById("location");
var y = document.getElementById("address");
var x = document.getElementById("location2");
var check_login = "<?php echo $check_login; ?>"


function getLocation(id) {
    document.getElementById('location_id').value = id
    $('.dinh_vi_lai').attr("id", id);
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

    $('#them_vi_tri').modal('show');

    $("#address").each(function() {
        var address = $(this).val().replace(/\,/g, ' '); // get rid of commas
        var url = address.replace(/\ /g, '%20'); // convert address into approprite URI for google maps

        $(this).wrap('<a class="preview_map" href="http://maps.google.com/maps?q=' + url +
            '"  data-popup="width=1000,height=1000,scrollbars=yes"></a>');
    });
}

 /* update location tomb */
 $(document).on('submit','#insert_form_location',function(e){
    e.preventDefault()
    $.post("ajax.php?pg=update_locationtomb",
      $(this).serialize(),
      function (data) {
          console.log(data)
        if (data =='') {
            $("#them_vi_tri").modal('hide')
          
            location.reload();

        }
        else{
            $("#mesessage").text(data)
          
          
        }
       
      },
      "json"
    );
    return false;
  })
  
   $(document).on('click','.media_control', function(){
    $(".sidebar").toggleClass("sidebar_media");
    $("#map").toggleClass("map_media");
    $(this).toggleClass("media_control_t")
    var x = $('.media_control_son').text();

    if (x === "→") {
          $('.media_control_son').text("←");
    } else {
        $('.media_control_son').text("→");
      
       
    }
  })
  
  $(document).on('click', '.preview_map', function(event) {
    event.preventDefault();
    const $this = $(this)
    const url = $this.attr("href");
    const windowName = "popUp";
    const windowSize = $this.data("popup");
    window.open(url, windowName, windowSize);
});
$(document).on("click", ".logout",function() {
        if (confirm('Bạn có chắc muốn đăng xuất không')) {
            $.get("ajax.php?pg=logout", function() {
                $(location).attr("href","index.php");
            });
        }
        return false;
    });
// search 
$("input[name=search]").keyup(function() {
    
    var th = $(this);
    var vl = $(this).val();
    if (vl !="" && check_login !='') {
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
  // search tomb 
$(document).on("click", "#click_search_tomb", function() {
    $('#search_tomb').modal('show')
    setTimeout(function() { 
        console.log('abc')
        $('#search_input').focus() 
    }, 1000);
});
<?php if($num_mem_die >0): ?>
    $('#search_map').keyup(function() {
        let vl = $(this).val();
        if (vl != '' && check_login !='') {
            $.post(path + "/ajax.php?pg=search_mem_map", {
                search: vl,
                family: <?php echo $family; ?>
            }, function(puerto) {
                let data = JSON.parse(puerto)
                let ul = $('<ul class="pt-drop">')
                if (data == '') {
                    ul.append('<li>Không có kết quả nào!</li>')
                } else {
                    for (let i = 0; i < data.length; i++) {
                        let deathdate = new Date((data[i]['deathdate'] * 1000) - 1).toLocaleString(
                        "vi-VN", {
                            timeZone: "Asia/Ho_Chi_Minh",
                            day: "numeric",
                            month: "short",
                            year: "numeric"
                        });
                        if (data[i]['deathdate'] != 0) {
                            var death_day = ' - <span>' + deathdate + '(ngày mất)</span>';
                        } else {
                            var death_day = '';
                        }
                        let li = '<li>' +
                            '<a href="#" data-id="' + data[i]['id'] + '" class="search_map up_location">' +
                            data[i]['lastname'] + ' ' + data[i]['firstname'] + death_day + '</a>' +
                            '</li>';
                        ul.append(li)
                    }
                }
                $(".search_mem_son").html(ul);
                $('.search_mem_son').css('display', 'block');
            });
        } else {
            $('.search_mem_son').css('display', 'none');
        }


    })
    $(document).on('click', '.search_map', function() {
        // $('#location_id').val($(this).attr('data-id'));
        getLocation($(this).attr('data-id'))
        $('.search_mem_son').css('display', 'none');
    });
<?php endif ?>


</script>
<!-- Modal login  -->
<?php
if ($usr == 0) {
 include 'modal_login.php' ;
}
?>