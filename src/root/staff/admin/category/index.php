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
    <title>Admin - Edit category</title>
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
if (isset($_GET['r'])) {
    $delid = $_GET['r'];
    $query = "SELECT * FROM subcategory WHERE subCategoryId = '$delid'";
    $qresult = $connection->query($query);

    if ($qresult->num_rows > 0) {
        $query = "DELETE FROM subcategory WHERE subCategoryId = '$delid'";
        $connection->query($query);
    }
}
?>
<div id="container">
<form method="POST" action="">
    <h1>Edit category</h1>
    Category name: <br>
    <label for="name"></label><input type="text" id="name" name="name"> <br><br>
    <input type="submit" value="Add" name="add" id="add"><br><br>
</form>

<?php
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $query = "INSERT INTO subcategory (SubCategoryName, SubCategoryDesc, CategoryId) VALUES ('$name', 'placeholder', 2)";
    $connection->query($query);
}
?>

<form action="">
    <table>
        <?php
        $query = "SELECT * FROM subcategory ORDER BY subCategoryName";
        $qresult = $connection->query($query);
        while ($row = $qresult->fetch_assoc()) {
            $temp = $row['SubCategoryName'];
            $brandId = $row['SubCategoryId'];
            echo "<tr>
                <td>
                ".$temp."
                </td>
                <td>
                
                    <a href='index.php?r=".$brandId."'>❌</a>
                </td>
              </tr>";
        }
        ?>
    </table>
</form>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/footer/main.html";
$connection->close();
?>
</body>
</html>