<?php
include './configs/config.php';
$select_data = new Getdata;
$up_data = new Updata;
$table_name =  prefix .'members ';
// up data
// up data
if ($_SERVER["REQUEST_METHOD"] == "GET") {
     if (!empty($_GET['family_null'])) {
		find_parent($_GET['family_null'],$db,$select_data,$up_data);
    }
}

//  select data 

$column_get = prefix .'families.name,'. prefix .'members.family,Count(*) as num_not_generation ';
$join = ' JOIN '.prefix.'families on '.prefix.'families.id = '.prefix.'members.family ';
$conditio_get = ' WHERE '.prefix.'members.generation IS NULL GROUP BY '.prefix.'members.family';
$get_data = $select_data->select_join($table_name,$column_get,$join,$conditio_get,$db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Cập nhật đời</title>
</head>
<body>
    <div class="container">
        <h4 class="text-center">Cập nhật các gia phả thiếu đời</h4>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" class="d-flex align-items-center justify-content-center">
            <select name="family_null" class="form-select"  style="width: 90%;">
                <option  selected="true" disabled="disabled">Xem </option>
                <?php foreach ($get_data as $gt):?>
                    <option value="<?= $gt['family'] ?>"><?= $gt['name'] ?> - <?= $gt['num_not_generation'] ?> Thành viên</option>
                <?php endforeach ?>
            </select>
            <button class="btn btn-info btn-sm">Cập nhật</button>
        </form>
    </div>
    
</body>
</html>