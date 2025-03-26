<?php
session_start();
include "../config/db.php";

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Fetch username from the database
$stmt_user = $conn->prepare("SELECT name FROM users WHERE id = ?");
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();
$username = $user["name"] ?? "User"; // Default to "User" if no username is found

// Fetch tasks for the logged-in user
$stmt = $conn->prepare("SELECT * FROM tasks WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Database error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($username); ?>'s To-Do List</title>
    <link rel="stylesheet" href="../assets/style1.css">
</head>
<body>
    <a href="../auth/logout.php" class="signout">Sign out</a>
    <div class="title"><?php echo htmlspecialchars($username); ?>'s TO-DO LIST</div>
    <div class="container">
        <!-- Form to add a new task -->
        <form action="../tasks/add_task.php" method="POST">
            <div class="input-container">
                <input type="text" name="task" placeholder="Add your task" required>
                <button type="submit" name="add">ADD</button>
            </div>
        </form>

        <!-- Display tasks -->
        <ul id="taskList">
            <?php if ($result->num_rows > 0) { ?>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <li>
                        <?= htmlspecialchars($row["task"]) ?> - 
                        <span class="status-<?= htmlspecialchars($row["status"]) ?>">
                            <?= htmlspecialchars($row["status"]) ?>
                        </span>
                        <a href="../tasks/update_task.php?id=<?= htmlspecialchars($row['id']) ?>">✔</a>
                        <a href="../tasks/delete_task.php?id=<?= htmlspecialchars($row['id']) ?>">✖</a>
                    </li>
                <?php } ?>
            <?php } else { ?>
                <li>No tasks found. Add a new task!</li>
            <?php } ?>
        </ul>
    </div>
</body>
</html>
