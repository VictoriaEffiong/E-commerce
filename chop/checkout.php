<?php
include 'db.php';

// Handle successful Paystack payment (after redirect from verify.php)
if (isset($_GET['reference'])) {
    $reference = $_GET['reference'];

    // Verify payment with Paystack API
    $secret_key = "sk_test_abc8333f1d56ff9831a117bac18443d63fe37f83"; // 🔑 Your Paystack SECRET key

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
            // Retrieve metadata (customer + items passed from JS)
            $metadata = $result['data']['metadata'];
            $customer_name = $metadata['customer_name'];
            $email = $metadata['email'];
            $phone = $metadata['phone'];
            $address = $metadata['address'];
            $total_amount = $result['data']['amount'] / 100; // kobo → naira
            $order_items = json_decode($metadata['items'], true);

            // Save order in DB
            $sql = "INSERT INTO orders (customer_name, email, phone, address, card_last4, total_amount) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $card_last4 = "****"; // We don’t have raw card info (Paystack handles this securely)
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

            // Send confirmation email
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
            echo "<script>alert('Payment verification failed.');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Checkout - Ediokeff Foods</title>
  <link rel="shortcut icon" href="./uploads/logo2.png" type="image/x-icon">
  <style>
    :root {
      --green: #482d0a;
      --cream: #ede3d1;
      --dark: #2f4f4f;
    }
    body { font-family: Arial, sans-serif; background: var(--cream); margin: 0; padding: 0; }
    header { background: var(--green); color: white; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 1000; }
    .logo { display: flex; align-items: center; }
    .logo img { height: 40px; margin-right: 10px; }
    nav { display: flex; gap: 1.2rem; }
    nav a { color: white; text-decoration: none; font-weight: bold; padding: 0.5rem; transition: background 0.3s; position: relative; }
    nav a:hover { background: #000; border-radius: 4px; }
    .container { max-width: 600px; margin: 2rem auto; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); position: relative; z-index: 1; }
    h2 { text-align: center; margin-bottom: 1.5rem; }
    .order-summary { margin-bottom: 2rem; }
    .order-summary ul { list-style: none; padding: 0; }
    .order-summary li { margin-bottom: 0.5rem; }
    input[type="text"], input[type="email"], input[type="tel"], textarea { width: 100%; padding: 0.5rem; margin-bottom: 1rem; border: 1px solid #ccc; border-radius: 4px; }
    textarea { resize: vertical; }
    button { width: 100%; padding: 0.8rem; background: var(--green); color: white; border: none; font-size: 1rem; border-radius: 4px; cursor: pointer; }
    button:hover { background: #f39c12; }
  </style>
  <script src="https://js.paystack.co/v1/inline.js"></script>
</head>
<body>
  <div class="container">
    <h2>Checkout</h2>

    <div class="order-summary">
      <h3>Order Summary</h3>
      <ul id="summary-list"></ul>
      <p><strong>Total:</strong> ₦<span id="total"></span></p>
    </div>

    <form id="payment-form">
      <input type="text" id="customer_name" name="customer_name" placeholder="Full Name" required />
      <input type="email" id="email" name="email" placeholder="Email Address" required />
      <input type="tel" id="phone" name="phone" placeholder="Phone Number" required />
      <textarea id="address" name="address" placeholder="Delivery Address" rows="3" required></textarea>

      <!-- (Card fields kept for design, but Paystack handles card details securely) -->
      <!-- <input type="text" name="card_number" placeholder="Card Number (16 digits)" maxlength="16" />
      <input type="text" id="expiry" placeholder="MM/YY" maxlength="5" />
      <input type="text" id="cvv" placeholder="CVV" maxlength="3" /> -->

      <input type="hidden" id="total_amount" name="total_amount">
      <input type="hidden" id="items_input" name="items">

      <button type="button" onclick="payWithPaystack()">Pay Now</button>
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

    function payWithPaystack() {
      let handler = PaystackPop.setup({
        key: 'pk_test_727f9e51d2d374e908c64541bea92a9a346da3bc', // 🔑 Your Paystack PUBLIC key
        email: document.getElementById("email").value,
        amount: totalAmountInput.value * 100, // Paystack expects kobo
        currency: "NGN",
        ref: ''+Math.floor((Math.random() * 1000000000) + 1),
        metadata: {
          customer_name: document.getElementById("customer_name").value,
          email: document.getElementById("email").value,
          phone: document.getElementById("phone").value,
          address: document.getElementById("address").value,
          items: itemsInput.value
        },
        callback: function(response){
          // Redirect to same page with ?reference=xxx for verification
          window.location.href = "checkout.php?reference=" + response.reference;
        },
        onClose: function(){
          alert('Transaction was not completed.');
        }
      });
      handler.openIframe();
    }
  </script>
</body>
</html>
