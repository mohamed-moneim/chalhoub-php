<?php
require('./I18N/Arabic.php'); 
require("./conn.php");
$Arabic = new I18N_Arabic('Glyphs');

// Ensure database connection
if (!isset($conn)) {
    die("Database connection error.");
}

if (isset($_POST['empcode'])) {
    $empCode = $_POST['empcode'];
    $lang = $_POST['lang'];

    // Secure database query
    $stmt = $conn->prepare("SELECT * FROM employees WHERE employee_code = ?");
    $stmt->bind_param("s", $empCode);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_row();

    if (!$row) {
        die("Employee not found.");
    }

    // Choose the correct image
    $imageFile = ($lang == "en") ? 'cert-en.jpg' : 'cert-ar.jpg';

    if (!file_exists($imageFile)) {
        die("Certificate template missing.");
    }

    // Load image
    $image = imagecreatefromjpeg($imageFile);
    if (!$image) {
        die("Failed to load certificate image.");
    }

    // Define text color (RGB)
    $textColor = imagecolorallocate($image, 14, 29, 69);

    // Set font path
    $fontPath = __DIR__ . '/arial.ttf';
    if (!file_exists($fontPath)) {
        die("Font file missing.");
    }

    // Get text based on language
    if ($lang == "en") {
        $text = $row[1]; // Assuming English name
        $fontSize = 50;
        $x = 900;
        $y = 1250;
        
    // Debugging: Check text output

    // Try shifting text position for debugging
    $testText = "Test";
    imagettftext($image, 30, 0, 100, 100, $textColor, $fontPath, $testText);

    // Write main text to image
    $result = imagettftext($image, $fontSize, 0, $x, $y, $textColor, $fontPath, $text);
    if (!$result) {
        die("Failed to write text.");
    }

    // Save image
    $outputFile = $row[1] . '.jpg';
    imagejpeg($image, $outputFile, 100);

    // Free memory
    imagedestroy($image);

    // Redirect
    header("Location: certpage.php?id=" . urlencode($row[1]));
    exit;
    } else {
        $text = $Arabic->utf8Glyphs($row[5]); // Assuming Arabic name
        $fontSize = 60;
        $x = 900;
        $y = 1450;
    // Debugging: Check text output


    $result = imagettftext($image, $fontSize, 0, $x, $y, $textColor, $fontPath, $text);
    if (!$result) {
        die("Failed to write text.");
    }

    // Save image
    $outputFile = $row[5] . '.jpg';
    imagejpeg($image, $outputFile, 100);

    // Free memory
    imagedestroy($image);

    // Redirect
    header("Location: certpage.php?id=" . urlencode($row[5]));
    exit;
    }

}

?>

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
<div class="text-center">

<img src="dist/ramadan.jpg" class="hundred" />
</div>
<form method="post" action="index.php">
<div class="form-group">
    <label class="text-right" for="exampleInputEmail1"> Please Enter your Employee Code / برجاء إدخال الكود الوظيفي</label>
    <input name="empcode" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Employee Code">
  </div>
  <div class="form-group">
  <label class="text-right" for="exampleInputEmail1">اللغة / Language</label>

  <select name="lang" class="form-select col-lg-12" aria-label="Default select example">
  <option selected value="ar">العربية</option>
  <option value="en">English</option>
</select>
</div>
<button type="submit" class="btn btn-primary">أدخل / Enter</button>
</form>
</div>
</div>
</body>
</html>