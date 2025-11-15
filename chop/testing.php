<?php 

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'chop3';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// $sql = "INSERT INTO testing (id, name, description, price) values(1,'vicky1','this  a desdcription','1000')";

// if($conn->query($sql)===TRUE){
//     echo "Newrecord created successfully";
// }else{
//     echo "Error: " .$sql . "<br>" . $conn->error;
// }

$fetch = "SELECT id, description, amount, image FROM foods";
$result = $conn->query($fetch);

if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc()){
    
        echo "ID: ". $row["id"] . " - description:" .$row["description"] . " - amount: " . $row["amount"] . $row['image'] . "<br>";
    }
}else{
    echo "No results found";
}


$conn->close();


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Food Ordering Website</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="style.css">
<link rel="shortcut icon" href="./uploads/logo2.png" type="image/x-icon">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
    }
    header {
      background: #f39c12;
      color: white;
      padding: 1rem 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      position: sticky;
      top: 0;
      z-index: 1000;
    }
    .logo {
      display: flex;
      align-items: center;
    }
    .logo img {
      width: 100px;
      height: 100px;
      margin-right: 10px;
    }
    .navbar {
      display: flex;
      gap: 1rem;
    }
    .navbar a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      padding: 0.5rem;
      transition: background 0.3s;
      position: relative;
    }
    .navbar a:hover {
      background: #000;
      border-radius: 4px;
    }
    .cart-count {
      position: absolute;
      top: -8px;
      right: -10px;
      background: transparent;
      border: solid 2px black ;
      color: #fff;
      border-radius: 50%;
      padding: 2px 6px;
      font-size: 0.75rem;
    }
    .welcome {
      /* background: url('https://images.unsplash.com/photo-1543353071-10c8ba85a904?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8Zm9vZCUyMGJhY2tncm91bmR8ZW58MHx8MHx8fDA%3D') no-repeat center center;
      background-size: cover; */
      
      height: 400px;
      width: 90%;

      /* display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 2rem;
      text-shadow: 2px 2px 5px rgba(0,0,0,0.7);
      text-align: center; */
    }
    .welcome h1{
      width: 40%;
      margin-left: 8%;
      margin-top: 5%;
      color: #000;
    }
    .head1 p{
      width: 40%;
      margin-left: 8%;
      color: #000;
    }

    .head1 .img1{
      float: right;
      width: 42%;
    }
    .head1 input{
      margin-left: 8%;
      border: solid 2px #74562f;
      background: transparent;
      border-radius: 20px;
      width: 12%;
      padding: 8px;
      font-weight: bold;
      color: #000;

    }
    .head1 input:hover{
      transition: background 0.3s;
      background: #482d0a;
      color: #fff;
      font-weight: bold;
      
    }
   
    
    

   

    .main-content {
      display: flex;
      flex-wrap: wrap;
      padding: 1rem;
    }
    .left-content {
      flex: 1;
      min-width: 300px;
    }
    .right-cart {
      display: none;
      width: 100%;
      max-width: 400px;
      margin-left: auto;
    }
    .menu-section {
      padding: 2rem 1rem;
      text-align: center;
      
    }
    .menu-section h2{
      color: #000;
    }
    .menu {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1rem;
    }
    .item {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      padding: 1rem;
      width: 200px;
      text-align: center;
      transition: transform 0.2s ease;
    }
    .item:hover {
      transform: translateY(-5px);
    }
    .item img {
      width: 100%;
      border-radius: 8px;
    }
    .item h3 {
      margin: 0.5rem 0;
    }
    .item button {
      background: #482d0a;
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      cursor: pointer;
      border-radius: 4px;
      transition: background 0.3s;
    }
    .item button:hover {
      background: #472c0ad0;
    }
    @media (max-width: 768px) {
      .main-content {
        flex-direction: column;
      }
      .navbar {
        flex-direction: column;
        width: 100%;
        align-items: center;
      }
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">
      <img src="./img/logo2.png" alt="Logo">
      <h1>Ediokeff Foods</h1>
    </div>
    <nav class="navbar">
      <a href="#">Home</a>
      <a href="#menu">Menu</a>
      <a href="#" id="cart-link">Cart <span id="cart-count" class="cart-count">0</span></a>
      <a href="#">About Us</a>
      <a href="contact.html">Contact</a>
    </nav>
  </header>

<form action="index.php" method="POST">

<input type="text" name="name">
<input type="submit" value="submit">
</form>

  <div class="welcome">
    <div class="head1">
      <img class="img1" src="./img/food.png" alt="Food">
       <h1>Welcome! We serve a delightful variety of food - Fresh & Fast Delivery!</h1>
    <p>Experience the enticing aroma and savor the rich flavor of our carefully prepared meals. For you and your family</p>
    <a href="#menu">
      <input type="button" id="" name="order" value="Order now">
    </a>

    <a href="contact.html">
           <input type="button" id="" name="reach" value="Reach Us">
    </a>

    </div>
    <div class="clear"></div>
   
 <!-- <div class="head2">
 <img src="./img/logo2.png" alt="image of a set rable of food"> -->
</div>  


  </div>

  <div class="main-content">
    <div class="left-content">
      <section class="menu-section">
        <h2>Our Menu</h2>
        <div class="menu" id="menu"></div>
      </section>
    </div>
  </div>

  <!-- Footer Section -->
  <footer class="footer">
    <div class="footer-container">
        <div class="footer-logo">
            <img src="./img/logo2.png" alt="Food Website Logo">
        </div>
        
        <div class="footer-main-content">
            <div class="inline-sections">
                <div class="footer-section footer-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="#menu">Menu</a></li>
                        <li><a href="#">About Us</a></li>
                        <!-- <li><a href="#">Gallery</a></li>
                        <li><a href="#">Blog</a></li> -->
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </div>
                
                <div class="footer-section footer-links">
                    <h3>Categories</h3>
                    <ul>
                        <li><a href="breakfast.html">Breakfast</a></li>
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
            <p>&copy; 2024 Ediokeff Foods. All Rights Reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
        </div>
    </div>
</footeAr>

  <script>
    const menuItems = [
      { id: 1, name: "Burger", price: 5.99, img: "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBwgHBgkIBwgKCgkLDRYPDQwMDRsUFRAWIB0iIiAdHx8kKDQsJCYxJx8fLT0tMTU3Ojo6Iys/RD84QzQ5OjcBCgoKDQwNGg8PGjclHyU3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3N//AABEIAJQApgMBEQACEQEDEQH/xAAbAAACAwEBAQAAAAAAAAAAAAAABQMEBgEHAv/EAD8QAAEDAwIEBAIIBAQGAwAAAAECAwQABRESIQYTMUEiUWFxFIEHFSMyQpGxwTNSodFDcpThFlVikvDxJCU0/8QAGgEBAAMBAQEAAAAAAAAAAAAAAAIDBAUBBv/EADIRAAICAQQABQMBBwUBAAAAAAABAgMRBBIhMQUTIkFRFGFx8DJCgZGhscEjUtHh8UP/2gAMAwEAAhEDEQA/APcaAKAKAKAKAKAKAKAKAKAKAKAKAKAKAKAKAKAKAKAKAKAKAKAKAKAKA4aArSZ8WKkqfeSgDHU+dVzthDtk41zn0im5fYqFuJw4A3gqUpJSBn1NUvVwRatNNlMcVxFrKGkqWQMqKUkhPuR0qr6+D6Rd9DNLLPlfFDaJCWSlOtSdQTvuPPPSovXpSxgLRNxycXxS226srDZbbRqUEr8QPb0NSWtWeSP0cmlgmY4pguTDEPM5wTqUEjUB7+XWrI6ytvBF6SxLJcbvluWcCSkdwVbA+x6VZHUVy6ZU6LF7F9l5t9GtlxK0+aTkVcpJ9FbTXZJmvTwKAKAKAKAKAKAKAKAKAKAXXK6NQmVrCSspznHSst+qjUvll9Onla8dGcul5uKkBvSGVLAVlCjsPL39q5up1l3XWTo6fS1d94FbAlrkuXBTaVlGAsnbrsMd6yRlZKTsxnBqkq1FVFiQhx1xxiaUgHBSHASQPTJwPc1Y23LEyqOFHMCJcblId+2HK5akstAkhXbfGMn1706ffHsiSlnHHOeWUkMxxHU0pHLc0aQtAypZ6eIk7D0FVQnHbh8fj/JdKM92Vz+f8HzLjvzFuQ4aVqiIOdLadCVeZxnb/apZlJ7a+V9jyLjBb7O2Vri6tbjEthjS20nlhbgSvWcdCcY6Udj4klg9hWsOEnnPsQuMmAliRJioivcwglJyVAjsjpj1FWZkllojiM24xeV+vc+nbkuI/DlRXnGIbWSAXFKWpRG2Ukjw+3nV0ZtYceCp07k4y5bHVg49mEoN8ihEUj/9aUkDPatdWrln19GS7Qx/+b5+DeW64xblERJhPJeaWNlJNboTU1lHOnCUHiSLdTIhQBQBQBQBQBQHCcCgEVyvKVPOQYgJf+7noAff0rm6jWLLqhyzfTpXtVk+hG1b9bZW64ouJVlRV0Pt61yo1bk23yuzfK3a8JcF1xokLQ82FOaQnWrqParm2k1JclEX04vg4mGlLSFBvosZJOxI6DFRjXiKlj3PXa92GyR+OOasvNp5i052wMfL51bZFuTdq5IQnhJQfBEhphpZUFOhXLGShIBKt9gajBVx5bf/AGScpyWMe5C8wXENPFTfM+4G0jfbfPrUJRlOKn7/AAThJRbguvkpLkOOB9qTLS006SpxXKB+QAFeRulJtN4LHTFJOMcv8lCDMbhvAqZCkk+FTmRpzsTp77V5TZ5cvkturdkOHgXOJRCeZnlDUiO8VllDgxkZIII/D7Ua2NSXKJJ74uHTRTmONIfgrcdE1LbQUplWQlG+6K9bwk1yiUYt7ljDz3/ks3VT6LelXwDJjsIQ6yGndQbBUdPMHfodq0vpPHBkhhzxnn9dEPDNwnWKc44zFcW6VpU7HbGEKQr9O2DU6ZyhPgjqK4WRwmewWy4MXOG1LjKCm3B+RGxB9Qdq60ZKSyjjyi4vDLdSIhQBQBQBQBQFa4v/AA8N10Y1JTtk96pvs8utyLKob5qJmPh1pbSnwrStRc1Dqc+dcGcZJJd+/wDM6sZxbz/AuCLuMJT07Vd5LzhFPmFhMdIKtKS5j+bbetCpjl45KvMeO8H2I5SMhAUs7A9MVNUY7WSLsyfJjJSskJSFK6nG5ryVLyeqzggfQhGNSh4jgVTOjBZGZVkFzRpjq5KdJ1ug+JWfLyFRalFejh/JKOH+1z9hM+2htrOrwpHnWN1s2xtRXuaHHowcLLUcRmxlW4WsbY26VdKG+PWMf1PK7FCXec/0M4tsKc1HcpzgiqMM1bkMGZFuizJK2GFSGyz9jzRnQo+eetaI+XGTwsoon5korc8MgatMp3mKU0I5ecQlxpKyPCogj5V6oTR47YfknVbxGe57TagXAoIaLhUGwFbb/LcetT5iVZ3razQ/R+6u2SnrfIISiQouNYO2rO+PetejsxJwZj1kNyU17G/rpHPCgCgCgCgCgFl/x9WOqUnUkbk/y+tZdZHdSy/TP/URjZHFdntwTquKVo2AbbIJ9q5UPs8o630t01naSNcd28py3Gnq8P8AEEZWnPua2b9q5RneknnsrHjyEnmpLU7S2PCUtDKv65FR8774Iz0+ztlJz6SYqIi5CIbxKDpwXEqTn1xXjtlnCXJFV1/IWrjhF3cSiNFuzxO6izGJSg+WelSfm9v+4xV0jR/GRSAqVb7mjAzlwpH9Aai5Q/eTG2Xs0ULhxVw2wgokfGN5GCAhVe7qpcJMKE17ozdw4/4TCFNNKlHPUFtf9q8lTJr0x/qTjLD9TKkrje3Xd8rLS31hI0NgkZ9PU1TZXfJ5ZroqhjEWLZ1+K14NqWwCOhBSTVPkNdyN0KuOOQt3EEZSkx5DK2QvYr66favXVJLhkZ055NV/xLZUBLsmeFFZAJUg52+XSrIbpdmGenmukMrXd7VPWkMS4qiVKyjmAFI7GrYwTfKM84zhwO7fBbbnR3TpUeYCMb4zVtVajJMosm3Fo1grpmE7QBQBQBQBQHn3FcJF4u7n1xcnI9pi4SlhtzQFqwCSo9/L5Vjt9csN8HS0tnlQ9EMyfv2VYl+4Ps6+VZrd8XLGwLTWtaj28Sv2NQjbVFelF89Nq7fVbLC/P+C6+5xVxA2UM2uHa2T/AIkpfMX/ANqf71PErPbBSlpqf3nJ/bolb4IgsIU7dLg8sFOCEqDacd/Ws/0VUfVY8mWVzm+EUW3uBbE0kwosdQdUVJWhpTutXTOrBGfnVk7aFLHbRbXRbZwiGVx4s4RbbUVtj8S1hKQPYZquWrWOEbavDZN5kxTfOJbnJsr0lgoYdjeJ9tKMkoPcH0rJ5s52KMumR1OllS/T0zFw7PP4rU6+1csIQNRbUvSEjvVstR5GIOOWZN7+Ra3w2ly5CGAlbeklU1L4KEk5xnrtt5Z3G9XR1S2bp8fbAjNJ8mn4dtnD8eayi4qedbXqwtPg3TjJBBzgVnjdulma4NC1c4rFawbWZwrY7olDkO6SFg4COY+XOvkTWuenhJ8Mvp8Svq4lBfyx/YTPcEzIZCophykajqS8ggq2wAFDpg7+tVSoe3B5qNd53K4FF74emMQ2GW4ri1uuBUhTSchCUjoO5zVVcbFJt/wMk7LJPc2Z2fb3kPiQ3HmFtfhUp5kg56dOvQVNOWMT7N+iuUvTNnp30eq+qpTkWcpclgrRyH1jPKUR09RuB6EVqolFPlGLWtWPMeD09BBGQcitxzD6oAoAO1AROvNN55jiEYGTqIGB515lBJvo8zvfFUePeZrnxXMWFBLSYz2UlIGxJ6VwdQr5ahtSwvydGjR2WJcYMReLo7dnlPSHtRUdYbQThO/U+te88NvP5O9ptOqo7UOeDbQI6kXjlLShIVl1weEHboP7VTZqZ1vhHL1dlrm630PBxY/dH1s2e4trSg4VpbIOobY37+1Su1WqivVwYo1SksxR83N6aqM4ZDig40kKKlJzknbYny3rmxfmSzJ5yI1ylLakeeSpKrlNcaYla3mlFXLUdvb3rrwrVUctdmqn/Rk2nkdv3ci1MwzAjB5SSfiDq1kZ7dvLzo1mOMLj39zs0OErd7m19vYWQ/iJMpDaFFKV7LUTtp/eoqKNGrshsxjIxubUaxtPmMcIeaLUhCfxoV1wPPyqMN1k8N9dHGtpjKvclyaHhi3RpkFqc406ws6glCwACkbJOMeVY7cqTi3k5bi49it/hP40Pxm1tISkH4dxzYtEnJAOR1qyrVSjJP8An9z2MnF5RCzZbzBtS4aowXHjkltwOJRg5yVJwRk79/KtU9XVL3OlTqqlLdLsrQ7rcTFQ82uU22QClaiSkg9K8k2nt3cnQhZpbf3UyaJxXcWln7ZDwScEHerVOcfchbo6LP2Vg1MbjCOlpCrhFcSFYGtKdQz+taIajPaONdpnXLCZQunHtkkRXY9uDqn1ApSeUQAfPfFWTlxwI6ezs230bOSVcMsiU40tKVEMlCskJ8j5b5qWhbdXJgtWJcmqyK2lZ2gOHpQHnHHH0eTuIuI/rSJcWW21spbU0+hR04z0wehzVVle/wBzXp9TGpYayMOHvo1tFuQF3P8A+xf78xGltPsnv7nNRhp4R75J2+IXS4i8L9e5hLdw/NV9IF6YvbKGRpDkdDWkNhjUQjSBsBjt1z1rm+KTdcI7eDTor3FSecsOKb0ZN5FsjyDHgxUBHLCwlKlnO5+Q/rVOjqUobmu+v+f4ltscd9vkVQ27UwtT8Zz4daE4LrZ0gnr16d61WLf6ZLglBJdDjiHiGdKtAbabjF5X2aXgSVLOOuKzx0EHJSbIKzy87V2YvhyxTEzGpTCFoWVEA7EFQODq9M9622tzjtZCuMIeo3UK+QSWrRxLBYaSoHkvNJCtB8zjp71glo5Ke6Dw/wBf0JynxugKLvaJ1hnqWwhb8Mqyy62NWQexx0/eo12xllN+pdnTqujZXiRUYjO3W6NmWlzllYLgVtt869lZGEWz2fEcIc3XiyQqc1Hs6WEwYa/E64nIdI6pTjt2zUKdEtu+3tnLnHzOF/MzV2vd6fuxeiuJRqyI7ZAWlsnGSAfxbYyexNa6dNTGG2Sz8/czyoaREJ0iZNSpz4yRIWvL6C6UEADB0/h646V6qGlt6+PcpVcnwNbLe4T3EQRJiusRFkscsnLbbaUjSVHp1zWe3S2Rq9Ly1z92wlKEsFHihEaDdEM2cCQ8548JOycnZO3ep6SFk4Zt4RbCyfeWafhmRBuTQgXFtDMpxBHIcSQSR5dvKseqpvrlui+C2rzHYpN9Ffifg+FDtz9xjhaeQMrbTsfl617pdVbOarkbndFLLPjgqLxIi3LuXDqXHW21ltbaXQFg4B+6diNxXUVVqe+JXK3RWeixYfzg9P4M4gm3RsxbvCeYnMglai3pSRt1HY71tqscuJLk5GqphXLNbzE1dXGUKA5gZzigO9BQGKu3FHDlw5rEaWVz0BSEKbjLKgRnbOOmRXO1ipvg62+fY1affXNS9jyC48NXaXKkz2oTjvOXpDa0feGM6s+/ao04jUov2N11qlZldBAg3aHAejG3uJQtWS6GgvB8uvSoysg+UxGyPzyWH+JXI7SWpfLbWrpzWyClQ9Rn9q9hmXMeSXmVsitt3KZzbzSubywFFKXEhCcDwj2zivW2uWS2p8Jn3N4kCpIdcbjuyEoUEqOCEhWxx616mxsj0NOAuLTJlrs9zkBaln/4yj1B7oP6j8q5viOke3zYrrs9jJJ4TIPpHviYRVAtuA8v+ModUp/uaeG0b35k+vYlfOShhdmDVc3ZDzOPA00kJ5eeo9K7O3HZjUm3w8DyzuouF9Q5IbcLRPMbQFBJBHXHYDeoTfHBbXXh5yX7lcYhSmWlPwxS4EFaRqCc+eKohBvo0ysUexMmUZBU00tDjK3SHFbBQB7j3H5dKvT2r1GWUPMeYmmtamOHXIepiM/HfUol1vcggnf1I+VRc+TyNDx9w4lMaY5Fm2scuXHd1csDBCSQc6u/+1ePbKLi/cshGUHk0Uy7m+wotrhASJEhSA6kHAPz/X2rHpKpKWWuf1ySuUY5fseocPWhiyWhi3sYIaHiVjGtR3JrtxjtWDizlueRlgVIidoAoAoD5WCpCgDgkYB8qA8cm8GvcJuqucy5sOtDWtZ5ZThI6k9fMCuVqK3CSx22baHvz9hFO+kmK9CMeFEkk6SOYQBj23q2Vc5R2vglx7C0cYMLgfCphytY6EAf13rF9FJSzuRJZ+BXAZa4luzEOSXYjLpKRIWjUNXYfOtDUtPW5x5Ixi5yxJGob+iGKhZDl0klP8qEJST+tYpeM2dbP7l0dJXnOQkfRNC/wZT6T/1YzUF41av2ol30mnfX9xY59HMu2upfjTgFNqCgpWxBHQg1cvFYWLbKJOvSQi8xY+VL4eRDDF7bivyB991YClk9znr+VaKbeMKLSJWUPduyZO4QbE6+VWxaACrolecfLrUp2WJ9cGjT06eS5az+SubU2o55ix7Gq/PaNq8Pg+Uzv1PHcQW3XndH8oV3/OvVqpLojPwuElhjWycIshwOxpSkEd1+1HqJ2lC0dWnzhf1Hg4CZfLa3pRXoGE530/pUoueMZKZyq728nZFlZiSmosd9tbiiErU6oJASO29VWbl9ycXXsbwazgmzQbLxA5MUwoPS08ttRVlLe+Tgds7DbyqzSalb1CX8Dk6qr0Zi+j0kHauucw7QBQBQBQCa9XtduUW2Yi3lgZyfCn8+9c/Wa76fhRyycIbjzD6VbnKuEWGHQExQv7UIJwryzWKjWfUWtvtLg6mnp21Z+5iUQ4hW1oSOUpO5HQHvn/atO9p8mny4yXHBreHoUOOvUqSw2wrZCEDKlK9AanmLeShqcVtR9sOwDMdQ3IaZKn9IbUo6s469tzv7Yqvbn8FrbSxg11k4lNztoMdwKUwssubHOoe4zuCD+dczV6i+lqC69uCtaeG5tk9/4nZtNodlTC3pQnqU5Kj2A9ajVq79QlUopv5wRWnjB7m+DydxUvifXcZj0jlFZEeKwVBJ98dcd66VVMaIbYrn5Lovfy+vyKY1v+tLm2zboTrshvBdwgFITjue2em9XuzZDM3hFNnlRmN2+Fw4zMduUERVNKCUZ2JOe4HtUN7xlMvjsljjJBJ4a8QFtcexgkkL09PTNeb3nkswo/b8ESOH7mpkuNynTggfezg+ppmPvEs8yeMb3n8jBmFdYlrflOyZX2TqElKHNJwRgfmSO/nRQTWUsFctRiSi3kLcg3lz4V2dJS4FK/iSF48sEZx1qUYyRXZZFrOMjFvhhuItZyMJHNUsHIOME989q92tvkr82OFhDeyvtwpsdTL7xRKJWWDnSgpAOQO29YtdFRrVi7TGcxmn8G5vHEaBEaTEWTJOFKDZ2G3TNW6rxFbEoP1cZ/8ATlRr5H9uuDNwjh1hQPZSf5T5V06L4XR3RKpRcS5V54FAFAYu9h9N3e5mpSSQUjJwBj+lfKeKb/qGpPjjBprxtE94jNuxVa2ErHRQIrFTJp4R0dHZy4MxiuGYzpWWXFtauyVbCumtZNcM2zrrim3wcicCzFIMh29rZKtmsNayB6nUKsl4lXF4cDn3zdcnGDyLbLwXdXXVyJ0swHA5oCeXr5vfOcjbNWXeIUxWIrcUucovKZBY79I4S4seg3pCmmHPs385wMfccGeoP6H0q3U6ZarT7q+WuV/wew1OJ8lDjbiB7iC4lDAWYLJw15LPdWP0qeh0sdPDn9olfa7HiPRXRflxbUiFFedZCU6VFIxnbzrT5bbyeRtSik0bb6OWmPqBctEgurckYeyMFBSNk+owc/OuH4pJ+YoY4KZT3PLK/EjHEF04rcjQTqjPkOR3vut4SACCR3BztWui6mOnTk+uH8lsbnDhGKfvEq3Sn23VOIcBKFZUUnbY4/rXQjUprMQ9U1nk1M9riK32GPNDbXwmgPraC1FzHTKhjsMZ96yV30zsdSeGWfVY59yZi63O6WyVLnQJykctIS2hBCFadwceffyzVsrK1LZuWSxR9O5IRxbXfrlNVJjxHopdVzApY05zvn50svqh75/AqrlNZNEi08SRIr0iW+3ywgrUnxErIHTHyFUPWV5SSfJKVWE2nnBVsBuT8l111tR1J0hejoPIVTrLIOKWTLK7Mdo/uDb8UNc7mBKtyOpH/uudBp5wUHo3BbLrLD3PjONa9JQVJIBTj9a7XhVUq4y3LGSm1pmnrrlQUAUBj+L3J7Uht1QSiKF6W1IyVKUR+IeXUVw/FIXTxx6fb+RdXgzbvEjJUlh5H3spCtBGr2rjeTPbvXRcmKb40+ywPgVrSp1QPiSCflWulblmaLnZKxYk+hzw/wAKzlsh+XPmBauwdIH5dK6ENCpr1JIpcorhjJ6w3BtwEyi8kHwhTaRgeW2Kz2eF/wC0JxZj+Mray7ND12t7br2gIDp32HTFZ6ZXUt1qTWDxoRQuG3VvJetyUJwfuuoCkn5GtD123ifJ7GTRfc4aluow5HiqJzsBgfvVf1sM8Nm2OqhjEojBaWOGrczCTDC1SgXNTZCUAgY6461U1K+W+T6M11im+EQcLXOc5NQ06lYbUrZSc+H3pqKIqOYkMCWdKuM64fCPWFh1SV+HntpX39fQ1orhXXDcrGvwQ4Yyf4nuAkshy3tEIGlWF7K2x0x/5tVUdHXtfq7+3/ZNKXaGUriO4Rrhhi3DlgDYu4IONx086hXpo7c7ufwa3qZOOGhtZp90kyFSV29htoABWlZyBUPL8r1wbyjO8r1ZK7lwVeZMmK4sICNScoGCoDyFe32NtWPkuldGNbhD3PoxfhGsxUrMcY3zvnHtWZtyfJkNVbbC3cYLEtD+QRlGpOfz+ea6en8L82tWKWM/YhKzDwa5tJS2kKxkAA4r6KKaSTM59V6AoAoCN1lp3HMQleDkZGcGvHFPsZFd8srNxgCOhllPLOtsFGMKHl5Vl1WmdtWyHBKMsPJ57xNbptpuVvdUQoOJBU3nZKh1Ge/audOh0QSfZ09K42Jp+w8icRSUoTrjqx6HNV/VzRc9JBlg8SAnJSU+4r36yTI/RISXiVCuclp2S+rQ2DlGnOax2ZnJz9xLRyx6Rc5MUHQmKpptofhwCTUFTBr1Elo+OS5HnlDa1OBorxhCj1FR8mJ59GxBPQqQpHxDupLedA7Jz1rVWowWETWlS6JI09iEgaevTbarM5WMHj05Eu9w2ni8hKg4fxaicUVCfsV/TxQtcusJx0K5Z8PkKu8ptHvlovIvbL7hWW1KOc5xmo7NqPVVk0NsvLgbCW468K2+7VMueCx0xa5Z16Clb6ZCW1R3epXqHiPbIFUOrKwjLLT88dG3jcPsOxkImBXNCQcpJxkjfPnXUq8MrUMT7MDseeBzAiNQYjcVhOltsYArp1VqqChHpFbeXksVYeBQBQBQBQBQCniSyt3yByFL5bqDradxnSr+1U3Uq2O1l1NzqnuRhZFuvdsOmRBedQn/ABY45iT8huPyrjWaK2Ptk69erpn74KDt05ezyXEejiCP1FUuixfusvVlb6ZSdvUJeynWs+4qGyS9iacfkjTOgrV/EaO3QEU2v4JkvxkMJPiZ6eYqOH8HuClMnw0gq1tfJQqyMW/YixHMucXJw4jr2IrTCuRVKSXuJ5F1j6v4jf51rjVIzSsijka5tOK0tkKPknevXVI8VsTR2xyWtX2UCWsncBMdZ/aqZ0Sb4RNWw+TSwI3EEjCY9mnnPdxstp/NWKh9Ja/Yi9TSvc2HD3C05MluXeVtp5agpEds6snzUf2FaaNDslumzJfrFKO2CNrXROeFAFAFAFAFAFAFAFAc00BwoB6gEeooCJcOMv78dlXu2DTCPcsgXaLa59+3xFf5mEn9q82x+BufyfH1DZz1tUD/AEyP7V5tj8Hu+XyfCuHLGo5VZrcfeI2f2r3avg83S+Tn/DNh/wCSWz/SN/2pgbn8kjdhs7Ry1aYCD5pjIH7V6MstoiR2xhthpP8AlQBQ8JNO2BQHcb0B0UAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUAUB//9k="},
      { id: 2, name: "Pizza", price: 8.99, img: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRucsrT4Jh73B2qI1r_AjPA0IK7qiliiPvG4w&s" },
      { id: 3, name: "Pasta", price: 6.49, img: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQimG0z8Qk8WEWndMOtGsMx1ulxh0dOHkMzA-LXENij91InQoKPRM2W84s&s" },
      { id: 4, name: "Salad", price: 4.99, img: "data:image/jpeg;base64,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" },
      { id: 5, name: "Jollof", price: 8.49, img: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyEDIyrDGAUIVsnec6PIa_BaLoyZarcBKc21CJGHT8FoyA7cp1xxdKxsk&s" },
      { id: 6, name: "White Soup", price: 9.99, img: "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBwgHBgkIBwgKCgkLDRYPDQwMDRsUFRAWIB0iIiAdHx8kKDQsJCYxJx8fLT0tMTU3Ojo6Iys/RD84QzQ5OjcBCgoKDQwNGg8PGjclHyU3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3N//AABEIAJQBCAMBIgACEQEDEQH/xAAbAAACAwEBAQAAAAAAAAAAAAAEBQADBgIBB//EADwQAAIBAwIEBAMGBQMDBQAAAAECAwAEERIhBTFBURMiYXEGMoEUI0KRocEVsdHh8DNSYiRy8RZEgqPC/8QAGQEAAwEBAQAAAAAAAAAAAAAAAQIDBAAF/8QAJREAAgICAgMAAgMBAQAAAAAAAAECEQMhEjEEIkETUUJhcTMy/9oADAMBAAIRAxEAPwDyyt7i9mENuM9WPRa2XBuEQwFVUF3b53P7V5ZWcNjCIoVGBuW6sfWrml0jynGeeK0YcCx99kpS5aQ2uJIUjKM+kYxgc6WSTqDpgUBfUZNDkljknNSrgo6ZidzXOaovbg29u8q48m5HpVEHEEuGwpKdQO9QyZ4Y5Uyixyl0H42zU5c6UWNxpu3eaU4b8LdK84pxyC0GiMh37iprysfHk2H8MrpDWSVIhqkYKo7mkPFviWO2JS0Akk6seQrOcS4zPd6tTHSTyFZ+7ujGTgZHvWSfmSnqOjRDx1HchpNdTXNyZZCxmkOS3QVFg8Z2DlSw3DJ1qjggF3GZDnO4WiEaSGRhKCoTqBzNYJPezSuiyGQ4ZGkAZRyZd66guC4OMAchnbP9KtV4LtN8CUDfvVUYADsU0uhxg8jXJ29nFPEvubWRmRvE6ahXlmwktvKQZV2YA5/Kuby5a5AWUDCbKBywKRuLizd5LedlY8yBmtOOmqJSbTsdz3SREK74btjJpBxR5r6UG3jcgHtRME095qik59fLp/MnajVWO3xrkOcbAcjWiKSIybYrtOHShgso0Jzcbb/WmVrbW9rM2iRjkZ6eUds1TefebyS6IuZVOZ+tVudI+76/yoTOiv0M5khkUBlErryJ7fvQ8ssmgqThR0qmOVo18vmNX2+q4Uq2MDlU1KTHpGi+BpoFiuIVkxI8mrT9BWuVtONY3r5tHrsWjEGVbUc9zWgi4vdQqurfbrV15KxpWTeJy6NS8pIwOXaqmfFIrX4khNwsdyugNt4nQGnccyXC6kz6npVYeVjk6FeGSIHya719q4KYNTGK0/SRckoGMir45e1CAahXcbEHBprA0MY5aE4lwxLoGSAAT8z2b+9RHomKTbnQlFTVMXoyxYqxRlw6nDDtXtPOL8M+2r41vpFwoxnlrHrUrz5+NNP16LLIq2HO2Kq3Y15ksa7G1ekyK0eYxVbvjlXcx0igpJQKRsZFfEXH2OZWwdSkD3rK2t60TFCAQD8p7itDfypIBEDlydqzHFkS24m41DzANgdM15XmtSkmbvGWqYyupPu8g4WVc5Owz2rPSO2s5zkd6Ia5KyCOUYTmhJzvVUkLTyl49IB6E1jTsvVMDdzgjlntQk8YZGZsaRRt1E8LfeoVHfoaouZBIqxwDO3608exWgvhqN4arANMajmDjNGxypO5j1A42z60LZReBEC7Ko6DnvXt3IISssTINRwUBGfp3qUk3JjWghYYwjqi6ZAeQqq5uWYCMlhp2Ixzq0M0rqdIGkDfqaDuxMJC0hznrTRi0gN7OSvl1HYe9JI7h7+Yx6Cqg7kUwundYJCiaiF5etBWkM9vCQQBI2ck/wBKvj9VZOXs6K+IymDmusYwgzsp7+tUcLvJTE8MmDE5xkjl7UNexyqvn1AknIPQ02suG6Yx4xCgqML1rRfrsjWyi4nleLwymDyOBRJBWIZBOwosQojDUMkjFDzhyroDpx1pVNSVDOLRZCfKCuCe1Xwv4cmtcBm5rQySIsKgbtRtlEoKtNgg7kZwcClk6Cth72CX1hqDP4w3WTSRpbHy+vSq7Vrk2xS5PnQ7k0QJymiGF2WEuWc6MdMZ51UgE97Ininb/SyfmHrU+aeinCtlUluJQc4IrXfDoRLUL4pyw8wPIVmS0UMkaTsIpH+VSedXif7M2pZT5aTjUrRzkmtmhF/4d1JbyYXB2J7UWZEyqll1NyGRk+1Y+fjFvFcILtpGaQEKdOR/m9etGuY2jeUIragDny+2a0Y/LlBVMm8KatGzDaTggivQRrz0rP2/EpFyJkLodw/Ij3ppa3cVwoKMRno22K9DHmjPpmaeNxCwxoiJ6GXGedWKw71cRjCKT1qUPE1SmTJ0WKK6rwGpkDcnApWxim7cKu5rLcW4slurKGy5qz4w4+vDrY+GuuV+QB5Vi0uGvE1y/wCofmGeVef5GSTdRNWGC+jPgnE2fjRSViwcZAPQ0R8VYF7BKo2ZcZ6Eigfh/h7S8cjdQfCjUu7HptimnEuHm8d0VmLxsWRe4649awTdOn2aoLYoj8S5UQCMlgc6uwo/7MsETvcox0DOa5+H7Vr2YzPI0VtG2cjnJjoKO4xdCdbiBlIBxpI9P3FLGK7Y0p7pGdleW/uCSPCQL5A++a98Jo2QBVxndidqvIOrHIAY2rq6gjEOvOo42FFS2Ci/Rd3GpoRHpb/dtn2FAX1rI7p4lnpliOQc7CrYbmW3Ughjjl1xVy3l1djTKAq9H60YaFd2dW0ehF0g5bfFd3qFYiGBG3XpTC2gXwNU0ozjyjvQM0ivFMshPy8xVeOgWK7eETDSrHUeY71cIWjyrqnfURvRXBY44oAZjht98Z2r2c621fpUZT3SOinQpEUl1cFpY1OjJyw5mmNja+IrSzTAack+wFQ9hj61xNZy3Vu6xZEZGCQaeORuWwSjSLbn7N5jCdeORpTdnCjAGsDzf0q5IpIgQGDDPOqEUzz6AmcnvT2k7QjTfZ3w+2llImwPBU7sdgNs0/je3UK0cSSRhSZGY5JHPYZwMVTYwC3tpYxKQHGJMnJHUaV75wM9jXsMcca/Z7WB8y7M7nU7jtyGB7Cum4saGmCrcNIpZYzp79vSgoJ8TF8lmwQN+uedat+HxpCiphnJy4DY2HIHbnueVILyKSDPhNGmpvMOv0qPGmX5r4ju7WXidi0eFiuAA0b9m/vSRoeMW8jpdrG7IN9Lgn6VoUkJBeGMNIqjJauZLcKjXNwx1leYPOux5XDROcORnLpb24VHEWCrbb+ZfetjZbcPVLid2zjdhg5pJaXCSMBL5cnGPXvRaXSGdnOGjRvahlfPYYKhyLdJUA1HPehr+C6QI1vIVdTlXFJD8TPDeSRuoQhvkJpj/wCpLSRFznXy0jkaEecHo6ST7NLwviEd9EHXIcbOnY0zCrjbnWb4G8f2ybRjJUMSOtP/ABMAYFe5inzgmYZxqVBKNjmcCvK4IBUGpVLJ0H8hSTjfFhYwlT8zcqcuwCnPLFfOfii78e7YMfLGdsVm8rJxjSHwxtinjaXvEvB8CKSXxCV1jlnt6fpVnDOCTwFftd9a251A+WQMf/PvQCXzW0pUNIY25qeTUBxGTVEfAhIYnnrzpFY6k+jVcV2fS5FtrSz1W9xGqgZLhhvSy1u5+LzE2UgFpHkT3A/F6Vh+B2Nxxm6+xxN5BhpXJPkX/OlfQgsNjaJY2SaYYh8oyS/rUMsIwd/R4NvoY2HgkaUCpBEMIrHGfU0j4lMk9/IynyKdII6+tWX9wYbOPUx8WTZQBypBFK6F1dtRFIr42xvofp1uGGwGxqNGByPtVNu8mnLEHPQdKtbGksTSxjJsaTSOF8zZkyxHM9KLBRE1ggnoMUEZ1ijK6cP1Orp0pe10UYtrIHbvWqMaJchze36FdWgA6MZB/lSW2uGuGIUnOrmaEllluGwPKnU0Vb6YWRUGCNzRa0C9j23ixCoMg19qrYLG7mYvpAOyDf0pBPxt5ZgkcWlV2BBwT606s+IKeHsZ1BHMs34az8GnbKXrRbBeQRaZmiAbJGlySwPIbDAyKs/jYW0dfs+h8FTrA2NKLe1jFz4syu4JJAY9OhqmaXXkL85Od6vGJKUi55lJUDVqI2xXNpbsJA5ySDmq5UYFZM404I2rQWkMJgWWSRixPm0ry+lK2+kFR+lSAtLnUqZGWYnZRVlxxOHhyajbytARhpVbDHbqegrkamMkkJIRW0hh1zViIssbQTKxdzy6Y7/mKSMadso+tHMHErK7gCW0kgOeq4YD96U8RnRWWPSx82VZhg06PD4bUxmPSDgrp7HmP3pDxrwY3UPKBIPw5501CofcPeARyLI6qzHA1HegzaXSXJWVzNAhyGX5WFC2yRTqoYZJwckUys7GeNQUuICAf9NpDy/lUGtlBZxW1jmt/F4XhJ03dAfnHPPvS3hF6BJonmVweYIxWmgtrZrgvEwJO7ANgA9gKzl7wdFv7hmLIhbUgUZ2O9NFpxaYCj4ptVNzDcQnaRDuOu/+flSWG2kMnk51sbXh32uFY7hzhAfCY4wDVFtw8RN96mGBwRVY5eMaElBt2h98E2MtvE89w+7cgO1a5dLbg0q4IA1vtjy7YpoBivTwSUoJoyZNSLDgDLHGKlUXOTAQvOpVbEDL19FtK52wCa+a3uHkZm6k1vviGQrwyTSfm2zXzZl0PIzOXJO57fSvO82V5P8ADR469QG6XfIxnNAJDPcXQgiDM0h0gZwN6dLbtO5CDbbJPIUz4Zw23hEl0smWhG7HkpqcctKijjsa8PsLX4f4cltANVw/mlc83b+lX2cej/qJiCVHPOMelLbTiyTupvUcMD/qEDS396r4teQvLEiSEFjvGOQqDTk7ZRa0iriE89zdtJ5ljYELjt/gpfJC5IEfOnCTQmLLqQMEc+dCXLaE0spUrufau5bOoBWcxA62UMNgo3zXtzO0kYw4j9870tnu2clbSM6yeZFVi0vpArPJ5xyIHKrpVtsm38Gy3dvOpVpQTv5u9cKttCjM8YYsmcPkgD0wede2tnqMSJCFYHzMev0pjNw03EUimIiMDck4A9N+9B5Ip0BRYrkYSQB40BToVGBQLO8M2o7jrTW3sLi1XwNYMbdMDaiouBzTTJldC92OAaDmg8WBtDbSWsIEZZ98MNz025cuw6d965it5H+5MZUa11Cfy4/PpTWa1nsHIIC4PzBFJB/7sZoeaJXlMjM7sdyWbP8AOu/LHtgcZfCu7dpLiZ91jAwu2PLyA/LFL3cicCIDUR8w/D6+ppsEdlwFJXtzqnwo0BxEAefrRWWIODFUTTGVVbzHqcVsOHxhrHTG6RHBXuXJ6Gs9DZv44Y7MckGi4Lki5iAlIWP5mI5EdsUvPZXjo7Ec8M7L4LyKoz5BkfnRKLOtwjGEIx8w6VZ/EVA8WZAzEjOrcD6VfZX8E96MgGMHDeo7UspWw7oXccd/GjVJdGo5Ok5IpfBwuK4uvEum+7xqBA3Y9PpWturKxvlJTETgeUpkke+edZTiUklsTEDlVOkEdPani2SZTAXt5JIlO6HbV2pxw2aSaCTxMDPI9M1k1upFui8h1Fh83ajkbxnQNIwjb/lgVLJjKRlaNPwm3t7Y67nKAkuCpyMn8Jri3gaW5kE4Ag1FNznpz9qFhZljjSz82/3kjbjP9qYqUWYK0ia8YbSdmpLf1DMAgs5HkEUuqOWMnB1DB967njfZsDUNm9+9FEhX1M2RnT5h19a8dZrtXklDLIN3LEYbtSWmwphXAZ9M/h/7q0dZHhhMd3G3TVT64vZVPy4r0vBl6tGTOthF1cCAZOM9q8qqN/HhR3UEnvXtbyB58Uao+HIgPlJ3rA3C6GGkbZ/OvpHxBF4vC5Mbkb18+mXVu4yegry/KVZTV479KJ94V8GJM6d2Hc1RHKbC2Z5DIzyvlI/wluWPeqpF6Hyg8zvyrzhrw/xR1uTm2A1Rq/LWOX71NItVocxxrJYpMSUkVdKRnmvc0vnB+xmQadcUg5djmnyyxTJpwgUdcbE0jvpJFZ2kixHnSSOR7UYNMSVnFjdR+XMWf92TzpjeKjxBlUF8DJHUVnBLNasGeOQRk5DlDjHvTOLiBJCONiM5NBx2MgmCBWBIQg0ysrDWPJ9aBju41IwQMDGB1o+3vNKfcuAexqbjvYf8Jcw+EybFQeuOtdG7fDQSoQgI0qhxoPcdN8/WvZLiSaNkcgg7kt2qu0YeIba4J8LGpDvkE9vT0peO9B+HRVmTDwRSrjKsgKufpXSLHJphjMsTMcESHYGmKPADrOA6nYg9AO35UJeRl7USxO6zai3/AHfXvTSh+jlJfSqezkBVE1NldRRfNj6e29K2UaiNSnBwcGndtFIlms9xdqzvGpjjjIyoPJifYVQbmIyLHcId4gWc7ZP+ftQ4NAT2K1LbgE47CuRlmCnOMbjrR9zZ6R4kJKnOAp/Ec48veuJbOQArHGzynB55DA/tntQUL0NYPCMOZAdsbA8xR9vZxNaSTSDLLgKRtuapuYFiQqYyr6fMMjCtjOK8g4gGs40YrqRvlz83rVoxcexW/wBFV/aMbFllIP4iE6dqz/hX1vKBp+Y5THlY+3etPplYeJjMbZ1MDk6ev0zih5ItXGNFviZmi+5YrnBG5O/YA0Y90xXaQqtOKXaXS200LIzkgZ2JNNHjtp0IkJBx82n9aOt7dI0P2mSCRpACsUh3ORsc9DS654Y0koZpUhbZRhyCP/j1PpVUkydsVXXCR4wdRrUnAYHrVvFLQWENuyal1jzbcz3plb3fD7KNDcSgzglXhbmh6nFD8XuH4jGkkCt4UfJsc6i3LlQ+qK+G8UWAFZGOHIIzyNMILu2SbWmfFYksdWT6j1rNPCyjVkaM7g9DRVuY4irOfLnZhzqeTHX0eLs1U0iSyiKQavLk7bEdM174CsDGQSoGzYOV/WhoLi2uVZonAlY7FulFMXj0+IS2Rq8Q4IBqKpPYWDcPSUcTij2ZQ3McsVrZIInwWXOBSLgKPNdtNI2tsks3c1oGOBivU8KPq2Zc7tlGkBwqjYcsVKItY9TZNSvRS0Zmy+dBLbyRnkymvnvEIDHK23IkV9FU1lviK0WK52xh91Fef50OpL4aPHlujKSIdwRih1iW6nRZWPgpjVtTWaHx5CkbM+kDkOZ969uU+xrawnQgaQCRjyGenvWDm10aa2C2V2Y+IGzmiIhkyiN01dMVal4sgnUEgwtnJHSqHv5or+JjazLAuUYlep5frVinTFJNBoOrYsATz6Ua6GrsIe6b+H2xjUuXXcjlRM3h3HDYHaFJdWASwzp6H9+XalZjMfCotat+LxApI9v51YrTWlpBCYyIT94GB75ruNChM9hw8uVt0MQ05Mgc9KHS1dVRoZVlVuR5V7wqENDdqXBLSA4c4yoH9/0rzhMXg3cx1ZiwxAPTBA5fWu3VnBIluETT4Sn0B3NUm+cugWJydWDqBwoq37ZquFVmUxZ3PauuKTx2hkbUGREyc9c8hSx5NhbpbOry/t7WEXLsFTmAd8+1Z25+MeINhLVYlRPk8RdRA6dv3pJe3Ml3cNI40r+BOiiqVAyFJ9a9DHh4q2ZJ5G9IeWnHroB3mZQwGchRufb3o5uMi/8AA0/ePEgDIo0kD0HbP1rKqygFdt6Zx4MMb2riM5BA1fiHLB6Gn/FBi85IeRcaVIz4TI2R5Mfh9uxpjHLa3sIk8TDHl71nY5LS5B8aJo7qNSQyHSHkz2zsT+tSzuUCa1VlYDzaxvmozwcdorHLehtxAwxSpBEdLEDLfhHbHr3q+0hZmIRc6d2z275qq0jTUkk66nc7Z3yT602uZ0EEkEcQE8YzHbgg6u+COe2f51DjyLXRZHfwxW88E+hoSgWNVwGJ2OD1xt+lAyASzRTW8hi+9UBhuUyen6Um+JoL+OS3ljjkMMsa4ZFJUnPXaifh7Xc3EdvN4iqCGK482Ack+gAyc+3ej+N2juWj2bWvE5IXZyFdl3yWbpRE0ZuLd4rvRIsRBUnmRuBj9N+maZ3ktpeyH7ZbmyuGOuOVgcMDy1Y3/LagWlt44FhASWcnzSLnAA5Y2Hr0qjUU7TETtUKX4PE5WR3LOx2aRyBtvjP1H0q22iu7d2WWEwIuMSliI2Jz5QdwTtyptHB4i6/AIDAsUByCOhHXbf8AOhGXQ5ZOTA5AO1B5P6Csf6F4tZVnZwoYMDlH5EVW1mQivrDKT5o/xD+1NAQ2lV9crivJYFlHygnO3pUPy/sfjRTBw+Vbd57dlRAQCzHGKZWjy2sLGaYEE6WViMMewHWu7GeKM6ZQ4I21KMgj1FHx2Fvdy/d4eMnLN6etDipaXYebW2H8GjjSBpYhhW6dqPU+K2BVS/dsIIlwo2AFM7O1xuRuefpXrePj4RUTBklbsus7cnSANzUoPid0J3k4baP92nlvJQf/AKwe/fHLlzqVqI9l0yeGc9DS3jtn9stfIQsqboacWlzb8TtFurRxJFIOfLB7EdCKHuYjHnANJkgpRoeEqPmjcZkjuorVohHpJV9saj0r24jvZ5dRjIV8AhgSpHXNaT4g4Bb8Wi1xAR3I5MBzPrWWimubO8tLW8Rk0OoYncYryM2Bwdo248nIqtpvtvGxoP3KRvpHcqKIwy2MhjBxITj0APOqOGzBuJmK3hVYIg/mAyc4xz9c0wljIs3DHya2IGeWwX+ZqSKgM7tPZ5c5aPAcEcvWu2lW4soVDnwwOWOvL8qhVooEJf7xlzkjc7jaqZ4pUtFSM4dc5K8sHka74Al4t3bAvaORoUeTGQ/pV9vfW5ljnlBjS6+6JK/IQev1qpZZ24PEgXxnJOS2xwCcUHMjT2C4K7OQ4PIHv+VdSao4ZcVgjjl8GPy7gNJ3Hf8AnSbi95/EAVcrCsOwHMyHp+ldXl7PHZxRmVfEA0sc5PP+lZ65md5DrYkNuT3q+Bbtk8r9aL3a3CARZYnrVkNlrXUz6W5AUuDOFK52710kJkTUCW78xitTbf0zpUM04NI/yPmrv4deWQUTIuJBlQNyPfbagbKa5tcyQucLzB3FNbf4iv5tEQmjBbbOjGO2SN6muae9oZ8WdWvCjMYjcxyRwNucDzyd9A/fkO9W376rjWYQheQsygY3JzTGS7a0faRmnKgkcwR70rv3LsJCWy3nOc7mllk5aGjCthL38SXCRFznIAUHoedGRyTPOnkGtMsc9B0B/T86zi+Nc+FOV5bKQBzHKthw/g9zE4zBK0mMkkYVBz59aSfqtDxdvY8aWReF3H2ZBIWVlJc5bl09jn8qyVqhgRokICS4199uXP1rQC2aF1DHBPylHBB+oNX/AMPSaIkopIxy2z71BSlIqqizPyNM6fNluW/aqEklSdcQ+MTsADvmtLFYQCTzRlvQscUTDZQ27mSKFUJ/Fzx6UYu3sWTS6PbB5IooTMkQkT5O60n4xFiXxhn7w6iOmetOJA5K6VDMOZUb4pfxZlCEP8wG9Wkk4ixbsUw6y+9FDIOOvSjZeHC1gguLmePMvyxoDuB+W39RXAiN5cZhg8JdsIpzisk4tOmVUk0UwQu1wI8DJ+atNaxCBFijGWPOqbKxEBCRAvM3zuTmn1jw4RDXIcL1Jrd4njU+TM2bKno5srMlg7Dz1xf8QOt7Lh0qiYeS4uVIIiPVVPIt/L32ri84n9qj8HhkjJBnD3AG7jsh7f8AL8s8wNEixoqxqFUdP8/ma9Na6Mbd9lkESQQrFEulFGwzvz3z6+tSrIxqOKlFHMyVpd3PC7o3NkQS3+rCxwsvv2Pr+dbfhnEbbi9oJocq42kifZoz2asJIKoSWW2lEtvK8ci8mQ9Ox6Ee/wClTjKtMZr9G/ubMjzxikfEuGwX8RSdQso+V+xonhXxXbzlYeJgRSchMPkc/wD5+tOLmyiuE1KRv8rDka6cFNaCpNHy3iNtccHheFY93fPijkwFFPK0PDYI5/NIUy5A333x+YH5VsbuwLAxXKeLAedZvjHBHdfFgJkAOcA4KjBGMdff+teZm8dxdo2Y8lqmLbyBZrGJ2iOTEADnGD0H5Z/Kh7icRcNtZG1EqvhuU3yAcVPiQzosKW7sqlQGI/z3qvgoMvDprVwcxtqUkcgc/utZ1/5KJ7PbK8SeVoIlLwMPLrGNLY36Z3oS5luo7kOnyrt4GnbT3rvT9nnTU6oRJqwNzVxm+1uqookcggBjjT/aikrtDfxEN5qkldimBywO9AmEtzHKtE9kEdsSBu+KFeAZ5cqssiWkSlGxM8OByomO2mhhB04zvg0dFYvdO0cQxpUszNyVRzNKmuZwdLSFh0yMZFVi3JE9R7O5k1+Zcj/coq6yiMcyzgalU7ryIHc1Vby+flzp/Z20coGtchl+ZT+n8hSylWhlG9lsSM7pK7qPl2Rc9fXG9U3lrL4FwA51IgJjA3Ze4P5V3qkiJkG0KYyOeM8sinMCC4BnCsSlu5Y47ghf1IP0qcJSUqY0l6mT+GyFuyZGyM7Dpmvo9jxEJAIdEkglGgKT+m9ZSXhXmZbeLwpx59CnY9TjtXVnevEAJs+gqkxY/wBmiLSeP/1Gda7YIx+lHqzpalosFeRycY9jST7Ytyo+0M2oJpDg8h+9GxSPJZpHHhxnZi2D+VZoqUbHdMtQ42LH3pq6poGghiiZ2Pze3tSPEg3O3vtXXirgZcs3Yb5+tDE3F7DJWFzysCsmQo3wTtj1pHcBJXZQwAQZGrPmJ6DFMZtU6FQGDn5QNyfT0FF8N+HZJHDToBnkM/zq/tkdRQtqHYqsLKW6bfKouBrJ5DsK03D+GnSBENC9X6tTFbG1sIvFunSJF6scD6ChbvjUkvk4YngQj/3MqeZ+XyoRt7t+R2Na8Phxh7T2zNPO3pBsjWXCYg1y2WPyRoNTufQUqurq44ltcqIbf8NshyMf8z1PoNh686HVQXLsS8jfNI5yze5/blVq1sIliDfbYYxirV51woou0g8Vhq2HU9qIC61j0prYbdK9q5mBbSg8i7CpRsBgJaGepUqBUEYnYjuR70dwzjd9wtohbS5iaQIYZBlN/Tp9KlSmXYr6PpSgSwI7jdhkjpS68s4RmVQVYKeRqVKeaVHQYhu7SC7jYyoAV6rtWetIwt1Jp2BiJI74O1SpXiZ9TN+PoRXarJcElQNLYAHtRNvCng6wME7V7Urh/hJAFCgD5hk1XpGeVSpSfTmeSoEikZcg6d9+dJLlFUhMZU5O/Q56V7Uq+JksgJyYY2p1wmVw4XOx6VKlHL0dA0VvM0amTAYKB5GGVI32P5Ux4tcyi+vLZCEijbRhBjUPWpUoRfqF9oWamWUaSc5Az13FeiCO8uR4y7udJI51KlKuxpdA/ELdbG58KF3K/wDI13ZzSSPpZuo/epUp32KujUcRsIrdfKzssargMeeeeaH4bEl3KUcaFB5Jt+vOvKlLP/og/wATX2PDrW3WMRx4Lcz1qn4m4hNwm1iazCB5JRHqYZKggnI9dqlSvYxpKOjz5t2JHUtMZpXeWXGdchyfp2+mK9BLKjHnz/WpUoissWrFqVK4JctM5PuoY0TYOMmpUoo5nsYAqVKlA4//2Q==" },
      { id: 7, name: "Afang Soup", price: 12.00, img: "data:image/jpeg;base64,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" },
      { id: 8, name: "Fried Chicken", price: 1.49, img: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRXFwQ9fRok1YUP2MyT_zNFJW25LQtoqhO4Dq_KQRHoKrEt2NDBkNKwRoE&s" },
      { id: 9, name: "Egusi", price: 4.99, img: "data:image/jpeg;base64,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" },
      { id: 10, name: "Fried Rice", price: 8.49, img: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTF0JrpVW_vA5FQ4d7x5hGEfvaJrB4iyHfXfLgRFsTa1D8qMPFMO28LF5U&s" },
      { id: 11, name: "Smoothie", price: 2.99, img: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTIqwX3qtk0es_3UlTgCQi_ZrrRy9bmatoLODdUYHtLiI2hsptWyRmbILM&s" },
    ];

    let cart = JSON.parse(localStorage.getItem("cart")) || [];
A
    function renderMenu() {
      const menu = document.getElementById("menu");
      menu.innerHTML = "";
      menuItems.forEach(item => {
        const div = document.createElement("div");
        div.className = "item";
        div.innerHTML = `
          <img src="${item.img}" alt="${item.name}" />
          <h3>${item.name}</h3>
          <p>#${item.price.toFixed(2)}</p>
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
      document.getElementById("cart-count").textContent = count;
    }

    document.getElementById("cart-link").addEventListener("click", (e) => {
      e.preventDefault();
      window.location.href = "order.html";
    });

    renderMenu();
    updateCartCount();
  </script>
</body>
</html>
