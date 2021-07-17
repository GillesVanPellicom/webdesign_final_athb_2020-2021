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
if (isset($_POST['submit'])) {
    $id = $_POST['productId'];
    $clientId = $_SESSION['ClientID'];
    $amount = $_POST['amount'];
    $query = "SELECT * FROM cart WHERE ClientId = '$clientId' AND ProductId = '$id'";
    $qresult = $connection->query($query);

    if ($qresult->num_rows != 0) {
        $row = $qresult->fetch_assoc();
        $amount = $amount + $row['Amount'];
        $query = "UPDATE cart SET Amount = '$amount' WHERE ClientId = '$clientId' AND ProductId = '$id'";
        $connection->query($query);
    } else {

        $query = "INSERT INTO cart (ProductId, Amount, ClientId) VALUES ('$id','$amount','$clientId')";
        $connection->query($query);
    }

    echo "<h1 class='text-center' style='margin-top: 3%'>";
    if ($langId == 1) {
        echo "Uw product is toegevoegd aan uw winkelwagen.";
    } else if ($langId == 2) {
        echo "Your product has been added to your cart.";
    } else if ($langId == 3) {
        echo "Votre produit a été ajouté à votre panier.";
    }
    echo "</h1>
<div class='text-center' style='margin-top: 1%'>
<form action='/shop/' class='inline'>
    <button class='submit-button button' >";
    if ($langId == 1) {
        echo "Verderwinkelen";
    } else if ($langId == 2) {
        echo "Continue shopping";
    } else if ($langId == 3) {
        echo "continuer les achats";
    }
    echo "</button>
</form>
</div>
<div class='text-center'  style='margin-top: 1%'>
<form action='/shop/cart/' class='inline'>
    <button class='submit-button button' >";
    if ($langId == 1) {
        echo "Naar winkelwagen";
    } else if ($langId == 2) {
        echo "Go to cart";
    } else if ($langId == 3) {
        echo "Aller au panier";
    }
    echo "</button>
</form></div>";
} else {
    //TODO "page deos not exist"
    header("Location: ");
}
?>
</body>
</html>