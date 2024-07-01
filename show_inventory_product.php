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
.editBtn{
    background-color: green;
    border-radius: 5px;
    border: none;
    width: 51px;
    height: 32px;
    color: white;
}
.deleteBtn{
    background-color: red;
    border-radius: 5px;
    border: none;
    width: 51px;
    height: 32px;
    color: white;
}
 </style>
    <script>
        $(document).ready(function() {
            
            loadinventory();

            function loadinventory() {
                $.ajax({
                    url: 'database/get_inventory.php',
                    type: 'GET',
                    success: function(data) {
                        var inventory = JSON.parse(data);
                        
                        var table = '<table border="1">';
                        table += '<tr><th>Name</th><th>barcode</th><th>quantity</th><th>supplier name</th><th>Actions</th></tr>';
                        for (var i = 0; i < inventory.length; i++) {
                            table += '<tr>';
                            table += '<td>' + inventory[i].pro_name + '</td>';
                            table += '<td>' + inventory[i].barcode + '</td>';
                            table += '<td>' + inventory[i].quantity + '</td>';
                            table += '<td>' + inventory[i].supplier_name + '</td>';
                            table += '<td>';
                            table += '<button class="editBtn" data-id="' + inventory[i].id + '">Edit</button>';
                            table += '<button class="deleteBtn" data-id="' + inventory[i].id + '">Delete</button>';
                            table += '</td>';
                            table += '</tr>';
                        }
                        table += '</table>';
                        
                        $('#inventoryList').html(table);

                        $('.editBtn').click(function() {
                            var productId = $(this).data('id');
                            // Redirect to edit page with supplier ID
                            window.location.href = 'database/edit_inventory.php?id=' + productId;
                        });

                        $('.deleteBtn').click(function() {
                            var productId = $(this).data('id');
                            if (confirm('Are you sure you want to delete this product ?')) {
                                $.ajax({
                                    url: 'database/delete_inventory.php',
                                    type: 'POST',
                                    data: { id: productId },
                                    success: function(response) {
                                        if (response && response.message) {
                                            alert(response.message);
                                        } else {
                                            alert('product deleted successfully.');
                                        }
                                        
                                        loadinventory();
                                    },
                                    error: function() {
                                        alert('Error deleting product.');
                                    }
                                });
                            }
                        });
                    },
                    error: function() {
                        $('#productList').html('Error fetching products.');
                    }
                });
            }
        });
    </script>
    </div>
</body>
</html>
