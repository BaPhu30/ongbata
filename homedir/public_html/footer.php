<div class="pt-footer">
    <div class="pt-container">
        Copyright © 2021 <a href="<?php echo path; ?>"><?php echo site_title; ?></a>. Đã đăng ký Bản quyền .<br>
    </div>
</div>
</div>


<!-- jQuery Library -->
<script src="https://cdnjs.deepai.org/deepai.min.js"></script>
<script src="<?= path ?>/js/jquery.min.js"></script>
<script src="<?= path ?>/js/popper.min.js"></script>
<script src="<?= path ?>/js/bootstrap.min.js"></script>
<script src="<?= path ?>/js/jquery.livequery.js"></script>
<script src="<?= path ?>/js/jquery-confirm.min.js"></script>
<script src="<?= path ?>/js/fileinput.min.js"></script>
<script src="<?= path ?>/js/lightbox.js"></script>
<script src="<?= path ?>/js/datepicker.min.js"></script>
<script src="<?= path ?>/js/datepicker.en.js"></script>
<script src="<?= path ?>/js/Chart.min.js"></script>
<script src="<?= path ?>/js/jquery.uploader.js"></script>
<script src="<?= path ?>/js/jspdf.min.js"></script>
<script src="<?= path ?>/js/html2canvas.js"></script>
<script src="<?= path ?>/js/panzoom.min.js"></script>
<script src="<?= path ?>/js/jquery.amsify.suggestags.js"></script>
<script src="<?= path ?>/js/firebase.js"></script>
  <script src="<?php echo path; ?>/js/thu-vien-map-box.js"></script>

<!-- QR CODE -->
<script src="<?= path ?>/js/qrcode.js"></script>
<script>
    var path = '<?php echo path; ?>',
        nophoto = '<?php echo nophoto; ?>',
        lang = <?php echo json_encode($lang); ?>;
         // logout when error      
<?php if($error == 0): ?>
  $.get(path + "/ajax.php?pg=logout", function () {
          $(location).attr("href", path + "/index.php");
  });
<?php endif ?>

</script>

<!-- Main JS -->
<script src="<?php echo path; ?>/js/custom.js?v1.62"></script>
<script src="<?php echo path; ?>/js/custom1.js"></script>

<script>
    //check contains form login
    if ($("#form-login-wb").length > 0){ 
      $('.login-account, .login_mobile').hide()
    }
    
    function getMap(lat, long, lname, fname) {
        var fname = lname + ' ' + fname;
        lat = Number(lat);
        long = Number(long);
        if (lat !== 0) {
            $('.dirlonglat').css({
                'display': 'block'
            })
            $('.map-box-popup').css({
                'height': '250px'
            })
            mapboxgl.accessToken =
                "pk.eyJ1IjoibmhhbnRpbjM4MDUiLCJhIjoiY2tnaXNjc3J1MW8xODJ4bDdpdHZvNGhlMiJ9.ZXsvXEgoH8zx6qj0oix0VQ";
            var map = new mapboxgl.Map({
                container: "map",
                style: "mapbox://styles/mapbox/streets-v9",
                center: [long, lat],
                zoom: 10,
            });
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
            };
            map.on("click", "dot-point", function(e) {
                var coordinates = e.features[0].geometry.coordinates.slice();
                var description = e.features[0].properties.description;
                console.log(coordinates, description);
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
                    pixelRatio: 2,
                });

                map.addSource("dot-point", {
                    type: "geojson",
                    data: {
                        type: "FeatureCollection",
                        features: [{
                            type: "Feature",
                            geometry: {
                                type: "Point",
                                coordinates: [long, lat],
                            },
                            properties: {
                                title: fname,
                            },
                        }, ],
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
    }

    //direct to long lat
    function drLongLat(lat, long) {
        var lat = Number(lat)
        var long = Number(long)
        window.open('https://www.google.com/maps/dir/' + lat + ',' + long + '')
    }

    function sendSms(e){
        var x = document.getElementsByClassName('tree-title-ongbata')
        x = x[0].innerText
        var content = 'Cùng phát triển gia phả dòng họ '+x+' <?= path ?>/invitemember?mobile=<?php echo us_mobile ?>'
        var phone = document.getElementById('inviteNumberPhone').value
        var link = 'sms:'+phone+''+e+'body='+content+''
        window.open(link, '_blank')
    }



    // long lat api
    $(document).ready(function() {
        var locate = document.getElementById("longLat");
        $("#location").click(function() {
            $('#spinLocate').show()
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                location.innerHTML = "Geolocation is not supported by this browser.";
            }
        })

        $('#spinLocate').hide()

        function showPosition(position) {        
            locate.innerHTML =
            "Vĩ độ (Vĩ tuyến): " +
            position.coords.latitude +
            "<br>Kinh Độ (Kinh tuyến): " +
            position.coords.longitude;
            $("#longitude").val(position.coords.longitude)
            $("#latitude").val(position.coords.latitude)
            $('#spinLocate').hide();
        }

        $('#myCheck').click(function() {
            var checkBox = document.getElementById("myCheck");
            var text = document.getElementById("inputDeadDate");
            if (checkBox.checked == true) {
                text.style.display = "none";
            } else {
                text.style.display = "block";
            }
        })

        $('#watchLongLat').click(function() {
            var long = $('#longitude').val()
            var lat = $('#latitude').val()
            console.log(long, lat)
            window.open('https://www.google.com/maps/place/' + lat + ',' + long + '')
        })



        $("#deadDate").datepicker({
            onSelect: function() {
                var dead = $('input[name=deathdate]').val()
                var deadArray = dead.split('/')
                deadArray = deadArray.map(Number)
                var lunarDate = moment().year(deadArray[2]).month(deadArray[1]).date(deadArray[0])
                    .lunar().format('DD-MM-YYYY');
                lunarDate = lunarDate.split('-')
                lunarDate = lunarDate.map(Number)
                console.log(lunarDate)
                let day = lunarDate[0] - 1
                let month = lunarDate[1] - 1
                let year = lunarDate[2]
                $('#printLunar').html(day + '/' + month + '/' + year)
            }
        });

        //invite member to ongbata by phone
        $('#inviteMember').click(function() {
            var phone = $('#phoneinvite').val()
            var newLink = $("<a>", {
                id: "smsinvite",
                name: "link",
                href: "sms:" + phone + "&body= " + phone + " ",
                text: "some text"
            });
            newLink[0].click()
            console.log(phone, newLink)

        })

        //invite member to ongbata by Email
        $('#inviteMailMember').click(function() {
            var mail = $('#emailInvite').val()
            var mailLink = $("<a>", {
                id: "emailInvite",
                name: "link",
                href: "mailto:" + mail +
                    "?subject=look at this website&body=Hi,I found this website and thought you might like it http://www.geocities.com/wowhtml/" +
                    mail + " ",
                text: "some text"
            });
            mailLink[0].click()
            console.log(mail, mailLink)

        })
        if ($('.pt-list-item').length < 2) {
            var xs = $('.pt-list-item').length - 1
            var ka = $('.pt-list-item')[xs]
            var clickFamily = $(ka).find('a')
            console.log(ka)
            clickFamily[0].click()
        }

        $('#transl').click(function() {
            var ab = ['true', 'vi', 'Thành công', 'Lỗi!', 'YÊN NGHỈ', ' Phần mềm gia phả ông bà ta', ' Không có kết quả nào!', 'Gửi đi', 'Đóng', ' Email xác thực:', 'Chào mừng', ' Tìm kiếm gia đình ...', 'Trang Chủ', 'Gia phả', 'Các kế hoạch', 'Về chúng tôi', 'Contact Us', ' Thông tin chi tiết', 'Đăng xuất', ' Không có thông báo', 'Tạo gia phả', ' Bảng điều khiển', 'Người dùng', 'Gia phả', ' Người quản lý (Chỉ tên người dùng):', ' Simple Pricing for Everyone!', ' Định giá được xây dựng cho các doanh nghiệp thuộc mọi quy mô. Luôn biết những gì bạn sẽ phải trả. Tất cả các kế hoạch đều đi kèm với đảm bảo hoàn tiền 100%.', '/per month', 'Bắt đầu', ' Your payments have been calculated!', ' phần mềm gia phả online', 'Ông bà ta', ' Phần mềm gia phả ông bà ta là nơi lưu trữ thông tin của dòng họ, nhắc nhở con cháu tụ hop với gia đình ở những ngày giỗ, chạp thông qua ứng dụng nhắc nhở tự động từ tin nhắn của mỗi cá nhân.', ' Nơi lưu trữ kí ức, hiện thực và tương lai', '', ' Đăng nhập', ' Đăng ký', ' Tên Đăng Nhập', ' Nhập tên đăng nhập', ' Mật khẩu', ' Nhập mật khẩu', ' Mật khẩu mới', ' Nhập mật khẩu mới', ' Mật khẩu để xem gia phả', ' Nhập mật khẩu để xem gia phả', ' Email:', ' Nhập email', 'Đăng nhập', 'Đăng kí', ' Mọi người có thể thấy gia phả này', 'Gia Phả', ' Danh sách các cây bạn quản lý!', 'Kết quả khác!', ' Quên mật khẩu của bạn?', 'Reset it now', ' Chính sách bảo mật', ' Bằng cách nhấp vào nút Đăng ký, bạn đã tự động chấp nhận trong {a} của chúng tôi, đừng ngần ngại đọc nó trước!', 'Xem mật khẩu:', ' Chúng tôi rất tiếc phải thông báo với bạn rằng, gia đình này không được công khai. bạn cần có chế độ xem mật khẩu để hiển thị nó.', ' Mật khẩu để xem gia phả', 'Nhập', 'Chỉnh sửa', 'Thành viên mới', ' Đường dẫn gia phả', 's gia phả:', 'Chia sẻ', ' Chia sẻ trên Facebook', ' Chia sẻ trên Twitter', ' Chia sẻ trên Whatsapp', 'Gửi email', 'Xuất hình ảnh', ' Di sản của gia đình', ' Liên kết thành viên này với tư cách là cha mẹ của gia đình:', ' Quản lý thông tin chi tiết của bạn', ' Gửi chi tiết', ' Tên người dùng của bạn', ' Viết tên của bạn', ' Liên hệ chúng tôi', 'Về chúng tôi', ' Tên người dùng:', 'Gia đình', ' Lấy lại mật khẩu của bạn:', ' Địa chỉ email đã đăng ký của bạn', ' Lấy lại mật khẩu mới', 'Mật khẩu mới', ' Nhập mật khẩu của bạn', ' Nhập lại mật khẩu', ' Nhập lại mật khẩu', ' Danh sách gia phả', ' Không có kết quả !', ' Những thành viên', 'Gia phả', 'Chỉnh sửa', 'second', 'minute', 'hour', 'day', 'week', 'month', 'year', 'decade', 'ago', ' Thêm mới thành viên', 'Cá nhân', 'Liên hệ', ' Tiểu sử', 'Hình ảnh', ' Kết nối thành viên này mới tên người dùng (có thể bỏ trống) : ....', 'Tên', 'Họ', 'Giới tính', 'Nữ', 'Nam', 'Mối quan hệ', 'Con', ' Vợ / chồng (đã ly dị)', 'Bố / Mẹ', ' Vợ / chồng (hiện tại)', ' Ngày tháng năm sinh', ' Ngày tháng năm cưới', 'Ngày mất', ' Thành viên này vẫn còn sống', ' Enter Photo URL', 'Hình ảnh', ' Choose an image from your device', ' Hoặc chọn hình avarta', 'Website', 'Home Tel', 'Mobile', 'Birth Place', 'Death Place', ' Profession', 'Company', ' Interests', 'Bio Notes', 'Photos', ' Nhập tên thành viên', 'Nhập họ', ' Enter Facebook', 'Enter Twitter', ' Enter Instagram', 'Enter Email', 'Enter Website', ' Enter Home Tel', 'Enter Mobile', ' Enter Birth Place', ' Enter Death Place', ' Enter Profession', ' Enter Company', ' Enter Interests', ' Enter Bio Notes', 'Ngày sinh:', 'in', 'Ngày mất:', ' Ngày cưới:', 'Manage infos:', ' Your first name', ' Your last name', ' Edit Username', ' Edit Password', 'Edit Email', 'Male', 'Female', 'Country', 'State/Region', 'City', 'Full Address', ' Không có hình ảnh nào được chọn ...', ' Chọn hình ảnh', 'Gửi thông tin', ' Quá trình chỉnh sửa thông tin đã kết thúc thành công.', ' Số lượng gia đình mà bạn có thể thêm vào gói bạn có đã hết hạn, vui lòng nâng cấp gói của bạn để biết thêm!', ' Số lượng thành viên mỗi gia đình mà bạn có thể thêm cho gói bạn có đã hết hạn, vui lòng nâng cấp gói của bạn để có thêm!', ' Bạn không có quyền thêm ảnh vào album bằng gói bạn có, vui lòng nâng cấp gói của bạn để biết thêm!', ' Bạn không có quyền sử dụng gói di sản mà bạn có, vui lòng nâng cấp gói của bạn để biết thêm!', ' Không tìm thấy dữ liệu nào!', ' Không tìm thấy dữ liệu nào!', ' Bạn có chắc chắn bạn muốn thoát?', ' Không có tập tin nào được chọn...', ' Tất cả các trường là bắt buộc!', ' Bạn đã đăng nhập thành công!', ' Mật khẩu không chính xác!', ' Có gì đó không đúng!', ' Tất cả đã được làm xong!', ' Thanh toán thành công!', ' Không thể truy xuất thanh toán từ PayPal!', ' Thành công, tất cả đã xong!', ' Gia đình này đã tồn tại!', 'Tên là bắt buộc!', ' Bạn cần một địa chỉ email chính xác!', ' Email này đã tồn tại!', ' Tên người dùng này đã tồn tại!', ' Bạn đã được đăng ký thành công.', ' Bạn đã đăng ký thành công, nhưng chúng tôi đã gửi cho bạn một email để xác minh!', ' Bạn đã đăng ký thành công, nhưng cần được ban quản trị chấp nhận!', ' ID gia đình của bạn đã được tạo thành công!', ' Bạn đã đăng nhập thành công!', ' người dùng này cần được quản lý phê duyệt trước khi đăng nhập!', ' người dùng này cần xác minh bằng địa chỉ email!', ' ID gia đình hoặc mật khẩu không chính xác!', ' Không có người dùng với thông tin này!', ' Đã gửi mật khẩu đặt lại thành công.', ' Bạn không có quyền truy cập vào trang này!', ' Được rồi, bạn có thể đăng nhập ngay bây giờ.', ' bạn không thể xếp hạng gia đình này vì nó không phải là của bạn!', ' bạn không thể xếp một gia đình hai lần trong cùng một cây!', ' bạn không thể xếp hạng gia đình này vì nó không được công khai!', ' bạn không thể chạy theo gia đình này!', ' mật khẩu nhiều hơn 6 chữ cái', ' mật khẩu không khớp với mật khẩu', ' bạn có thể đăng nhập ngay bây giờ bằng mật khẩu mới này', ' Bạn có chắc chắn muốn xóa thành viên này không?', ' Tắt tùy chọn gói', ' Các kế hoạch đã được lưu thành công.', 'Thanh toán', 'Người dùng', 'Trạng thái', 'Số tiền', ' ID thanh toán', ' ID người thanh toán', 'Được tạo lúc', 'Tạo người dùng', 'Xin chào,', ' Chào mừng bạn trở lại trang tổng quan của bạn một lần nữa.', ' Số liệu thống kê trong 7 ngày qua', ' Số liệu thống kê cho năm nay', ' Số liệu thống kê trong 7 ngày qua', ' Số liệu thống kê cho năm nay', ' Các gia đình', ' Các gia đình', 'Người dùng', ' Các thành viên', 'Hình ảnh', ' Người dùng mới (24h)', ' Thanh toán mới nhất (24h)', ' Khảo sát mới nhất (24h)', ' Các thành viên', ' Trạng thái', ' tên tài khoản', 'Kế hoạch', 'Các trang', 'Tín dụng', ' Lần thanh toán cuối cùng', ' Đăng ký tại', ' Cập nhật tại', ' Xóa người dùng', ' Chỉnh sửa người dùng', 'Thanh toán', 'Người dùng', ' trạng thái', 'gói', 'Số tiền', ' Ngày thanh toán', 'TXN', ' Cài đặt chung', ' Tiêu đề trang web:', ' Từ khóa trang web:', ' Mô tả trang web:', ' URL trang web:', ' Gửi cài đặt', 'ngày', 'tháng', ' Gia đình mới nhất', ' Thành viên mới nhất', 'Trạng thái', 'Tên', 'Công khai', ' Các thành viên', ' người điều hành', 'ngày', 'Chỉnh sửa', 'xoá', ' xác minh', 'Trang mới', 'Tiêu đề', 'trong Menu', 'Tạo', ' Trạng thái đăng ký:', ' Cần phê duyệt mà không cần email', 'Mở', ' Ẩn biểu mẫu đăng ký', ' Gia đình cần được phê duyệt trước khi phát trực tiếp', 'Màu sắc', 'Bằng email', ' Tiêu đề trang', ' Biểu tượng trang', ' Nội dung trang', ' Hiển thị nó trong menu', 'Lưu', ' Cài đặt đã được gửi thành công.']
            fix = document.getElementsByTagName('textarea')
            for (var i = 0; i < y.length; i++) {
                y[i].value = ab[i]
            }
        })




    });
    
    
    
    
 
       function fbLogout() {
    		
                                FB.logout(function() {
                                //   $('.fbLink').attr("onclick","fbLogin()");
                                });
                                
                                var auth2 = gapi.auth2.getAuthInstance();
                                auth2.signOut().then(function () {
                                    // document.getElementById("gSignIn").style.display = "block";
                                });
                                
                                auth2.disconnect();
    		};

</script>



<!-- choose me -->
<?php 
$connect_me = $connect_me ?? '';

if(!empty($connect_me) || $connect_me == 0){
    $connect_me_F = (int)$connect_me;
}else{
     $connect_me_F = 1;
}

if(!empty($num_mem)){
    $num_mem_F = (int)$num_mem;
}else{
    $num_mem_F = 0;
}
// echo $connect_me_F;
// echo $num_mem_F ;
?>
<?php if( $connect_me_F ==0  && $usr >0 && $num_mem_F>2):?>
<script>
    $(function() {  
		$.post( "<?php echo path ?>/ajax.php?pg=fet_mem&&id=<?php echo $rs['id']; ?>", 
		function(data){
			var data_mem = JSON.parse(data);
            var data_me = []
            for (var i = 0; i < data_mem.length; i++) {
				var item = '<option  value=" '+data_mem[i]['lastname']+' '+data_mem[i]['firstname']+ '-'+data_mem[i]['birth_day']+'" data-id="'+data_mem[i]['id']+'" >'
                data_me.push(item)
                // $('#input_choose').val(data_mem[i]['lastname']+''+data_mem[i]['firstname']+'-'+data_mem[i]['birth_day'])
                // $('#id_choose').val(data_mem[i]['id'])
            };
			$('#choose_me').html(data_me) 
		});
	});
    $(document).on("change","#input_choose",function(){
        const Value = $('#input_choose').val();
        if (Value.length == 0) {
            $('#id_choose').val('')
        }else{
        const Text = $('option[value="' + Value + '"]').attr('data-id');
            if(!Value) return;
             $('#id_choose').val(Text)
        }
    })
    $(document).on("submit","#form_add_me",function(e){
        e.preventDefault()
        $.post( "<?php echo path ?>/ajax.php?pg=connect_me",
         $(this).serialize(),
      function (data) {
          if (data!='') {
            $('#error_value_null').text(data)
              $('#error_value_null').show(500)
          }else{
            $('#modal_it_me').modal("hide")
          }
       
      },
      "json");
    })
</script>
<?php endif ?>
<!-- Modal login  -->
<?php
if ($usr == 0) {
 include 'modal_login.php' ;
}
?>
</body>

</html>