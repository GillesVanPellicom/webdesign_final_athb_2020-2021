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
    <title>
        <?php
        if ($langId == 1) {
            echo "Product bewerken";
        } else if ($langId == 2) {
            echo "Edit product";
        } else if ($langId == 3) {
            echo "Modifier produit";
        } ?>
    </title>
    <link rel="stylesheet" type="text/css" href="/include/default.css">
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/nav/nav.php";

echo "<div id='container'>";
$productId = $_GET['i'];
$clientId = $_SESSION['ClientID'];
$query = "SELECT
    cart.ProductId,
    cart.Amount,
    cart.ClientId,
    product.ProductId,
    product.ProductName,
    product.BrandId,
    brand.BrandId,
    brand.BrandName
FROM cart
         INNER JOIN product
                    ON cart.ProductId = product.ProductId
         INNER JOIN brand
                    ON product.BrandId = brand.BrandId WHERE ClientId = '$clientId' AND cart.ProductId = '$productId'";
$qresult = $connection->query($query);

if ($qresult->num_rows <= 0) {

} else {
    $row = $qresult->fetch_assoc();
    echo "<div class='text-center formdiv'><h1 style='margin-top: 3%'>" . $row['BrandName'] . " " . $row['ProductName'] . "</h1>";

    echo " <form method='POST' class='text-center'>
    <select name='newAmount' id='newAmount' class='form-input'>";
    $amount = $row['Amount'];
    $query = "SELECT ProductStock FROM product WHERE ProductId = '$productId'";
    $qresult = $connection->query($query);
    $row = $qresult->fetch_assoc();
    $maxAmount = $row['ProductStock'];
    for ($i = 0; $i < $maxAmount + 1; $i++) {
        if ($i == $amount) {
            echo "<option value='" . $i . "' selected>" . $i . "</option>";

        } else {
            echo "<option value='" . $i . "'>" . $i . "</option>";

        }
    }

    echo "
<input type='submit' value='ok' name='editsubmit' id='editsubmit' class='button'>
</div>
</select>
</form>
";
}

if (isset($_POST['editsubmit'])) {
    $newAmount = $_POST['newAmount'];

    if ($newAmount == 0) {
        $query = "DELETE FROM cart WHERE WHERE ProductId = '$productId' AND ClientId = '$clientId'";
    } else {
        $query = "UPDATE cart SET Amount = '$newAmount' WHERE ProductId = '$productId' AND ClientId = '$clientId'";

    }
    $connection->query($query);
    header("Location: index.php");
}
echo "</div>";
include $_SERVER['DOCUMENT_ROOT'] . "/include/footer/main.html";
$connection->close();
?>


</body>
</html>