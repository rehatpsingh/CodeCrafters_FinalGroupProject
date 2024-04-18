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

    // Get form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Query to get the count of products
    $countQuery = $conn->query("SELECT COUNT(*) FROM Products");
    $countResult = $countQuery->fetchColumn();

    // Generate a new product ID by adding 1 to the count
    $newProductID = $countResult + 1;

    // Prepare and execute SQL query to insert data with the new unique ID
    $stmt = $conn->prepare("INSERT INTO Products (product_id, name, description, price) VALUES (:product_id, :name, :description, :price)");
    $stmt->bindParam(':product_id', $newProductID);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);

    // Execute the insert statement
    $stmt->execute();

    // Redirect to the add product page with a success message
    header("Location: products.php");
} catch (PDOException $e) {
    // Handle database connection errors
    if ($e->getCode() === '23000') {
        // Integrity constraint violation (e.g., duplicate entry)
        echo "Error: Duplicate entry for primary key 'product_id'. Please try again with a different product ID.";
    } else {
        echo "Error: " . $e->getMessage();
    }
}

// Close the database connection
$conn = null;
?>