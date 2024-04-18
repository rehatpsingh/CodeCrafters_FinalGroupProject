<?php
require 'fpdf184/fpdf.php';

// Define a custom class that extends the FPDF class
class PDF extends FPDF {
    // Override the Footer method to add custom footer content
    function Footer() {
        // Set the position of the footer at 1.5 cm from the bottom
        $this->SetY(-15);
        // Set the font for the footer
        $this->SetFont('Arial', 'I', 8);
        // Add the footer text
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C'); // Add page number centered
    }
}

// Create a new PDF document
$pdf = new PDF();
$pdf->AddPage();

$left_margin = 15;
$right_margin = 15;
$pdf->SetMargins($left_margin, 10, $right_margin);

$logoPath = 'logo/Logo.png';
$logoWidth = 50;
$logoHeight = 20;
$pdf->Image($logoPath, (210 - $logoWidth) / 2, 20, $logoWidth, $logoHeight);

$pdf->SetFont('Arial', 'B', 18);
$pdf->Ln($logoHeight + 10);
$pdf->Cell(0, 20, 'List of Products', 0, 1, 'C');
$pdf->Ln(10);

$servername = "localhost";
$username = "root";
$password = "20031975@Reh";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT product_id, name, price FROM products";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetFillColor(144, 238, 144);

    $pdf->Cell(40, 10, 'Product ID', 1, 0, 'C', true);
    $pdf->Cell(80, 10, 'Product Name', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Price ($)', 1, 1, 'C', true);

    $pdf->SetFillColor(255, 255, 255);

    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(40, 10, $row['product_id'], 1, 0, 'C');
        $pdf->Cell(80, 10, $row['name'], 1, 0, 'C');
        $pdf->Cell(40, 10, number_format($row['price'], 2), 1, 1, 'C');
    }
} else {
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'No products found.', 0, 1, 'C');
}

$conn->close();
$pdf->Output('D', 'product_list.pdf');

?>
