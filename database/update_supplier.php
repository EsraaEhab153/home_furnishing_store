<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if(isset($_POST['supplierId']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['location'])) {
        
        $supplierId = $_POST['supplierId'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $location = $_POST['location'];

       
        include('connection.php');

        try {
          
            $stmt = $conn->prepare("UPDATE suppliers SET name = ?, email = ?, location = ? WHERE id = ?");
            $stmt->execute([$name, $email, $location, $supplierId]);

           
            header("Location: edit_user.php?id=$supplierId&success=1");
            exit();
        } catch (PDOException $e) {
            
            header("Location: edit_user.php?id=$supplierId&error=" . urlencode($e->getMessage()));
            exit();
        }
    } else {
      
        header("Location: edit_user.php?id=$supplierId&error=Required fields are missing.");
        exit();
    }
} else {
   
    header("Location: edit_user.php?error=Form data not submitted.");
    exit();
}
?>
