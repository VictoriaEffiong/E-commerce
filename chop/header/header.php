<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ediokeff Foods</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="shortcut icon" href="./uploads/logo2.png" type="image/x-icon">
<link rel="stylesheet" href="style.css">
  <style>
    html {
  scroll-behavior: smooth;
}
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
      margin-top: 8%;
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
      margin-top: 3%;
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
      <img src="./uploads/logo2.png" alt="Logo">
      <h1>Ediokeff Foods</h1>
    </div>
    <nav class="navbar">
      <a href="#">Home</a>
      <a href="#menu">Menu</a>
      <a href="order.php" id="cart-link">Cart <span id="cart-count" class="cart-count">0</span></a>
      <a href="#">About Us</a>
      <a href="contact.php">Contact</a>
    </nav>
  </header>
