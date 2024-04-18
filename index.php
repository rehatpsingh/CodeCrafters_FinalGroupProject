<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Store | Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('images/background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .navbar {
            background-color: #2c8e3c !important;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            font-weight: 600;
        }
        .card-text {
            font-size: 24px;
            font-weight: 700;
        }
        .btn-primary {
            background-color: #2c8e3c;
            border-color: #2c8e3c;
        }
        .btn-primary:hover {
            background-color: #248233;
            border-color: #248233;
        }
        .logo {
            max-width: 200px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="index.php">Grocery Store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="order.php">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="customer.php">Customers</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="text-center">
            <img src="logo/Logo.png" alt="Grocery Store" class="logo">
            <h1 class="mb-4">Welcome to Grocery Store</h1>
            <p>Explore the store and manage your products, orders, and customers.</p>

            <!-- Buttons to generate PDF -->
            <div class="mb-5">
                <button class="btn btn-primary mr-2" onclick="window.location.href='generate_pdf.php'">
                    <i class="fa fa-file-pdf-o"></i> Get Products List
                </button>
                <button class="btn btn-primary mr-2" onclick="window.location.href='generate_customers_pdf.php'">
                    <i class="fa fa-file-pdf-o"></i> Get Customers List
                </button>
            </div>

            <!-- Cards for various statistics or information -->
            <div class="row">
                <?php
                // Database connection details
                $host = 'localhost';
                $db = 'mydb';
                $user = 'root';
                $pass = '20031975@Reh'; // Replace with your MySQL password

                try {
                    // Create a new PDO instance
                    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Fetch counts from the database
                    // Fetch total products
                    $stmt = $conn->query("SELECT COUNT(*) FROM Products");
                    $totalProducts = $stmt->fetchColumn();

                    // Fetch total orders
                    $stmt = $conn->query("SELECT COUNT(*) FROM Orders");
                    $totalOrders = $stmt->fetchColumn();

                    // Fetch total customers
                    $stmt = $conn->query("SELECT COUNT(*) FROM Customers");
                    $totalCustomers = $stmt->fetchColumn();

                    // Fetch total revenue
                    $stmt = $conn->query("SELECT SUM(total_amount) FROM Orders");
                    $totalRevenue = $stmt->fetchColumn();

                } catch (PDOException $e) {
                    // Handle errors
                    echo "Error: " . $e->getMessage();
                }

                // Close the connection
                $conn = null;
                ?>

                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Products</h5>
                            <p class="card-text"><?php echo $totalProducts; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Orders</h5>
                            <p class="card-text"><?php echo $totalOrders; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Customers</h5>
                            <p class="card-text"><?php echo $totalCustomers; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Revenue</h5>
                            <p class="card-text">$<?php echo number_format($totalRevenue, 2); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
