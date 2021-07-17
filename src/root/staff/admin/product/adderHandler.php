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
        <title>Working...</title>
        <?php
        if ($_SESSION['ClientIsStaff'] == 0) {
            header("Location: /resources/error/404.html");
        }
        ?>
    </head>
    <body>
    <?php

    if (isset($_POST['ProductApply'])) {
        $name = "";
        $brandId = "";
        $price = "";
        $descEn = "";
        $descFr = "";
        $descNl = "";
        $image = "";
        $sku = "";
        $upc = "";
        $subCatId = "";

        if (empty($_POST['ProductName'])) {
            $name = "Unnamed Product";
        } else {
            $name = sanitizeString($_POST['ProductName']);
        }

        $brandId = sanitizeString($_POST['Brand']);
        $subCatId = sanitizeString($_POST['Category']);

        if (empty($_POST['Price'])) {
            $price = "12";
        } else {
            $price = sanitizeString($_POST['Price']);
        }

        if (empty($_POST['DescEn'])) {
            $descEn = "Placeholder";
        } else {
            $descEn = $connection->real_escape_string(sanitizeString($_POST['DescEn']));
        }

        if (empty($_POST['DescFr'])) {
            $descFr = "Placeholder";
        } else {
            $descFr = $connection->real_escape_string(sanitizeString($_POST['DescFr']));
        }

        if (empty($_POST['DescNl'])) {
            $descNl = "Placeholder";
        } else {
            $descNl = $connection->real_escape_string(sanitizeString($_POST['DescNl']));
        }
        if (empty($_POST['stock'])) {
            $stock = 0;
        } else {
            $stock = sanitizeString($_POST['stock']);
        }
        if (empty($_POST['image'])) {
            $image = "default.jpg";
        } else {
            $image = sanitizeString($_POST['image']);
        }

        if (empty($_POST['sku'])) {
            $sku = false;
        } else {
            $sku = sanitizeString($_POST['sku']);
        }

        if (empty($_POST['upc'])) {
            $upc = false;
        } else {
            $upc = sanitizeString($_POST['upc']);
        }
        if (isset($_POST['visible'])) {
            $visible = "1";
        } else {
            $visible = "0";
        }


        $query = "INSERT INTO product (
                     ProductName, BrandId, ProductCurrentPrice, SubCategoryId, ProductIsVisible, ProductStock, ProductImg) 
                     VALUES (
                             '$name','$brandId','$price','$subCatId', '$visible', '$stock', '$image'
                     )";
        $qresult = $connection->query($query);


        $query = "SELECT LAST_INSERT_ID() FROM product";
        $qresult = $connection->query($query);
        $row = $qresult->fetch_assoc();
        $id = $row['LAST_INSERT_ID()'];

        if ($upc) {
            $query = "UPDATE product SET ProductUpc = '$upc' WHERE ProductId = '$id'";
            $connection->query($query);
        }
        if ($sku) {
            $query = "UPDATE product SET ProductSku = '$sku' WHERE ProductId = '$id'";
            $connection->query($query);
        }

        $query = "INSERT INTO productdescr (ProductId, LanguageId, ProductDescription) VALUES ('$id','1','$descNl')";
        if (!$connection->query($query)) {
            echo $connection->error;
        }
        $query = "INSERT INTO productdescr (ProductId, LanguageId, ProductDescription) VALUES ('$id','2','$descEn')";
        if (!$connection->query($query)) {
            echo $connection->error;
        }
        $query = "INSERT INTO productdescr (ProductId, LanguageId, ProductDescription) VALUES ('$id','3','$descFr')";
        if (!$connection->query($query)) {
            echo $connection->error;
        }


        header("Location:index.php?i=" . $id);

    }

    ?>

    </body>
    </html>

<?php
$connection->close();
?>