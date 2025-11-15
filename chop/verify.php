<?php
include 'db.php';

if (!isset($_GET['reference'])) {
    die('No reference supplied');
}

$reference = $_GET['reference'];
$secret_key = "sk_test_abc8333f1d56ff9831a117bac18443d63fe37f83"; // 🔑 Your Paystack SECRET key

// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.paystack.co/transaction/verify/" . rawurlencode($reference));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Authorization: Bearer $secret_key",
]);

$request = curl_exec($ch);
curl_close($ch);

if ($request) {
  $result = json_decode($request, true);

  if ($result['status'] && $result['data']['status'] === 'success') {
      // ✅ Extract metadata
      $metadata = $result['data']['metadata'];
      $customer_name = $metadata['customer_name'];
      $email = $metadata['email'];
      $phone = $metadata['phone'];
      $address = $metadata['address'];
      $total_amount = $result['data']['amount'] / 100;
      $order_items = json_decode($metadata['items'], true);

      // Save order in DB
      $sql = "INSERT INTO orders (customer_name, email, phone, address, card_last4, total_amount) 
              VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $card_last4 = "****";
      $stmt->bind_param("sssssd", $customer_name, $email, $phone, $address, $card_last4, $total_amount);
      $stmt->execute();
      $order_id = $stmt->insert_id;

      foreach ($order_items as $item) {
          $food_name = $item['name'];
          $quantity = $item['qty'];
          $price = $item['price'];
          $sql_item = "INSERT INTO order_items (order_id, food_name, quantity, price) VALUES (?, ?, ?, ?)";
          $stmt_item = $conn->prepare($sql_item);
          $stmt_item->bind_param("isid", $order_id, $food_name, $quantity, $price);
          $stmt_item->execute();
      }

      // Send email
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
          <p><strong>Items:</strong><br>$items_html</p>
          <p><strong>Total Amount:</strong> ₦" . number_format($total_amount, 2) . "</p>
          <p><strong>Order Time:</strong> " . date('Y-m-d H:i:s') . "</p>
      ";
      $headers = "MIME-Version: 1.0\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8\r\n";
      $headers .= "From: no-reply@yourdomain.com\r\n";
      mail($to, $subject, $message, $headers);

      echo "<script>
              alert('Payment successful! Order placed.');
              localStorage.removeItem('cart');
              window.location.href='index.php';
            </script>";
      exit;

  } else {
      echo "<h2>Payment Verification Failed ❌</h2>";
      echo "<pre>" . print_r($result, true) . "</pre>";
  }
} else {
  echo "Network error.";
}
