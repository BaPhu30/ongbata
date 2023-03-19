<?php
include "header.php";
include 'configs/connection.php';



// header('Content-Type: application/json');
$result = mysqli_query($db, "SELECT * FROM ftree_v1_4_members WHERE id='" . $_GET['id'] . "'");
mysqli_close($db);



?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.deepai.org/deepai.min.js"></script>

<?php
if (mysqli_num_rows($result) > 0) {
?>
    <table>
        <tr>
            <td>Sl No</td>
            <td>First Name</td>
            <td>Last Name</td>
            <td>City</td>
            <td>Email id</td>
            <td>longitude</td>
            <td>latitude</td>
            <td>Action</td>
        </tr>
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["author"]; ?></td>
                <td><?php echo $row["lastname"]; ?></td>
                <td><?php $fname = $row["firstname"];
                    echo $row["firstname"]; ?></td>
                <td><?php $long = $row["longitude"];
                    echo $row["longitude"]; ?></td>
                <td><?php $lat = $row["latitude"];
                    echo $row["latitude"]; ?></td>
                <td><img class="w-100" src="http://localhost/ongbata/demo-ongbata/sourse-code/<?php echo $row["photo"]; ?>" alt=""></td>
                <td><a href="update-process.php?id=<?php echo $row["id"]; ?>">Update</a></td>
            </tr>
        <?php
            $i++;
        } ?>
    </table>
    <a id="colorImage">do mau hinh anh</a>
    <p id="imageC"></p>
    <div id="map" class="map-box"></div>

<?php
} else {
    echo "No result found";
}
?>
<script type="text/javascript">
    $(document).ready(function() {
        var lat = <?php echo json_encode($lat); ?>;
        var long = <?php echo json_encode($long); ?>;
        var fname = <?php echo json_encode($fname); ?>;
        lat = Number(lat)
        long = Number(long)
        console.log(lat)
        if (lat !== 0) {
            mapboxgl.accessToken =
                "pk.eyJ1IjoibmhhbnRpbjM4MDUiLCJhIjoiY2tnaXNjc3J1MW8xODJ4bDdpdHZvNGhlMiJ9.ZXsvXEgoH8zx6qj0oix0VQ";
            var map = new mapboxgl.Map({
                container: "map",
                style: "mapbox://styles/mapbox/streets-v9",
                center: [long, lat],
                zoom: 12,
            })
            var size = 200;

            // This implements `StyleImageInterface`
            // to draw a pulsing dot icon on the map.
            var pulsingDot = {
                width: size,
                height: size,
                data: new Uint8Array(size * size * 4),

                // When the layer is added to the map,
                // get the rendering context for the map canvas.
                onAdd: function() {
                    var canvas = document.createElement("canvas");
                    canvas.width = this.width;
                    canvas.height = this.height;
                    this.context = canvas.getContext("2d");
                },

                // Call once before every frame where the icon will be used.
                render: function() {
                    var duration = 1000;
                    var t = (performance.now() % duration) / duration;

                    var radius = (size / 2) * 0.3;
                    var outerRadius = (size / 2) * 0.7 * t + radius;
                    var context = this.context;

                    // Draw the outer circle.
                    context.clearRect(0, 0, this.width, this.height);
                    context.beginPath();
                    context.arc(
                        this.width / 2,
                        this.height / 2,
                        outerRadius,
                        0,
                        Math.PI * 2
                    );
                    context.fillStyle = "rgba(255, 200, 200," + (1 - t) + ")";
                    context.fill();

                    // Draw the inner circle.
                    context.beginPath();
                    context.arc(this.width / 2, this.height / 2, radius, 0, Math.PI * 2);
                    context.fillStyle = "rgba(255, 100, 100, 1)";
                    context.strokeStyle = "white";
                    context.lineWidth = 2 + 4 * (1 - t);
                    context.fill();
                    context.stroke();

                    // Update this image's data with data from the canvas.
                    this.data = context.getImageData(0, 0, this.width, this.height).data;

                    // Continuously repaint the map, resulting
                    // in the smooth animation of the dot.
                    map.triggerRepaint();

                    // Return `true` to let the map know that the image was updated.
                    return true;
                },
            }
            map.on('click', 'dot-point', function(e) {

                var coordinates = e.features[0].geometry.coordinates.slice();
                var description = e.features[0].properties.description;
                console.log(coordinates, description)
                // Ensure that if the map is zoomed out such that multiple
                // copies of the feature are visible, the popup appears
                // over the copy being pointed to.
                while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                    coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                }

                new mapboxgl.Popup()
                    .setLngLat(coordinates)
                    .setHTML(description)
                    .addTo(map);
            });

            map.on("load", function() {
                map.addImage("pulsing-dot", pulsingDot, {
                    pixelRatio: 2
                });

                map.addSource("dot-point", {
                    type: "geojson",
                    data: {
                        type: "FeatureCollection",
                        features: [{
                                type: "Feature",
                                geometry: {
                                    type: "Point",
                                    coordinates: [long, lat]
                                },
                                properties: {
                                    title: fname,
                                },
                            },


                        ],
                    },
                });

                map.addLayer({
                    id: "layer-with-pulsing-dot",
                    type: "symbol",
                    source: "dot-point",
                    layout: {
                        "icon-image": "pulsing-dot",
                        "text-field": ["get", "title"],
                        "text-font": ["Open Sans Semibold", "Arial Unicode MS Bold"],
                        "text-offset": [0, 1.25],
                        "text-anchor": "top",
                    },
                });


            });
            map.addControl(new mapboxgl.FullscreenControl());
            map.addControl(new mapboxgl.NavigationControl());


        }

        $('#colorImage').click(function() {
            deepai.setApiKey('59e32b5e-be38-4868-834d-d2f27481702f');
            (async function() {
                var resp = await deepai.callStandardApi("colorizer", {
                    image: "https://ap-south-1.linodeobjects.com/thoixua/wp-content/uploads/2021/06/bia-ha-noi-1973-750x375.jpg",
                });
                console.log(resp);
                await deepai.renderResultIntoElement(resp, document.getElementById('imageC'));
            })()
        })

    })
</script>

</div>
<?php
include __DIR__ . "/footer.php";
?>