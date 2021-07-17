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
            echo "Winkelwagen";
        } else if ($langId == 2) {
            echo "Shoppingcart";
        } else if ($langId == 3) {
            echo "Panier d'achat";
        } ?></title>
    <link rel="stylesheet" type="text/css" href="/include/default.css">
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/nav/nav.php";
echo "<div id='container'>";
if (isset($_SESSION['ClientID'])) {
    $ClientId = $_SESSION['ClientID'];
    $query = "SELECT
    cart.ProductId,
    cart.Amount,
    cart.ClientId,
    product.ProductId,
    product.ProductName,
    product.BrandId,
    product.ProductCurrentPrice,
    product.ProductIsVisible,
    brand.BrandId,
    brand.BrandName
FROM cart
         INNER JOIN product
                    ON cart.ProductId = product.ProductId
         INNER JOIN brand
                    ON product.BrandId = brand.BrandId WHERE ClientId = '$ClientId'";
    $qresult = $connection->query($query);
    if ($qresult->num_rows <= 0) {
        echo "<h1 class='text-center' style='margin-top: 3%'>";
        if ($langId == 1) {
            echo "Er zit niets in uw winkelwagen.";
        } else if ($langId == 2) {
            echo "Your cart seems to be empty.";
        } else if ($langId == 3) {
            echo "Il n'y a rien dans votre panier.";
        }
        echo "</h1>
<form action='/shop/' class='inline'>
<div class='text-center' style='margin-top: 1%'>
<button class='submit-button button' >

    ";
        if ($langId == 1) {
            echo "Verderwinkelen";
        } else if ($langId == 2) {
            echo "Continue shopping";
        } else if ($langId == 3) {
            echo "continuer les achats";
        }
        echo "</button></div>
</form>";


    } else {
        echo "<div class='text-center formdiv'><table border='0' class='text-center' style='width: 100%'>
    <tr>
        <td><strong>Product</strong></td>
        <td><strong>#</strong></td>
        <td><strong>Price/u</strong></td>
        <td><strong>Price</strong></td>
    </tr>
    <?php
    $total = 0;";
        while ($row = $qresult->fetch_assoc()) {
            $total += $row['ProductCurrentPrice'] * $row['Amount'];
            echo "
        <tr>
            <td>" . $row['BrandName'] . " " . $row['ProductName'] . "</td>
            <td>" . $row['Amount'] . "</td>
            <td>€ " . $row['ProductCurrentPrice'] . "</td>
            <td>€ " . $row['ProductCurrentPrice'] * $row['Amount'] . "</td>
            <td><a href='editItem.php?i=" . $row['ProductId'] . "'>✏️</a></td>
            <td><a href='removeItem.php?i=" . $row['ProductId'] . "'>❌</a></td>
        </tr>
        ";
        }

        $btw = ($total / 100) * 21;

        echo "
<tr><td>.</td></tr>
<tr>
    <td colspan='3'><strong>
    ";
        if ($langId == 1) {
            echo "Subtotaal:";
        } else if ($langId == 2) {
            echo "Subtotal:";
        } else if ($langId == 3) {
            echo "Sous-total:";
        }
        echo "</strong></td>
    <td colspan='3'><strong>€ " . $total . "</strong></td>
</tr>
<tr>
    <td colspan='3'><strong>";
        if ($langId == 1) {
            echo "BTW (21%):";
        } else if ($langId == 2) {
            echo "Tax (21%):";
        } else if ($langId == 3) {
            echo "Impôt (21%):";
        }
        echo "</strong></td>
    <td colspan='3'><strong>€
            " . $btw . "
        </strong></td>
</tr>
<tr>
    <td colspan='3'><strong>";
        if ($langId == 1) {
            echo "Totaal:";
        } else if ($langId == 2) {
            echo "Total:";
        } else if ($langId == 3) {
            echo "Total:";
        }
        echo "</strong></td>
    <td colspan='3'><strong>€ " . ($total + $btw) . "</strong></td>
</tr>
</table>";
        if ($langId == 1) {
            $temp = "Bestellen";
        } else if ($langId == 2) {
            $temp = "Order";
        } else if ($langId == 3) {
            $temp = "Commander";
        }
        echo "
<form method='post' action='order.php?i=".$ClientId."'>
<input type='submit' value='" . $temp . "' class='button' name='submit' id='submit' style='margin-top: 4%'>
</form></div>
";
    }
} else {
    echo "<h1 class='text-center' style='margin-top: 3%'>";
    if ($langId == 1) {
        echo "U moet ingelogd zijn om een winkelwagen te gebruiken.";
    } else if ($langId == 2) {
        echo "You need to be logged in to use the shoppig cart.";
    } else if ($langId == 3) {
        echo "Vous devez être connecté pour utiliser le panier shoppig.";
    }
    echo "</h1>
<form action='/login/' class='inline'>
<div class='text-center' style='margin-top: 1%'>
<button class='submit-button button' >

    ";
    if ($langId == 1) {
        echo "Inloggen";
    } else if ($langId == 2) {
        echo "Log in";
    } else if ($langId == 3) {
        echo "Connectez-vous";
    }
    echo "</button></div>
</form>";
}

echo "</div>";
include $_SERVER['DOCUMENT_ROOT'] . "/include/footer/main.html";
$connection->close();
?>

</body>
</html>