<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Suppliers</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<button onclick="window.location.href='show_suppliers.php';">Show Suppliers</button>


    <script>
        $(document).ready(function() {
            $('#showSuppliersBtn').click(function() {
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
                                        //alert(response.message);
                                        alert("successfully delete supplier")
                                        $('#showSuppliersBtn').trigger('click');
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
            });
        });
    </script>
</body>
</html>
