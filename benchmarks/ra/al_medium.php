<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header('Location: ../../login.php');
    exit();
}
$conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

$scenarios = [
    'twoshot', 'sixwide', 'sixshot', 'headclick', 'xyclick', 'bounceclick', 'bouncetrack', 'smoothtrack', 'precisesphere', 'airtrack', 'reactivesphere', 'strafetrack', 'wideflick', 'speedflick', 'orblick', 'headswitch', 'waveswitch', 'xyswitch'
];

$scores = [
    'twoshot' => [
        1 => [1000, 'Ace', 'static'], 2 => [1100, 'Legend', 'static'], 3 => [1200, 'Sentinel', 'static'], 4 => [1300, 'Valour', 'static']
    ],
    'sixwide' => [
        1 => [1100, 'Ace', 'static'], 2 => [1200, 'Legend', 'static'], 3 => [1300, 'Sentinel', 'static'], 4 => [1400, 'Valour', 'static']
    ],
    'sixshot' => [
        1 => [900, 'Ace', 'static'], 2 => [1000, 'Legend', 'static'], 3 => [1100, 'Sentinel', 'static'], 4 => [1200, 'Valour', 'static']
    ],
    'headclick' => [
        1 => [650, 'Ace', 'dynamic'], 2 => [700, 'Legend', 'dynamic'], 3 => [750, 'Sentinel', 'dynamic'], 4 => [800, 'Valour', 'dynamic']
    ],
    'xyclick' => [
        1 => [600, 'Ace', 'dynamic'], 2 => [700, 'Legend', 'dynamic'], 3 => [800, 'Sentinel', 'dynamic'], 4 => [900, 'Valour', 'dynamic']
    ],
    'bounceclick' => [
        1 => [450, 'Ace', 'dynamic'], 2 => [550, 'Legend', 'dynamic'], 3 => [650, 'Sentinel', 'dynamic'], 4 => [750, 'Valour', 'dynamic']
    ],
    'bouncetrack' => [
        1 => [2100, 'Ace', 'precise'], 2 => [2400, 'Legend', 'precise'], 3 => [2700, 'Sentinel', 'precise'], 4 => [3000, 'Valour', 'precise']
    ],
    'smoothtrack' => [
        1 => [2400, 'Ace', 'precise'], 2 => [2700, 'Legend', 'precise'], 3 => [3000, 'Sentinel', 'precise'], 4 => [3300, 'Valour', 'precise']
    ],
    'precisesphere' => [
        1 => [2400, 'Ace', 'precise'], 2 => [2700, 'Legend', 'precise'], 3 => [3000, 'Sentinel', 'precise'], 4 => [3300, 'Valour', 'precise']
    ],
    'airtrack' => [
        1 => [2000, 'Ace', 'reactive'], 2 => [2400, 'Legend', 'reactive'], 3 => [2800, 'Sentinel', 'reactive'], 4 => [3200, 'Valour', 'reactive']
    ],
    'reactivesphere' => [
        1 => [2000, 'Ace', 'reactive'], 2 => [2400, 'Legend', 'reactive'], 3 => [2800, 'Sentinel', 'reactive'], 4 => [3200, 'Valour', 'reactive']
    ],
    'strafetrack' => [
        1 => [2000, 'Ace', 'reactive'], 2 => [2300, 'Legend', 'reactive'], 3 => [2600, 'Sentinel', 'reactive'], 4 => [2900, 'Valour', 'reactive']
    ],
    'wideflick' => [
        1 => [84, 'Ace', 'speed'], 2 => [91, 'Legend', 'speed'], 3 => [98, 'Sentinel', 'speed'], 4 => [105, 'Valour', 'speed']
    ],
    'speedflick' => [
        1 => [114, 'Ace', 'speed'], 2 => [121, 'Legend', 'speed'], 3 => [128, 'Sentinel', 'speed'], 4 => [135, 'Valour', 'speed']
    ],
    'orblick' => [
        1 => [108, 'Ace', 'speed'], 2 => [114, 'Legend', 'speed'], 3 => [120, 'Sentinel', 'speed'], 4 => [126, 'Valour', 'speed']
    ],
    'headswitch' => [
        1 => [50, 'Ace', 'evasive'], 2 => [55, 'Legend', 'evasive'], 3 => [60, 'Sentinel', 'evasive'], 4 => [65, 'Valour', 'evasive']
    ],
    'waveswitch' => [
        1 => [45, 'Ace', 'evasive'], 2 => [49, 'Legend', 'evasive'], 3 => [53, 'Sentinel', 'evasive'], 4 => [57, 'Valour', 'evasive']
    ],
    'xyswitch' => [
        1 => [69, 'Ace', 'evasive'], 2 => [76, 'Legend', 'evasive'], 3 => [83, 'Sentinel', 'evasive'], 4 => [90, 'Valour', 'evasive']
    ]
];

function save_rank($scenario, $score, $rank)
{
    $conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
    $query = $conn->query("SELECT {$scenario}, {$scenario}_rank FROM ra_aimlab_medium WHERE user_id = {$_SESSION['user_id']}");
    $result = $query->fetch_all();

    if (empty($result)) {
        $conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
        $query = $conn->query("INSERT INTO ra_aimlab_medium (user_id, {$scenario}, {$scenario}_rank) VALUES ({$_SESSION['user_id']}, {$scenario}, '{$scenario}_rank')");
    } else {
        $conn->query("UPDATE ra_aimlab_medium SET {$scenario} = '{$score}', {$scenario}_rank = '{$rank}' WHERE user_id = {$_SESSION['user_id']}");
    }

    return $result;
}

foreach ($_GET as $response => $value) {
    if ($value) {
        $conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
        if ($value >= $scores[$response][1][0] && $value < $scores[$response][2][0]) {
            save_rank($response, $value, $scores[$response][1][1]);
            $_SESSION[$response] = $value;
            $_SESSION[$response . '_rank'] = $scores[$response][1][1];
        } elseif ($value >= $scores[$response][2][0] && $value < $scores[$response][3][0]) {
            save_rank($response, $value, $scores[$response][2][1]);
            $_SESSION[$response] = $value;
            $_SESSION[$response . '_rank'] = $scores[$response][2][1];
        } elseif ($value >= $scores[$response][3][0] && $value < $scores[$response][4][0]) {
            save_rank($response, $value, $scores[$response][3][1]);
            $_SESSION[$response] = $value;
            $_SESSION[$response . '_rank'] = $scores[$response][3][1];
        } elseif ($value >= $scores[$response][4][0]) {
            save_rank($response, $value, $scores[$response][4][1]);
            $_SESSION[$response] = $value;
            $_SESSION[$response . '_rank'] = $scores[$response][4][1];
        }
    }
};

foreach ($scenarios as $scene) {
    $q = "SELECT * FROM ra_aimlab_medium WHERE user_id = {$_SESSION['user_id']}";
    $res = mysqli_query($conn, $q);
    $r = mysqli_fetch_assoc($res);
    if (empty($r)) {
        $conn->query("INSERT INTO ra_aimlab_medium (user_id) VALUES ({$_SESSION['user_id']})");
    }
    foreach ($r as $key => $value) {
        $_SESSION[$key] = $value;
    }
}

$replace = [
    "rA Twoshot Med",
    "rA Sixwide",
    "rA Sixshot",
    "rA Headclick",
    "rA XYclick Med",
    "rA Bounceclick Med",
    "rA Bouncetrack Med",
    "rA Smoothtrack Med",
    "rA Precisesphere Med",
    "rA Airtrack Med",
    "rA Reactivesphere Med",
    "rA Strafetrack Med",
    "rA Wideflick Med",
    "rA Speedflick Med",
    "rA Orbflick Med",
    "rA Headswitch",
    "rA Waveswitch Med",
    "rA XYswitch Med"
];
?>

<head>
    <link rel="stylesheet" href="../../styles/layouts/ra.scss">
    <!-- <link rel="stylesheet" href="../styles/components/navbar.scss"> -->

    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<?php require_once '../../components/layout/navbar.php'; ?>

<body>


    <form method="GET" id="my_form"></form>
    <div class='tab-container'>
        <span>Revosect Aimlabs Benchmarks - Medium</span>
        <table id='tab-content'>
            <tr class='head'>
                <th>Scenario</th>
                <th>New High Score</th>
                <th>High Score</th>
                <th>Rank</th>
            </tr>

            <?php foreach ($scenarios as $scene) : ?>
                <tr>
                    <td class='<?= $scores[$scene][1][2] ?>'><?= str_replace($scenarios, $replace, $scene) ?></td>
                    <td><input type="number" name='<?= $scene ?>' form="my_form" /></td>
                    <td class="hs"> <?= $_SESSION[$scene] ?> </td>
                    <td class='<?= $_SESSION[$scene . "_rank"] ?>'><?= $_SESSION[$scene . "_rank"] ?></td>
                </tr>
            <?php endforeach; ?>

        </table>
        <button class="submit-btn" type="submit" form="my_form">Apply changes</button>
    </div>


</body>