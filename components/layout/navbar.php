<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/components/navbar.scss">
</head>

<body>
    <div class="navbar">
        <div class="navbar-brand">
            <a href="#">aimtop</a>
        </div>
        <div class="navbar-actions">
            <a href="#" class="btn-pastel-blue">Find player</a>
            <?php if (!isset($_SESSION["user_id"])): ?>
                <a href="register.php" class="btn-gray">Sign Up</a>
                <a href="login.php" class="btn-pastel-blue">Login</a>
            <?php else: ?>
                <a href="register.php" class="btn-purple">Benchmarks</a>
                <a href="register.php" class="btn-pastel-blue">Profile</a>
            <?php endif; ?>
        </div>
    </div>




</body>