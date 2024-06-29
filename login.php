<?php
session_start();

// Database pdoection
require 'src/database/connection.php';

// Login logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $password = $_POST["password"];

  $stmt = $pdo->prepare("SELECT * FROM users WHERE name=:name");
  // $stmt->bind_param("s", $name);
  $stmt->execute(['name' => $name]);
  $result = $stmt->fetchAll()[0];
  $r = $result;
  print_r($result['password']);
  if ($result != []) {
    if (password_verify($password, $r['password'])) {
      $_SESSION["user_id"] = $r["id"];
      header("Location: index.php");
      exit();
    } else {
      $error = "Invalid username or password";
    }
  } else {
    $error = "Invalid username or password";
  }
}
?>

<head>
  <link rel="stylesheet" href="styles/layouts/login.scss">
  <title>Login</title>
</head>

<body>
  <div class="box">
    <h2>Login to aimtop</h2>
    <?php if (isset($error)) { ?>
      <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <label>Username:</label>
      <input type="text" name="name" minlength="4" required><br><br>
      <label>Password:</label>
      <input type="password" name="password" required><br><br>
      <input type="submit" value="Login">
    </form>


    <br><br>
    <a href="https://discord.gg/QJauGpg7zg" target="_blank" class="buttons">
      <button class="btn-pastel-blue">Discord Server</button>
    </a>
    <a href="register.php" class="buttons">
      <button class="btn-pastel-blue">Register</button>
    </a>
  </div>

</body>