<?php

move_uploaded_file(
    $_FILES['pdf']['tmp_name'],
    // $_SERVER['DOCUMENT_ROOT'].'/./uploads/test.pdf'
    $_SERVER['DOCUMENT_ROOT'].'/Ongbata/demo-ongbata/sourse-code/uploads/test.pdf'
);

echo $_SERVER['DOCUMENT_ROOT'].'/Ongbata/demo-ongbata/sourse-code/uploads/test.pdf';
