<?php

include('connection.php');


if (isset($_POST['productId']) && isset($_POST['quantity'])) {
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];

  
    $stmt = $conn->prepare("SELECT pro_name FROM inventory WHERE id = :productId");
    $stmt->bindParam(':productId', $productId);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

   
    $stmt = $conn->prepare("SELECT * FROM stock WHERE name = :productName");
    $stmt->bindParam(':productName', $product['pro_name']);
    $stmt->execute();
    $existingProduct = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingProduct) {
       
        $stmt = $conn->prepare("UPDATE stock SET quantity = quantity + :quantity WHERE product_name = :productName");
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':productName', $product['pro_name']);
        $stmt->execute();
    } else {
       
        $stmt = $conn->prepare("INSERT INTO stock (product_name, quantity) VALUES (:productName, :quantity)");
        $stmt->bindParam(':productName', $product['pro_name']);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->execute();
    }

    // Update inventory quantity
    $stmt = $conn->prepare("UPDATE inventory SET quantity = quantity - :quantity WHERE id = :productId");
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':productId', $productId);
    $stmt->execute();

    echo "success";
} else {
    echo "error";
}
?>
