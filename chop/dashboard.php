<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}
?>

<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard-Ediokeff Foods</title>
  <link rel="shortcut icon" href="./uploads/logo2.png" type="image/x-icon">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f8f9fa;
      margin: 0;
      padding: 0;
  height: 100vh;
  width: 100vw;
  overflow-x: hidden;
}

body::before {
  content: "";
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: url('uploads/stone-design.jpg') center center no-repeat;
  background-size: cover;   /* ensures full screen and responsive */
  filter: brightness(50%);  /* dim overlay */
  z-index: -1;
}


    /* ===== TOP NAVBAR ===== */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #f39c12;
      color: #fff;
      padding: 20px 40px;   /* increased padding for bigger space */
    }
    .navbar-left {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    .navbar-left img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
    }
    .navbar-left h1 {
      font-size: 24px;
      margin: 0;
    }

    .navbar-right a {
      margin-left: 20px;
      color: #fff;
      text-decoration: none;
      font-weight: bold;
      padding: 8px 14px;
      border-radius: 6px;
      transition: background 0.3s ease;
    }
    .navbar-right a:hover {
      background: #000;
    }

    /* ===== DASHBOARD CARDS ===== */
    .admin-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      padding: 60px 40px;   /* added more top padding */
    }
    .admin-card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      padding: 30px;
      text-align: center;
      transition: transform 0.2s ease;
    }
    .admin-card:hover {
      transform: translateY(-5px);
    }
    .admin-card h3 {
      margin-bottom: 15px;
      color: #333;
    }
    .admin-card a {
      display: inline-block;
      padding: 10px 20px;
      background: #482d0a;
      color: #fff;
      text-decoration: none;
      border-radius: 8px;
      transition: background 0.2s ease;
    }
    .admin-card a:hover {
      background: #f39c12;
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <div class="navbar">
    <div class="navbar-left">
      <img src="./uploads/logo2.png" alt="Logo"> <!-- replace with your logo -->
      <h1>Admin Dashboard</h1>
    </div>
    <div class="navbar-right">
      <a href="admin_register.php">➕ Add Admin</a>
      <a href="logout.php">🚪 Logout</a>
    </div>
  </div>

  <!-- DASHBOARD CARDS -->
  <div class="admin-container">
    <div class="admin-card">
      <h3>Add Food</h3>
      <p>Add new items to the menu</p>
      <a href="add_food.php">Add</a>
    </div>

    <div class="admin-card">
      <h3>Delete Food</h3>
      <p>Remove food items from menu</p>
      <a href="delete_food.php">Delete</a>
    </div>

    <div class="admin-card">
      <h3>View Orders</h3>
      <p>See all customer orders</p>
      <a href="view_orders.php">View</a>
    </div>

    <div class="admin-card">
      <h3>View Messages</h3>
      <p>Check customers messages</p>
      <a href="view_messages.php">Check</a>
    </div>
  </div>

</body>
</html>
