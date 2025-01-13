<?php
include 'db_connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if admin
    $sql_admin = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
    $admin_result = $conn->query($sql_admin);
    if ($admin_result->num_rows > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = 'admin';
        header("Location: dashboard.php");
        exit();
    }

    // Check if user
    $sql_user = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $user_result = $conn->query($sql_user);
    if ($user_result->num_rows > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = 'user';
        header("Location: user_dashboard.php");
        exit();
    }

    echo "Invalid login credentials.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        <form method="POST" class="space-y-4">
            <input type="text" name="username" placeholder="Username" class="w-full px-4 py-2 border rounded" required>
            <input type="password" name="password" placeholder="Password" class="w-full px-4 py-2 border rounded" required>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Login</button>
        </form>
    </div>
</body>
</html>
