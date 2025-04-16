
<!DOCTYPE html>
<html>
<head>
<title>Shalhoub Group</title>
<link rel="stylesheet" href="dist/bootstrap.min.css">
<link rel="stylesheet" href="dist/style.css">
</head>
<body>
    <div class="row">
<div class="col-lg-8 col-md-12 col-sm-12 cntr">
    <div class="text-center">
    <img src="dist/shalhoub.png" class="logo" />
</div>
<div class="text-center col-lg-8 col-md-12 cntr">
<?php
if(isset($_GET['id'])){
    ?>
    <h1><?= $_GET['id']; ?> Thank you / شكراً  </h1>

    <img class="cert" src="<?= $_GET['id'].".jpg"; ?>" />
    <a style="display:block" class="btn btn-primary" href="<?= $_GET['id'].".jpg"; ?>">Download / تنزيل</a>
    <h4>Created by <a href="www.skysofteg.com">Sky Soft</a> &copy; </h4>

    <?php
}

?>

</div>

</div>
<div class="text-center col-lg-8 col-md-12 cntr">


</div>
</div>

</body>
</html>