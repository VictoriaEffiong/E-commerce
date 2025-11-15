<?php
include 'db.php';

// Collect order data
$customer_name = $_POST['customer_name'] ?? '';
$email         = $_POST['email'] ?? '';
$phone         = $_POST['phone'] ?? '';
$address       = $_POST['address'] ?? '';
$card_last4    = isset($_POST['card_number']) ? substr($_POST['card_number'], -4) : null; // only last 4
$total_amount  = $_POST['total_amount'] ?? 0;
$order_items   = json_decode($_POST['items'] ?? '[]', true);

// Insert order
$sql  = "INSERT INTO orders (customer_name, email, phone, address, card_last4, total_amount) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssd", $customer_name, $email, $phone, $address, $card_last4, $total_amount);
$stmt->execute();
$order_id = $stmt->insert_id;

// Insert each item (supports either name/qty or food_name/quantity keys)
$sql_item  = "INSERT INTO order_items (order_id, food_name, quantity, price) VALUES (?, ?, ?, ?)";
$stmt_item = $conn->prepare($sql_item);

foreach ($order_items as $item) {
    $food_name = $item['food_name'] ?? $item['name'] ?? '';
    $quantity  = $item['quantity']  ?? $item['qty']  ?? 0;
    $price     = $item['price']     ?? 0;
    $stmt_item->bind_param("isid", $order_id, $food_name, $quantity, $price);
    $stmt_item->execute();
}

// --- Email the order details ---
$to       = "victoriaeffanga2020@gmail.com";
$subject  = "New Order #$order_id from $customer_name";

// Build items list for email
$items_html = '';
foreach ($order_items as $i) {
    $nm  = $i['food_name'] ?? $i['name'] ?? '';
    $qt  = $i['quantity']  ?? $i['qty']  ?? 0;
    $amt = number_format(($i['price'] ?? 0) * $qt, 2);
    $items_html .= "{$nm} (x{$qt}) — ₦{$amt}<br>";
}

$message = "
<h2>New Order Received</h2>
<p><strong>Order ID:</strong> #{$order_id}</p>
<p><strong>Name:</strong> {$customer_name}<br>
<strong>Email:</strong> {$email}<br>
<strong>Phone:</strong> {$phone}<br>
<strong>Address:</strong> {$address}</p>
<p><strong>Items:</strong><br>{$items_html}</p>
<p><strong>Total:</strong> ₦" . number_format((float)$total_amount, 2) . "</p>
<p><strong>Time:</strong> " . date('Y-m-d H:i:s') . "</p>
";

// headers for HTML email
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: no-reply@yourdomain.com\r\n";
if (!empty($email)) {
    $headers .= "Reply-To: {$email}\r\n";
}

@mail($to, $subject, $message, $headers);

echo "Order saved successfully";
