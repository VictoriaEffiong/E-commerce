<!-- Footer Section -->
<footer class="footer">
    <div class="footer-container">
        <div class="footer-logo">
            <!-- <img src="./img/logo2.png" alt="Food Website Logo"> -->
        </div>
        
        <div class="footer-main-content">
            <div class="inline-sections">
                <div class="footer-section footer-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="#menu">Menu</a></li>
                        <li><a href="#">About Us</a></li>
                        <!-- <li><a href="#">Gallery</a></li>
                        <li><a href="#">Blog</a></li> -->
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                
                <div class="footer-section footer-links">
                    <h3>Categories</h3>
                    <ul>
                        <li><a href="breakfast.php">Breakfast</a></li>
                        <li><a href="#">Lunch</a></li>
                        <li><a href="#">Dinner</a></li>
                        <!--  <li><a href="#">Desserts</a></li>
                        <li><a href="#">Beverages</a></li>
                        <li><a href="#">Special Offers</a></li> --> 
                    </ul>
                </div>
                
                <div class="footer-section footer-contact">
                    <h3>Contact Us</h3>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Food Street, Uyo City</p>
                    <p><i class="fas fa-phone"></i> (+234) 0901-807-1774</p>
                    <p><i class="fas fa-envelope"></i> victoriaeffanga2020@gmail.com</p>
                    <p><i class="fas fa-clock"></i> Mon-Sun: 8:00 AM - 10:00 PM</p>
                </div>
            </div>
            
            <div class="newsletter-section">
                <h3>Newsletter</h3>
                <p>Subscribe to our newsletter for the latest recipes and offers.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Your Email Address" required>
                    <button type="submit">Subscribe</button>
                </form>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2025 Ediokeff Foods. All Rights Reserved. 
                <!-- | <a href="#">Privacy Policy</a> -->
        </div>
    </div>
</footer>

  <script>
<?php
// Build the JS menuItems array from your database
include 'db.php';
$__items = [];
$__res = $conn->query("SELECT id, name, price, image FROM foods ORDER BY id DESC");
if ($__res) {
  while ($__row = $__res->fetch_assoc()) {
    $img = $__row['image'];
    // If you store only filenames, prefix uploads/. If you already store full URLs or data: URIs, keep them.
    if (!preg_match('/^(https?:\/\/|data:|uploads\/)/', $img)) {
      $img = 'uploads/' . $img;
    }
    $__items[] = [
      'id'    => (int)$__row['id'],
      'name'  => $__row['name'],
      'price' => (float)$__row['price'],
      'img'   => $img
    ];
  }
}
// Output a const menuItems = [...] that your existing JS uses
echo "const menuItems = " . json_encode($__items, JSON_UNESCAPED_SLASHES) . ";";
?>

// Preserve your existing cart behavior
let cart = JSON.parse(localStorage.getItem("cart")) || [];

function renderMenu() {
  const menu = document.getElementById("menu");
  if (!menu) return;
  menu.innerHTML = "";
  menuItems.forEach(item => {
    const div = document.createElement("div");
    div.className = "item"; // keep your original class for styling
    div.innerHTML = `
      <img src="${item.img}" alt="${item.name}" />
      <h3>${item.name}</h3>
      <p>₦${Number(item.price).toFixed(2)}</p>
      <button onclick="addToCart(${item.id})">Add to Cart</button>
    `;
    menu.appendChild(div);
  });
}

function addToCart(id) {
  const item = menuItems.find(m => m.id === id);
  const existing = cart.find(ci => ci.id === id);
  if (existing) {
    existing.qty += 1;
  } else {
    cart.push({ ...item, qty: 1 });
  }
  saveCart();
  updateCartCount();
}

function saveCart() {
  localStorage.setItem("cart", JSON.stringify(cart));
}

function updateCartCount() {
  const count = cart.reduce((acc, item) => acc + item.qty, 0);
  const badge = document.getElementById("cart-count");
  if (badge) badge.textContent = count;
}

// Keep your existing Cart link behavior
const cartLink = document.getElementById("cart-link");
if (cartLink) {
  cartLink.addEventListener("click", (e) => {
    e.preventDefault();
    window.location.href = "order.php";
  });
}

// Only render if #menu exists (prevents duplicate or conflicting renders)
if (document.getElementById('menu')) { renderMenu(); }
updateCartCount();


  // Select all anchor links with hashes
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener("click", function(e) {
      e.preventDefault();

      document.querySelector(this.getAttribute("href")).scrollIntoView({
        behavior: "smooth"
      });
    });
  });
</script>


</body>
</html>





