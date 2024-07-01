<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (isset($_POST["id"]) && isset($_POST["quantity"])) {
        
        $id = $_POST["id"];
        $quantity = $_POST["quantity"];

        
        require_once 'connection.php';

        
        $sql = "UPDATE stock SET quantity = quantity - :quantity WHERE barcode = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        
        if ($stmt->rowCount() > 0) {
            
            echo json_encode(array("success" => true));
        } else {
           
            echo json_encode(array("success" => false, "message" => "Failed to update quantity."));
        }
    } else {
       
        echo json_encode(array("success" => false, "message" => "ID or quantity parameter is missing."));
    }
} else {
    
    echo json_encode(array("success" => false, "message" => "Invalid request method."));
}
?>
