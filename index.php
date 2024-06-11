<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  // User is not logged in, redirect to login page
  header('Location: login.php');
  exit();
}
$conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

// // Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$scenarios = ['rasp', 'bounceshot', 'onew5ts', 'multiclick', 'anglestrafe', 'arcstrafe', 'smoothbot', 'preciseorb', 'plaza', 'air', 'patstrafe', 'airstrafe', 'psalmts', 'skyts', 'evats', 'bouncets'];

$scores = [
  'rasp' => [
    1 => [750, 'Platinum'], 2 => [850, 'Diamond'], 3 => [950, 'Jade'], 4 => [1050, 'Master']
  ],
  'bounceshot' => [
    1 => [600, 'Platinum'], 2 => [700, 'Diamond'], 3 => [800, 'Jade'], 4 => [900, 'Master']
  ],
  '1w5ts' => [
    1 => [1000, 'Platinum'], 2 => [1100, 'Diamond'], 3 => [1200, 'Jade'], 4 => [1300, 'Master']
  ],
  'multiclick' => [
    1 => [1360, 'Platinum'], 2 => [1460, 'Diamond'], 3 => [1560, 'Jade'], 4 => [1660, 'Master']
  ],
  'anglestrafe' => [
    1 => [740, 'Platinum'], 2 => [830, 'Diamond'], 3 => [920, 'Jade'], 4 => [1000, 'Master']
  ],
  'arcstrafe' => [
    1 => [660, 'Platinum'], 2 => [750, 'Diamond'], 3 => [850, 'Jade'], 4 => [940, 'Master']
  ],
  'smoothbot' => [
    1 => [3050, 'Platinum'], 2 => [3450, 'Diamond'], 3 => [3850, 'Jade'], 4 => [4250, 'Master']
  ],
  'preciseorb' => [
    1 => [1650, 'Platinum'], 2 => [2050, 'Diamond'], 3 => [2450, 'Jade'], 4 => [2850, 'Master']
  ],
  'plaza' => [
    1 => [2680, 'Platinum'], 2 => [2980, 'Diadmond'], 3 => [3280, 'Jade'], 4 => [3530, 'Master']
  ],
  'air' => [
    1 => [2450, 'Platinum'], 2 => [2700, 'Diamond'], 3 => [2950, 'Jade'], 4 => [3200, 'Master']
  ],
  'patstrafe' => [
    1 => [2260, 'Platinum'], 2 => [2620, 'Diamond'], 3 => [2800, 'Jade'], 4 => [3050, 'Master']
  ],
  'airstrafe' => [
    1 => [2800, 'Platinum'], 2 => [3000, 'Diamond'], 3 => [320, 'Jade'], 4 => [3400, 'Master']
  ],
  'psalmts' => [
    1 => [810, 'Platinum'], 2 => [880, 'Diamond'], 3 => [950, 'Jade'], 4 => [1020, 'Master']
  ],
  'skyts' => [
    1 => [1030, 'Platinum'], 2 => [1130, 'Diamond'], 3 => [1220, 'Jade'], 4 => [1300, 'Master']
  ],
  'evats' => [
    1 => [550, 'Platinum'], 2 => [600, 'Diamond'], 3 => [650, 'Jade'], 4 => [700, 'Master']
  ],
  'bouncets' => [
    1 => [630, 'Platinum'], 2 => [670, 'Diamond'], 3 => [710, 'Jade'], 4 => [700, 'Master']
  ]
];


function save_rank($scenario, $score, $rank) {
  $conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
  $query = $conn->query("SELECT {$scenario}, {$scenario}_rank FROM vt_s4 WHERE user_id = {$_SESSION['user_id']}");
  $result = $query->fetch_all();

  if (empty($result)) {
    $conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
    $query = $conn->query("INSERT INTO vt_s4 (user_id, {$scenario}, {$scenario}_rank) VALUES ({$_SESSION['user_id']}, {$scenario}, '{$scenario}_rank')");
  } else {
    $conn->query("UPDATE vt_s4 SET {$scenario} = '{$score}', {$scenario}_rank = '{$rank}' WHERE user_id = {$_SESSION['user_id']}");
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
  if (isset($_SESSION[$scene])) {
    break;
  }

  foreach ($scenarios as $scene) {
    $score_q = $conn->execute_query("SELECT {$scene} FROM vt_s4 WHERE user_id = ?", [$_SESSION['user_id']]);
    foreach ($score_q->fetch_all() as $task) {
      foreach ($scenarios as $sc) {
        $_SESSION[$scene] = $task[0];
      }
    }

    foreach ($scenarios as $scn) {
      $rank_q = $conn->execute_query("SELECT " . $scn . '_rank' . " FROM vt_s4 WHERE user_id = ?", [$_SESSION['user_id']]);
      foreach ($rank_q->fetch_all() as $rank) {
        if (!empty($rank)) {
          $_SESSION[$scn . '_rank'] = $rank[0];
        }
      }
    }
  }
}



$colors = [
  'Platinum' => 'bg-blue-500',
  'Diamond' => 'bg-purple-500',
  'Jade' => 'bg-green-500',
  'Master' => 'bg-pink-500'
];

?>

<head>
  <link rel="stylesheet" href="styles/vt-s4.scss">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/htmx.org@1.9.12" integrity="sha384-ujb1lZYygJmzgSwoxRggbCHcjc0rB2XoQrxeTUQyRjrOnlCoYta87iKBWq3EsdM2" crossorigin="anonymous"></script>
  <title>VT S4 INTER</title>
</head>

<?php require_once 'components/layout/navbar.php' ?>

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
        <td><input type="number" name="rasp" form="my_form" /></td>
        <td class='<?= $_SESSION['rasp'] ?>'><?= $_SESSION['rasp'] ?></td>
        <td class='<?= $_SESSION['rasp_rank'] ?>'><?= $_SESSION['rasp_rank'] ?></td>
      </tr>
      <tr>
        <td class='dynamic'> VT Bounceshot Intermediate</td>
        <td><input type="number" name="bounceshot" form="my_form" /></td>
        <td class='<?= $_SESSION['bounceshot'] ?>'><?= $_SESSION['bounceshot'] ?></td>
        <td class='<?= $_SESSION['bounceshot_rank'] ?>'><?= $_SESSION['bounceshot_rank']  ?></td>
      </tr>
      <tr>
        <td class='static'> VT 1w5s Rasp Intermediate</td>
        <td><input type="number" name="onew5ts" form="my_form" /></td>
        <td class='<?= $_SESSION['onew5ts'] ?>'><?= $_SESSION['onew5ts'] ?></td>
        <td class='<?= $_SESSION['onew5ts_rank'] ?>'><?= $_SESSION['onew5ts_rank'] ?></td>
      </tr>
      <tr>
        <td class='static'> VT Multiclick 120 Intermediate</td>
        <td><input type="number" name="multiclick" form="my_form" /></td>
        <td class='<?= $_SESSION['multiclick'] ?>'><?= $_SESSION['multiclick'] ?></td>
        <td class='<?= $_SESSION['multiclick_rank'] ?>'><?= $_SESSION['multiclick_rank'] ?></td>
      </tr>
      <tr>
        <td class='strafe'> VT AngleStrafe Intermediate</td>
        <td><input type="number" name="anglestrafe" form="my_form" /></td>
        <td class='<?= $_SESSION['anglestrafe'] ?>'><?= $_SESSION['anglestrafe'] ?></td>
        <td class='<?= $_SESSION['anglestrafe_rank'] ?>'><?= $_SESSION['anglestrafe_rank'] ?></td>
      </tr>
      <tr>
        <td class='strafe'> VT ArcStrafe Intermediate</td>
        <td><input type="number" name="arcstrafe" form="my_form" /></td>
        <td class='<?= $_SESSION['arcstrafe'] ?>'><?= $_SESSION['arcstrafe'] ?></td>
        <td class='<?= $_SESSION['arcstrafe_rank'] ?>'><?= $_SESSION['arcstrafe_rank'] ?></td>
      </tr>
      <tr>
        <td class='precise'> VT Smoothbot Intermediate</td>
        <td><input type="number" name="smoothbot" form="my_form" /></td>
        <td class='<?= $_SESSION['smoothbot'] ?>'><?= $_SESSION['smoothbot'] ?></td>
        <td class='<?= $_SESSION['smoothbot_rank'] ?>'><?= $_SESSION['smoothbot_rank'] ?></td>
      </tr>
      <tr>
        <td class='precise'> VT PreciseOrb Intermediate</td>
        <td><input type="number" name="preciseorb" form="my_form" /></td>
        <td class='<?= $_SESSION['preciseorb'] ?>'><?= $_SESSION['preciseorb'] ?></td>
        <td class='<?= $_SESSION['preciseorb_rank'] ?>'><?= $_SESSION['preciseorb_rank'] ?></td>
      </tr>
      <tr>
        <td class='reactive'> VT Plaza Intermediate</td>
        <td><input type="number" name="plaza" form="my_form" /></td>
        <td class='<?= $_SESSION['plaza'] ?>'><?= $_SESSION['plaza'] ?></td>
        <td class='<?= $_SESSION['plaza_rank'] ?>'><?= $_SESSION['plaza_rank'] ?></td>
      </tr>
      <tr>
        <td class='reactive'> VT Air Intermediate</td>
        <td><input type="number" name="air" form="my_form" /></td>
        <td class='<?= $_SESSION['air'] ?>'><?= $_SESSION['air'] ?></td>
        <td class='<?= $_SESSION['air_rank'] ?>'><?= $_SESSION['air_rank'] ?></td>
      </tr>
      <tr>
        <td class='strafe'> VT PatStrafe Intermediate</td>
        <td><input type="number" name="patstrafe" form="my_form" /></td>
        <td class='<?= $_SESSION['patstrafe'] ?>'><?= $_SESSION['patstrafe'] ?></td>
        <td class='<?= $_SESSION['patstrafe_rank'] ?>'><?= $_SESSION['patstrafe_rank'] ?></td>
      </tr>
      <tr>
        <td class='strafe'> VT AirStrafe Intermediate</td>
        <td><input type="number" name="airstrafe" form="my_form" /></td>
        <td class='<?= $_SESSION['airstrafe'] ?>'><?= $_SESSION['airstrafe'] ?></td>
        <td class='<?= $_SESSION['airstrafe_rank'] ?>'><?= $_SESSION['airstrafe_rank'] ?></td>
      </tr>
      <tr>
        <td class='speed'> VT psalmTS Intermediate</td>
        <td><input type="number" name="psalmts" form="my_form" /></td>
        <td class='<?= $_SESSION['psalmts'] ?>'><?= $_SESSION['psalmts'] ?></td>
        <td class='<?= $_SESSION['psalmts_rank'] ?>'><?= $_SESSION['psalmts_rank'] ?></td>
      </tr>
      <tr>
        <td class='speed'> VT skyTS Intermediate</td>
        <td><input type="number" name="skyts" form="my_form" /></td>
        <td class='<?= $_SESSION['skyts'] ?>'><?= $_SESSION['skyts'] ?></td>
        <td class='<?= $_SESSION['skyts_rank'] ?>'><?= $_SESSION['skyts_rank'] ?></td>
      </tr>
      <tr>
        <td class='evasive'> VT evaTS Intermediate</td>
        <td><input type="number" name="evats" form="my_form" /></td>
        <td class='<?= $_SESSION['evats'] ?>'><?= $_SESSION['evats'] ?></td>
        <td class='<?= $_SESSION['evats_rank'] ?>'><?= $_SESSION['evats_rank'] ?></td>
      </tr>
      <tr>
        <td class='evasive'> VT bounceTS Intermediate</td>
        <td><input type="number" name="bouncets" form="my_form" /></td>
        <td class='<?= $_SESSION['bouncets'] ?>'><?= $_SESSION['bouncets'] ?></td>
        <td class='<?= $_SESSION['bouncets_rank'] ?>'><?= $_SESSION['bouncets_rank'] ?></td>
      </tr>
    </table>
    <button type="submit" form="my_form" class="sb">Apply Changes</button>
  </div>

</body>
