<?php include 'db.php'; ?>
<!-- <!DOCTYPE html>
<html>
<head>
  <title>Delete Food</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="sidebar">
      <h2>Admin Panel</h2>
      <ul>
        <li><a href="add_food.php">Add Food</a></li>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="index.php">Frontend</a></li>
        <li><a href="delete_food.php">Delete Food</a></li>
        <li><a href="view_orders.php">View Orders</a></li>
      </ul>
    </div>
    <div class="main">
      <h1>Delete Food</h1>
      <ul>
        ?php
        $result = $conn->query("SELECT * FROM foods");
        while ($row = $result->fetch_assoc()) {
          echo "<li>{$row['description']} - ₦{$row['amount']} <a href='delete_food.php?id={$row['id']}'>[Delete]</a></li>";
        }
        if (isset($_GET['id'])) {
          $id = $_GET['id'];
          $conn->query("DELETE FROM foods WHERE id=$id");
          header("Location: delete_food.php");
        }
        ?>
      </ul>
    </div>
  </div>
</body>
</html> -->



<?php
//include("../db.php"); // adjust if needed

$message = "";

// Handle delete request
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    
    // Get food image before deleting
    $stmt = $conn->prepare("SELECT image FROM foods WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($image);
    $stmt->fetch();
    $stmt->close();

    // Delete from DB
    $stmt = $conn->prepare("DELETE FROM foods WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        // Remove image file
        if ($image && file_exists($image)) {
            unlink($image);
        }
        $message = "✅ Food item deleted successfully!";
    } else {
        $message = "❌ Failed to delete food item.";
    }
    $stmt->close();
}

// Fetch all foods
$result = $conn->query("SELECT * FROM foods ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Delete Food-Ediokeff Foods</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="shortcut icon" href="./uploads/logo2.png" type="image/x-icon">
  <style>
    .food-list { display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px; }
    .food-item {
      border: 1px solid #ddd;
      padding: 10px;
      border-radius: 8px;
      width: 200px;
      text-align: center;
      background: #fafafa;
    }
    .food-item img { max-width: 100%; border-radius: 6px; }
    .delete-btn {
      display: inline-block;
      margin-top: 8px;
      padding: 6px 12px;
      background: crimson;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
    }
    .delete-btn:hover { background: darkred; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Manage / Delete Foods</h1>
    <p><a href="dashboard.php" style="text-decoration: none; color: #000; float: right; padding-bottom: 3%;">⬅ Back to Admin Dashboard</a></p>

    <?php if ($message): ?>
      <p style="color: green;"><?= $message ?></p>
    <?php endif; ?>

    <div class="food-list">
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="food-item">
          <img src="<?= $row['image'] ?>" alt="<?= htmlspecialchars($row['name']) ?>">
          <h3><?= htmlspecialchars($row['name']) ?></h3>
          <p>₦<?= number_format($row['price'], 2) ?></p>
          <a href="?delete=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
        </div>
      <?php endwhile; ?>
    </div>

    <p><a href="index.php" style="text-decoration: none; color: #000;">⬅ Back to Home Page</a></p>
  </div>
</body>
</html>
