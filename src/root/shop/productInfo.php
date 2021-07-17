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
    <?php
    $id = $_GET['i'];

    $query = "
    SELECT product.*, brand.BrandName
    FROM product
         INNER JOIN brand
                    ON product.BrandId = brand.BrandId
    WHERE ProductId = '$id'";

    $qresult = $connection->query($query)->fetch_assoc();
    ?>

    <title>
        <?php
        echo $qresult['BrandName'] . " " . $qresult['ProductName'];
        ?>
    </title>
    <link rel="stylesheet" type="text/css" href="/include/default.css">
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/nav/nav.php";
?>
<div id="container">
    <div class="singelproductdiv text-center">
        <h1><?= $qresult['BrandName'] . " " . $qresult['ProductName'] ?></h1>


        <?php
        echo "<img class='detailpicture' src='/resources/images/" . $qresult['ProductImg'] . "'><h3>";
        if ($langId == 1) {
            echo "Prijs: ";
        } else if ($langId == 2) {
            echo "Price: ";
        } else if ($langId == 3) {
            echo "Prix: ";
        }
        echo "€ " . $qresult['ProductCurrentPrice'] ?> </h3>
        <form method='POST' action="productAdder.php">
            <?php
            $query = "
    SELECT * 
    FROM productdescr 
    WHERE LanguageId = '$langId' AND ProductId = '$id'";
            $qresult = $connection->query($query)->fetch_assoc();
            if (isset($_SESSION['ClientID'])) {
                $desc = $qresult['ProductDescription'];
                $query = "SELECT ProductStock FROM product WHERE ProductId = '$id'";
                $qresult = $connection->query($query);
                $row = $qresult->fetch_assoc();
                $amount = $row['ProductStock'];

                if ($amount <= 0) {
                    if ($langId == 1) {
                        echo "<br><div class='error'>Dit product is op het moment niet op voorraad.</div>";
                    } else if ($langId == 2) {
                        echo "<br><div class='error'>This product is currently out of stock.</div>";
                    } else if ($langId == 3) {
                        echo "<br><div class='error'>Ce produit est actuellement en rupture de stock.</div>";
                    }
                } else {
                    echo "
<br><br>
<select name='amount' id='amount' class='productamount-input'>";


                    for ($i = 1; $i < $amount + 1; $i++) {
                        echo "<option value='" . $i . "'>" . $i . "</option>";
                    }

                    if ($langId == 1) {
                        $temp = "Toevoegen";
                    } else if ($langId == 2) {
                        $temp = "Add";
                    } else if ($langId == 3) {
                        $temp = "Ajoutez";
                    }

                    echo "</select>
<input type='text' value='" . $id . "' name='productId' id='productId' style='display: none;'>
<input type='submit' value='" . $temp . "' name='submit' id='submit' class='button'>";
                }


            } else {
                echo "<br><br>";
                if ($langId == 1) {
                    echo "U moet ingelogd zijn voor u dit kan toevoegen.";
                } else if ($langId == 2) {
                    echo "You must be logged in to add this to the shopping cart.";
                } else if ($langId == 3) {
                    echo "Vous devez être connecté avant de pouvoir l'ajouter.";
                }
            }
            ?>

        </form>
        <br>
        <?php
        echo "<p class='producttext text-center'>" . $desc . "</p>";
        ?>
    </div>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/footer/main.html";
$connection->close();
?>
</body>
</html>