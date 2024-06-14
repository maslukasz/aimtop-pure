<head>
    <!-- <link rel="stylesheet" href="styles/components/navbar.scss"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <!-- <div class="navbar">
        <div class="navbar-brand">
            <a href="#">aimtop</a>
        </div>
        <div class="navbar-actions">
            <a href="#" class="btn-pastel-blue">Find player</a>
            <?php if (!isset($_SESSION["user_id"])) : ?>
                <a href="register.php" class="btn-gray">Sign Up</a>
                <a href="login.php" class="btn-pastel-blue">Login</a>
            <?php else : ?>
                <a href="register.php" class="btn-purple">Benchmarks</a>
                <a href="register.php" class="btn-pastel-blue">Profile</a>
            <?php endif; ?>
        </div>
    </div> -->

    <nav class="navbar">
        <div class="container">
            <div id="navMenu" class="navbar-menu">
                <div class="navbar-start">
                    <button class="button is-ghost">
                        <a class="navbar-item" href="../index.php">
                            aimtop
                        </a>
                    </button>
                </div>

                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                            <button class="button is-ghost"> <a href="https://discord.gg/QJauGpg7zg" target="_blank">Discord</a> </button>
                            <button class="button is-ghost"> <a href="https://x.com/aimtop_hub" target="_blank">Twitter</a> </button>
                            <?php if (!isset($_SESSION["user_id"])) : ?>
                                <a href="register.php" class="button is-dark">Sign Up</a>
                                <a href="login.php" class="button is-success">Login</a>
                            <?php else : ?>
                                <a href="register.php" class="button is-dark">Benchmarks</a>
                                <a href="register.php" class="button is-link">Profile</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>



</body>