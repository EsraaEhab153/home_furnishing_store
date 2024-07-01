<?php
// database connection file
include('connection.php');

try {

    $sql = "SELECT * FROM suppliers";
    $stmt = $conn->query($sql);
    $suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);

  
    echo json_encode($suppliers);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
