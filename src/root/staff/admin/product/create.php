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
        <title>Admin - Add product</title>
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
    ?>
    <h1>Add product</h1>

    <form method="POST" action="adderHandler.php">

        <label for="ProductName">Name</label><br>
        <input type="text" name="ProductName"
               id="ProductName"><br><br>


        <label for="Brand">Brand</label><br>
        <select name="Brand" id="Brand">
            <?php
            $query = "select * FROM brand ORDER BY BrandName";
            $qresult = $connection->query($query);
            while ($row = $qresult->fetch_assoc()) {
                echo "<option value='" . $row['BrandId'] . "'>" . $row['BrandName'] . "</option>";
            }
            ?>
        </select><br><br>

        <label for="Category">Category</label><br>
        <select name="Category" id="Category">
            <?php
            $query = "select * FROM subcategory ORDER BY SubCategoryName";
            $qresult = $connection->query($query);
            while ($row = $qresult->fetch_assoc()) {
                echo "<option value='" . $row['SubCategoryId'] . "'>" . $row['SubCategoryName'] . "</option>";
            }
            ?>
        </select><br><br>


        <label for="Price">Price in € (##.##)</label> <br>
        <input value="0" type="number" name="Price" id="Price" min="0" step="0.01"> <br><br>

        <label for="stock">Stock amount</label> <br>
        <input type="number" name="stock" id="stock" min="0" step="1"> <br><br>

        <!--    <label for="file">Product image</label><br>-->
        <!--    <input type="file" name="file" id="file"><br><br>-->

        <label for="DescNl">Description (Dutch)</label><br>
        <textarea name="DescNl" id="DescNl" cols="30" rows="10"></textarea> <br><br>

        <label for="DescEn">Description (English)</label><br>
        <textarea name="DescEn" id="DescEn" cols="30" rows="10"></textarea> <br><br>

        <label for="DescFr">Description (French)</label><br>
        <textarea name="DescFr" id="DescFr" cols="30" rows="10"></textarea> <br><br>

        <label for="sku">Imagename (With extention e.g. .jpg .png)</label><br>
        <input type="text" name="image" id="image"> <br><br>

        <label for="sku">Stock Keeping Unit [SKU] (Optional)</label><br>
        <input type="text" name="sku" id="sku"> <br><br>


        <label for="upc">Universal Product Code [UPC] (Optional)</label><br>
        <input type="number" name="upc" id="upc"><br><br>


        <label for="visible">Product Is Visible?</label><BR>
        <input type="checkbox" name="visible" id="visible"><br><br>

        <input type="submit" value="Apply" id="ProductApply" name="ProductApply">
    </form>

    <?php
    //if (isset($_POST['ProductApply'])) {
    //    //Image handler
    //    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "resources/images/product";
    //    $target_dir = $target_dir . basename($_FILES["uploadFile"]["name"]);
    //    $uploadOk = 1;
    //
    //
    //    if ($_FILES['file']['uploadFile'] === UPLOAD_ERR_OK) {
    //        $check = getimagesize($_FILES["file"]["tmp_name"]);
    //        if ($check !== false) {
    //            echo "File is an image - " . $check["mime"] . ".";
    //            $uploadOk = 1;
    //        } else {
    //            echo "File is not an image.";
    //            $uploadOk = 0;
    //        }
    //
    //
    //// Allow certain file formats
    //        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    //            && $imageFileType != "gif") {
    //            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //            $uploadOk = 0;
    //        }
    //
    //// Check if $uploadOk is set to 0 by an error
    //        if ($uploadOk == 0) {
    //            echo "Sorry, your file was not uploaded.";
    //// if everything is ok, try to upload file
    //        } else {
    //            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    //                echo "The file " . sanitizeString(basename($_FILES["file"]["name"])) . " has been uploaded.";
    //            } else {
    //                echo "Sorry, there was an error uploading your file.";
    //            }
    //        }
    //    }
    //}
    //?>

    </body>
    </html>
<?php
$connection->close();
?>