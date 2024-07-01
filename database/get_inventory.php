
<?php
//Include  database connection file
include('connection.php');

try {
    $sql = "SELECT * FROM inventory";
    $stmt = $conn->query($sql);
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    echo json_encode($inventory);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
