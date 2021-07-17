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
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="/include/default.css">
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/nav/nav.php";
$query = "SELECT product.*, brand.BrandName
    FROM product
         INNER JOIN brand
                    ON product.BrandId = brand.BrandId
                    WHERE ProductIsVisible = 1 ORDER BY BrandName";
$qresult = $connection->query($query);
?>
<div id="container">
<?php
while ($row = $qresult->fetch_assoc()) {
    echo "
    <a href='productInfo.php?i=" . $row['ProductId'] . "'><div class='productdiv'>" .
        "<img width='90%' height='90%' src='/resources/images/".$row['ProductImg']."'><h2>".
        $row['BrandName'] . " "
        . $row['ProductName'] . " </h2><br>  <strong>€" . $row['ProductCurrentPrice'] . "</strong> 
</div></a>";
}
?>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/footer/main.html";
$connection->close();
?>
</body>
</html>