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
        <?php if (!isset($_SESSION["user_id"])): ?>
            <div class="navbar-actions">
                <a href="register.php" class="btn-gray">Sign Up</a>
                <a href="login.php" class="btn-pastel-blue">Login</a>
            </div>
        <?php else: ?>
            <div class="navbar-actions">
                <a href="register.php" class="btn-purple">Benchmarks</a>
                <a href="register.php" class="btn-pastel-blue">Profile</a>
            </div>
        <?php endif; ?>
    </div>

    <style>
        .navbar-actions a {
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            margin-left: 10px;
        }

        .btn-pastel-pink {
            background-color: #ffcce0;
            color: #333;
        }

        .btn-pastel-pink:hover {
            background-color: #ffb3c6;
        }

        .btn-pastel-blue {
            background-color: #c9daf8;
            color: #333;
        }

        .btn-pastel-blue:hover {
            background-color: #a2c4f5;
        }
    </style>



</body>