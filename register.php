<?php
session_start();

// Database connection
$conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Registration logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    // Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Email already exists";
    } else if ($password != $confirmPassword) {
        $error = "Passwords do not match";
    } else {
        // Insert new user
        $name = 'czarek';
        $stmt = $conn->prepare("INSERT INTO users (email, password, name) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $password, $name);
        $stmt->execute();
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles/css/login.css">
    <title>Register</title>
</head>

<body>
    <div class="box">
        <h2>Register</h2>
        <?php if (isset($error)) { ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label>Email:</label>
            <input type="email" name="email" required><br><br>
            <label>Password:</label>
            <input type="password" name="password" required><br><br>
            <label>Confirm Password:</label>
            <input type="password" name="confirmPassword" required><br><br>
            <input type="submit" value="Register">
        </form>

        <br><br>
        <a href="https://discord.gg/QJauGpg7zg" target="_blank" class="buttons">
            <button class="btn-pastel-pink">Discord Server</button>
        </a>
        <a href="login.php" class="buttons">
            <button class="btn-pastel-blue">Login</button>
        </a>
    </div>

</body>

</html>