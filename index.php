<?php

$rasp = '';
$bounceshot = '';
$onew5ts = '';
$multiclick = '';
$anglestrafe = '';
$smoothbot = '';

//  VT Pasu Rasp Intermediate
if ($_GET['rasp'] >= 750 && $_GET['rasp'] < 850 ) {
  $rasp = 'Platinum';
} elseif ($_GET['rasp'] >= 850 && $_GET['rasp'] < 950 ) {
  $rasp = 'Diamond';
} elseif ($_GET['rasp'] >= 950  && $_GET['rasp'] < 1050 ) {
  $rasp = 'Jade';
} elseif ($_GET['rasp'] >= 1050) {
  $rasp = 'Master';
}

// VT Bounceshot Intermediate
if ($_GET['bounceshot'] >= 600 && $_GET['bounceshot'] < 700) {
  $bounceshot = 'Platinum';
} elseif ($_GET['bounceshot'] >= 700 && $_GET['bounceshot'] < 800) {
  $bounceshot = 'Diamond';
} elseif ($_GET['bounceshot'] >= 800 && $_GET['bounceshot'] < 900) {
  $bounceshot = 'Jade';
} elseif ($_GET['bounceshot'] >= 900) {
  $bounceshot = 'Master';
}

//  VT 1w5ts Rasp Novice
if ($_GET['onew5ts'] >= 1000 && $_GET['onew5ts'] < 1100) {
  $onew5ts = 'Platinum';
} elseif ($_GET['onew5ts'] >= 1100 && $_GET['onew5ts'] < 1200) {
  $onew5ts = 'Diamond';
} elseif ($_GET['onew5ts'] >= 1200 && $_GET['onew5ts'] < 1300) {
  $onew5ts = 'Jade';
} elseif ($_GET['onew5ts'] >= 1300) {
  $onew5ts = 'Master';
}

//  VT Multiclick 120 Intermediate
if ($_GET['multiclick'] >= 1360 && $_GET['multiclick'] < 1460) {
  $multiclick = 'Platinum';
} elseif ($_GET['multiclick'] >= 1460 && $_GET['multiclick'] < 1560) {
  $multiclick = 'Diamond';
} elseif ($_GET['multiclick'] >= 1560 && $_GET['multiclick'] < 1660) {
  $multiclick = 'Jade';
} elseif ($_GET['multiclick'] >= 1660) {
  $multiclick = 'Master';
}

//  VT AngleStrafe Intermediate
if ($_GET['anglestrafe'] >= 660 && $_GET['anglestrafe'] < 750) {
  $anglestrafe = 'Platinum';
} elseif ($_GET['anglestrafe'] >= 750 && $_GET['anglestrafe'] < 850) {
  $anglestrafe = 'Diamond';
} elseif ($_GET['anglestrafe'] >= 850 && $_GET['anglestrafe'] < 940) {
  $anglestrafe = 'Jade';
} elseif ($_GET['anglestrafe'] >= 940) {
  $anglestrafe = 'Master';
}

//  VT Smoothbot Intermediate
if ($_GET['smoothbot'] >= 3050 && $_GET['smoothbot'] < 3450) {
  $smoothbot = 'Platinum';
} elseif ($_GET['smoothbot'] >= 3450 && $_GET['smoothbot'] < 3850) {
  $smoothbot = 'Diamond';
} elseif ($_GET['smoothbot'] >= 3850 && $_GET['smoothbot'] < 4250) {
  $smoothbot = 'Jade';
} elseif ($_GET['smoothbot'] >= 4250) {
  $smoothbot = 'Master';
}


?>

<head>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <form method="GET" id="my_form"></form>

  <div class='ml-5'>
    <table class='bg-black text-white/60'>
      <tr>
        <th>Scenario</th>
        <th>High Score</th>
        <th>Rank</th>
      </tr>
      <tr>
        <td class='bg-yellow-500'> VT Pasu Rasp Intermediate</td>
        <td><input type="text" name="rasp" form="my_form" /></td>
        <td><?= $rasp ?></td>
      </tr>
      <tr>
        <td class='bg-yellow-500'> VT Bounceshot Intermediate</td>
        <td><input type="text" name="bounceshot" form="my_form" /></td>
        <td><?= $bounceshot ?></td>
      </tr>
      <tr>
        <td class='bg-red-500'> VT 1w5s Rasp Intermediate</td>
        <td><input type="text" name="onew5ts" form="my_form" /></td>
        <td><?= $onew5ts ?></td>
      </tr>
      <tr>
        <td class='bg-red-500'> VT Multiclick 120 Intermediate</td>
        <td><input type="text" name="multiclick" form="my_form" /></td>
        <td><?= $multiclick ?></td>
      </tr>
      <tr>
        <td class='bg-pink-500'> VT AngleStrafe Intermediate</td>
        <td><input type="text" name="anglestrafe" form="my_form" /></td>
        <td><?= $anglestrafe ?></td>
      </tr>
      <tr>
        <td class='bg-pink-500'> VT ArcStrafe Intermediate</td>
        <td><input type="text" name="arcstrafe" form="my_form" /></td>
        <td><?= $arcstrafe ?></td>
      </tr>
      <tr>
        <td class='bg-red-500'> VT Smoothbot Intermediate</td>
        <td><input type="text" name="smoothbot" form="my_form" /></td>
        <td><?= $smoothbot ?></td>
      </tr>
    </table>
    <button type="submit" form="my_form">ok</button>
  </div>

</body>