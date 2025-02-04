<!DOCTYPE html>
<html lang="en">
    <style>
            body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .container {
        display: flex;
    }

    .sidebar {
        width: 250px;
        background-color: #333;
        color: #fff;
        padding: 20px;
    }

    .sidebar .logo img {
        width: 100%;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
    }

    .sidebar ul li {
        margin: 15px 0;
    }

    .sidebar ul li a {
        color: #fff;
        text-decoration: none;
        display: flex;
        align-items: center;
    }

    .sidebar ul li a i {
        margin-right: 10px;
    }

    .content {
        flex: 1;
        padding: 20px;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .search-bar {
        display: flex;
    }

    .search-bar input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .search-bar button {
        padding: 10px;
        background-color: #5cb85c;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .product-list {
        display: flex;
        flex-wrap: wrap;
    }

    .product-item {
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin: 10px;
        padding: 10px;
        width: calc(33.333% - 20px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .product-item img {
        width: 100%;
    }

    .product-item h2 {
        font-size: 18px;
        margin: 10px 0;
    }

    .product-item p {
        font-size: 16px;
        color: #333;
    }

    .product-item button {
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    </style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OnShop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="logo.svg" alt="OnShop">
            </div>
            <ul>
                <li>
                    <a href="#">
                        <i class="fas fa-home"></i>
                        Home
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-shopping-cart"></i>
                        Categories
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-wallet"></i>
                        Wallet
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-shopping-cart"></i>
                        Cart
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-user"></i>
                        User Profile
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-cog"></i>
                        Settings
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-sign-out-alt"></i>
                        Log Out
                    </a>
                </li>
            </ul>
        </div>
        <div class="content">
            <div class="header">
                <h1>Jeans</h1>
                <div class="search-bar">
                    <input type="text" placeholder="Search Product">
                    <button>
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <div class="profile">
                    <img src="profile.jpg" alt="Sarif Hossain">
                    <span>Sarif Hossain</span </div>
            </div>
            <div class="product-list">
                <div class="product-item">
                    <img src="jeans1.jpg" alt="Jeans 1">
                    <h2>Stylish Jeans</h2>
                    <p>$49.99</p>
                    <button>Add to Cart</button>
                </div>
                <div class="product-item">
                    <img src="jeans2.jpg" alt="Jeans 2">
                    <h2>Classic Jeans</h2>
                    <p>$39.99</p>
                    <button>Add to Cart</button>
                </div>
                <div class="product-item">
                    <img src="jeans3.jpg" alt="Jeans 3">
                    <h2>Comfort Fit Jeans</h2>
                    <p>$59.99</p>
                    <button>Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>