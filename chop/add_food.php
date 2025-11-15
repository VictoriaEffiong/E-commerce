<?php include 'db.php'; ?>

<?php
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $price = floatval($_POST['price']);
    $image = "";

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $filename = time() . "_" . basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $filename;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $image = "uploads/" . $filename; 
        }
    }

    if ($name && $price && $image) {
        $stmt = $conn->prepare("INSERT INTO foods (name, price, image, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sds", $name, $price, $image);
        if ($stmt->execute()) {
            $message = "✅ Food added successfully!";
        } else {
            $message = "❌ Error adding food: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "⚠️ Please fill all fields and upload an image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ediokeff Foods-Add Food</title>
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


    .container {
      background: #fff;
      width: 400px;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 18px rgba(0, 0, 0, 3);
      text-align: center;
      animation: fadeIn 0.8s ease-in-out;
    }

    h1 {
      margin-bottom: 20px;
      font-size: 24px;
      color: #333;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
      text-align: left;
    }

    label {
      font-weight: 600;
      color: #444;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="number"],
    input[type="file"] {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
      outline: none;
      transition: 0.3s;
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    input[type="file"]:focus {
      border-color: #482d0a;
      box-shadow: 0 0 5px rgba(0,123,255,0.5);
    }

    button {
      background: #482d0a;
      color: white;
      padding: 12px;
      font-size: 16px;
      font-weight: bold;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background: #f39c12;
      box-shadow: 0 5px 12px rgba(0, 0, 0, 0.6);
    }

    p a {
      display: inline-block;
      margin-top: 20px;
      color: #000;
      text-decoration: none;
      font-weight: 600;
      transition: 0.3s;
    }

    p a:hover {
      color: #cccc;
    }

    p[style] {
      margin-bottom: 15px;
      font-weight: bold;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Add Food Item</h1>
    <?php if ($message): ?>
      <p style="color: green;"><?= $message ?></p>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
      <label for="name">Food Name</label>
      <input type="text" id="name" name="name" required>

      <label for="price">Price (₦)</label>
      <input type="number" id="price" name="price" step="0.01" required>

      <label for="image">Food Image</label>
      <input type="file" id="image" name="image" accept="image/*" required>

      <button type="submit">Add Food</button>
    </form>

    <p><a href="index.php">⬅ Back to Home Page</a></p>
    <p><a href="dashboard.php">⬅ Back to Admin Dashboard</a></p>

  </div>
</body>
</html>
