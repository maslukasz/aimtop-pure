<?php
session_start();

echo $_SESSION['id'];
// Database connection
$host = "192.168.0.134";
$username = "bot";
$password = "bot";
$database = "test";

$conn = new mysqli($host, $username, $password, $database);
echo $conn->get_warnings();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$email = 'lukasz@gmail.com';
$q = $conn->query("SELECT * FROM users WHERE email='" . $email . "'");
echo $q->num_rows;
echo json_encode($q->fetch_all());

// Login logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    echo $email;

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo json_encode($result);
    if (!empty($result)) {
        if ($password === $row['password']) {
            // header("Location: index.php");
            $_SESSION['id'] = $row['id'];
        }
    }
    // if ($result->num_rows > 0) {
    //     $row = $result->fetch_assoc();
    //     if (password_verify($password, $row["password"])) {
    //         $_SESSION["user_id"] = $row["id"];
    //         header("Location: index.php");
    //         exit();
    //     } else {
    //         $error = "Invalid email or password";
    //     }
    // } else {
    //     $error = "Invalid email or password";
    // }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
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

    // Check if user is logged in
    <?php
    if (isset($_SESSION["user_id"])) {
        header("Location: dashboard.php");
        exit();
    } ?>

</body>

</html>