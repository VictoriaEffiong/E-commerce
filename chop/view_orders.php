<?php include 'db.php'; ?>






<?php
// include("../db.php"); // adjust path if needed

$message = "";

// Handle status update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'], $_POST['status'])) {
    $order_id = intval($_POST['order_id']);
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE orders SET status=? WHERE order_id=?");
    $stmt->bind_param("si", $status, $order_id);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        $message = "✅ Order status updated!";
    } else {
        $message = "❌ Failed to update status or no changes made.";
    }
    $stmt->close();
}

// Fetch all orders
$sql = "SELECT * FROM orders ORDER BY order_date DESC";
$orders = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Orders - Admin</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="shortcut icon" href="./uploads/logo2.png" type="image/x-icon">
  <style>
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    table, th, td { border: 1px solid #ddd; }
    th, td { padding: 10px; text-align: left; }
    th { background: #f4f4f4; }
    .status-select { padding: 4px; }
    .update-btn {
      padding: 4px 8px;
      background: seagreen;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .update-btn:hover { background: darkgreen; }
    
  </style>
</head>
<body>
  <div class="container">
    <header>
    <h1>Customer Orders</h1>

    <p><a href="dashboard.php" style="text-decoration: none; color: #000; float: right; padding-bottom: 3%;">⬅ Back to Admin Dashboard</a></p>
  </header>

    <?php if ($message): ?>
      <p style="color: green;"><?= $message ?></p>
    <?php endif; ?>

    <table>
      <tr>
        <th>Order ID</th>
        <th>Customer</th>
        <th>Items</th>
        <th>Total Price</th>
        <th>Status</th>
        <th>Action</th>
        <th>Date</th>
      </tr>

      <?php while ($order = $orders->fetch_assoc()): ?>
        <tr>
          <td><?= $order['order_id'] ?></td>
          <td>
            <?= htmlspecialchars($order['customer_name']) ?><br>
            <?= htmlspecialchars($order['email']) ?><br>
            <?= htmlspecialchars($order['phone']) ?><br>
            <?= htmlspecialchars($order['address']) ?>
          </td>
          <td>
            <?php
              $stmt = $conn->prepare("SELECT quantity, food_name, price 
                                      FROM order_items 
                                      WHERE order_id = ?");
              $stmt->bind_param("i", $order['order_id']);
              $stmt->execute();
              $stmt->bind_result($quantity, $food_name, $price);

              while ($stmt->fetch()) {
                  echo $quantity . " × " . htmlspecialchars($food_name) . 
                       " (₦" . number_format($price, 2) . ")<br>";
              }
              $stmt->close();
            ?>
          </td>
          <td>₦<?= number_format($order['total_amount'], 2) ?></td>
          <td>
            <form method="POST" style="display:inline;">
              <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
              <select name="status" class="status-select">
                <option <?= $order['status']=='Pending'?'selected':'' ?>>Pending</option>
                <option <?= $order['status']=='Processing'?'selected':'' ?>>Processing</option>
                <option <?= $order['status']=='Completed'?'selected':'' ?>>Completed</option>
              </select>
          </td>
          <td>
              <button type="submit" class="update-btn">Update</button>
            </form>
          </td>
          <td><?= $order['order_date'] ?></td>
        </tr>
      <?php endwhile; ?>
    </table>

  </div>
</body>
</html>
