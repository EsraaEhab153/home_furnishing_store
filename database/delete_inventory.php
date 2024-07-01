<?php

include('connection.php');


if(isset($_POST['id'])) {
    $productId = $_POST['id'];

    try {
       
        $stmt = $conn->prepare("DELETE FROM inventory WHERE id = ?");
        $stmt->execute([$productId]);

       
        echo json_encode(['success' => true, 'message' => 'product deleted successfully.']);
    } catch (PDOException $e) {
        
        echo json_encode(['error' => 'Error deleting product: ' . $e->getMessage()]);
    }
} else {
    
    echo json_encode(['error' => 'product ID is missing.']);
}
?>
