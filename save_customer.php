<?php
// Database connection
$host = 'localhost';
$db = 'mydb';
$user = 'root';
$pass = '20031975@Reh'; // Replace with your MySQL password

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch the count of customers
    $countQuery = $conn->query("SELECT COUNT(*) FROM customers");
    $countResult = $countQuery->fetchColumn();

    // Generate a new customer ID by adding 1 to the count
    $newCustomerID = $countResult + 1;

    // Get form data
    $firstName = $_POST['first_name'];
    $email = $_POST['email'];
    $addressId = $_POST['address_id'];

    // Prepare and execute SQL query to insert data with the new unique ID
    $stmt = $conn->prepare("INSERT INTO customers (customer_id, first_name, email, address_id) VALUES (:customer_id, :first_name, :email, :address_id)");
    $stmt->bindParam(':customer_id', $newCustomerID);
    $stmt->bindParam(':first_name', $firstName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':address_id', $addressId);
    $stmt->execute();

    // Redirect back to the appropriate page with a success message
    header("Location: success.php?message=Customer added successfully");
} catch (PDOException $e) {
    // Handle database errors
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>