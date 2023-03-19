<?php 


include '../connectserve/connect.php';
// $userid = $_POST['vima'];
$visitorsid = $_POST['vimaVisit'];
if ($_POST['vima']!=null) {
    $userid = $_POST['vima'];
}
else{
    $userid = 0;
}

 $sql = "SELECT m.id as map,ftree_v1_4_members.*,m.*FROM ftree_v1_4_mapbox m left join ftree_v1_4_members  on m.membersid = ftree_v1_4_members.id WHERE membersid = '{$userid}'ORDER BY m.id DESC";
$result = $connect->query($sql);
if (!empty($result) && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $authorid= $row['author'];
    }
}



if ($visitorsid == $authorid) {
    $delete="khong_value";

}
else {
    $delete="xoa_dulieu";

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Map Ong ba ta</title>
    <link rel="icon" href="1419255.png" type="image/png" sizes="20x20">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet" />
    <!-- Mapbox GL JS -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.4.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.4.1/mapbox-gl.js"></script>
    <!-- Geocoder plugin -->

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
    <!-- Turf.js plugin -->
    <script src="../javascript/thu-vien-map-box.js"></script>
    <link rel="stylesheet" href="../css/profile-ongbata.css">
    <link rel="stylesheet" href="../css/profile_ongbata_reponsive.css" type="text/css">
    <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.css" type="text/css">
    <script  type='text/javascript'  src="../javascript/jquery.js"></script>
    <script src="../../js/custom.js"></script>
</head>
<style>
    p{
        margin:0;
    }
    .mapboxgl-ctrl-top-left>.mapboxgl-ctrl
    {
        width: 100% !important;
        min-width: 100% !important;
    }
    @media only screen and (max-width: 700px)
        {
            .mapboxgl-ctrl-top-left>.mapboxgl-ctrl
            {
                width: 58.5% !important;
                margin-bottom: 20px;
            }
  
        }
</style>
<body>
        <div class="z_index_10 media_display material-icons position-absolute top-0  click_map" id="click_map">
        <span class="material-icons lui">
        arrow_back_ios
        </span>
        <span class="material-icons tien">
        arrow_forward_ios
        </span>
    </div>
   <div style="height: 100vh; position: relative;">
    <div class="sidebar">
        <div class="heading d-flex align-items-center ">
            <h1 class="text-center fs-5 text">Các địa điểm đã đánh dấu trên bản đồ của <?php  echo(empty($lastname)?"ko_co":$lastname) ; ?> <?php echo(empty($firstname)?"ko_co":$firstname) ;?></h1>
        </div>
        <div id="listings" class="listings"></div>
    </div>
   </div>
    <div id="map" class="map">
        
    </div>
    
    <div class="modal fade edit_map <?php echo $delete; ?>" id="edit_map" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                                        <h4 class="modal-title width_100"><center> Chỉnh sửa tên ví trí hoặc mô tả</center></h4>
                                    </div>
                    <div class="modal-body">
                        <div class=" d-flex justify-content-between align-items-center mb_10">
                            <div class="  d-flex align-items-center rounded-3 ">

                               <div class="avatar avatar-sm rounded-circle gallery_dd_s">
                                </div>
                                    <div class="fz_14 pd_5 d-grid">
                                                    <span><b> <?php echo $firstname?></b></span>

                                    </div>

                           </div>
    
                        </div>
                        <form>
                            <div class="d-flex  justify-content-between">
                                <div class="location_son">
                                    <label for="nhap_ten-diadiem" ><b>Nhập tên Mộ:</b></label>
                                    <input type="text" id="nhap_ten-diadiem" name="nhap_ten-diadiem" required class="modal_input border border-success rounded location width_100">
                                </div>
                                <div class="location_son">
                                    <label for="nhap_mota-diadiem" > <b>Nhập mô tả chi tiết phần Mộ: </b></label>
                                    <input type="text" id="nhap_mota-diadiem" name="nhap_mota-diadiem"   class="modal_input2 border border-success rounded location  width_100" >
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn modal_cancel_btn btn-outline-warning">Cancel</button>
                        <button type="button" name='xoa2' class="btn btn-outline-danger delete2" >Delete</button>
                        <button type="button" class="btn modal_save_btn btn-outline-success">Update</button>
                        
                    </div>
                </div>
            </div>
    </div>
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css" type="text/css">
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.css" type="text/css">
    <script>
        /* This will let you use the .remove() function later on */
        if (!('remove' in Element.prototype)) {
            Element.prototype.remove = function () {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            };
        }

        mapboxgl.accessToken = 'pk.eyJ1IjoiZ2lhcDE1IiwiYSI6ImNrcmFuenhrZDFqN2MycGxwa3J6OHA4cDgifQ.1G6kupnoC6sI2dA5SfEBbA';

        /**
        * Add the map to the page
        */
        var map = new mapboxgl.Map({
            container: 'map',
            style:  'mapbox://styles/mapbox/streets-v11',
            center: [0,0],
            zoom: 0.5,
            // scrollZoom: false
        });
     

            
            map.addControl(
            new mapboxgl.FullscreenControl()
            );
            map.addControl(
            new mapboxgl.NavigationControl()
            );
           
        
        var stores = {
            'type': 'FeatureCollection',
            'features': [
                <?php
                    $query = "SELECT m.id as map,ftree_v1_4_members.*,m.*FROM ftree_v1_4_mapbox m left join ftree_v1_4_members  on m.membersid = ftree_v1_4_members.id WHERE membersid = '{$userid}'ORDER BY m.id DESC";
                    $result = mysqli_query($connect, $query);
                                                                                            
                    while ($row = mysqli_fetch_array($result)){
                        $id_location= $row['id'];?>
                            {
                            'type': 'Feature',
                            'geometry': {
                                'type': 'Point',
                                'coordinates': [<?php echo $row['latitude'];?>,<?php echo $row['longitude'];?>]
                            },
                            'properties': {
                                'phoneFormatted': '<?php echo $row['mobile']?>',
                                'phone': '<?php echo $row['mobile']?>',
                                'address': '<?php echo $row['title']?>',
                                'city': '<?php echo $row['description']?>',
                                'country': '',
                                'id_action': '<?php echo $row['id']?>'
                                // 'crossStreet': 'at 15th St NW',
                                // 'postalCode': '20005',
                                // 'state': 'D.C.'
                            }
                             },
                             

                <?php }?>
            ]
        };

        /**
        * Assign a unique id to each store. You'll use this `id`
        * later to associate each point on the map with a listing
        * in the sidebar.
        */
        stores.features.forEach(function (store, i) {
            store.properties.id = i;
        });

        /**
        * Wait until the map loads to make changes to the map.
        */
        map.on('load', function (e) {
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
           
            var geocoder = new MapboxGeocoder({
                accessToken: mapboxgl.accessToken,
                mapboxgl: mapboxgl,
        
                
            });
           var Directions =  new MapboxDirections({
            accessToken: mapboxgl.accessToken
           });

            /**
            * Add all the things to the page:
            * - The location listings on the side of the page
            * - The search box (MapboxGeocoder) onto the map
            * - The markers onto the map
            */
            buildLocationList(stores);
            map.addControl(geocoder, 'top-left');
            map.addControl(Directions, 'top-left');
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
            geocoder.on('result', function (ev) {
                /* Get the coordinate of the search result */
                var searchResult = ev.result.geometry;

                /**
                * Calculate distances:
                * For each store, use turf.disance to calculate the distance
                * in miles between the searchResult and the store. Assign the
                * calculated value to a property called `distance`.
                */
                var options = { units: 'miles' };
                stores.features.forEach(function (store) {
                    Object.defineProperty(store.properties, 'distance', {
                        value: turf.distance(searchResult, store.geometry, options),
                        writable: true,
                        enumerable: true,
                        configurable: true
                    });
                });

                /**
                * Sort stores by distance from closest to the `searchResult`
                * to furthest.
                */
                stores.features.sort(function (a, b) {
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
                var listings = document.getElementById('listings');
                while (listings.firstChild) {
                    listings.removeChild(listings.firstChild);
                }
                buildLocationList(stores);

                /* Open a popup for the closest store. */
                createPopUp(stores.features[0]);

                /** Highlight the listing for the closest store. */
                var activeListing = document.getElementById(
                    'listing-' + stores.features[0].properties.id
                );
                activeListing.classList.add('active');

                /**
                * Adjust the map camera:
                * Get a bbox that contains both the geocoder result and
                * the closest store. Fit the bounds to that bbox.
                */
                var bbox = getBbox(stores, 0, searchResult);
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
            var lats = [
                sortedStores.features[storeIdentifier].geometry.coordinates[1],
                searchResult.coordinates[1]
            ];
            var lons = [
                sortedStores.features[storeIdentifier].geometry.coordinates[0],
                searchResult.coordinates[0]
            ];
            var sortedLons = lons.sort(function (a, b) {
                if (a > b) {
                    return 1;
                }
                if (a.distance < b.distance) {
                    return -1;
                }
                return 0;
            });
            var sortedLats = lats.sort(function (a, b) {
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
            stores.features.forEach(function (marker) {
                /* Create a div element for the marker. */
                var el = document.createElement('div');
                /* Assign a unique `id` to the marker. */
                el.id = 'marker-' + marker.properties.id;
                /* Assign the `marker` class to each marker for styling. */
                el.className = 'marker';

                /**
                * Create a marker using the div element
                * defined above and add it to the map.
                **/
                new mapboxgl.Marker(el, { offset: [0, -23] })
                    .setLngLat(marker.geometry.coordinates)
                    .addTo(map);

                /**
                * Listen to the element and when it is clicked, do three things:
                * 1. Fly to the point
                * 2. Close all other popups and display popup for clicked store
                * 3. Highlight listing in sidebar (and remove highlight for all other listings)
                **/
                el.addEventListener('click', function (e) {
                    flyToStore(marker);
                    createPopUp(marker);
                    var activeItem = document.getElementsByClassName('active');
                    e.stopPropagation();
                    if (activeItem[0]) {
                        activeItem[0].classList.remove('active');
                    }
                    var listing = document.getElementById(
                        'listing-' + marker.properties.id
                    );
                    listing.classList.add('active');
                });
            });
        }

        /**
        * Add a listing for each store to the sidebar.
        **/
        function buildLocationList(data) {
            data.features.forEach(function (store, i) {
                /**
                * Create a shortcut for `store.properties`,
                * which will be used several times below.
                **/
                var prop = store.properties;

                /* Add a new listing section to the sidebar. */
                var listings = document.getElementById('listings');
                var listing = listings.appendChild(document.createElement('div'));
             
                /* Assign a unique `id` to the listing. */
                listing.id = 'listing-' + prop.id;
                /* Assign the `item` class to each listing for styling. */
                listing.className = 'item ';

                /* Add the link to the individual listing created above. */
                var link = listing.appendChild(document.createElement('a'));
                link.href = '#';
                link.className = 'title';
                link.id = 'link-' + prop.id;
                link.innerHTML = prop.address;

                
                /* Add details to the individual listing. */
                var details = listing.appendChild(document.createElement('div'));
                details.innerHTML = prop.city;
                if (prop.phone) {
                    details.innerHTML += '  ' /* + prop.phoneFormatted; */
                }
                if (prop.distance) {
                    var roundedDistance = Math.round(prop.distance * 100) / 100;
                    listing.innerHTML +=
                        '<p><strong> Cách ' + roundedDistance + ' dặm</strong></p>';
                }
                // tu add
                var edit = listing.appendChild(document.createElement('span'));
                edit.className = ' <?php echo $delete; ?> action_map edit fa fa-edit';
                edit.id = prop.id_action;
                edit.innerHTML = 'Edit';

                var xoa = listing.appendChild(document.createElement('span'));
                xoa.className = '<?php echo $delete; ?> action_map delete fa fa-trash-o xoa'+prop.id_action;
                xoa.id = prop.id_action;
                xoa.innerHTML = 'Delete';


                /**
                * Listen to the element and when it is clicked, do four things:
                * 1. Update the `currentFeature` to the store associated with the clicked link
                * 2. Fly to the point
                * 3. Close all other popups and display popup for clicked store
                * 4. Highlight listing in sidebar (and remove highlight for all other listings)
                **/
                link.addEventListener('click', function (e) {
                    for (var i = 0; i < data.features.length; i++) {
                        if (this.id === 'link-' + data.features[i].properties.id) {
                            var clickedListing = data.features[i];
                            flyToStore(clickedListing);
                            createPopUp(clickedListing);
                        }
                    }
                    var activeItem = document.getElementsByClassName('active');
                    if (activeItem[0]) {
                        activeItem[0].classList.remove('active');
                    }
                    this.parentNode.classList.add('active');
                });
                // 
                    $.ajax({
                    url : "fetch_anh_daidien_son.php",
                    type : "POST",
                    cache: false,
                    success:function(data){
                    $(".gallery_dd_s").html(data);
                    }
                });
                   //   edit
                $(".edit").click(function(){
                    
                            $('#edit_map').modal('show');
                            
                            var title = this.parentNode.querySelector('.title')
                            var prtitle = this.parentNode.querySelector('div')
                            var xoa2 = $(this).attr("id");
                            $('.modal_input').val(title.innerHTML).focus();
                            $('.modal_input2').val(prtitle.innerHTML).focus();
                            $('.delete2').val(xoa2);
                            // $(".delete2").addClass("xoa"+xoa2);
                            // save edit
                            $('.modal_save_btn')[0].onclick = saveTask;
                            function saveTask() {
                                
                                var id = $('.delete2').val();
                                var name = $('.modal_input').val()
                                var pr_name = $('.modal_input2').val()
                                
                                $.ajax({
                                    url: '../Process/edit_map.php',
                                    method: "POST",
                                    type: 'JSON',
                                    data: {
                                        'update': 1,
                                        'id': id,
                                        'name_ed': name ,
                                        'pr_name': pr_name,
                                    },
                                    success: function(response){
                                        title.innerHTML = $('.modal_input').val();
                                        prtitle.innerHTML = $('.modal_input2').val();
                                        $('#edit_map').modal('hide');
                                        window.location.reload();
                                 
                                    }
                                });	
                                	
                               
                            }
                            // delete modal
                             $('.delete2')[0].onclick = DeleteTask;
                             function DeleteTask() {
                                var id = $('.delete2').val(); 
                                $.ajax({
                                    url: '../Process/edit_map.php',
                                    method: "POST",
                                    type: 'JSON',
                                    data: {
                                        'delete': 1,
                                        'id': id,
                                    },
                                    success: function(response){
                                        $('#edit_map').modal('hide');
                                        $('.xoa'+id).parent().remove();
                                    }
                                });	

                             }

                            // Cancel edit
                            $('.modal_cancel_btn').click(closeModal);
                            function closeModal() {
                                $('#edit_map').modal('hide');
                            }
                });
                $(".delete").click(function(){
                    var id = $(this).attr("id");
                    $clicked_btn = $(this);
                    $.ajax({

                        url: '../Process/edit_map.php',
                        method: "POST",
                        type: 'JSON',
                        data: {
                            'delete': 1,
                            'id': id,
                                },
                    success: function(response){
                        $clicked_btn.parent().remove();
                         }
                    });	

                    
                });
                $(".xoa_dulieu").remove();
            });
            
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
            var popUps = document.getElementsByClassName('mapboxgl-popup');
            if (popUps[0]) popUps[0].remove();

            var popup = new mapboxgl.Popup({ closeOnClick: false })
                .setLngLat(currentFeature.geometry.coordinates)
                .setHTML(
                    '<h3>Địa Điểm</h3>' +
                    '<h4>' +
                    currentFeature.properties.address +
                    '</h4>'
                )
                .addTo(map);
        }
    </script>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="../bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</html>

<script>
    $(document).ready(function(){
  $(".click_map").click(function(){
    $(this).toggleClass("left_50");
    $("#map").toggleClass("map_tg");
    $(".sidebar").toggleClass("sidebar_tg");
    $(".lui").toggleClass("lui_tg");
    $(".tien").toggleClass("tien_tg");
    
    
  });

 

});
</script>
