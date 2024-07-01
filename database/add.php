<?php
 session_start();

 $table_name = $_SESSION['table'];
 $name = $_POST['name'];
 $email = $_POST['email'];
 $location = $_POST['location'];
try{
    
    $command = "INSERT INTO $table_name (`name`, `email`, `location`) VALUES ('$name', '$email', '$location')";

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
header('location:http://localhost/home_furnishing_store/add_supplier.php');
?>