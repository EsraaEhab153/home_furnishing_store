<?php

include('database/connection.php');
require('fpdf/fpdf.php');




$stmt_inventory = $conn->query("SELECT * FROM inventory");
$inventory_data = $stmt_inventory->fetchAll(PDO::FETCH_ASSOC);


$stmt_stock = $conn->query("SELECT * FROM stock");
$stock_data = $stmt_stock->fetchAll(PDO::FETCH_ASSOC);

// Create PDF
class PDF extends FPDF
{
    // Page header
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Inventory and Stock Data', 0, 1, 'C');
        $this->Ln(5);
    }

    // Load inventory data
    function LoadInventoryData($data)
    {
        $this->SetFont('Arial', '', 10);
        $this->Cell(50, 10, 'Product Name', 1, 0, 'C');
        $this->Cell(40, 10, 'Barcode', 1, 0, 'C');
        $this->Cell(30, 10, 'Quantity', 1, 0, 'C');
        $this->Cell(50, 10, 'Supplier Name', 1, 1, 'C');

        foreach ($data as $row) {
            $this->Cell(50, 10, $row['pro_name'], 1, 0, 'C');
            $this->Cell(40, 10, $row['barcode'], 1, 0, 'C');
            $this->Cell(30, 10, $row['quantity'], 1, 0, 'C');
            $this->Cell(50, 10, $row['supplier_name'], 1, 1, 'C');
        }
    }

    // Load stock data
    function LoadStockData($data)
    {
        $this->SetFont('Arial', '', 10);
        $this->Cell(80, 10, 'Product Name', 1, 0, 'C');
        $this->Cell(60, 10, 'Quantity', 1, 1, 'C');

        foreach ($data as $row) {
            $this->Cell(80, 10, $row['name'], 1, 0, 'C');
            $this->Cell(60, 10, $row['quantity'], 1, 1, 'C');
        }
    }
}

$pdf = new PDF();
$pdf->AddPage();

// Load inventory data
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Inventory Data', 0, 1, 'L');
$pdf->Ln(5);
$pdf->LoadInventoryData($inventory_data);
$pdf->Ln(10);

// Load stock data
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Stock Data', 0, 1, 'L');
$pdf->Ln(5);
$pdf->LoadStockData($stock_data);
$pdf->Ln(10);

// Output PDF
$pdf->Output();

?>
