<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(isset($_POST['productId']) && isset($_POST['pro_name']) && isset($_POST['barcode']) && isset($_POST['quantity']) && isset($_POST['supplier_name'])) {
        
        $productId = $_POST['productId'];
        $pro_name = $_POST['pro_name'];
        $barcode = $_POST['barcode'];
        $quantity = $_POST['quantity'];
        $supplier_name = $_POST['supplier_name'];

        
        include('connection.php');

        try {
            
            $stmt = $conn->prepare("UPDATE inventory SET pro_name = ?, barcode = ?, quantity = ?, supplier_name = ? WHERE id = ?");
            $stmt->execute([$pro_name, $barcode, $quantity,  $supplier_name ,$productId]);

            
            header("Location: edit_inventory.php?id=$productId&success=1");
            exit();
        } catch (PDOException $e) {
            
            header("Location: edit_inventory.php?id=$productId&error=" . urlencode($e->getMessage()));
            exit();
        }
    } else {
      
        header("Location: edit_inventory.php?id=$productId&error=Required fields are missing.");
        exit();
    }
} else {
 
    header("Location: edit_inventory.php?error=Form data not submitted.");
    exit();
}
?>
