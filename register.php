<?php
session_start();

require 'src/database/connection.php';
// Check connectio// Registration logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $confirmPassword = $_POST["confirmPassword"];

  $hashPassword = password_hash($password, PASSWORD_DEFAULT);

  $stmt = $pdo->prepare("SELECT * FROM users WHERE name=:name");
  $stmt->execute(['name' => $username]);
  $result = $stmt->fetchAll()[0];
  $r = $result;

  /*
  EDUCATION NOTES:
  fetchAll() return [] if null
  fetch() return false if null
  */

  if ($result != []) {
    $error = "User with this name already exists";
  } else if ($password != $confirmPassword) {
    $error = "Passwords do not match";
  } else {
    // Insert new user
    $stmt = $pdo->prepare("INSERT INTO users (password, name) VALUES (:password, :username)");
    $stmt->execute(['password' => $hashPassword, 'username' => $username]);
    header("Location: index.php");
    exit();
  }
}
?>

<head>
  <link rel="stylesheet" href="styles/layouts/login.scss">
  <title>Login</title>
</head>

<body>
  <div class="box">
    <h2>Register</h2>
    <?php if (isset($error)) { ?>
      <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <label>Username:</label>
      <input type="text" name="username" required><br><br>
      <label>Password:</label>
      <input type="password" name="password" required><br><br>
      <label>Confirm Password:</label>
      <input type="password" name="confirmPassword" required><br><br>
      <input type="submit" value="Register">
    </form>

    <br><br>
    <a href="https://discord.gg/QJauGpg7zg" target="_blank" class="buttons">
      <button class="btn-pastel-blue">Discord Server</button>
    </a>
    <a href="login.php" class="buttons">
      <button class="btn-pastel-blue">Login</button>
    </a>
  </div>

</body>