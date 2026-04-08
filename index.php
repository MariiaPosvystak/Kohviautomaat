<?php
session_start();
require "config.php";

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

$drinks = $conn->query("SELECT * FROM drinks");

// Joogi joomine
if (isset($_GET["drink"])) {
    $id = $_GET["drink"];
    $conn->query("UPDATE drinks SET topsijua = topsijua - 1 WHERE id=$id AND topsijua > 0");
    header("Location: index.php");
    exit;
}
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
    include("nav.php")
?>
<div class="drinks">
<?php while ($row = $drinks->fetch_assoc()): ?>
    <?php if ($row["topsijua"] > 0): ?>
        <div class="drink">
            <h3><?= $row["jooginimi"] ?></h3>
            <p>Topsid: <?= $row["topsijua"] ?></p>
            <a href="?drink=<?= $row["id"] ?>">Joo</a>
        </div>
    <?php endif; ?>
<?php 
endwhile;
echo "</div>";
include("footer.php"); 
?>
</body>
</html>