<?php
session_start();
include "../config/db.php";
if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/login.php");
    exit();
}

$id = $_GET["id"];
$sql = "DELETE FROM tasks WHERE id = $id AND user_id = {$_SESSION['user_id']}";

if ($conn->query($sql)) {
    header("Location: ../views/index.php");
} else {
    echo "Error: " . $conn->error;
}
?>
