<?php
session_start();
include 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        $message = "✅ Admin registered successfully! <a href='admin_login.php' style='text-decoration: none;'><br>Login here</a>";
    } else {
        $message = "❌ Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Ediokeff Foods-Register Admin</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="shortcut icon" href="./uploads/logo2.png" type="image/x-icon">
<style>
    body { font-family: Arial, sans-serif; background:#f4f4f4; display:flex; justify-content:center; align-items:center; height:100vh; margin:0; }
    .form-container { background:#fff; padding:30px; border-radius:12px; box-shadow:0 6px 20px rgba(0,0,0,0.5); width:320px; }
    h2 { text-align:center; margin-bottom:20px; }
    .input-group { position:relative; margin-bottom:20px; }
    .input-group i { position:absolute; left:10px; top:18px; color:#888; }
    .input-group input { width:85%; padding:14px 10px 14px 35px; border:1px solid #ccc; border-radius:6px; outline:none; }
    .input-group input:focus { border-color:#482d0a; box-shadow:0 0 4px rgba(0,123,255,0.4); }
    .input-group label { position:absolute; top:14px; left:35px; color:#888; pointer-events:none; transition:0.3s; }
    .input-group input:focus + label,
    .input-group input:not(:placeholder-shown) + label { top:-8px; left:30px; font-size:12px; color:#482d0a; background:#fff; padding:0 4px; }
    button { width:100%; padding:12px; border:none; background:#482d0a; color:#fff; border-radius:6px; font-size:16px; cursor:pointer; }
    button:hover { background:#f39c12; }
    p { text-align:center; margin-top:10px; }
</style>
</head>
<body>
    <div class="form-container">
        <h2>Register Admin</h2>
        <p style="color:green;"><?= $message ?></p>
        <form method="POST">
            <div class="input-group">
                <i class="fa fa-user"></i>
                <input type="text" name="username" placeholder=" " required>
                <label>Username</label>
            </div>
            <div class="input-group">
                <i class="fa fa-lock"></i>
                <input type="password" name="password" placeholder=" " required>
                <label>Password</label>
            </div>
            <button type="submit">Register</button>
        </form>
        <p style="text-decoration: none; color: #888;">Already registered? <a href="admin_login.php" style="text-decoration: none; color: #888;">Login</a></p>
    </div>
</body>
</html>
