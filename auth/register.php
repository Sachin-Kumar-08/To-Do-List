<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql)) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
    <link rel="stylesheet" href="../assets/style.css"> <!-- Link to CSS -->
</head>
<body>
    <h1>TODO-LIST</h1>
    <div class="container">
        <h2>Sign Up</h2>


        <form action=" " method="post">
            <input type="text" name="name" placeholder="User Name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Sign Up</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="login.php">Sign in</a>
        </div>
    </div>
</body>
</html>
