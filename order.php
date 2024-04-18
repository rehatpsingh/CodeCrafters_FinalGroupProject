<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Order | Grocery Store</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
        }
        .navbar {
            background-color: #2c8e3c !important;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .form-control {
            border-radius: 8px;
        }
        .btn-primary {
            background-color: #2c8e3c;
            border-color: #2c8e3c;
        }
        .btn-primary:hover {
            background-color: #248233;
            border-color: #248233;
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
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="order.php">Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="customer.php">Customer</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <h1 class="mb-4">Add Order</h1>
        <form action="save_order.php" method="POST">
            <div class="form-group">
                <label for="customer_id">Customer:</label>
                <select id="customer_id" name="customer_id" class="form-control" required>
                    <?php
                    // Database connection
                    $host = 'localhost';
                    $db = 'mydb';
                    $user = 'root';
                    $pass = '20031975@Reh'; // Replace with your MySQL password

                    // Create a new PDO instance
                    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Query to fetch all customers
                    $stmt = $conn->query("SELECT customer_id, first_name, last_name FROM customers");
                    
                    // Loop through each customer and create an option in the dropdown
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $customer_full_name = $row['first_name'] . ' ' . $row['last_name'];
                        echo '<option value="' . $row['customer_id'] . '">' . $customer_full_name . '</option>';
                    }
                    
                    // Close the database connection
                    $conn = null;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="order_date">Order Date:</label>
                <input type="date" id="order_date" name="order_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="total_amount">Total Amount:</label>
                <input type="number" id="total_amount" name="total_amount" class="form-control" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="canceled">Canceled</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Order</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>