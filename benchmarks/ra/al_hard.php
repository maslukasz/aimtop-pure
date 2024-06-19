<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header('Location: ../../login.php');
    exit();
}
$conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

$scenarios = [
    'twoshot', 'fourwide', 'threewide_small', 'threedclick', 'xyclick', 'jumpclick', 'jumptrack', 'smoothtrack', 'precisesphere', 'airtrack', 'reactivesphere', 'strafetrack', 'wideflick', 'speedflick', 'orbflick', 'threedswitch', 'waveswitch', 'xyswitch'
];

$scores = [
    'twoshot' => [
        1 => [1120, 'Mythic', 'static', 1400], 2 => [1190, 'Immortal', 'static', 1720], 3 => [1260, 'Archon', 'static', 1200], 4 => [1330, 'Ethereal', 'static', 830], 5 => [1400, 'Divine', 'static']
    ],
    'fourwide' => [
        1 => [1420, 'Mythic', 'static', 1400], 2 => [1490, 'Immortal', 'static', 1640], 3 => [1570, 'Archon', 'static', 1570], 4 => [1640, 'Ethereal', 'static', 1640], 5 => [1720, 'Divine', 'static']
    ],
    'threewide_small' => [
        1 => [1000, 'Mythic', 'static', 1400], 2 => [1050, 'Immortal', 'static', 1050], 3 => [1100, 'Archon', 'static', 1100], 4 => [1150, 'Ethereal', 'static', 1150], 5 => [1200, 'Divine', 'static']
    ],
    'threedclick' => [
        1 => [550, 'Mythic', 'dynamic', 1400], 2 => [620, 'Immortal', 'dynamic', 620], 3 => [690, 'Archon', 'dynamic', 690], 4 => [760, 'Ethereal', 'dynamic', 760], 5 => [830, 'Divine', 'dynamic']
    ],
    'xyclick' => [
        1 => [740, 'Mythic', 'dynamic', 1400], 2 => [820, 'Immortal', 'dynamic', 820], 3 => [900, 'Archon', 'dynamic', 900], 4 => [1000, 'Ethereal', 'dynamic', 1000], 5 => [1100, 'Divine', 'dynamic']
    ],
    'jumpclick' => [
        1 => [3100, 'Mythic', 'dynamic', 1400], 2 => [3550, 'Immortal', 'dynamic', 3550], 3 => [4000, 'Archon', 'dynamic', 4000], 4 => [4450, 'Ethereal', 'dynamic', 4450], 5 => [4900, 'Divine', 'dynamic']
    ],
    'jumptrack' => [
        1 => [2100, 'Mythic', 'precise', 1400], 2 => [2400, 'Immortal', 'precise', 2400], 3 => [2600, 'Archon', 'precise', 2600], 4 => [2800, 'Ethereal', 'precise', 2800], 5 => [3000, 'Divine', 'precise']
    ],
    'smoothtrack' => [
        1 => [2150, 'Mythic', 'precise', 1400], 2 => [2250, 'Immortal', 'precise', 2250], 3 => [2600, 'Archon', 'precise', 2600], 4 => [2800, 'Ethereal', 'precise', 2800], 5 => [3000, 'Divine', 'precise']
    ],
    'precisesphere' => [
        1 => [2200, 'Mythic', 'precise', 1400], 2 => [2400, 'Immortal', 'precise', 2400], 3 => [2600, 'Archon', 'precise', 2600], 4 => [2900, 'Ethereal', 'precise', 2900], 5 => [3200, 'Divine', 'precise']
    ],
    'airtrack' => [
        1 => [2100, 'Mythic', 'reactive', 1400], 2 => [2250, 'Immortal', 'reactive', 2250], 3 => [2400, 'Archon', 'reactive', 2400], 4 => [2600, 'Ethereal', 'reactive', 2600], 5 => [2800, 'Divine', 'reactive']
    ],
    'reactivesphere' => [
        1 => [1750, 'Mythic', 'reactive', 1400], 2 => [1900, 'Immortal', 'reactive', 1900], 3 => [2050, 'Archon', 'reactive', 2050], 4 => [2200, 'Ethereal', 'reactive', 2200], 5 => [2400, 'Divine', 'reactive']
    ],
    'strafetrack' => [
        1 => [2100, 'Mythic', 'reactive', 1400], 2 => [2250, 'Immortal', 'reactive', 2250], 3 => [2400, 'Archon', 'reactive', 2400], 4 => [2600, 'Ethereal', 'reactive', 2600], 5 => [2800, 'Divine', 'reactive']
    ],
    'wideflick' => [
        1 => [104, 'Mythic', 'speed', 1400], 2 => [108, 'Immortal', 'speed', 108], 3 => [112, 'Archon', 'speed', 112], 4 => [116, 'Ethereal', 'speed', 116], 5 => [120, 'Divine', 'speed']
    ],
    'speedflick' => [
        1 => [125, 'Mythic', 'speed', 1400], 2 => [130, 'Immortal', 'speed', 130], 3 => [135, 'Archon', 'speed', 135], 4 => [140, 'Ethereal', 'speed', 140], 5 => [145, 'Divine', 'speed']
    ],
    'orbflick' => [
        1 => [112, 'Mythic', 'speed', 1400], 2 => [120, 'Immortal', 'speed', 120], 3 => [128, 'Archon', 'speed', 128], 4 => [136, 'Ethereal', 'speed', 136], 5 => [144, 'Divine', 'speed']
    ],
    'threedswitch' => [
        1 => [50, 'Mythic', 'evasive', 1400], 2 => [54, 'Immortal', 'evasive', 54], 3 => [58, 'Archon', 'evasive', 58], 4 => [62, 'Ethereal', 'evasive', 62], 5 => [65, 'Divine', 'evasive']
    ],
    'waveswitch' => [
        1 => [48, 'Mythic', 'evasive', 1400], 2 => [51, 'Immortal', 'evasive', 51], 3 => [54, 'Archon', 'evasive', 54], 4 => [57, 'Ethereal', 'evasive', 57], 5 => [60, 'Divine', 'evasive']
    ],
    'xyswitch' => [
        1 => [80, 'Mythic', 'evasive', 1400], 2 => [85, 'Immortal', 'evasive', 85], 3 => [90, 'Archon', 'evasive', 90], 4 => [96, 'Ethereal', 'evasive', 96], 5 => [102, 'Divine', 'evasive']
    ]
];


function save_rank($scenario, $score, $rank)
{
    $conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
    $query = $conn->query("SELECT {$scenario}, {$scenario}_rank FROM ra_aimlab_hard WHERE user_id = {$_SESSION['user_id']}");
    $result = $query->fetch_all();

    if (empty($result)) {
        $conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
        $query = $conn->query("INSERT INTO ra_aimlab_hard (user_id, {$scenario}, {$scenario}_rank) VALUES ({$_SESSION['user_id']}, {$scenario}, '{$scenario}_rank')");
    } else {
        $conn->query("UPDATE ra_aimlab_hard SET {$scenario} = '{$score}', {$scenario}_rank = '{$rank}' WHERE user_id = {$_SESSION['user_id']}");
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
        } elseif ($value >= $scores[$response][4][0] && $value < $scores[$response][5][0]) {
            save_rank($response, $value, $scores[$response][4][1]);
            $_SESSION[$response] = $value;
            $_SESSION[$response . '_rank'] = $scores[$response][4][1];
        } elseif ($value >= $scores[$response][5][0]) {
            save_rank($response, $value, $scores[$response][5][1]);
            $_SESSION[$response] = $value;
            $_SESSION[$response . '_rank'] = $scores[$response][5][1];
        }
    }
};

foreach ($scenarios as $scene) {
    $q = "SELECT * FROM ra_aimlab_hard WHERE user_id = {$_SESSION['user_id']}";
    $res = mysqli_query($conn, $q);
    $r = mysqli_fetch_assoc($res);
    if (empty($r)) {
        $conn->query("INSERT INTO ra_aimlab_hard (user_id) VALUES ({$_SESSION['user_id']})");
    }
    foreach ($r as $key => $value) {
        $_SESSION[$key] = $value;
    }
}
$replace = [
    "rA Twoshot",
    "rA Fourwide",
    "rA Threewide Small",
    "rA 3Dclick",
    "rA XYclick",
    "rA Jumpclick",
    "rA Jumptrack",
    "rA Smoothtrack",
    "rA Precisesphere",
    "rA Airtrack",
    "rA Reactivesphere",
    "rA Strafetrack",
    "rA Wideflick",
    "rA Speedflick",
    "rA Orbflick",
    "rA 3Dswitch",
    "rA Waveswitch",
    "rA XYswitch"
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
        <span>Revosect Aimlabs Benchmarks - Hard <br>[<a href="https://steamcommunity.com/sharedfiles/filedetails/?id=2780064771" target="_blank">Link to the playlist</a>]</span>
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