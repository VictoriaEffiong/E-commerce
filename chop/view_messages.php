<?php
include 'db.php'; // adjust path if needed

$message = "";

// Handle delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM contacts WHERE contact_id=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $message = "✅ Message deleted successfully!";
    } else {
        $message = "❌ Failed to delete message.";
    }
    $stmt->close();
}

// Fetch all messages
$sql = "SELECT * FROM contacts ORDER BY submitted_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Messages-Ediokeff Foods</title>
  <link rel="stylesheet" href="../styles.css">
  <link rel="shortcut icon" href="./uploads/logo2.png" type="image/x-icon">
  <style>
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    table, th, td { border: 1px solid #ddd; }
    th, td { padding: 10px; text-align: left; vertical-align: top; }
    th { background: #f4f4f4; }
    .delete-btn {
      padding: 4px 8px;
      background: crimson;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
    }
    .delete-btn:hover { background: darkred; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Customer Messages</h1>
    <p><a href="dashboard.php" style="text-decoration: none; color: #000; float: right; padding-bottom: 3%;">⬅ Back to Admin Dashboard</a></p>

    <?php if ($message): ?>
      <p style="color: green;"><?= $message ?></p>
    <?php endif; ?>

    <table>
      <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Subject</th>
        <th>Date</th>
        <th>Action</th>
      </tr>

      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['contact_id'] ?></td>
          <td><?= htmlspecialchars($row['full_name']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['phone']) ?></td>
          <td><?= htmlspecialchars($row['subject']) ?></td>
          <td><?= $row['submitted_at'] ?></td>
          <td>
            <a href="?delete=<?= $row['contact_id'] ?>" class="delete-btn" onclick="return confirm('Delete this message?')">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>

</div>
</body>
</html>
