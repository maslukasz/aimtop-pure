<?php

$scores = [
  'rasp' => [550 => 'Iron', 600 => 'Gold']
];

$i = 0;

foreach ($scores as $value => $key) {
  $i++;
  print_r($_GET);
  echo count($scores);
  foreach ($key as $rank => $score) {
    echo $score;

    if ($rank == 550) {
      echo 'xd';
    }
  }
}
