<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
    <style>
        body{
    display:flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url(IMG-20240309-WA0040.jpg) no-repeat;
    background-size:contain;
    background-position: center;
    background-color: #93887D;
 }
#home{
    background-color: rgba(255, 255, 255, 40%);
    border-radius: 20px;
    height: 539px;
    width: 573px;
    justify-content:center ;
    position: relative;
    top:39px;
}
form{
    position: relative;
    top: 160px;
    left: 149px;
}
input{
    background-color: rgba(111,64,38,40%);
    width: 300px;
    height: 29px;
    border: 1px solid rgb(111, 64, 38);
    border-radius: 13px;
    margin-bottom:30px; 
    position: relative;
    top: -58px;
    left: -17px;
    font-weight: bold;
    font-size: 17px;
}
#location{
    left:-30px;
}
label{
    position: relative;
    top: -58px;
    left: -38px;
}
button{
    color: white;
    background-color: #6f4026;
    height: 39px;
    border: none;
    border-radius: 14px;
    position: relative;
    left: 69px;
    top: -28px;
}
    </style>
</head>
<body>
    <div id="home">
    <h1>Edit Supplier</h1>

    <?php
    // Check if supplier ID is provided in the URL
    if(isset($_GET['id'])) {
        $supplierId = $_GET['id'];

        
        include('connection.php');

        try {
           
            $stmt = $conn->prepare("SELECT * FROM suppliers WHERE id = ?");
            $stmt->execute([$supplierId]);
            $supplier = $stmt->fetch(PDO::FETCH_ASSOC);

            
            ?>
            <form action="update_supplier.php" method="POST">
                <input type="hidden" name="supplierId" value="<?php echo $supplier['id']; ?>">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $supplier['name']; ?>"><br>
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $supplier['email']; ?>"><br>
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" value="<?php echo $supplier['location']; ?>"><br>
                <button type="submit">Update Supplier</button>
            </form>
            <?php
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo 'Supplier ID is missing.';
    }
    ?>
    </div>
</body>
</html>
