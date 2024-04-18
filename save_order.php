<?php
require 'fpdf184/fpdf.php';

class PDF extends FPDF {
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

$host = 'localhost';
$db = 'mydb';
$user = 'root';
$pass = '20031975@Reh';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $customer_id = $_POST['customer_id'];
    $order_date = $_POST['order_date'];
    $total_amount = $_POST['total_amount'];
    $status = $_POST['status'];

    $stmt = $conn->query("SELECT COUNT(*) AS order_count FROM Orders");
    $order_count = $stmt->fetch(PDO::FETCH_ASSOC)['order_count'];
    $order_id = $order_count + 1;

    $stmt = $conn->prepare("INSERT INTO Orders (order_id, customer_id, order_date, total_amount, status) VALUES (:order_id, :customer_id, :order_date, :total_amount, :status)");
    $stmt->bindParam(':order_id', $order_id);
    $stmt->bindParam(':customer_id', $customer_id);
    $stmt->bindParam(':order_date', $order_date);
    $stmt->bindParam(':total_amount', $total_amount);
    $stmt->bindParam(':status', $status);
    $stmt->execute();

    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetMargins(15, 10, 15);

    $logo_path = 'Logo/logo.png';
    $logo_width = 40;
    $logo_height = 20;
    $pdf->Image($logo_path, ($pdf->GetPageWidth() - $logo_width) / 2, 10, $logo_width, $logo_height);

    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Ln($logo_height + 10);
    $pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Order ID: ' . $order_id, 0, 1);
    $pdf->SetXY($pdf->GetPageWidth() - 15 - 40, $pdf->GetY() - 10);
    $pdf->Cell(40, 10, 'Order Date: ' . $order_date, 0, 1, 'R');

    $pdf->Cell(0, 10, 'Customer ID: ' . $customer_id, 0, 1);
    $pdf->Cell(0, 10, 'Status: ' . $status, 0, 1);

    $pdf->SetXY($pdf->GetPageWidth() - 15 - 40, $pdf->GetY());
    $pdf->Cell(40, 10, 'Total Amount: $' . number_format($total_amount, 2), 0, 1, 'R');

    // Add a horizontal line just before the amount
    $pdf->Line(15, $pdf->GetY(), $pdf->GetPageWidth() - 15, $pdf->GetY());

    $invoice_filename = "invoices/invoice_" . $order_id . ".pdf";
    $pdf->Output('F', $invoice_filename);

    if (file_exists($invoice_filename)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($invoice_filename) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($invoice_filename));
        readfile($invoice_filename);
        exit;
    } else {
        echo "Error: Invoice file not found.";
    }

    echo "Order and invoice saved successfully!";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
