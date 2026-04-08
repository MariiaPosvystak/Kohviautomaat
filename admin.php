<?php
session_start();
require "config.php";

if ($_SESSION["role"] != "admin") {
    header("Location: index.php");
    exit;
}

if (isset($_POST["add"])) {
    $id = $_POST["id"];
    $conn->query("UPDATE drinks SET topsijua = topsijua + topsipakk WHERE id=$id");
}

$drinks = $conn->query("SELECT * FROM drinks");
?>

<!DOCTYPE html> 
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Kohviautomaat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
    include("header.php");
    include("nav.php");
?>
<h1>Admini paneel</h1>

<table>
<tr><th>Jook</th><th>Topsid</th><th>Lisa</th></tr>

<?php while ($row = $drinks->fetch_assoc()): ?>
<tr>
    <td><?= $row["jooginimi"] ?></td>
    <td><?= $row["topsijua"] ?></td>
    <td>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $row["id"] ?>">
            <button name="add">Lisa täitepakend</button>
        </form>
    </td>
</tr>
<?php 
endwhile; 
echo "</table>";
include("footer.php");
?>
</body>
</html>