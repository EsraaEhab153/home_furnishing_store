<?php

include('connection.php');


if(isset($_POST['id'])) {
    $supplierId = $_POST['id'];

    try {
       
        $stmt = $conn->prepare("DELETE FROM suppliers WHERE id = ?");
        $stmt->execute([$supplierId]);

       
        echo json_encode(['success' => true, 'message' => 'Supplier deleted successfully.']);
    } catch (PDOException $e) {
        
        echo json_encode(['error' => 'Error deleting supplier: ' . $e->getMessage()]);
    }
} else {
    
    echo json_encode(['error' => 'Supplier ID is missing.']);
}
?>
