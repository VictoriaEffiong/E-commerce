<?php
include 'db.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $card_number = $_POST['card_number'];
    $card_last4 = substr($card_number, -4);
    $total_amount = $_POST['total_amount'];
    $order_items = json_decode($_POST['items'], true);

    // Save order in database
    $sql = "INSERT INTO orders (customer_name, email, phone, address, card_last4, total_amount) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssd", $customer_name, $email, $phone, $address, $card_last4, $total_amount);
    $stmt->execute();
    $order_id = $stmt->insert_id;

    // Save each order item
    foreach ($order_items as $item) {
        $food_name = $item['name'];
        $quantity = $item['qty'];
        $price = $item['price'];

        $sql_item = "INSERT INTO order_items (order_id, food_name, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt_item = $conn->prepare($sql_item);
        $stmt_item->bind_param("isid", $order_id, $food_name, $quantity, $price);
        $stmt_item->execute();
    }

    // Send email with order details
    $to = "victoriaeffanga2020@gmail.com";
    $subject = "New Order from $customer_name";
    
    $items_html = "";
    foreach ($order_items as $item) {
        $items_html .= $item['name'] . " (x" . $item['qty'] . ") - ₦" . number_format($item['price'] * $item['qty'], 2) . "<br>";
    }

    $message = "
        <h2>New Order Details</h2>
        <p><strong>Name:</strong> $customer_name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Phone:</strong> $phone</p>
        <p><strong>Address:</strong> $address</p>
        <p><strong>Card Last 4 Digits:</strong> $card_last4</p>
        <p><strong>Items:</strong><br>$items_html</p>
        <p><strong>Total Amount:</strong> ₦" . number_format($total_amount, 2) . "</p>
        <p><strong>Order Time:</strong> " . date('Y-m-d H:i:s') . "</p>
    ";

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8\r\n";
    $headers .= "From: no-reply@yourdomain.com\r\n";

    mail($to, $subject, $message, $headers);

    echo "<script>
            alert('Order placed successfully!');
            localStorage.removeItem('cart');
            window.location.href='index.php';
          </script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Checkout - Foodie Delight</title>
  <link rel="shortcut icon" href="./uploads/logo2.png" type="image/x-icon">
  <style>
    :root {
      --green: #482d0a;
      --cream: #ede3d1;
      --dark: #2f4f4f;
    }
    body {
      font-family: Arial, sans-serif;
      background: var(--cream);
      margin: 0;
      padding: 0;
    }
    header {
      background: var(--green);
      color: white;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 1000;
    }
    .logo {
      display: flex;
      align-items: center;
    }
    .logo img {
      height: 40px;
      margin-right: 10px;
    }
    nav {
      display: flex;
      gap: 1.2rem;
    }
    nav a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      padding: 0.5rem;
      transition: background 0.3s;
      position: relative;
    }
    nav a:hover {
      background: #000;
      border-radius: 4px;
    }
    .container {
      max-width: 600px;
      margin: 2rem auto;
      background: white;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      position: relative;
      z-index: 1;
    }
    h2 {
      text-align: center;
      margin-bottom: 1.5rem;
    }
    .order-summary {
      margin-bottom: 2rem;
    }
    .order-summary ul {
      list-style: none;
      padding: 0;
    }
    .order-summary li {
      margin-bottom: 0.5rem;
    }
    input[type="text"], input[type="email"], input[type="tel"], textarea {
      width: 100%;
      padding: 0.5rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    textarea {
      resize: vertical;
    }
    button {
      width: 100%;
      padding: 0.8rem;
      background: var(--green);
      color: white;
      border: none;
      font-size: 1rem;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover {
      background: #482d0a;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Checkout</h2>

    <div class="order-summary">
      <h3>Order Summary</h3>
      <ul id="summary-list"></ul>
      <p><strong>Total:</strong> ₦<span id="total"></span></p>
    </div>

    <form method="POST" id="payment-form">
      <input type="text" name="customer_name" placeholder="Full Name" required />
      <input type="email" name="email" placeholder="Email Address" required />
      <input type="tel" name="phone" placeholder="Phone Number" required />
      <textarea name="address" placeholder="Delivery Address" rows="3" required></textarea>
      
      <input type="text" name="card_number" placeholder="Card Number (16 digits)" maxlength="16" required />
      <input type="text" id="expiry" placeholder="MM/YY" maxlength="5" required />
      <input type="text" id="cvv" placeholder="CVV" maxlength="3" required />

      <input type="hidden" name="total_amount" id="total_amount">
      <input type="hidden" name="items" id="items_input">

      <button type="submit">Pay Now</button>
    </form>
  </div>

  <script>
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    const summaryList = document.getElementById("summary-list");
    const totalEl = document.getElementById("total");
    const totalAmountInput = document.getElementById("total_amount");
    const itemsInput = document.getElementById("items_input");

    if (cart.length === 0) {
      alert("Your cart is empty!");
      window.location.href = "cart.php";
    }

    let total = 0;
    cart.forEach(item => {
      const li = document.createElement("li");
      li.textContent = `${item.name} (x${item.qty}) - ₦${(item.price * item.qty).toFixed(2)}`;
      summaryList.appendChild(li);
      total += item.price * item.qty;
    });

    totalEl.textContent = total.toFixed(2);
    totalAmountInput.value = total.toFixed(2);
    itemsInput.value = JSON.stringify(cart);
  </script>
</body>
</html>
