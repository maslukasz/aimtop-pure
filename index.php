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



?>

<head>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/htmx.org@1.9.12" integrity="sha384-ujb1lZYygJmzgSwoxRggbCHcjc0rB2XoQrxeTUQyRjrOnlCoYta87iKBWq3EsdM2" crossorigin="anonymous"></script>
  <title>VT S4 INTER</title>
</head>

<?php require_once 'components/layout/navbar.php' ?>

<body>

  <div class='btns'>
    <button>asd</button>

    <button hx-get='benchmarks/vt4_controller.php' hx-target='#r' hx-swap='innerHTML'>test</button>
  </div>



  <div class='tr'>

  </div>

</body>
