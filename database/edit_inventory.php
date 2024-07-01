<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit product</title>
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
    <h1>Edit product</h1>

    <?php
    
    if(isset($_GET['id'])) {
        $productId = $_GET['id'];

        
        include('connection.php');

        try {
           
            $stmt = $conn->prepare("SELECT * FROM inventory WHERE id = ?");
            $stmt->execute([$productId]);
            $inventory = $stmt->fetch(PDO::FETCH_ASSOC);

            
            ?>
            <form action="update_inventory.php" method="POST">
                <input type="hidden" name="productId" value="<?php echo $inventory['id']; ?>">
                <label for="pro_name">Name:</label>
                <input type="text" id="pro_name" name="pro_name" value="<?php echo $inventory['pro_name']; ?>"><br>
                <label for="barcode">barcode:</label>
                <input type="text" id="barcode" name="barcode" value="<?php echo $inventory['barcode']; ?>"><br>
                <label for="quantity">quantity:</label>
                <input type="number" min="1" id="quantity" name="quantity" value="<?php echo $inventory['quantity']; ?>"><br>
                <label for="supplier_name">supplier_name:</label>
                <input type="text" id="supplier_name" name="supplier_name" value="<?php echo $inventory['supplier_name']; ?>"><br>
                <button type="submit">Update Supplier</button>
            </form>
            <?php
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo 'product ID is missing.';
    }
    ?>
    </div>
</body>
</html>
