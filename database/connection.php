<?php
  $servername='localhost';
  $username = 'root';
  $password = '';


  //connection to DB
  try{
    $conn = new PDO("mysql:host=$servername;dbname=store",$username,$password);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
  }catch (\Exception $e){
   $error_message = $e->getMessage();
  }

?>