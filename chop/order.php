
<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Your Cart-Ediokeff Foods</title>
  <link rel="shortcut icon" href="./uploads/logo2.png" type="image/x-icon">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #ede3d1;
      margin: 0;
      padding: 0;
    }
    header {
      background: #f39c12;
      color: white;
      padding: 1rem 2rem;
      text-align: center;
    }
    .cart-container {
      max-width: 600px;
      margin: 2rem auto;
      background: white;
      padding: 1rem;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .cart-container h2 {
      margin-bottom: 1rem;
      text-align: center;
    }
    ul {
      list-style: none;
      padding: 0;
    }
    li {
      display: flex;
      justify-content: space-between;
      padding: 0.5rem 0;
      border-bottom: 1px solid #eee;
    }
    .remove-btn {
      background: #dc3545;
      color: white;
      border: none;
      border-radius: 4px;
      padding: 0.3rem 0.6rem;
      cursor: pointer;
    }
    .total {
      margin-top: 1rem;
      font-size: 1.2rem;
      text-align: center;
    }
    .btn-row {
      display: flex;
      justify-content: space-between;
      margin-top: 1rem;
    }
    .checkout-btn, .home-btn {
      padding: 0.7rem 1.2rem;
      background: #482d0a;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 1rem;
      text-decoration: none;
      display: inline-block;
    }
    .checkout-btn:hover, .home-btn:hover {
      background: #f39c12;
    }
  </style>
</head>
<body>
  <header>
    
    <h1>Your Cart</h1>
  </header>
  <div class="cart-container">
    <h2>Items in Cart</h2>
    <ul id="cart-items"></ul>
    <p class="total"><strong>Total:</strong> ₦<span id="total">0.00</span></p>

    <div class="btn-row">
            <a href="index.php" class="home-btn" id="homeBtn" style="display: inline-block;">Back to Home</a>
      <button class="checkout-btn" onclick="proceedToCheckout()">Proceed to Checkout</button>
    </div>
  </div>

  <script>
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    function renderCart() {
      const cartItems = document.getElementById("cart-items");
      const totalDisplay = document.getElementById("total");
      const homeBtn = document.getElementById("homeBtn");
      cartItems.innerHTML = "";
      let total = 0;

      if (cart.length === 1) {
        homeBtn.style.display = "inline-block";
      } else {
        homeBtn.style.display = "inline-block";
      }

      cart.forEach(item => {
        const li = document.createElement("li");
        li.innerHTML = `
          ${item.name} (x${item.qty}) - ₦${(item.price * item.qty).toFixed(2)}
          <button class="remove-btn" onclick="removeFromCart(${item.id})">x</button>
        `;
        cartItems.appendChild(li);
        total += item.price * item.qty;
      });

      totalDisplay.textContent = total.toFixed(2);
    }

    function removeFromCart(id) {
      const index = cart.findIndex(item => item.id === id);
      if (index > -1) {
        if (cart[index].qty > 1) {
          cart[index].qty--;
        } else {
          cart.splice(index, 1);
        }
      }
      localStorage.setItem("cart", JSON.stringify(cart));
      renderCart();
    }

    function proceedToCheckout() {
      if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
      }
      window.location.href = "checkout.php"; // Redirect to the checkout page
    }

    renderCart();
  </script>
</body>
</html>
