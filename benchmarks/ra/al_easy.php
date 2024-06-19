<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header('Location: ../../login.php');
    exit();
}
$conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

$scenarios = [
    'sixshot', 'minishot', 'bounceclick', 'xyclick', 'bouncetrack', 'xytrack', 'spatialsphere', 'strafetrack', 'xyswitch', 'headswitch'
];

$scores = [
    'sixshot' => [
        1 => [800, 'Bronze', 'static'], 2 => [1000, 'Silver', 'static'], 3 => [1200, 'Gold', 'static'], 4 => [1400, 'Platinum', 'static']
    ],
    'minishot' => [
        1 => [85, 'Bronze', 'static'], 2 => [95, 'Silver', 'static'], 3 => [105, 'Gold', 'static'], 4 => [115, 'Platinum', 'static']
    ],
    'bounceclick' => [
        1 => [400, 'Bronze', 'dynamic'], 2 => [500, 'Silver', 'dynamic'], 3 => [600, 'Gold', 'dynamic'], 4 => [700, 'Platinum', 'dynamic']
    ],
    'xyclick' => [
        1 => [500, 'Bronze', 'dynamic'], 2 => [600, 'Silver', 'dynamic'], 3 => [700, 'Gold', 'dynamic'], 4 => [800, 'Platinum', 'dynamic']
    ],
    'bouncetrack' => [
        1 => [1800, 'Bronze', 'precise'], 2 => [2200, 'Silver', 'precise'], 3 => [2600, 'Gold', 'precise'], 4 => [3000, 'Platinum', 'precise']
    ],
    'xytrack' => [
        1 => [1800, 'Bronze', 'precise'], 2 => [2200, 'Silver', 'precise'], 3 => [2600, 'Gold', 'precise'], 4 => [3000, 'Platinum', 'precise']
    ],
    'spatialsphere' => [
        1 => [2400, 'Bronze', 'precise'], 2 => [2800, 'Silver', 'precise'], 3 => [3200, 'Gold', 'precise'], 4 => [3600, 'Platinum', 'precise']
    ],
    'strafetrack' => [
        1 => [1900, 'Bronze', 'reactive'], 2 => [2400, 'Silver', 'reactive'], 3 => [2900, 'Gold', 'reactive'], 4 => [3400, 'Platinum', 'reactive']
    ],
    'xyswitch' => [
        1 => [45, 'Bronze', 'evasive'], 2 => [55, 'Silver', 'evasive'], 3 => [65, 'Gold', 'evasive'], 4 => [75, 'Platinum', 'evasive']
    ],
    'headswitch' => [
        1 => [35, 'Bronze', 'evasive'], 2 => [40, 'Silver', 'evasive'], 3 => [45, 'Gold', 'evasive'], 4 => [50, 'Platinum', 'evasive']
    ]
];


function save_rank($scenario, $score, $rank)
{
    $conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
    $query = $conn->query("SELECT {$scenario}, {$scenario}_rank FROM ra_aimlab_easy WHERE user_id = {$_SESSION['user_id']}");
    $result = $query->fetch_all();

    if (empty($result)) {
        $conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
        $query = $conn->query("INSERT INTO ra_aimlab_easy (user_id, {$scenario}, {$scenario}_rank) VALUES ({$_SESSION['user_id']}, {$scenario}, '{$scenario}_rank')");
    } else {
        $conn->query("UPDATE ra_aimlab_easy SET {$scenario} = '{$score}', {$scenario}_rank = '{$rank}' WHERE user_id = {$_SESSION['user_id']}");
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
    $q = "SELECT * FROM ra_aimlab_easy WHERE user_id = {$_SESSION['user_id']}";
    $res = mysqli_query($conn, $q);
    $r = mysqli_fetch_assoc($res);
    if (empty($r)) {
        $conn->query("INSERT INTO ra_aimlab_easy (user_id) VALUES ({$_SESSION['user_id']})");
    }
    foreach ($r as $key => $value) {
        $_SESSION[$key] = $value;
    }
}

$replace = [
    "rA Sixshot Easy",
    "rA Minishot",
    "rA Bounceclick Easy",
    "rA XYclick Easy",
    "rA Bouncetrack Easy",
    "rA XYtrack",
    "rA Spatialsphere",
    "rA Strafetrack Easy",
    "rA XYswitch Easy",
    "rA Headswitch Easy"
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
        <span>Revosect Aimlabs Benchmarks - Easy <br>[<a href="https://steamcommunity.com/sharedfiles/filedetails/?id=2777610687" target="_blank">Link to the playlist</a>]</span>
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