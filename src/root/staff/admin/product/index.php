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
    <title>Admin - Products Overview</title>
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
<div id="container">
    <h1>Edit product</h1>
    <a href="create.php"><u>Add product - Click</u></a><br><br>
    <a href="uploadimage.php"><u>Add image - Click</u></a><br><br>
    <table border="0">
        <tr>
            <td><strong>Brand</strong></td>
            <td><strong>Name</strong></td>
            <td><strong>Price</strong></td>
            <td><strong>Stock #</strong></td>
            <td><strong>Visible</strong></td>
        </tr>
        <?php
        $query = "SELECT product.*, brand.BrandName
    FROM product
         INNER JOIN brand
                    ON product.BrandId = brand.BrandId";
        $qresult = $connection->query($query);

        while ($row = $qresult->fetch_assoc()) {
            if ($row['ProductIsVisible'] == 1) {
                $visible = "yes";
            } else {
                $visible = "no";

            }
            echo "<tr>
<td>" . $row['BrandName'] . "</td>
<td>" . $row['ProductName'] . "</td>
<td>€ " . $row['ProductCurrentPrice'] . "</td>
<td>" . $row['ProductStock'] . "</td>
<td>" . $visible . "</td>
<td><a href='edit.php?i=" . $row['ProductId'] . "'>✏️</a></td>
</tr>";
        }
        ?>
    </table>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/footer/main.html";
$connection->close();
?>
</body>
</html>