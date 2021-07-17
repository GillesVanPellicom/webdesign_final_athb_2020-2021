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
    <title><?php
        if ($langId == 1) {
            echo "Bestelling";
        } else if ($langId == 2) {
            echo "Order";
        } else if ($langId == 3) {
            echo "Commande";
        } ?></title>
    <link rel="stylesheet" type="text/css" href="/include/default.css">
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/nav/nav.php";

if (isset($_POST['submit'])) {
if (isset($_GET['i'])) {
    $ClientID = $_GET['i'];
    $query = "SELECT * FROM cart WHERE ClientId = '$ClientID'";
    $qresult = $connection->query($query);

    while ($row = $qresult->fetch_assoc()) {
        $productId = $row['ProductId'];
        $amount = $row['Amount'];

        $query = "SELECT ProductStock FROM product WHERE ProductId = '$productId'";
        $stock = $connection->query($query)->fetch_assoc()['ProductStock'];
        $newStock = $stock-$amount;

        $query = "UPDATE product SET ProductStock = '$newStock' WHERE ProductId = '$productId'";
        $connection->query($query);

    }
}
}

?>
<div id='container'>
<h1 class="text-center"><?php
    if ($langId == 1) {
        echo "Uw bestelling is verwerkt.";
    } else if ($langId == 2) {
        echo "Your order has been processed.";
    } else if ($langId == 3) {
        echo "Votre commande est traitée.";
    } ?></h1>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/footer/main.html";
$connection->close();
?>

</body>
</html>