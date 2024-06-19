<?php
session_start();
$conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Registration logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $confirmPassword = $_POST["confirmPassword"];

  $hashPassword = password_hash($password, PASSWORD_DEFAULT);

  // Check if email already exists
  $stmt = $conn->prepare("SELECT * FROM users WHERE name=?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $error = "User with this name already exists";
  } else if ($password != $confirmPassword) {
    $error = "Passwords do not match";
  } else {
    // Insert new user
    $stmt = $conn->prepare("INSERT INTO users (password, name) VALUES (?, ?)");
    $stmt->bind_param("ss", $hashPassword, $username);
    $stmt->execute();
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