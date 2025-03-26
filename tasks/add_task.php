<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task = trim($_POST['task']);
    $user_id = $_SESSION["user_id"];

    $stmt = $conn->prepare("INSERT INTO tasks (user_id, task) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $task);
    $stmt->execute();

    header("Location: ../views/index.php");
    exit();
}
?>