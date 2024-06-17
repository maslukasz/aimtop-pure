<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  // User is not logged in, redirect to login page
  header('Location: ../login.php');
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
    1 => [750, 'Platinum', 'dynamic'], 2 => [850, 'Diamond', 'dynamic'], 3 => [950, 'Jade', 'dynamic'], 4 => [1050, 'Master', 'dynamic']
  ],
  'bounceshot' => [
    1 => [600, 'Platinum', 'dynamic'], 2 => [700, 'Diamond', 'dynamic'], 3 => [800, 'Jade', 'dynamic'], 4 => [900, 'Master', 'dynamic']
  ],
  'onew5ts' => [
    1 => [1000, 'Platinum', 'static'], 2 => [1100, 'Diamond', 'static'], 3 => [1200, 'Jade', 'static'], 4 => [1300, 'Master', 'static']
  ],
  'multiclick' => [
    1 => [1360, 'Platinum', 'static'], 2 => [1460, 'Diamond', 'static'], 3 => [1560, 'Jade', 'static'], 4 => [1660, 'Master', 'static']
  ],
  'anglestrafe' => [
    1 => [740, 'Platinum', 'strafe'], 2 => [830, 'Diamond', 'strafe'], 3 => [920, 'Jade', 'strafe'], 4 => [1000, 'Master', 'strafe']
  ],
  'arcstrafe' => [
    1 => [660, 'Platinum', 'strafe'], 2 => [750, 'Diamond', 'strafe'], 3 => [850, 'Jade', 'strafe'], 4 => [940, 'Master', 'strafe']
  ],
  'smoothbot' => [
    1 => [3050, 'Platinum', 'precise'], 2 => [3450, 'Diamond', 'precise'], 3 => [3850, 'Jade', 'precise'], 4 => [4250, 'Master', 'precise']
  ],
  'preciseorb' => [
    1 => [1650, 'Platinum', 'precise'], 2 => [2050, 'Diamond', 'precise'], 3 => [2450, 'Jade', 'precise'], 4 => [2850, 'Master', 'precise']
  ],
  'plaza' => [
    1 => [2680, 'Platinum', 'reactive'], 2 => [2980, 'Diadmond', 'reactive'], 3 => [3280, 'Jade', 'reactive'], 4 => [3530, 'Master', 'reactive']
  ],
  'air' => [
    1 => [2450, 'Platinum', 'reactive'], 2 => [2700, 'Diamond', 'reactive'], 3 => [2950, 'Jade', 'reactive'], 4 => [3200, 'Master', 'reactive']
  ],
  'patstrafe' => [
    1 => [2260, 'Platinum', 'strafe'], 2 => [2620, 'Diamond', 'strafe'], 3 => [2800, 'Jade', 'strafe'], 4 => [3050, 'Master', 'strafe']
  ],
  'airstrafe' => [
    1 => [2800, 'Platinum', 'strafe'], 2 => [3000, 'Diamond', 'strafe'], 3 => [320, 'Jade', 'strafe'], 4 => [3400, 'Master', 'strafe']
  ],
  'psalmts' => [
    1 => [810, 'Platinum', 'speed'], 2 => [880, 'Diamond', 'speed'], 3 => [950, 'Jade', 'speed'], 4 => [1020, 'Master', 'speed']
  ],
  'skyts' => [
    1 => [1030, 'Platinum', 'speed'], 2 => [1130, 'Diamond', 'speed'], 3 => [1220, 'Jade', 'speed'], 4 => [1300, 'Master', 'speed']
  ],
  'evats' => [
    1 => [550, 'Platinum', 'evasive'], 2 => [600, 'Diamond', 'evasive'], 3 => [650, 'Jade', 'evasive'], 4 => [700, 'Master', 'evasive']
  ],
  'bouncets' => [
    1 => [630, 'Platinum', 'evasive'], 2 => [670, 'Diamond', 'evasive'], 3 => [710, 'Jade', 'evasive'], 4 => [700, 'Master', 'evasive']
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
  $q = "SELECT * FROM vt_s4 WHERE user_id = {$_SESSION['user_id']}";
  $res = mysqli_query($conn, $q);
  foreach (mysqli_fetch_assoc($res) as $key => $value) {
    $_SESSION[$key] = $value;
  }
}

$replace = [
  'VT Pasu Rasp Intermediate',
  'VT Bounceshot Intermediate',
  'VT 1w5s Rasp Intermediate',
  'VT Multiclick 120 Intermediate',
  'VT AngleStrafe Intermediate',
  'VT ArcStrafe Intermediate',
  'VT Smoothbot Intermediate',
  'VT PreciseOrb Intermediate',
  'VT Plaza Intermediate',
  'VT Air Intermediate',
  'VT PatStrafe Intermediate',
  'VT AirStrafe Intermediate',
  'VT psalmTS Intermediate',
  'VT skyTS Intermediate',
  'VT evaTS Intermediate',
  'VT bounceTS Intermediate'
];

?>

<head>
  <link rel="stylesheet" href="../styles/vt-s4.scss">
  <!-- <link rel="stylesheet" href="../styles/components/navbar.scss"> -->


  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<?php require_once '../components/layout/navbar.php'; ?>


<body class='bd'>

  <form method="GET" id="my_form"></form>
  <div class='tab-container'>
    <span>Voltaic KvKs Benchmarks S4 - Intermediate</span>
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