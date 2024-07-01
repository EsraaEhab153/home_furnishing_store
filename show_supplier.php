<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Suppliers</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div id="home">
    <div id="suppliersList"></div>
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
#suppliersList{
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
            // Call function to load suppliers when page is ready
            loadSuppliers();

            function loadSuppliers() {
                $.ajax({
                    url: 'database/get_supplier.php',
                    type: 'GET',
                    success: function(data) {
                        var suppliers = JSON.parse(data);
                        
                        var table = '<table border="1">';
                        table += '<tr><th>Name</th><th>Email</th><th>Location</th><th>Actions</th></tr>';
                        for (var i = 0; i < suppliers.length; i++) {
                            table += '<tr>';
                            table += '<td>' + suppliers[i].name + '</td>';
                            table += '<td>' + suppliers[i].email + '</td>';
                            table += '<td>' + suppliers[i].location + '</td>';
                            table += '<td>';
                            table += '<button class="editBtn" data-id="' + suppliers[i].id + '">Edit</button>';
                            table += '<button class="deleteBtn" data-id="' + suppliers[i].id + '">Delete</button>';
                            table += '</td>';
                            table += '</tr>';
                        }
                        table += '</table>';
                        
                        $('#suppliersList').html(table);

                        $('.editBtn').click(function() {
                            var supplierId = $(this).data('id');
                            // Redirect to edit page with supplier ID
                            window.location.href = 'database/edit_user.php?id=' + supplierId;
                        });

                        $('.deleteBtn').click(function() {
                            var supplierId = $(this).data('id');
                            if (confirm('Are you sure you want to delete this supplier?')) {
                                $.ajax({
                                    url: 'database/delete_user.php',
                                    type: 'POST',
                                    data: { id: supplierId },
                                    success: function(response) {
                                        if (response && response.message) {
                                            alert(response.message);
                                        } else {
                                            alert('Supplier deleted successfully.');
                                        }
                                        // Reload suppliers after deletion
                                        loadSuppliers();
                                    },
                                    error: function() {
                                        alert('Error deleting supplier.');
                                    }
                                });
                            }
                        });
                    },
                    error: function() {
                        $('#suppliersList').html('Error fetching suppliers.');
                    }
                });
            }
        });
    </script>
    </div>
</body>
</html>
