<?php

$rasp = '';
$bounceshot = '';
$onew5ts = '';
$multiclick = '';
$anglestrafe = '';
$smoothbot = '';
$preciseorb = '';
$plaza = '';
$air = '';
$patstrafe = '';
$airstrafe = '';
$psalmts = '';
$skyts = '';
$evats = '';
$bouncets = '';

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

//  VT PreciseOrb Intermediate
if ($_GET['preciseorb'] >= 1650 && $_GET['preciseorb'] < 2050) {
  $preciseorb = 'Platinum';
} elseif ($_GET['preciseorb'] >= 2050 && $_GET['preciseorb'] < 2450) {
  $preciseorb = 'Diamond';
} elseif ($_GET['preciseorb'] >= 2450 && $_GET['preciseorb'] < 2850) {
  $preciseorb = 'Jade';
} elseif ($_GET['preciseorb'] >= 2850) {
  $preciseorb = 'Master';
}

//  VT Plaza Intermediate
if ($_GET['plaza'] >= 2680 && $_GET['plaza'] < 2980) {
  $plaza = 'Platinum';
} elseif ($_GET['plaza'] >= 2980 && $_GET['plaza'] < 3280) {
  $plaza = 'Diamond';
} elseif ($_GET['plaza'] >= 3280 && $_GET['plaza'] < 3530) {
  $plaza = 'Jade';
} elseif ($_GET['plaza'] >= 3530) {
  $plaza = 'Master';
}

//  VT Air Intermediate
if ($_GET['air'] >= 2450 && $_GET['air'] < 2700) {
  $air = 'Platinum';
} elseif ($_GET['air'] >= 2700 && $_GET['air'] < 2950) {
  $air = 'Diamond';
} elseif ($_GET['air'] >= 2950 && $_GET['air'] < 3200) {
  $air = 'Jade';
} elseif ($_GET['air'] >= 3200) {
  $air = 'Master';
}

//  VT Air Intermediate
if ($_GET['patstrafe'] >= 2260 && $_GET['patstrafe'] < 2620) {
  $patstrafe = 'Platinum';
} elseif ($_GET['patstrafe'] >= 2620 && $_GET['patstrafe'] < 2800) {
  $patstrafe = 'Diamond';
} elseif ($_GET['patstrafe'] >= 2800 && $_GET['patstrafe'] < 3050) {
  $patstrafe = 'Jade';
} elseif ($_GET['patstrafe'] >= 3050) {
  $patstrafe = 'Master';
}

//  VT AirStrafe Intermediate
if ($_GET['airstrafe'] >= 2800 && $_GET['airstrafe'] < 3000) {
  $airstrafe = 'Platinum';
} elseif ($_GET['airstrafe'] >= 3000 && $_GET['airstrafe'] < 3200) {
  $airstrafe = 'Diamond';
} elseif ($_GET['airstrafe'] >= 3200 && $_GET['airstrafe'] < 3400) {
  $airstrafe = 'Jade';
} elseif ($_GET['airstrafe'] >= 3400) {
  $airstrafe = 'Master';
}

//  VT psalmTS Intermediate
if ($_GET['psalmts'] >= 810 && $_GET['psalmts'] < 880) {
  $psalmts = 'Platinum';
} elseif ($_GET['psalmts'] >= 880 && $_GET['psalmts'] < 950) {
  $psalmts = 'Diamond';
} elseif ($_GET['psalmts'] >= 950 && $_GET['psalmts'] < 1020) {
  $psalmts = 'Jade';
} elseif ($_GET['psalmts'] >= 1020) {
  $psalmts = 'Master';
}

//  VT skyTS Intermediate
if ($_GET['skyts'] >= 1030 && $_GET['skyts'] < 1130) {
  $skyts = 'Platinum';
} elseif ($_GET['skyts'] >= 1130 && $_GET['skyts'] < 1220) {
  $skyts = 'Diamond';
} elseif ($_GET['skyts'] >= 1220 && $_GET['skyts'] < 1300) {
  $skyts = 'Jade';
} elseif ($_GET['skyts'] >= 1300) {
  $skyts = 'Master';
}

//  VT evaTS Intermediate
if ($_GET['evats'] >= 550 && $_GET['evats'] < 650) {
  $evats = 'Platinum';
} elseif ($_GET['evats'] >= 600 && $_GET['evats'] < 650) {
  $evats = 'Diamond';
} elseif ($_GET['evats'] >= 650 && $_GET['evats'] < 700) {
  $evats = 'Jade';
} elseif ($_GET['evats'] >= 700) {
  $evats = 'Master';
}

//  VT bounceTS Intermediate
if ($_GET['bouncets'] >= 630 && $_GET['bouncets'] < 650) {
  $bouncets = 'Platinum';
} elseif ($_GET['bouncets'] >= 670 && $_GET['bouncets'] < 650) {
  $bouncets = 'Diamond';
} elseif ($_GET['bouncets'] >= 710 && $_GET['bouncets'] < 760) {
  $bouncets = 'Jade';
} elseif ($_GET['bouncets'] >= 760) {
  $bouncets = 'Master';
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
        <td class='bg-green-500'> VT Smoothbot Intermediate</td>
        <td><input type="text" name="smoothbot" form="my_form" /></td>
        <td><?= $smoothbot ?></td>
      </tr>
      <tr>
        <td class='bg-green-500'> VT PreciseOrb Intermediate</td>
        <td><input type="text" name="preciseorb" form="my_form" /></td>
        <td><?= $preciseorb ?></td>
      </tr>
      <tr>
        <td class='bg-blue-500'> VT Plaza Intermediate</td>
        <td><input type="text" name="plaza" form="my_form" /></td>
        <td><?= $plaza ?></td>
      </tr>
      <tr>
        <td class='bg-blue-500'> VT Air Intermediate</td>
        <td><input type="text" name="air" form="my_form" /></td>
        <td><?= $air ?></td>
      </tr>
      <tr>
        <td class='bg-pink-500'> VT PatStrafe Intermediate</td>
        <td><input type="text" name="patstrafe" form="my_form" /></td>
        <td><?= $patstrafe ?></td>
      </tr>
      <tr>
        <td class='bg-pink-500'> VT AirStrafe Intermediate</td>
        <td><input type="text" name="airstrafe" form="my_form" /></td>
        <td><?= $airstrafe ?></td>
      </tr>
      <tr>
        <td class='bg-red-500'> VT psalmTS Intermediate</td>
        <td><input type="text" name="psalmts" form="my_form" /></td>
        <td><?= $psalmts ?></td>
      </tr>
      <tr>
        <td class='bg-red-500'> VT skyTS Intermediate</td>
        <td><input type="text" name="skyts" form="my_form" /></td>
        <td><?= $skyts ?></td>
      </tr>
      <tr>
        <td class='bg-purple-700'> VT evaTS Intermediate</td>
        <td><input type="text" name="evats" form="my_form" /></td>
        <td><?= $evats ?></td>
      </tr>
      <tr>
        <td class='bg-purple-700'> VT bounceTS Intermediate</td>
        <td><input type="text" name="bouncets" form="my_form" /></td>
        <td><?= $bouncets ?></td>
      </tr>
    </table>
    <button type="submit" form="my_form">ok</button>
  </div>

</body>