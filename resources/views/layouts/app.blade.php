<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-commerce Homepage')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Include your CSS styles here */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
        }

        /* Top Header Styles */
        /* .top-header {
            height: 60px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: calc(100% - 250px);
            margin-left: 250px;
            z-index: 100;
        } */

        .top-header {
            height: 60px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 0 20px;
            display: flex;
            justify-content: space-between; /* This ensures items are spread out */
            align-items: center;
            position: fixed;
            width: calc(100% - 250px);
            margin-left: 250px;
            z-index: 100;
        }

        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .profile-section-wrapper {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        /* Search Bar Styles */
        .search-bar {
            flex-grow: 1;
            margin-right: 20px;
            max-width: 600px;
        }

        .search-input {
            width: 100%;
            padding: 8px 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }

        .profile-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .profile-info {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .profile-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .message-icon {
            font-size: 20px;
            color: #666;
            cursor: pointer;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #e3f2fd;
            padding: 20px;
            color: #333;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar-item {
            display: flex;
            align-items: center;
            padding: 15px;
            margin: 5px 0;
            cursor: pointer;
            transition: background-color 0.3s;
            border-radius: 8px;
            color: #333;
        }

        .sidebar-item:hover {
            background-color: #bbdefb;
        }

        .sidebar-item.active {
            background-color: #1976d2;
            color: white;
            font-weight: bold;
            border-left: 4px solid #fff;
        }

        .sidebar-item i {
            color: inherit;
            margin-right: 15px;
        }

        .sidebar-item.active i {
            color: white;
        }

        /* Main Content Styles */
        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 20px;
            margin-top: 60px;
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .product-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            width: 100%;
            height: 200px;
            background-color: #f5f5f5;
        }

        .product-info {
            padding: 15px;
        }

        .product-title {
            font-size: 16px;
            margin-bottom: 10px;
            color: #333;
        }

        .product-price {
            font-size: 18px;
            color: #1976d2;
            font-weight: bold;
        }

        .add-to-cart {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #1976d2;
            color: white;
            text-align: center;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-to-cart:hover {
            background-color: #1565c0;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-logo">
                <i class="fas fa-shopping-bag" style="font-size: 24px; color: #1976d2;"></i>
                <span class="logo-text">OnShop</span>
            </div>
            <div class="sidebar-items">
                <div class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"
                        style="text-decoration: none; color: inherit; display: flex; align-items: center;">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </a>
                </div>
                <div class="sidebar-item {{ request()->routeIs('cart_view') ? 'active' : '' }}">
                    <a href="{{ route('cart_view') }}"
                        style="text-decoration: none; color: inherit; display: flex; align-items: center;">
                        <i class="fas fa-user"></i>
                        <span>Cart</span>
                    </a>
                </div>
                <div class="sidebar-item">
                    <i class="fas fa-wallet"></i>
                    <span>Wallet</span>
                </div>
                <div class="sidebar-item {{ request()->routeIs('account_orders') ? 'active' : '' }}">
                    <a href="{{ route('account_orders') }}"
                        style="text-decoration: none; color: inherit; display: flex; align-items: center;">
                        <i class="fas fa-shopping-cart"></i>
                        <span>My Account</span>
                    </a>
                </div>
                <div class="sidebar-item">
                    <i class="fas fa-user"></i>
                    <span>User Profile</span>
                </div>
                <div class="sidebar-item">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </div>
            </div>

            <!-- Logout Item at the bottom -->
            <div class="sidebar-item">
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit"
                        style="background: none; border: none; color: inherit; font: inherit; cursor: pointer;">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Top Header -->
        <div class="top-header">
            @if(request()->routeIs('dashboard') || request()->routeIs('products.search') || request()->routeIs('product_show'))
            <div class="search-bar">
                <form method="GET" action="{{ route('products.search') }}">
                    <input type="text" id="search" name="search" class="search-input" placeholder="Search products..." value="{{ request('search') }}">
                </form>
            </div>
            @else
            <!-- Add an empty div to maintain layout when search bar is hidden -->
            <div></div>
            @endif
            
            <div class="profile-section">
                <div class="message-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="profile-info">
                    <div class="profile-image">
                        <i class="fas fa-user"></i>
                    </div>
                    <a href="{{ route('account_orders') }}" style="text-decoration: none; color: inherit;">
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>
</body>

</html>