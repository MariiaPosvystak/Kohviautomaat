<nav>
    <ul>
        <li><a href="index.php">Avaleht</a></li>

        <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin"): ?>
            <li><a href="admin.php">Admin</a></li>
        <?php endif; ?>

        <?php if (isset($_SESSION["user"])): ?>
            <li><a href="logout.php">Logi välja</a></li>
        <?php else: ?>
            <li><a href="login.php">Logi sisse</a></li>
        <?php endif; ?>
    </ul>
</nav>