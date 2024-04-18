<?php
require 'fpdf184/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage();

$logoPath = 'logo/Logo.png';
$logoWidth = 50;
$logoHeight = 20;
$pdf->Image($logoPath, (210 - $logoWidth) / 2, 10, $logoWidth, $logoHeight);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln($logoHeight + 10);
$pdf->Cell(0, 10, 'List of Customers and Addresses', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(144, 238, 144);
$pdf->Cell(20, 10, 'ID', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'First Name', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'Email', 1, 0, 'C', true);
$pdf->Cell(70, 10, 'Address', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 10);

$host = 'localhost';
$db = 'mydb';
$user = 'root';
$pass = '20031975@Reh';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT c.customer_id, c.first_name, c.email, a.street_address, a.city, a.state, a.postal_code
            FROM customers c
            JOIN address a ON c.address_id = a.address_id";
    $result = $conn->query($sql);

    if ($result && $result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $pdf->Cell(20, 10, $row['customer_id'], 1);
            $pdf->Cell(40, 10, $row['first_name'], 1);
            $pdf->Cell(60, 10, $row['email'], 1);
            $address = $row['street_address'] . ', ' . $row['city'] . ', ' . $row['state'] . ' ' . $row['postal_code'];
            $pdf->Cell(70, 10, $address, 1);
            $pdf->Ln();
        }
    } else {
        $pdf->Cell(0, 10, 'No customers found.', 1, 1, 'C');
    }

    $conn = null;
    $pdf->Output('D', 'customers_list.pdf');

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
