<?php
session_start();
// $pass_in = $_POST[''];
// See the password_hash() example to see where this came from.
$key =$_GET['pass']; 
$hash = password_hash($key, PASSWORD_DEFAULT);

if (password_verify('rasmuslerdorf', $hash)) {
    echo 'Password is valid!';
    $pass = 'vao';
} else {
    $pass = '';
    header('Location: index');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="url_get" content="<?php echo $_SERVER['HTTP_HOST'] ?>">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- fire base -->
    <script src="https://www.gstatic.com/firebasejs/6.2.4/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.2.4/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.2.4/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/ui/5.0.0/firebase-ui-auth__vi.js"></script>
    <div id="config_firebase" apiKey="AIzaSyCmHUUC8v1wmj-PY2mLDwgBPwyfD2N04cQ"
        authDomain ="optongbata.firebaseapp.com"
        projectId="optongbata"
        storageBucket="optongbata.appspot.com"
        messagingSenderId="430716822997"
        appId="1:430716822997:web:198d69c42cbae4dee4495c"
        measurementId="G-00MNN2VM99"
    ></div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
    #list_choosed_mem {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .delete_mem {
        cursor: pointer;
    }
    </style>
</head>

<body>
    <?php if ($pass =='vao'): ?>
    <div class="container">
        <h4 class="text-center">Test notification</h4>
        <center class="text-success message_status" style="display:none"></center>
        <div class="choose_mem">
            <ul class=" d-flex text-white " id="list_choosed_mem">
            </ul>
            <input list="select_data" id="choose_data" required class="form-control" placeholder="Chọn người nhận">
            <datalist id="select_data">
            </datalist>

            <form id="send_message" class="m-2">
                <input class="form-control mb-1" type="text" name="title" placeholder="Nhập tiêu đề" required>
                <textarea class="form-control mb-1" name="body" id="" placeholder="Nhập nội dung" required></textarea>
                <input class="form-control mb-1" type="link" name="link_img" placeholder="Dán link ảnh" required>
                <input class="form-control mb-1" type="link" name="click_action" placeholder="Đường dẫn trang" required>
                <input type="hidden" name="pg" value="test_notification">

                <button class="btn btn-primary"  id="send" type="submit">Gửi</button>
            </form>
        </div>

    </div>
     <?php else: ?>
        <?php header('Location: https://giapha.ongbata.vn') ?>
    <?php endif ?>
    <script src="./js/firebase.js"></script>
</body>


</html>