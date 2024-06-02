<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header('Location: login.php');
    exit();
}

$conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// USER QUERY
$q = $conn->query("SELECT rasp, bounceshot, onew5ts, multiclick, anglestrafe, smoothbot, preciseorb, plaza, air, patstrafe, airstrafe, psalmts, skyts, evats, bouncets, arcstrafe FROM vt_s4 WHERE user_id = " . $_SESSION['user_id']);
$res2 = $q->fetch_all();
$q2 = $conn->query("SELECT rasp_rank, bounceshot_rank, onew5ts_rank, multiclick_rank, anglestrafe_rank, smoothbot_rank, preciseorb_rank, plaza_rank, air_rank, patstrafe_rank, airstrafe_rank, psalmts_rank, skyts_rank, evats_rank, bouncets_rank, arcstrafe_rank FROM vt_s4 WHERE user_id = " . $_SESSION['user_id']);
$res = $q2->fetch_all();

// INIT VARIABLES
$rasp = (intval($res2[0][0]) != 0 ? $rasp = intval($res2[0][0]) : $rasp = 0);
$bounceshot = (intval($res2[0][1]) != 0 ? $bounceshot = intval($res2[0][1]) : $bounceshot = 0);
$onew5ts = (intval($res2[0][2]) != 0 ? $onew5ts = intval($res2[0][2]) : $onew5ts = 0);
$multiclick = (intval($res2[0][3]) != 0 ? $multiclick = intval($res2[0][3]) : $multiclick = 0);
$anglestrafe = (intval($res2[0][4]) != 0 ? $anglestrafe = intval($res2[0][4]) : $anglestrafe = 0);
$smoothbot = (intval($res2[0][5]) != 0 ? $smoothbot = intval($res2[0][5]) : $smoothbot = 0);
$preciseorb = (intval($res2[0][6]) != 0 ? $preciseorb = intval($res2[0][6]) : $preciseorb = 0);
$plaza = (intval($res2[0][7]) != 0 ? $plaza = intval($res2[0][7]) : $plaza = 0);
$air = (intval($res2[0][8]) != 0 ? $air = intval($res2[0][8]) : $air = 0);
$patstrafe = (intval($res2[0][9]) != 0 ? $patstrafe = intval($res2[0][9]) : $patstrafe = 0);
$airstrafe = (intval($res2[0][10]) != 0 ? $airstrafe = intval($res2[0][10]) : $airstrafe = 0);
$psalmts = (intval($res2[0][11]) != 0 ? $psalmts = intval($res2[0][11]) : $psalmts = 0);
$skyts = (intval($res2[0][12]) != 0 ? $skyts = intval($res2[0][12]) : $skyts = 0);
$evats = (intval($res2[0][13]) != 0 ? $evats = intval($res2[0][13]) : $evats = 0);
$bouncets = (intval($res2[0][14]) != 0 ? $bouncets = intval($res2[0][14]) : $bouncets = 0);
$arcstrafe = (intval($res2[0][15]) != 0 ? $arcstrafe = intval($res2[0][15]) : $arcstrafe = 0);

$rasp_rank = ($res[0][0] != 0 || '' ? $rasp_rank = $res[0][0] : $rasp_rank = '');
$bounceshot_rank = ($res[0][1] != 0 || '' ? $bounceshot_rank = $res[0][1] : $bounceshot_rank = '');
$onew5ts_rank = ($res[0][2] != 0 || '' ? $onew5ts_rank = $res[0][2] : $onew5ts_rank = '');
$multiclick_rank = ($res[0][3] != 0 || '' ? $multiclick_rank = $res[0][3] : $multiclick_rank = '');
$anglestrafe_rank = ($res[0][4] != 0 || '' ? $anglestrafe_rank = $res[0][4] : $anglestrafe_rank = '');
$smoothbot_rank = ($res[0][5] != 0 || '' ? $smoothbot_rank = $res[0][5] : $smoothbot_rank = '');
$preciseorb_rank = ($res[0][6] != 0 || '' ? $preciseorb_rank = $res[0][6] : $preciseorb_rank = '');
$plaza_rank = ($res[0][7] != 0 || '' ? $plaza_rank = $res[0][7] : $plaza_rank = '');
$air_rank = ($res[0][8] != 0 || '' ? $air_rank = $res[0][8] : $air_rank = '');
$patstrafe_rank = ($res[0][9] != 0 || '' ? $patstrafe_rank = $res[0][9] : $patstrafe_rank = '');
$airstrafe_rank = ($res[0][10] != 0 || '' ? $airstrafe_rank = $res[0][10] : $airstrafe_rank = '');
$psalmts_rank = ($res[0][11] != 0 || '' ? $psalmts_rank = $res[0][11] : $psalmts_rank = '');
$skyts_rank = ($res[0][12] != 0 || '' ? $skyts_rank = $res[0][12] : $skyts_rank = '');
$evats_rank = ($res[0][13] != 0 || '' ? $evats_rank = $res[0][13] : $evats_rank = '');
$bouncets_rank = ($res[0][14] != 0 || '' ? $bouncets_rank = $res[0][14] : $bouncets_rank = '');
$arcstrafe_rank = ($res[0][15] != 0 || '' ? $arcstrafe_rank = $res[0][15] : $arcstrafe_rank = '');

function get_rank($task, $score, $rank)
{
    $conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
    $result = $conn->execute_query("SELECT {$task} FROM vt_s4 WHERE user_id = ?", [$_SESSION['user_id']]);
    while ($row = $result->fetch_all()) {
        if (intval($row) != 0 && $score != '') {
            $conn->execute_query("UPDATE vt_s4 SET {$task} = ?, {$task}_rank = ? WHERE user_id = ?", [$score, $rank, $_SESSION['user_id']]);
            header("Refresh");
        }
    }
    header('Refresh');
}

//  VT Pasu Rasp Intermediate
if ($_GET['rasp'] >= 750 && $_GET['rasp'] < 850) {
    $rasp = $_GET['rasp'];
    $rasp_rank = 'Platinum';
    get_rank('rasp', $_GET['rasp'], $rasp_rank);
} elseif ($_GET['rasp'] >= 850 && $_GET['rasp'] < 950) {
    $rasp_rank = 'Diamond';
    get_rank('rasp', $_GET['rasp'], $rasp_rank);
} elseif ($_GET['rasp'] >= 950 && $_GET['rasp'] < 1050) {
    $rasp_rank = 'Jade';
    get_rank('rasp', $_GET['rasp'], $rasp_rank);
} elseif ($_GET['rasp'] >= 1050) {
    $rasp_rank = 'Master';
    get_rank('rasp', $_GET['rasp'], $rasp_rank);
}
// VT Bounceshot Intermediate
if ($_GET['bounceshot'] >= 600 && $_GET['bounceshot'] < 700) {
    $bounceshot_rank = 'Platinum';
    $bounceshotbg = 'bg-blue-500';
    get_rank('bounceshot', $_GET['bounceshot'], $bounceshot_rank);
} elseif ($_GET['bounceshot'] >= 700 && $_GET['bounceshot'] < 800) {
    $bounceshot_rank = 'Diamond';
    get_rank('bounceshot', $_GET['bounceshot'], $bounceshot_rank);
} elseif ($_GET['bounceshot'] >= 800 && $_GET['bounceshot'] < 900) {
    $bounceshot_rank = 'Jade';
    get_rank('bounceshot', $_GET['bounceshot'], $bounceshot_rank);
} elseif ($_GET['bounceshot'] >= 900) {
    $bounceshot_rank = 'Master';
    get_rank('bounceshot', $_GET['bounceshot'], $bounceshot_rank);
}

//  VT 1w5ts Rasp Novice
if ($_GET['onew5ts'] >= 1000 && $_GET['onew5ts'] < 1100) {
    $onew5ts_rank = 'Platinum';
    $onew5tsbg = 'bg-blue-500';
    get_rank('onew5ts', $_GET['onew5ts'], $onew5ts_rank);
} elseif ($_GET['onew5ts'] >= 1100 && $_GET['onew5ts'] < 1200) {
    $onew5ts_rank = 'Diamond';
    get_rank('onew5ts', $_GET['onew5ts'], $onew5ts_rank);
} elseif ($_GET['onew5ts'] >= 1200 && $_GET['onew5ts'] < 1300) {
    $onew5ts_rank = 'Jade';
    get_rank('onew5ts', $_GET['onew5ts'], $onew5ts_rank);
} elseif ($_GET['onew5ts'] >= 1300) {
    $onew5ts_rank = 'Master';
    get_rank('onew5ts', $_GET['onew5ts'], $onew5ts_rank);
}

//  VT Multiclick 120 Intermediate
if ($_GET['multiclick'] >= 1360 && $_GET['multiclick'] < 1460) {
    $multiclick_rank = 'Platinum';
    get_rank('multiclick', $_GET['multiclick'], $multiclick_rank);
} elseif ($_GET['multiclick'] >= 1460 && $_GET['multiclick'] < 1560) {
    $multiclick_rank = 'Diamond';
    get_rank('multiclick', $_GET['multiclick'], $multiclick_rank);
} elseif ($_GET['multiclick'] >= 1560 && $_GET['multiclick'] < 1660) {
    $multiclick_rank = 'Jade';
    get_rank('multiclick', $_GET['multiclick'], $multiclick_rank);
} elseif ($_GET['multiclick'] >= 1660) {
    $multiclick_rank = 'Master';
    get_rank('multiclick', $_GET['multiclick'], $multiclick_rank);
}

//  VT AngleStrafe Intermediate
if ($_GET['anglestrafe'] >= 660 && $_GET['anglestrafe'] < 750) {
    $anglestrafe_rank = 'Platinum';
    $multiclickbg = 'bg-blue-500';
    get_rank('anglestrafe', $_GET['anglestrafe'], $anglestrafe_rank);
} elseif ($_GET['anglestrafe'] >= 750 && $_GET['anglestrafe'] < 850) {
    $anglestrafe_rank = 'Diamond';
    get_rank('anglestrafe', $_GET['anglestrafe'], $anglestrafe_rank);
} elseif ($_GET['anglestrafe'] >= 850 && $_GET['anglestrafe'] < 940) {
    $anglestrafe_rank = 'Jade';
    get_rank('anglestrafe', $_GET['anglestrafe'], $anglestrafe_rank);
} elseif ($_GET['anglestrafe'] >= 940) {
    $anglestrafe_rank = 'Master';
    get_rank('anglestrafe', $_GET['anglestrafe'], $anglestrafe_rank);
}

//  VT Smoothbot Intermediate
if ($_GET['smoothbot'] >= 3050 && $_GET['smoothbot'] < 3450) {
    $smoothbot_rank = 'Platinum';
    $smoothbotbg = 'bg-blue-500';
    get_rank('smoothbot', $_GET['smoothbot'], $smoothbot_rank);
} elseif ($_GET['smoothbot'] >= 3450 && $_GET['smoothbot'] < 3850) {
    $smoothbot_rank = 'Diamond';
    get_rank('smoothbot', $_GET['smoothbot'], $smoothbot_rank);
} elseif ($_GET['smoothbot'] >= 3850 && $_GET['smoothbot'] < 4250) {
    $smoothbot_rank = 'Jade';
    get_rank('smoothbot', $_GET['smoothbot'], $smoothbot_rank);
} elseif ($_GET['smoothbot'] >= 4250) {
    $smoothbot_rank = 'Master';
    get_rank('smoothbot', $_GET['smoothbot'], $smoothbot_rank);
}

//  VT PreciseOrb Intermediate
if ($_GET['preciseorb'] >= 1650 && $_GET['preciseorb'] < 2050) {
    $preciseorb_rank = 'Platinum';
    $preciseorbbg = 'bg-blue-500';
    get_rank('preciseorb', $_GET['preciseorb'], $preciseorb_rank);
} elseif ($_GET['preciseorb'] >= 2050 && $_GET['preciseorb'] < 2450) {
    $preciseorb_rank = 'Diamond';
    get_rank('preciseorb', $_GET['preciseorb'], $preciseorb_rank);
} elseif ($_GET['preciseorb'] >= 2450 && $_GET['preciseorb'] < 2850) {
    $preciseorb_rank = 'Jade';
    get_rank('preciseorb', $_GET['preciseorb'], $preciseorb_rank);
} elseif ($_GET['preciseorb'] >= 2850) {
    $preciseorb_rank = 'Master';
    get_rank('preciseorb', $_GET['preciseorb'], $preciseorb_rank);
}

//  VT Plaza Intermediate
if ($_GET['plaza'] >= 2680 && $_GET['plaza'] < 2980) {
    $plaza_rank = 'Platinum';
    $plazabg = 'bg-blue-500';
    get_rank('plaza', $_GET['plaza'], $plaza_rank);
} elseif ($_GET['plaza'] >= 2980 && $_GET['plaza'] < 3280) {
    $plaza_rank = 'Diamond';
    get_rank('plaza', $_GET['plaza'], $plaza_rank);
} elseif ($_GET['plaza'] >= 3280 && $_GET['plaza'] < 3530) {
    $plaza_rank = 'Jade';
    get_rank('plaza', $_GET['plaza'], $plaza_rank);
} elseif ($_GET['plaza'] >= 3530) {
    $plaza_rank = 'Master';
    get_rank('plaza', $_GET['plaza'], $plaza_rank);
}

//  VT Air Intermediate
if ($_GET['air'] >= 2450 && $_GET['air'] < 2700) {
    $air_rank = 'Platinum';
    $airbg = 'bg-blue-500';
    get_rank('air', $_GET['air'], $air_rank);
} elseif ($_GET['air'] >= 2700 && $_GET['air'] < 2950) {
    $air_rank = 'Diamond';
    get_rank('air', $_GET['air'], $air_rank);
} elseif ($_GET['air'] >= 2950 && $_GET['air'] < 3200) {
    $air_rank = 'Jade';
    get_rank('air', $_GET['air'], $air_rank);
} elseif ($_GET['air'] >= 3200) {
    $air_rank = 'Master';
    get_rank('air', $_GET['air'], $air_rank);
}

//  VT Air Intermediate
if ($_GET['patstrafe'] >= 2260 && $_GET['patstrafe'] < 2620) {
    $patstrafe_rank = 'Platinum';
    $patstrafebg = 'bg-blue-500';
    get_rank('patstrafe', $_GET['patstrafe'], $patstrafe_rank);
} elseif ($_GET['patstrafe'] >= 2620 && $_GET['patstrafe'] < 2800) {
    $patstrafe_rank = 'Diamond';
    get_rank('patstrafe', $_GET['patstrafe'], $patstrafe_rank);
} elseif ($_GET['patstrafe'] >= 2800 && $_GET['patstrafe'] < 3050) {
    $patstrafe_rank = 'Jade';
    get_rank('patstrafe', $_GET['patstrafe'], $patstrafe_rank);
} elseif ($_GET['patstrafe'] >= 3050) {
    $patstrafe_rank = 'Master';
    get_rank('patstrafe', $_GET['patstrafe'], $patstrafe_rank);
}

//  VT AirStrafe Intermediate
if ($_GET['airstrafe'] >= 2800 && $_GET['airstrafe'] < 3000) {
    $airstrafe_rank = 'Platinum';
    $airstrafebg = 'bg-blue-500';
    get_rank('airstrafe', $_GET['airstrafe'], $airstrafe_rank);
} elseif ($_GET['airstrafe'] >= 3000 && $_GET['airstrafe'] < 3200) {
    $airstrafe_rank = 'Diamond';
    get_rank('airstrafe', $_GET['airstrafe'], $airstrafe_rank);
} elseif ($_GET['airstrafe'] >= 3200 && $_GET['airstrafe'] < 3400) {
    $airstrafe_rank = 'Jade';
    get_rank('airstrafe', $_GET['airstrafe'], $airstrafe_rank);
} elseif ($_GET['airstrafe'] >= 3400) {
    $airstrafe_rank = 'Master';
    get_rank('airstrafe', $_GET['airstrafe'], $airstrafe_rank);
}

//  VT psalmTS Intermediate
if ($_GET['psalmts'] >= 810 && $_GET['psalmts'] < 880) {
    $psalmts_rank = 'Platinum';
    $psalmtsbg = 'bg-blue-500';
    get_rank('psalmts', $_GET['psalmts'], $psalmts_rank);
} elseif ($_GET['psalmts'] >= 880 && $_GET['psalmts'] < 950) {
    $psalmts_rank = 'Diamond';
    get_rank('psalmts', $_GET['psalmts'], $psalmts_rank);
} elseif ($_GET['psalmts'] >= 950 && $_GET['psalmts'] < 1020) {
    $psalmts_rank = 'Jade';
    get_rank('psalmts', $_GET['psalmts'], $psalmts_rank);
} elseif ($_GET['psalmts'] >= 1020) {
    $psalmts_rank = 'Master';
    get_rank('psalmts', $_GET['psalmts'], $psalmts_rank);
}

//  VT skyTS Intermediate
if ($_GET['skyts'] >= 1030 && $_GET['skyts'] < 1130) {
    $skyts_rank = 'Platinum';
    $skytsbg = 'bg-blue-500';
    get_rank('skyts', $_GET['skyts'], $skyts_rank);
} elseif ($_GET['skyts'] >= 1130 && $_GET['skyts'] < 1220) {
    $skyts_rank = 'Diamond';
    get_rank('skyts', $_GET['skyts'], $skyts_rank);
} elseif ($_GET['skyts'] >= 1220 && $_GET['skyts'] < 1300) {
    $skyts_rank = 'Jade';
    get_rank('skyts', $_GET['skyts'], $skyts_rank);
} elseif ($_GET['skyts'] >= 1300) {
    $skyts_rank = 'Master';
    get_rank('skyts', $_GET['skyts'], $skyts_rank);
}

//  VT evaTS Intermediate
if ($_GET['evats'] >= 550 && $_GET['evats'] < 650) {
    $evats_rank = 'Platinum';
    $evatsbg = 'bg-blue-500';
    get_rank('evats', $_GET['evats'], $evats_rank);
} elseif ($_GET['evats'] >= 600 && $_GET['evats'] < 650) {
    $evats_rank = 'Diamond';
    get_rank('evats', $_GET['evats'], $evats_rank);
} elseif ($_GET['evats'] >= 650 && $_GET['evats'] < 700) {
    $evats_rank = 'Jade';
    get_rank('evats', $_GET['evats'], $evats_rank);
} elseif ($_GET['evats'] >= 700) {
    $evats_rank = 'Master';
    get_rank('evats', $_GET['evats'], $evats_rank);
}

//  VT bounceTS Intermediate
if ($_GET['bouncets'] >= 630 && $_GET['bouncets'] < 650) {
    $bouncets_rank = 'Platinum';
    $bounceshotbg = 'bg-blue-500';
    get_rank('bouncets', $_GET['bouncets'], $bouncets_rank);
} elseif ($_GET['bouncets'] >= 670 && $_GET['bouncets'] < 650) {
    $bouncets_rank = 'Diamond';
    get_rank('bouncets', $_GET['bouncets'], $bouncets_rank);
}


?>

<head>
    <link rel="stylesheet" href="styles/vt-s4.scss">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/htmx.org@1.9.12"
        integrity="sha384-ujb1lZYygJmzgSwoxRggbCHcjc0rB2XoQrxeTUQyRjrOnlCoYta87iKBWq3EsdM2"
        crossorigin="anonymous"></script>
    <title>VT S4 INTER</title>
</head>

<body>
    <form method="GET" id="my_form"></form>
   <div class='flex'>
        <span>Voltaic KvKs Intermediate Benchmarks S4 - Intermediate</span>
        <table>
            <tr class='head'>
                <th>Scenario</th>
                <th>New High Score</th>
                <th>High Score</th>
                <th>Rank</th>
            </tr>
            <tr>
                <td class='dynamic'> VT Pasu Rasp Intermediate</td>
                <td><input class="text-[#EADFB4]" type="number" name="rasp" form="my_form" /></td>
                <td class='<?= $rasp ?>'><?= $rasp ?></td>
                <td class='<?= $rasp_rank ?>'><?= $rasp_rank ?></td>
            </tr>
            <tr>
                <td class='dynamic'> VT Bounceshot Intermediate</td>
                <td><input type="number" name="bounceshot" form="my_form" /></td>
                <td class='<?= $bounceshot ?>'><?= $bounceshot ?></td>
                <td class='<?= $bounceshot_rank ?>'><?= $bounceshot_rank ?></td>
            </tr>
            <tr>
                <td class='static'> VT 1w5s Rasp Intermediate</td>
                <td><input type="number" name="onew5ts" form="my_form" /></td>
                <td class='<?= $onew5ts ?>'><?= $onew5ts ?></td>
                <td class='<?= $onew5ts_rank ?>'><?= $onew5ts_rank ?></td>
            </tr>
            <tr>
                <td class='static'> VT Multiclick 120 Intermediate</td>
                <td><input type="number" name="multiclick" form="my_form" /></td>
                <td class='<?= $multiclick ?>'><?= $multiclick ?></td>
                <td class='<?= $multiclick_rank ?>'><?= $multiclick_rank ?></td>
            </tr>
            <tr>
                <td class='strafe'> VT AngleStrafe Intermediate</td>
                <td><input type="number" name="anglestrafe" form="my_form" /></td>
                <td class='<?= $anglestrafe ?>'><?= $anglestrafe ?></td>
                <td class='<?= $anglestrafe_rank ?>'><?= $anglestrafe_rank ?></td>
            </tr>
            <tr>
                <td class='strafe'> VT ArcStrafe Intermediate</td>
                <td><input type="number" name="arcstrafe" form="my_form" /></td>
                <td class='<?= $arcstrafe ?>'><?= $arcstrafe ?></td>
                <td class='<?= $arcstrafe_rank ?>'><?= $arcstrafe_rank ?></td>
            </tr>
            <tr>
                <td class='precise'> VT Smoothbot Intermediate</td>
                <td><input type="number" name="smoothbot" form="my_form" /></td>
                <td class='<?= $smoothbot ?>'><?= $smoothbot ?></td>
                <td class='<?= $smoothbot_rank ?>'><?= $smoothbot_rank ?></td>
            </tr>
            <tr>
                <td class='precise'> VT PreciseOrb Intermediate</td>
                <td><input type="number" name="preciseorb" form="my_form" /></td>
                <td class='<?= $preciseorb ?>'><?= $preciseorb ?></td>
                <td class='<?= $preciseorb_rank ?>'><?= $preciseorb_rank ?></td>
            </tr>
            <tr>
                <td class='reactive'> VT Plaza Intermediate</td>
                <td><input type="number" name="plaza" form="my_form" /></td>
                <td class='<?= $plaza ?>'><?= $plaza ?></td>
                <td class='<?= $plaza_rank ?>'><?= $plaza_rank ?></td>
            </tr>
            <tr>
                <td class='reactive'> VT Air Intermediate</td>
                <td><input type="number" name="air" form="my_form" /></td>
                <td class='<?= $air ?>'><?= $air ?></td>
                <td class='<?= $air_rank ?>'><?= $air_rank ?></td>
            </tr>
            <tr>
                <td class='strafe'> VT PatStrafe Intermediate</td>
                <td><input type="number" name="patstrafe" form="my_form" /></td>
                <td class='<?= $patstrafe ?>'><?= $patstrafe ?></td>
                <td class='<?= $patstrafe_rank ?>'><?= $patstrafe_rank ?></td>
            </tr>
            <tr>
                <td class='strafe'> VT AirStrafe Intermediate</td>
                <td><input type="number" name="airstrafe" form="my_form" /></td>
                <td class='<?= $airstrafe ?>'><?= $airstrafe ?></td>
                <td class='<?= $airstrafe_rank ?>'><?= $airstrafe_rank ?></td>
            </tr>
            <tr>
                <td class='speed'> VT psalmTS Intermediate</td>
                <td><input type="number" name="psalmts" form="my_form" /></td>
                <td class='<?= $psalmts ?>'><?= $psalmts ?></td>
                <td class='<?= $psalmts_rank ?>'><?= $psalmts_rank ?></td>
            </tr>
            <tr>
                <td class='speed'> VT skyTS Intermediate</td>
                <td><input type="number" name="skyts" form="my_form" /></td>
                <td class='<?= $skyts ?>'><?= $skyts ?></td>
                <td class='<?= $skyts_rank ?>'><?= $skyts_rank ?></td>
            </tr>
            <tr>
                <td class='evasive'> VT evaTS Intermediate</td>
                <td><input type="number" name="evats" form="my_form" /></td>
                <td class='<?= $evats ?>'><?= $evats ?></td>
                <td class='<?= $evats_rank ?>'><?= $evats_rank ?></td>
            </tr>
            <tr>
                <td class='evasive'> VT bounceTS Intermediate</td>
                <td><input type="number" name="bouncets" form="my_form" /></td>
                <td class='<?= $bouncets ?>'><?= $bouncets ?></td>
                <td class='<?= $bouncets_rank ?>'><?= $bouncets_rank ?></td>
            </tr>
        </table>
        <button type="submit" form="my_form" class="sb">Apply Changes</button>
    </div>
</body>