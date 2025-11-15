<?php
include 'db.php';

// Create the table if it doesn't exist
$conn->query("CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50),
    subject TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full-name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];

    $sql = "INSERT INTO contacts (full_name, email, phone, subject) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $full_name, $email, $phone, $subject);

    if ($stmt->execute()) {
        echo "<script>alert('Message sent successfully!');</script>";
    } else {
        echo "<script>alert('Error sending message. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact-Ediokeff Foods</title>
  <link rel="shortcut icon" href="./uploads/logo2.png" type="image/x-icon">
  <style>


    body {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      background: #ccc;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
  background: url('uploads/glasses.jpg') no-repeat center center fixed;
  background-size: cover;
  position: relative;
}

body::before {
  content: "";
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5); /* dim overlay */
  z-index: -1;
}

    .contact-form-container {
        width: 100%;
        max-width: 500px;
        padding: 20px;
        margin: auto auto;
    }
    .contact-form {
        background-color: #482d0ad8;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(183, 61, 4, 0.5);
        color: #fff;
    }
    .contact-form h2,
    .contact-form h4 {
        text-align: center;
        margin-bottom: 30px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .form-group input,
    .form-group textarea {
        width: 95%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: transparent;
        color: #fff;
    }
    .form-group textarea {
        resize: none;
    }
    button {
        font-weight: bolder;
        display: block;
        margin: auto auto;
        width: 50%;
        padding: 10px;
        background-color: #ee8e11;
        color: #fff;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    button:hover {
        background-color: #f58d06;
    }
    
  </style>
</head>
<body>
  <div class="contact-form-container">
    <form class="contact-form" method="POST" action="">
      <h2>Contact Us</h2>
      <h4>Hi! You've reached Ediokeff Foods, please leave a message</h4>
      <div class="form-group">
        <label for="full-name">Full Name</label>
        <input type="text" id="full-name" name="full-name" required>
      </div>
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone">
      </div>
      <div class="form-group">
        <label for="subject">Subject</label>
        <textarea id="subject" name="subject" rows="4" required placeholder="Leave a message here!"></textarea>
      </div>
      <button type="submit">Send Now</button>
    </form>
  </div>
</body>
</html>
