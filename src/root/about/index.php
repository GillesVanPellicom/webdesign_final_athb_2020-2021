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
            echo "Over ons";
        } else if ($langId == 2) {
            echo "About us";
        } else if ($langId == 3) {
            echo "De nous";
        }
        ?></title>
    <link rel="stylesheet" type="text/css" href="/include/default.css">

</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/nav/nav.php";
?>
<div id="container" class="text-center">
    <?php
    if ($langId == 1) {
        echo "<h1> Superset in een notendop
    </h1>
    <p style='width: 90%' class='text-center'>Bij superset proberen wij iedereen, jong en oud, voor elk budget een goede luisterervaring te bezorgen
    Dit doen wij door een combinatievan de voordeligste leveranciers, software en een diepe kennis over
    geluidsapparatuur.</p>";
    } else if ($langId == 2) {
        echo "<h1> Superset in a nutshell
    </h1>
   <p style='width: 90%;' class='text-center'> At superset we try to give everyone, young and old, a good listening experience for every budget.
    We do this through a combination of the cheapest suppliers, software and a deep knowledge about
    sound equipment.</p>";
    } else if ($langId == 3) {
        echo "<h1>Superset en bref
    </h1>
    <p style='width: 90%' class='text-center'>
    Chez superset, nous essayons de donner à tous, jeunes et moins jeunes, une bonne expérience d'écoute pour tous les budgets.
    Nous y parvenons en combinant les fournisseurs les moins chers, les logiciels et une connaissance approfondie de l'environnement.
    matériel de sonorisation.
</p>";
    }
    ?>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/footer/main.html";
$connection->close();
?>
</body>
</html>