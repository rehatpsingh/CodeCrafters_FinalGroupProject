<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer | Grocery Store</title>
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
                    <a class="nav-link" href="order.php">Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="customer.php">Customer</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <h1 class="mb-4">Add Customer</h1>
        <form action="save_customer.php" method="POST">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address_id">Address:</label>
                <select id="address_id" name="address_id" class="form-control" required>
                    <?php
                    // Database connection
                    $host = 'localhost';
                    $db = 'mydb';
                    $user = 'root';
                    $pass = '20031975@Reh'; // Replace with your MySQL password

                    // Create a new PDO instance
                    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Query to fetch all addresses
                    $stmt = $conn->query("SELECT address_id, street_address, city, state, postal_code FROM address");
                    
                    // Loop through each address and create an option in the dropdown
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $row['address_id'] . '">' . 
                        $row['street_address'] . ', ' . 
                        $row['city'] . ', ' . 
                        $row['state'] . ' ' . 
                        $row['postal_code'] . 
                        '</option>';
                    }
                    
                    // Close the database connection
                    $conn = null;
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Customer</button>
        </form>
    </div>
    

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>