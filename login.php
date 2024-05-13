<?php
session_start();

// Database connection
$conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Login logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password === $row["password"]) {
            $_SESSION["user_id"] = $row["id"];
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid email or password";
        }
    } else {
        $error = "Invalid email or password";
    }
}
?>

<head>
    <link rel="stylesheet" href="styles/layouts/login.scss">
    <title>Login</title>
</head>

<body>
    <div class="box">
        <h2>Login</h2>
        <?php if (isset($error)) { ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label>Email:</label>
            <input type="email" name="email" required><br><br>
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