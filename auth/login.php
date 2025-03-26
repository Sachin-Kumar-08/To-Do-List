<?php
session_start(); // Start the session
include "../config/db.php";

$error = ""; // Initialize error variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            header("Location: ../views/index.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User not found!";
    }
    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>TODO-LIST</h1>
    <div class="container">
        <h2>Login</h2>

        <?php if (!empty($error)): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="" method="post">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>

        <div class="signup-link">
            Don't have an account? <a href="register.php">Sign Up</a>
        </div>
    </div>
</body>
</html>