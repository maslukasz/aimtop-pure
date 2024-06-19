<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  // User is not logged in, redirect to login page
  header('Location: ../../login.php');
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
  'onew6ts' => [
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
  $query = $conn->query("SELECT {$scenario}, {$scenario}_rank FROM vt_s4_novice WHERE user_id = {$_SESSION['user_id']}");
  $result = $query->fetch_all();

  if (empty($result)) {
    $conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
    $query = $conn->query("INSERT INTO vt_s4_novice (user_id, {$scenario}, {$scenario}_rank) VALUES ({$_SESSION['user_id']}, {$scenario}, '{$scenario}_rank')");
  } else {
    $conn->query("UPDATE vt_s4_novice SET {$scenario} = '{$score}', {$scenario}_rank = '{$rank}' WHERE user_id = {$_SESSION['user_id']}");
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
  $q = "SELECT * FROM vt_s4_novice WHERE user_id = {$_SESSION['user_id']}";
  $res = mysqli_query($conn, $q);
  foreach (mysqli_fetch_assoc($res) as $key => $value) {
    $_SESSION[$key] = $value;
  }
}

$replace = ['VT Pasu Rasp Novice', 'VT Bounceshot Novice', 'VT 1w6ts Rasp Novice', 'VT Multiclick 120 Novice', 'VT Smoothbot Novice', 'VT PreciseOrb Novice', 'VT Plaza Novice', 'VT Air Novice', 'VT psalmTS Novice', 'VT skyTS Novice', 'VT evaTS Novice', 'VT bounceTS Novice'];

?>

<head>
  <link rel="stylesheet" href="../../styles/vt-s4.scss">
  <!-- <link rel="stylesheet" href="../../styles/components/navbar.scss"> -->

  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<?php require_once '../../components/layout/navbar.php'; ?>

<body>


  <form method="GET" id="my_form"></form>
  <div class='tab-container'>
    <span>Voltaic KvKs Benchmarks S4 - Novice</span>
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