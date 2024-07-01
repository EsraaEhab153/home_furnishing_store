<?php
require('fpdf/fpdf.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the data of ordered items from the POST request
    $data = json_decode(file_get_contents("php://input"), true);

    // Create a new PDF instance
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    // Add header for product, price, quantity, and total amount
    $pdf->Cell(40, 10, 'Product', 1);
    $pdf->Cell(30, 10, 'Price', 1);
    $pdf->Cell(30, 10, 'Quantity', 1);
    $pdf->Cell(40, 10, 'Total Amount', 1);
    $pdf->Ln(); // Move to the next line

    // Add items to the PDF
    foreach ($data['items'] as $item) {
        // Calculate total amount for the current item
        $totalAmount = $item['quantity'] * $item['price'];

        // Add item details to the PDF
        $pdf->Cell(40, 10, $item['name'], 1); // Product name
        $pdf->Cell(30, 10, 'LE' . $item['price'], 1); // Price
        $pdf->Cell(30, 10, $item['quantity'], 1); // Quantity
        $pdf->Cell(40, 10, 'LE' . number_format($totalAmount, 2), 1); // Total amount
        $pdf->Ln(); // Move to the next line
    }

    // Output the PDF
    $pdf->Output();
} else {
    // Return an error message if the request method is not POST
    echo json_encode(array("success" => false, "message" => "Invalid request method."));
}
?>
