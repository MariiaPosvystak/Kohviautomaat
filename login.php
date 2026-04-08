<?php
session_start();
require "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $pass = sha1($_POST["password"]);

    $sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION["user"] = $row["username"];
        $_SESSION["role"] = $row["role"];
        header("Location: index.php");
        exit;
    } else {
        $error = "Vale kasutajanimi või parool!";
    }
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
    include("nav.php");
?>
<form method="POST">
    <h2>Logi sisse</h2>
    <input type="text" name="username" placeholder="Kasutajanimi" required>
    <input type="password" name="password" placeholder="Parool" required>
    <button type="submit">Sisene</button>
</form>
<?php
if (isset($error)) echo "<p>$error</p>";
include("footer.php");
?>
</body>
</html>