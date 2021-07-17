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
    <a href="/login/">
        <?php
        if ($langId == 1) {
            echo "Inloggen ";
        } else if ($langId == 2) {
            echo "Log in";
        } else if ($langId == 3) {
            echo "Identifiez-vous";
        }
        ?>
    </a>
    <a href="javascript:void(0);" class="icon" onclick="dropbtn()">&#9776;</a>
</div>
<script src="/include/nav/dropdown.js"></script>