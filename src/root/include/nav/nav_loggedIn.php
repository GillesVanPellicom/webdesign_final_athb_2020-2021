<link rel="stylesheet" type="text/css" href="/include/nav/navStyle.css">
<div class="topnav" id="topnav">
    <a href="/shop/">
        <?php
        if ($langId == 1) {
            echo "Winkel ";
        } else if ($langId == 2) {
            echo "Shop";
        } else if ($langId == 3) {
            echo "Magasin";
        }
        ?>
    </a>
    <a href="/about/">
        <?php
        if ($langId == 1) {
            echo "Over ons";
        } else if ($langId == 2) {
            echo "About us";
        } else if ($langId == 3) {
            echo "De nous";
        }
        ?>
    </a>
    <a href="/shop/cart/">
        <?php
        if ($langId == 1) {
            echo "Winkelwagen";
        } else if ($langId == 2) {
            echo "Cart";
        } else if ($langId == 3) {
            echo "Panier d'achat";
        }
        ?>
    </a>
    <div class="dropdown">
        <button class="dropbtn"><?= $_SESSION['ClientFirstName']?>
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="/login/logout.php">
                <?php
                if ($langId == 1) {
                    echo "Uitloggen";
                } else if ($langId == 2) {
                    echo "Log out";
                } else if ($langId == 3) {
                    echo "Se déconnecter";
                }
                ?>
            </a>
            <!--<a href="#">
                <?php

                if ($langId == 1) {
                    echo "Bestellingen";
                } else if ($langId == 2) {
                    echo "Orders";
                } else if ($langId == 3) {
                    echo "Commandes";
                }
                ?>
            </a>-->
            <?php
            if ($_SESSION["ClientIsStaff"] == 1) {
                echo "<a href='/staff/admin'>Admin</a>";
            }
            ?>
        </div>
    </div>
    <a href="javascript:void(0);" class="icon" onclick="dropbtn()">&#9776;</a>
</div>

    <script src="/include/nav/dropdown.js"></script>
</div>
