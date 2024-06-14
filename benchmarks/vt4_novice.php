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
$scenarios = ['rasp', 'bounceshot', 'onew6ts', 'multiclick', 'smoothbot', 'preciseorb', 'plaza', 'air', 'psalmts', 'skyts', 'evats', 'bouncets'];

$scores = [
  'rasp' => [
    1 => [550, 'Iron', 'dynamic'], 2 => [650, 'Bronze', 'dynamic'], 3 => [750, 'Silver', 'dynamic'], 4 => [850, 'Gold', 'dynamic']
  ],
  'bounceshot' => [
    1 => [500, 'Iron', 'dynamic'], 2 => [600, 'Bronze', 'dynamic'], 3 => [700, 'Silver', 'dynamic'], 4 => [800, 'Gold', 'dynamic']
  ],
  '1w6ts' => [
    1 => [650, 'Iron', 'static'], 2 => [750, 'Bronze', 'static'], 3 => [850, 'Silver', 'static'], 4 => [950, 'Gold', 'static']
  ],
  'multiclick' => [
    1 => [1160, 'Iron', 'static'], 2 => [1260, 'Bronze', 'static'], 3 => [1360, 'Silver', 'static'], 4 => [1460, 'Gold', 'static']
  ],
  'smoothbot' => [
    1 => [2300, 'Iron', 'precise'], 2 => [2500, 'Bronze', 'precise'], 3 => [3100, 'Silver', 'precise'], 4 => [3500, 'Gold', 'precise']
  ],
  'preciseorb' => [
    1 => [1300, 'Iron', 'precise'], 2 => [1600, 'Bronze', 'precise'], 3 => [1900, 'Silver', 'precise'], 4 => [2200, 'Gold', 'precise']
  ],
  'plaza' => [
    1 => [2150, 'Iron', 'reactive'], 2 => [2450, 'Bronze', 'reactive'], 3 => [2850, 'Silver', 'reactive'], 4 => [3050, 'Gold', 'reactive']
  ],
  'air' => [
    1 => [1900, 'Iron', 'reactive'], 2 => [2200, 'Bronze', 'reactive'], 3 => [2500, 'Silver', 'reactive'], 4 => [2800, 'Gold', 'reactive']
  ],
  'psalmts' => [
    1 => [620, 'Iron', 'speed'], 2 => [690, 'Bronze', 'speed'], 3 => [760, 'Silver', 'speed'], 4 => [830, 'Gold', 'speed']
  ],
  'skyts' => [
    1 => [780, 'Iron', 'speed'], 2 => [860, 'Bronze', 'speed'], 3 => [950, 'Silver', 'speed'], 4 => [1040, 'Gold', 'speed']
  ],
  'evats' => [
    1 => [450, 'Iron', 'evasive'], 2 => [510, 'Bronze', 'evasive'], 3 => [560, 'Silver', 'evasive'], 4 => [620, 'Gold', 'evasive']
  ],
  'bouncets' => [
    1 => [490, 'Iron', 'evasive'], 2 => [550, 'Bronze', 'evasive'], 3 => [610, 'Silver', 'evasive'], 4 => [680, 'Gold', 'evasive']
  ]
];

function save_rank($scenario, $score, $rank)
{
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
$replace = ['VT Pasu Rasp Novice', 'VT Bounceshot Novice', 'VT 1w6ts Rasp Novice', 'VT Multiclick 120 Novice', 'VT Smoothbot Novice', 'VT PreciseOrb Novice', 'VT Plaza Novice', 'VT Air Novice', 'VT psalmTS Novice', 'VT skyTS Novice', 'VT evaTS Novice', 'VT bounceTS Novice'];


?>

<head>
  <link rel="stylesheet" href="../styles/vt-s4.scss">
  <script src="https://unpkg.com/htmx.org@1.9.12" integrity="sha384-ujb1lZYygJmzgSwoxRggbCHcjc0rB2XoQrxeTUQyRjrOnlCoYta87iKBWq3EsdM2" crossorigin="anonymous"></script>

</head>

<body>


  <div class="tab-list" role="tablist">
    <button hx-get="../benchmarks/vt4_novice.php" class="selected" role="tab" aria-selected="true" aria-controls="#flex" hx-swap='outerHTML'>Tab 1</button>
    <button hx-get="../benchmarks/vt4_controller.php" role="tab" aria-selected="false" aria-controls="#flex" hx-swap='outerHTML'>Tab 2</button>
    <button hx-get="/tab3" role="tab" aria-selected="false" aria-controls="tab-content">Tab 3</button>
  </div>
  <div class="card">...</div>


  <form method="GET" id="my_form"></form>
  <div class='flex'>
    <span>Voltaic KvKs Easy Benchmarks S4 - Intermediate</span>
    <table id='tab-content'>
      <tr class='head'>
        <th>Scenario</th>
        <th>New High Score</th>
        <th>High Score</th>
        <th>Rank</th>
      </tr>
      <?php foreach ($scenarios as $scene) : ?>
        <tr>
          <th class='<?= $scores[$scene][1][2] ?>'><?= str_replace($scenarios, $replace, $scene) ?></th>
          <td><input type="number" name='<?= $scene ?>' form="my_form" /></td>
          <td> <?= $_SESSION[$scene] ?> </td>
          <td class='<?= $_SESSION[$scene . "_rank"] ?>'><?= $_SESSION[$scene . "_rank"] ?>
          <td>
        </tr>
      <?php endforeach; ?>

    </table>
    <button type="submit" form="my_form" class="sb">Apply Changes</button>

  </div>


</body>
