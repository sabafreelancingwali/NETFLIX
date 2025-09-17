<?php
// login.php
session_start();
if (isset($_SESSION['user_id'])) {
    echo "<script>location.href = 'index.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body { background-color: #141414; color: #fff; font-family: 'Helvetica Neue', sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        form { background: #000; padding: 40px; border-radius: 10px; width: 300px; }
        input { display: block; width: 100%; margin: 10px 0; padding: 10px; background: #333; border: none; color: #fff; }
        button { background: #E50914; color: #fff; border: none; padding: 10px; width: 100%; cursor: pointer; }
        button:hover { background: #f40612; }
        @media (max-width: 768px) { form { width: 80%; } }
    </style>
</head>
<body>
    <form id="loginForm">
        <h2>Login</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <p>No account? <a href="signup.php" style="color: #E50914;">Signup</a></p>
    </form>
    <script>
        document.getElementById('loginForm').onsubmit = function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('process_login.php', { method: 'POST', body: formData })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.href = 'index.php';
                    } else {
                        alert(data.error);
                    }
                });
        };
    </script>
</body>
</html>
