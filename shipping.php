<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show inventory</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div id="home">
    <div id="inventoryList"></div>
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
#inventoryList{
    background-color: white;
    width: 528px;
    position: relative;
    left: 23px;
}
table{
    border: 0.2px solid  #6f4026;
    border-collapse: collapse;
    font-weight: bold;
    
}
.addBtn{
    background-color: green;
    border-radius: 5px;
    border: none;
    width: 89px;
    height: 32px;
    color: white;
}
 </style>
    <script>
        $(document).ready(function() {
    // Call function to load inventory when page is ready
    loadInventory();

    function loadInventory() {
        $.ajax({
            url: 'database/fetch.php',
            type: 'GET',
            success: function(data) {
                var inventory = JSON.parse(data);

                var table = '<table border="1">';
                table += '<tr><th>Name</th><th>Barcode</th><th>Quantity</th><th>Supplier Name</th><th>Actions</th></tr>';
                for (var i = 0; i < inventory.length; i++) {
                    table += '<tr>';
                    table += '<td>' + inventory[i].pro_name + '</td>';
                    table += '<td>' + inventory[i].barcode + '</td>';
                    table += '<td>' + inventory[i].quantity + '</td>';
                    table += '<td>' + inventory[i].supplier_name + '</td>';
                    table += '<td>';
                    table += '<button class="addBtn" data-id="' + inventory[i].id + '" data-quantity="' + inventory[i].quantity + '">Add to Stock</button>';
                    table += '</td>';
                    table += '</tr>';
                }
                table += '</table>';

                $('#inventoryList').html(table);

                
                $(document).on('click', '.addBtn', function() {
                    var productId = $(this).data('id');
                    var maxQuantity = $(this).data('quantity');
                    var quantity = prompt('Enter quantity to add to stock (maximum ' + maxQuantity + '):');
                    if (quantity !== null) {
                        if (parseInt(quantity) <= maxQuantity) {
                          
                            addToStock(productId, quantity);
                        } else {
                            alert('Quantity exceeds available stock.');
                        }
                    }
                });

            },
            error: function() {
                $('#inventoryList').html('Error fetching inventory.');
            }
        });
    }

    function addToStock(productId, quantity) {
        $.ajax({
            url: 'database/add_to_stock.php',
            type: 'POST',
            data: {
                productId: productId,
                quantity: quantity
            },
            success: function(response) {
                
                loadInventory();
                alert('Product added to stock successfully.');
            },
            error: function() {
                alert('Error adding product to stock.');
            }
        });
    }
});

    </script>
    </div>
</body>
</html>

