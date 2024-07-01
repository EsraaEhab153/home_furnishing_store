<?php
 session_start();

 $table_name = $_SESSION['table'];
 $pro_name = $_POST['pro_name'];
 $barcode = $_POST['barcode'];
 $quantity = $_POST['quantity'];
 $supplier_name = $_POST['supplier_name'];
try{
   
    $command = "INSERT INTO $table_name (`pro_name`, `barcode`, `quantity`,`supplier_name`) VALUES ('$pro_name', '$barcode', '$quantity', '$supplier_name')";

    include('connection.php');
    $conn->exec($command);
   $response = [
    'success'=> true,
    'message'=> $name .' '.'successfully add to the system'
   ];
}
catch (PDOException $e){
    $response = [
        'success'=> false,
        'message'=> $e->getMessage()
       ];
}

$_SESSION['response'] = $response;
header('location:http://localhost/home_furnishing_store/add_pro_to_inventory.php');
?>