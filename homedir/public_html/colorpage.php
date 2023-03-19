<?php
include __DIR__ . '/header.php';
?>


<script src="https://cdn.knightlab.com/libs/juxtapose/latest/js/juxtapose.min.js"></script>
<script src="./javascript/pixelcompare-master/js/pixelcompare.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="./js/color-page.js"></script>
<script src="https://cdnjs.deepai.org/deepai.min.js"></script>
<script src="./js/splide.min.js"></script>

<head>
    <link rel="stylesheet" href="./css/color-page.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="./javascript/pixelcompare-master/css/pixelcompare.css">
    <link rel="stylesheet" href="https://cdn.knightlab.com/libs/juxtapose/latest/css/juxtapose.css">
    <link rel="stylesheet" href="./css/splide.min.css">

</head>
<div id="contentAll">
    <!-- headear -->

    <!-- content -->
    <div class="content">
        <div class="content-one text-center">
            <div class="container content-top">
                <div class="content-top-title margin-bt">
                    <div class="content-top-title-heading fontsize-46">Xem ảnh của bạn có màu sắc</div>
                    <p>
                        Bạn hãy tải những bức ảnh đen trắng và bị mờ lên, bạn sẽ thấy ngạc nhiên trước bức ảnh màu
                        được tạo ra
                    </p>
                    <label for="uploadImage" class="button is-rounded content-top-title-btn">
                        <i class="fas fa-upload icon-title"></i>
                        Đăng ảnh lên
                        <input type="file" class="form-control none" id="uploadImage" />

                    </label>
                    <div class="w-100 mh-100 columns">
                        <div class="column">
                            <img id="oldImage" src="#" alt="your image" />
                        </div>
                        <div class="column newImage" id="newImage">

                        </div>
                    </div>
                </div>
                <div class="content-top-img display-flex margin-bt">
                    <div class="content-top-img-left width-50">
                        <div class="content-top-img-heading uppercase margin-bt fontsize-15 color-img-top">Khôi phục
                            màu sắc
                        </div>
                        <div class="img-top-liprary margin-bt">
                            <div id="img1"></div>
                        </div>
                        <span class="fontsize-15 color-img-top">
                            Tô màu cho bức ảnh đen trắng của bạn bằng công nghệ hiện đại tốt nhất thế giới
                        </span>
                    </div>
                    <div class="content-top-img-right width-50">
                        <div class="content-top-img-heading uppercase margin-bt fontsize-15 color-img-top">
                            Khôi phục màu sắc
                            <span class="content-top-img-right-new">Mới</span>
                        </div>
                        <div class="img-top-liprary margin-bt">
                            <div id="img2"></div>
                        </div>
                        <span class="fontsize-15 color-img-top">
                            Khôi phục màu trong ảnh bị mờ bằng công nghệ phục hồi tốt nhất thế giới
                        </span>
                    </div>
                </div>
                <div class="content-top-span font-size-12 ">
                    Được Ongbata.vn cấp phép <img class="content-top-span-img"></img> được tạo lên bởi các kỹ sư
                    phần mềm
                </div>
            </div>
        </div>
        <div class="content-two text-center">
            <div class="gallery-title">
                Nơi trưng bày phục hồi màu
                <span class="gallery-title-span">Mới</span>
            </div>
            <div id="splide" class="splide_mobile1 splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide">
                            <div id="image1" class="gallery gallery-color nero-color ">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/output-1.1.jpg" alt="">
                            </div>
                            <div class="gallery-position">
                                <div class="gallery-nocolor nero-nocolor margin-bt">
                                    <img src="https://ongbata.vn/wp-content/uploads/2019/10/image-26.png" alt="">
                                </div>
                                <span>
                                    Hình ảnh học sinh đội mũ cối đi dến trường
                                </span>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div id="image2" class="gallery gallery-color nero-color ">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/output-2.jpg" alt="">
                            </div>
                            <div class="gallery-position">
                                <div class="gallery-nocolor nero-nocolor margin-bt">
                                    <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/07/img_1.jpg" alt="">
                                </div>
                                <span>
                                    Hình ảnh Nghệ An - Bến Thủy năm 1920 - 1929
                                </span>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div id="image2" class="gallery gallery-color japanesque-color active-one">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/output-3.jpg" alt="">
                            </div>
                            <div class="gallery-position">
                                <div class="gallery-nocolor japanesque-nocolor margin-bt">
                                    <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/07/img_2-1.jpg" alt="">
                                </div>
                                <span>
                                    Hình ảnh ngôi làng năm xưa
                                </span>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div id="image3" class="gallery gallery-color japanesque-color active-one">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/output-4.jpg" alt="">
                            </div>
                            <div class="gallery-position">
                                <div class="gallery-nocolor japanesque-nocolor margin-bt">
                                    <img src="https://ongbata.vn/wp-content/uploads/2019/12/tuyen-ngon-doc-lap.jpg" alt="">
                                </div>
                                <span>
                                    Hình ảnh Bác đang soạn văn kiện
                                </span>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div id="image4" class="gallery gallery-color japanesque-color active-one">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/output-5.jpg" alt="">
                            </div>
                            <div class="gallery-position">
                                <div class="gallery-nocolor japanesque-nocolor margin-bt">
                                    <img src="https://ongbata.vn/wp-content/uploads/2019/10/image-9.png" alt="">
                                </div>
                                <span>
                                    Hình ảnh người dân đi cấy lúa
                                </span>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div id="image5" class="gallery gallery-color eugenie-color active-one">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/output-6.jpg" alt="">
                            </div>
                            <div class="gallery-position">
                                <div class="gallery-nocolor eugenie-nocolor margin-bt">
                                    <img src="https://ongbata.vn/wp-content/uploads/2019/10/xe-dap.jpg" alt="">
                                </div>
                                <span>
                                    Hình ảnh các cô gái mặc áo dài đi trên phố
                                </span>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div id="image7" class="gallery gallery-color eugenie-color active-one">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/output-8.jpg" alt="">
                            </div>
                            <div class="gallery-position">
                                <div class="gallery-nocolor eugenie-nocolor margin-bt">
                                    <img src="https://ongbata.vn/wp-content/uploads/2019/10/april-30-1975-tank.jpg" alt="">
                                </div>
                                <span>
                                    Hình ảnh những chiếc xe tăng tiến vào Dinh Độc Lập
                                </span>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div id="" class="gallery gallery-color eugenie-color active-one">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/maybayb52.jpeg" alt="">
                            </div>
                            <div class="gallery-position">
                                <div class="gallery-nocolor eugenie-nocolor margin-bt">
                                    <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/mot-goc-anh-khac-ve-chien-tranh-viet-nam-chup-tu-ben-thang-tran-11-111054.jpeg" alt="">
                                </div>
                                <span>
                                    Hình ảnh chiến sỹ Việt bắn rơi máy bay B52
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="gallery-slide-1 display-flex jc-betweeen">
                <button class="btn-pre gallery-btn">
                    <i class="fas fa-angle-left fontsize-28"></i>
                </button>
                <div class="gallery-slide-box">
                    <div class="gallery gallery-color active-one">
                        <div class="box-img">
                            <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/output-1.1.jpg" alt="">
                        </div>
                        <div class="gallery-position">
                            <div class="gallery-nocolor margin-bt">
                                <img src="https://ongbata.vn/wp-content/uploads/2019/10/image-26.png" alt="">
                            </div>
                            <span>
                                Hình ảnh học sinh đội mũ cối đi dến trường
                            </span>
                        </div>
                    </div>
                    <div class="gallery gallery-color">
                        <div class="box-img">
                            <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/output-2.jpg" alt="">
                        </div>
                        <div class="gallery-position">
                            <div class="gallery-nocolor margin-bt">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/07/img_1.jpg" alt="">
                            </div>
                            <span>
                                Hình ảnh Bến Thủy - Nghệ An 1920 - 1929
                            </span>
                        </div>
                    </div>
                    <div class="gallery gallery-color">
                        <div class="box-img">
                            <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/output-3.jpg" alt="">
                        </div>
                        <div class="gallery-position">
                            <div class="gallery-nocolor margin-bt">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/07/img_2-1.jpg" alt="">
                            </div>
                            <span>
                                Hình ảnh ngôi làng xưa
                            </span>
                        </div>
                    </div>
                    <div class="gallery gallery-color">
                        <div class="box-img">
                            <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/output-4.jpg" alt="">
                        </div>
                        <div class="gallery-position">
                            <div class="gallery-nocolor margin-bt">
                                <img src="https://ongbata.vn/wp-content/uploads/2019/12/tuyen-ngon-doc-lap.jpg" alt="">
                            </div>
                            <span>
                                Hình ảnh Bác đang soạn văn kiện
                            </span>
                        </div>
                    </div>
                </div>
                <button class="btn-next gallery-btn next">
                    <i class="fas fa-angle-right fontsize-28"></i>
                </button>
            </div>
        </div>
        <div class="content-three text-center">
            <div class="gallery-title color-333">
                Thư viện màu
            </div>
            <div id="splide2" class="splide_mobile2 splide">
                <div class="splide__track">
                    <ul class="splide__list color-333">
                        <li class="splide__slide">
                            <div class="gallery gallery-color nero-color">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/gallery2-1.jpg" alt="">
                            </div>
                            <div class="gallery-position">
                                <div class="gallery-nocolor nero-nocolor margin-bt">
                                    <img src="https://ongbata.vn/wp-content/uploads/2019/10/image-27.png" alt="">
                                </div>
                                <span>
                                    Hình ảnh học sinh đang được hướng dẫn băng bó vết thương
                                </span>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="gallery gallery-color japanesque-color">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/hangngangxua.jpeg" alt="">
                            </div>
                            <div class="gallery-position">
                                <div class="gallery-nocolor japanesque-nocolor margin-bt">
                                    <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/ha_noi_xua_pho_nguyen_sieu_9.jpeg" alt="">
                                </div>
                                <span>
                                    Hình ảnh Hà Nội ngày xưa
                                </span>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="gallery gallery-color lancers-color">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/gallery2-3.jpg" alt="">
                            </div>
                            <div class="gallery-position">
                                <div class="gallery-nocolor lancers-nocolor margin-bt">
                                    <img src="https://ongbata.vn/wp-content/uploads/2019/09/chien-luoc-dong-xuan.jpg" alt="">
                                </div>
                                <span>
                                    Bác cùng các chiến sỹ trong cuộc chiến tranh Đông Xuân 1953 - 1954
                                </span>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="gallery gallery-color eugenie-color">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/hinh-anh-bacho.jpeg" alt="">
                            </div>
                            <div class="gallery-position">
                                <div class="gallery-nocolor eugenie-nocolor margin-bt">
                                    <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/66_NAM_DBP_15.jpeg" alt="">
                                </div>
                                <span>
                                    Hình ảnh bác Hồ cùng bác Giáp và các đồng chí trong trận Điện Biên Phủ
                                </span>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="gallery gallery-color eugenie-color">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/hinhanhdinhdoclap.jpeg" alt="">
                            </div>
                            <div class="gallery-position">
                                <div class="gallery-nocolor eugenie-nocolor margin-bt">
                                    <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/9_253079.jpeg" alt="">
                                </div>
                                <span>
                                    Đội xe tăng vào dinh độc lập
                                </span>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="gallery gallery-color eugenie-color">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/gallery2-6.jpg" alt="">
                            </div>
                            <div class="gallery-position">
                                <div class="gallery-nocolor eugenie-nocolor margin-bt">
                                    <img src="https://ongbata.vn/wp-content/uploads/2019/08/vo-thi-sau.jpg" alt="">
                                </div>
                                <span>
                                    Hình ảnh người anh hùng Dân tộc Võ Thị Sáu
                                </span>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="gallery gallery-color eugenie-color">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/gallery2-7.jpg" alt="">
                            </div>
                            <div class="gallery-position">
                                <div class="gallery-nocolor eugenie-nocolor margin-bt">
                                    <img src="https://ongbata.vn/wp-content/uploads/2019/08/le-thi-hong-gam.jpg" alt="">
                                </div>
                                <span>
                                    Hình ảnh người anh hùng Dân tộc Lê Thị Hồng Gấm
                                </span>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="gallery gallery-color eugenie-color">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/bodoivietnam.jpeg" alt="">
                            </div>
                            <div class="gallery-position">
                                <div class="gallery-nocolor eugenie-nocolor margin-bt">
                                    <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/images.jpeg" alt="">
                                </div>
                                <span>
                                    Hình ảnh bộ đội Việt Nam
                                </span>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="gallery gallery-color lancers-color">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/duongphovietnam.jpeg" alt="">
                            </div>
                            <div class="gallery-position">
                                <div class="gallery-nocolor lancers-nocolor margin-bt">
                                    <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/images1888769_3.jpeg" alt="">
                                </div>
                                <span>
                                    Hình ảnh đường phố Việt Nam thời xưa
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="gallery-slide-2 display-flex jc-betweeen">
                <button class="btn-pre-2 gallery-btn">
                    <i class="fas fa-angle-left fontsize-28"></i>
                </button>
                <div class="gallery-slide-box">
                    <div class="gallery gallery-color active-one">
                        <div class="box-img">
                            <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/englishforvietnam.jpeg" alt="">
                        </div>
                        <div class="gallery-position">
                            <div class="gallery-nocolor margin-bt">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/891364student-war-protest-1381745147024-1382768321575.jpeg" alt="">
                            </div>
                            <span>
                                Hình ảnh phản đối chiến tranh tại Việt Nam
                            </span>
                        </div>
                    </div>
                    <div class="gallery gallery-color">
                        <div class="box-img">
                            <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/dienbienphu.jpeg" alt="">
                        </div>
                        <div class="gallery-position">
                            <div class="gallery-nocolor margin-bt">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/ttxvn_dienbienphu2.jpeg" alt="">
                            </div>
                            <span>
                                Hình ảnh trận Điện Biên Phủ trên không
                            </span>
                        </div>
                    </div>
                    <div class="gallery gallery-color">
                        <div class="box-img">
                            <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/duongphohanoi.jpeg" alt="">
                        </div>
                        <div class="gallery-position">
                            <div class="gallery-nocolor margin-bt">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/hangngang.jpeg" alt="">
                            </div>
                            <span>
                                Hình ảnh Hà Nội xưa
                            </span>
                        </div>
                    </div>
                    <div class="gallery gallery-color">
                        <div class="box-img">
                            <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/maydongphuc.jpeg" alt="">
                        </div>
                        <div class="gallery-position">
                            <div class="gallery-nocolor margin-bt">
                                <img src="https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/mot-goc-anh-khac-ve-chien-tranh-viet-nam-chup-tu-ben-thang-tran-11-111044.jpeg" alt="">
                            </div>
                            <span>
                                Hình ảnh may quân phục ngày xưa
                            </span>
                        </div>
                    </div>
                </div>
                <button class="btn-next-2 gallery-btn next">
                    <i class="fas fa-angle-right fontsize-28"></i>
                </button>
            </div>
        </div>
        <div class="content-four">
            <div class="container">
                <div class="content-four-item">
                    <div class="faq">
                        <h2 class="fontsize-46">Các câu hỏi thường gặp</h2>
                    </div>
                    <div class="content-four-list">
                        <div class="question-list">
                            <div id="question1" class="question display-flex">
                                <div class="question-icon">
                                    <i id="icon1" class="fas fa-angle-right"></i>
                                </div>
                                <div class="question-text fontsize-22">
                                    Ongbata.vn trông giống như một phép thuật
                                </div>
                            </div>
                            <p id="question-content1" class="question-content">
                                Công nghệ tự động chỉnh màu ảnh và khôi phục màu sắc trong ảnh bị mờ đã được cấp
                                phép độc quyền bởi MyHeritage từ DeOldify,
                                được tạo ra bởi các chuyên gia học sâu Jason Antic và Dana Kelley.
                                Jason và Dana đã phát triển và nâng cao mô hình chỉnh màu trong khoảng thời gian hai
                                năm,
                                và nó vẫn đang được hoàn thiện liên tục. Họ đã phát minh ra một cách tiếp cận ban
                                đầu là tự động chỉnh màu cho các bức ảnh đen trắng
                                bằng cách sử dụng các thuật toán máy học đặc biệt chú ý đến các chi tiết nhỏ - ma
                                quỷ nằm trong các chi tiết và mô hình của họ đóng đinh chúng một cách hoàn hảo.
                                Người mẫu đã được đào tạo bằng cách sử dụng hàng triệu bức ảnh thật và đã phát triển
                                sự hiểu biết về thế giới của chúng ta và màu sắc của nó.
                                Kết quả thực sự là ngoạn mục. Jason và Dana sau đó đã phát triển công nghệ khôi phục
                                màu sắc giúp khôi phục chính xác màu sắc trong các bức ảnh màu bị mờ.
                                Điều này là lý tưởng để làm sống lại những bức ảnh được chụp bằng màu từ những năm
                                1950 đến những năm 1990,
                                được in và lưu trữ trong các album, sau đó bị mờ dần theo năm tháng. Trái ngược với
                                chỉnh màu, sử dụng trí thông minh nhân tạo để đưa ra dự đoán tốt nhất về màu sắc
                                trong ảnh,
                                công nghệ này khôi phục màu sắc chân thực của ảnh và làm sắc nét ảnh trong quá trình
                                này.
                            </p>
                        </div>
                        <div class="question-list">
                            <div id="question2" class="question display-flex">
                                <div class="question-icon">
                                    <i id="icon2" class="fas fa-angle-right"></i>
                                </div>
                                <div class="question-text fontsize-22">
                                    Đây có thực sự là công nghệ tốt nhất trên thế giới để chỉnh màu cho ảnh đen
                                    trắng không
                                </div>
                            </div>
                            <p id="question-content2" class="question-content">
                                Chúng tôi tin như vậy. Đã có những nhóm khác, bao gồm một số công ty lớn nhất, đã cố
                                gắng chỉnh màu cho ảnh đen trắng bằng cách sử dụng học sâu và các phương pháp khác,
                                nhưng không ai đạt được kết quả thực tế như những nhóm này. Mô hình đầu tiên của
                                DeOldify được phát hành vào giữa năm 2018 do Jason và Dana đóng góp cho phạm vi công
                                cộng, nhưng những cải tiến đáng kể do DeOldify thực hiện hiện chỉ có trên MyHeritage
                                và không nơi nào khác.
                            </p>
                        </div>
                        <div class="question-list">
                            <div id="question3" class="question display-flex">
                                <div class="question-icon">
                                    <i id="icon3" class="fas fa-angle-right"></i>
                                </div>
                                <div class="question-text fontsize-22">
                                    Một số ảnh trên Ongbata.vn có được con người tô màu hoặc khôi phục thủ công
                                    không?
                                </div>
                            </div>
                            <p id="question-content3" class="question-content">
                                Không. Tất cả đều diễn ra tự động bằng công nghệ chuyên dụng.
                            </p>
                        </div>
                        <div class="question-list">
                            <div id="question4" class="question display-flex">
                                <div class="question-icon">
                                    <i id="icon4" class="fas fa-angle-right"></i>
                                </div>
                                <div class="question-text fontsize-22">
                                    Làm cách nào để Ongbata.vn quyết định xem ảnh của tôi nên được tô màu hay khôi
                                    phục lại màu sắc của ảnh?
                                </div>
                            </div>
                            <p id="question-content4" class="question-content">
                                Khi bạn tải ảnh lên, chúng tôi áp dụng công nghệ để xác định xem ảnh là đen trắng
                                (hoặc nâu đỏ) hay được chụp bằng màu ban đầu. Nếu ảnh được coi là đen trắng, ảnh sẽ
                                được tô màu, và nếu ảnh ban đầu được chụp bằng màu thì màu sắc của ảnh sẽ được khôi
                                phục. Khôi phục màu sắc là lý tưởng cho các bức ảnh màu cũ hơn được chụp từ những
                                năm 1950 đến 1990, nơi hóa học của các bức ảnh in thường bị ảnh hưởng bởi sự tàn phá
                                của thời gian.
                            </p>
                        </div>
                        <div class="question-list">
                            <div id="question5" class="question display-flex">
                                <div class="question-icon">
                                    <i id="icon5" class="fas fa-angle-right"></i>
                                </div>
                                <div class="question-text fontsize-22">
                                    Màu sắc có chân thực không
                                </div>
                            </div>
                            <p id="question-content5" class="question-content">
                                Trong trường hợp chỉnh màu, màu sắc được tái tạo lại bằng một thuật toán và có thể
                                không chính xác. Hãy coi đây là một mô phỏng công nghệ đưa ra dự đoán tốt nhất về
                                quá khứ trông như thế nào, bằng cách bắc cầu giữa quá khứ và hiện tại. Mô hình đã
                                được huấn luyện bởi hàng triệu bức ảnh mẫu, và kết quả là nó có khả năng tạo ra kết
                                quả rất thực tế. Nhưng có những trường hợp nó không thể biết được màu sắc thực sự là
                                gì
                            </p>
                        </div>
                        <div class="question-list">
                            <div id="question6" class="question display-flex">
                                <div class="question-icon">
                                    <i id="icon6" class="fas fa-angle-right"></i>
                                </div>
                                <div class="question-text fontsize-22">
                                    Tôi đã có nhiều ảnh trên Ongbata.vn. Tôi có thể sử dụng Ongbata.vn In Color ™
                                    trên chúng không?
                                </div>
                            </div>
                            <p id="question-content6" class="question-content">
                                Đúng. Bạn có thể sử dụng Ongbata.vn In Color ™ trên bất kỳ ảnh nào đã có trên
                                Ongbata.vn bằng cách chọn "Ảnh của tôi" từ tab Cây gia đình và nhấp vào bất kỳ ảnh
                                nào. Bạn cũng có thể tải ảnh mới lên Ongbata.vn và tô màu chúng hoặc khôi phục màu
                                của chúng trên
                            </p>
                        </div>
                        <div class="question-list">
                            <div id="question7" class="question display-flex">
                                <div class="question-icon">
                                    <i id="icon7" class="fas fa-angle-right"></i>
                                </div>
                                <div class="question-text fontsize-22">
                                    Trước đây tôi đã tô màu cho một bức ảnh ban đầu được chụp bằng màu. Tôi có thể
                                    khôi phục lại màu sắc của nó không?
                                </div>
                            </div>
                            <p id="question-content7" class="question-content">
                                Có, có hai cách để làm điều đó. Bạn chỉ cần tải ảnh lên một lần nữa bằng cách sử
                                dụng trang này và nếu ảnh ban đầu được chụp bằng màu, màu của ảnh sẽ được khôi phục.
                                Ngoài ra, bạn có thể truy cập phần Ảnh của tôi trên trang web gia đình của mình, tìm
                                ảnh trong thư viện ảnh của bạn và nhấp vào ảnh đó. Bạn sẽ cần xóa phiên bản đã tô
                                màu của ảnh bằng cách nhấp vào biểu tượng thùng rác và chọn “Ảnh đã tô màu” (hoặc
                                “Ảnh có màu nâng cao” nếu ảnh cũng đã được sửa). Sau khi tải lại trang, nút "Khôi
                                phục màu" sẽ xuất hiện.
                            </p>
                        </div>
                        <div class="question-list">
                            <div id="question8" class="question display-flex">
                                <div class="question-icon">
                                    <i id="icon8" class="fas fa-angle-right"></i>
                                </div>
                                <div class="question-text fontsize-22">
                                    Tôi cũng có thể sử dụng Ongbata.vn In Color ™ trên ảnh cũ có màu nâu đỏ hoặc hơi
                                    vàng không?
                                </div>
                            </div>
                            <p id="question-content8" class="question-content">
                                Đúng. Các thuật toán hoạt động trên tất cả các ảnh và xác định xem ảnh gốc là ảnh
                                đen trắng hay được chụp bằng màu và chỉnh màu hoặc khôi phục màu sắc cho phù hợp.
                            </p>
                        </div>
                        <div class="question-list">
                            <div id="question9" class="question display-flex">
                                <div class="question-icon">
                                    <i id="icon9" class="fas fa-angle-right"></i>
                                </div>
                                <div class="question-text fontsize-22">
                                    Chi phí sử dụng Ongbata.vn In Color ™ là bao nhiêu?
                                </div>
                            </div>
                            <p id="question-content9" class="question-content">
                                Người dùng có gói Hoàn chỉnh với Ongbata.vn có thể chỉnh màu hoặc khôi phục màu
                                trong số lượng ảnh không giới hạn. Những người dùng khác có thể chỉnh màu cho tối đa
                                10 ảnh và khôi phục màu trong tối đa 10 ảnh miễn phí và hơn thế nữa, họ sẽ cần đăng
                                ký để sử dụng nhiều hơn. Những người không đăng ký sẽ nhận thấy hình mờ của biểu
                                trưng Ongbata.vn ở dưới cùng bên phải ảnh của họ, trong khi những người đăng ký Hoàn
                                chỉnh sẽ có thể tạo ra những bức ảnh đã được chỉnh màu và phục hồi màu không có
                                logo.
                            </p>
                        </div>
                        <div class="question-list">
                            <div id="question10" class="question display-flex">
                                <div class="question-icon">
                                    <i id="icon10" class="fas fa-angle-right"></i>
                                </div>
                                <div class="question-text fontsize-22">
                                    Tôi nhận thấy rằng đôi khi một bức ảnh được tô màu có thể có những vùng nhỏ mà
                                    màu sắc có vẻ lệch lạc hoặc không nhất quán. Điều gì gây ra điều này?
                                </div>
                            </div>
                            <p id="question-content10" class="question-content">
                                Các thuật toán chỉnh màu đôi khi tạo ra kết quả không hoàn hảo, chẳng hạn như một
                                vùng da có màu giống quần áo hoặc quần áo có màu không nhất quán. Bạn có thể khắc
                                phục hầu hết các điểm không hoàn hảo bằng cách điều chỉnh cài đặt chỉnh màu cho đến
                                khi đạt được kết quả mong muốn.
                            </p>
                        </div>
                        <div class="question-list">
                            <div id="question11" class="question display-flex">
                                <div class="question-icon">
                                    <i id="icon11" class="fas fa-angle-right"></i>
                                </div>
                                <div class="question-text fontsize-22">
                                    Tại sao các bức ảnh được tô màu có biểu tượng bảng màu ở góc dưới cùng bên trái?
                                </div>
                            </div>
                            <p id="question-content11" class="question-content">
                                Chúng tôi phân biệt các bức ảnh được tô màu với những bức ảnh được chụp bằng màu ban
                                đầu bằng cách sử dụng một biểu tượng bảng màu nổi đặc biệt ở góc dưới bên trái của
                                các bức ảnh được tô màu. Mặc dù ảnh có màu sắc trung thực cao nhưng có màu sắc được
                                mô phỏng bằng các thuật toán tự động và những màu này có thể không giống với màu
                                thực của ảnh gốc. Biểu tượng bảng màu xuất hiện trên tất cả các bức ảnh được tô màu
                                để người dùng có thể phân biệt chúng với những bức ảnh có màu thực. Chúng tôi hy
                                vọng rằng cách làm có trách nhiệm này sẽ được những người khác sử dụng công nghệ màu
                                ảnh áp dụng. Ảnh đã qua phục hồi màu sẽ không có biểu tượng vì những màu đó là màu
                                chân thực.
                            </p>
                        </div>
                        <div class="question-list">
                            <div id="question12" class="question display-flex">
                                <div class="question-icon">
                                    <i id="icon12" class="fas fa-angle-right"></i>
                                </div>
                                <div class="question-text fontsize-22">
                                    Tôi có thể tô màu các video gia đình cũ mà tôi sở hữu, chẳng hạn như những video
                                    được quay bằng phim 8 mm không?
                                </div>
                            </div>
                            <p id="question-content12" class="question-content">
                                Không phải ngay bây giờ, nhưng làm như vậy là khả thi với cùng một công nghệ và
                                chúng tôi đang xem xét bổ sung hỗ trợ chỉnh màu video trong tương lai nếu người dùng
                                có đủ nhu cầu về nó. Vui lòng cho chúng tôi biết nếu bạn quan tâm đến việc chỉnh màu
                                hoặc khôi phục màu sắc cho các bộ phim mà bạn sở hữu.
                            </p>
                        </div>
                        <div class="question-list">
                            <div id="question13" class="question display-flex">
                                <div class="question-icon">
                                    <i id="icon13" class="fas fa-angle-right"></i>
                                </div>
                                <div class="question-text fontsize-22">
                                    Tôi nhận thấy rằng đôi khi một bức ảnh được tô màu có thể có những vùng nhỏ mà
                                    màu sắc có vẻ lệch lạc hoặc không nhất quán. Điều gì gây ra điều này?
                                </div>
                            </div>
                            <p id="question-content13" class="question-content">
                                Các thuật toán chỉnh màu đôi khi tạo ra kết quả không hoàn hảo, chẳng hạn như một
                                vùng da có màu giống quần áo hoặc quần áo có màu không nhất quán. Bạn có thể khắc
                                phục hầu hết các điểm không hoàn hảo bằng cách điều chỉnh cài đặt chỉnh màu cho đến
                                khi đạt được kết quả mong muốn.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->

</div>
<?php include __DIR__ . '/footer.php'; ?>