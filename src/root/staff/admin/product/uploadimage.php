<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/init.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add image</title>
    <link rel="stylesheet" type="text/css" href="/include/default.css">
    <?php
    if ($_SESSION['ClientIsStaff'] == 0) {
        header("Location: /resources/error/404.html");
    }
    ?>
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/nav/nav.php";
if (isset($_POST['uploadBtn'])) {
    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
        // get details of the uploaded file
        $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
        $fileName = $_FILES['uploadedFile']['name'];
        $fileSize = $_FILES['uploadedFile']['size'];
        $fileType = $_FILES['uploadedFile']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));


        // check if file has one of the following extensions
        $allowedfileExtensions = array('jpg', 'png',);

        if (in_array($fileExtension, $allowedfileExtensions)) {
            // directory in which the uploaded file will be moved
            $uploadFileDir = $_SERVER['DOCUMENT_ROOT'] . "/resources/images/";
            $dest_path = $uploadFileDir . $fileName;
            move_uploaded_file($fileTmpPath, $dest_path);

        }
    }
}
?>

<div id="container">
    <h1>Upload image</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" id="file-upload" name="uploadedFile"><br>
        <input type="submit" name="uploadBtn" value="Upload">
    </form>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/footer/main.html";
$connection->close();
?>
</body>
</html>