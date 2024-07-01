<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فاتورة بيع</title>
    <link rel="stylesheet" href="card.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<main>
    <?php
    require_once 'database/connection.php';

    $sql = "SELECT * FROM stock";
    $stmt = $conn->query($sql);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
        ?>
        <div class="card">
            <div class="image">
                <!-- Use the image URL from the database -->
                <img src="<?php echo $row["image_url"]; ?>" alt="image">
            </div>
            <div class="caption">
                <p class="product_name"><?php echo $row["name"]; ?></p>
                <p class="price"><b>$<?php echo $row["price"]; ?></b></p>
                <p class="stock" style="display: none;"><?php echo $row["quantity"]; ?></p> <!-- Hidden field for stock quantity -->
            </div>
            <button class="add" data-id="<?php echo $row["barcode"]; ?>" data-quantity="<?php echo $row["quantity"]; ?>">Add to cart</button>
        </div>
    <?php
    }
    ?>
</main>

<div id="dialog">
    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity">
    <button id="confirm">Confirm</button>
    <button id="cancel">cancel</button>
</div>

<div class="col-4 posOrderContainer">
    <div class="pos_header">
        <div class="setting">
            <a href="javascript:void(0);"><i class='bx bxs-cog'></i></a>
        </div>
        <p class="logo">متجر مفروشات</p>
        <p class="timeAndDate" id="tad">XXX X,XXXX XX:XX:XX XX</p>
    </div>
    <div class="pos_item_container" id="pos_item_container">
        
        <div class="pos_label">
            <p>product</p>
            <p>price</p>
            <p>quantity</p>
            <p>total</p>
        </div>
    </div>

    <div class="item_total_container">
        <p class="item_total">
            <span class="item_total--label">TOTAL</span>
            <span  class="item_total--value">LE 0.00</span>
        </p>
    </div>
   
</div>
<div class="checkoutbtncontainer">
    <a href="javascript:void(0)" class="checkoutbtn">checkout</a>
</div>

<script>
    var addButton = document.getElementsByClassName("add");
    var totalAmount = 0; 

    for (var i = 0; i < addButton.length; i++) {
        addButton[i].addEventListener("click", function (event) {
            var target = event.target;
            var id = target.getAttribute("data-id");
            var maxQuantity = parseInt(target.getAttribute("data-quantity")); // Maximum quantity available in stock

          
            document.getElementById("dialog").style.display = "block";

           
            document.getElementById("confirm").onclick = function() {
                var quantity = parseInt(document.getElementById("quantity").value);

                if (isNaN(quantity) || quantity <= 0) {
                    alert("Please enter a valid quantity.");
                    return;
                }

                if (quantity > maxQuantity) {
                    alert("Quantity is higher than currently available stock.");
                    return;
                }

                
                var productName = target.parentElement.querySelector(".product_name").textContent;
                var productPrice = parseFloat(target.parentElement.querySelector(".price").textContent.replace("$", ""));
                var itemTotal = quantity * productPrice; 
                totalAmount += itemTotal; 

               
                var itemDiv = document.createElement("div");
                itemDiv.classList.add("pos_item");

                var itemName = document.createElement("p");
                itemName.textContent = productName;
                itemDiv.appendChild(itemName);

                var itemPrice = document.createElement("p");
                itemPrice.textContent = "" + productPrice.toFixed(2);
                itemDiv.appendChild(itemPrice);

                var itemQuantity = document.createElement("p");
                itemQuantity.textContent = "Quantity: " + quantity;
                itemDiv.appendChild(itemQuantity);

                var itemValue = document.createElement("p");
                itemValue.textContent = " LE  " + itemTotal.toFixed(2);
                itemDiv.appendChild(itemValue);

                
                document.getElementById("pos_item_container").appendChild(itemDiv);

                // Update total amount
                document.querySelector(".item_total--value").textContent = "$ " + totalAmount.toFixed(2);

                // Hide dialog after confirmation
                document.getElementById("dialog").style.display = "none";
            };
        });
    }
    document.getElementById("cancel").onclick = function() {
        document.getElementById("dialog").style.display = "none";
    };

document.querySelector('.checkoutbtn').addEventListener('click', function() {
    var items = [];
    var itemElements = document.querySelectorAll('.pos_item');

    itemElements.forEach(function(itemElement) {
        var itemName = itemElement.querySelector('p:nth-child(1)').textContent;
        var itemPrice = parseFloat(itemElement.querySelector('p:nth-child(2)').textContent.replace(' LE  ', ''));
        var itemQuantity = parseInt(itemElement.querySelector('p:nth-child(3)').textContent.replace('Quantity: ', ''));
        items.push({ name: itemName, price: itemPrice, quantity: itemQuantity });
    });

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'receipt.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.responseType = 'blob'; 
    xhr.onload = function() {
        if (this.status === 200) {
            var blob = new Blob([this.response], { type: 'application/pdf' });
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = 'invoice.pdf';
            link.click();
        }
    };
    xhr.send(JSON.stringify({ items: items }));
});

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="invoice.js"></script>
</body>
</html>

