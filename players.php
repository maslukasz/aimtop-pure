<?php
session_start();
require_once 'components/layout/navbar.php';

// Database connection
$conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

$query = $conn->execute_query('SELECT * FROM users WHERE name=?', [$_GET['player']]);

?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find player</title>
    <link rel="stylesheet" href="styles/layouts/find-player.scss">
</head>

<body>
    <form method="GET" id="my_form">
        <div class="container">
            <input type="text" class="search" placeholder="Search for player" name="player" form="my_form">
        </div>
    </form>

    <?= json_encode($query->fetch_all()) ?> 

</body>