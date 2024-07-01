
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>طلب توريد</title>
    <link rel="stylesheet" href="loginstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    
        
    <form action="make_order.php" method="post">
        <h1>طلب توريد</h1>
        <div calss="container">
        <div>
            <label for="product" id="product">المنتج</label><br>
            <input type="text" required id="product"  name="product" autocomplete="off">
            
        </div>
        <div>
            <label for="quantity" id="quantity">الكمية</label><br>
            <input type="quantity" required id="quantity" name="quantity" autocomplete="off">
            
        </div><br>

        <div>
            <label for="supplier_email" id="supplier_emaillabel">البريد الالكتروني للمورد</label><br>
            <input type="email" required id="supplier_email" name="supplier_email" autocomplete="off">
            
        </div><br>
            <input type="submit" value="طلب توريد" class="submitbtn">
        </div>

    </form>
    <style>
        label{
            left: 345px;
        }
        #supplier_emaillabel{
            left:204px;
        }
    </style>
</body>
</html>