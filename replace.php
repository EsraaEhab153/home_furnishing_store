<?php
    //start the session
    session_start();
    if(!isset($_SESSION["user"]))header('location:replace.php');

    $user = $_SESSION['user'];
    
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>استبدال</title>
    <link rel="stylesheet" href="loginstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    
        
    <form action="replace.php" method="post">
        <h1>استبدال</h1>
        <div calss="container">
        <div>
            <label for="product" id="product">المنتج المستبدل</label><br>
            <input type="text" required id="product"  name="product" autocomplete="off">
            
        </div>
        <div>
            <label for="quantity" id="quantity">عدد القطع</label><br>
            <input type="number"  min="1" required id="quantity" name="quantity" autocomplete="off">
            
        </div><br>

        <div>
            <label for="product2" id="product2">المستبدل به</label><br>
            <input type="text" required id="product2" name="product2" autocomplete="off">
            
        </div><br>
        <div>
            <label for="quantity2" id="quantity2">عدد القطع</label><br>
            <input type="number" min="1" required id="quantity2" name="quantity2" autocomplete="off">
            
        </div><br>
            <input type="submit" value="استبدال" class="submitbtn">
        </div>

    </form>
    <input type="checkbox" id="check">
        <label for="check">
            <i id="list" class='bx bx-list-ul'></i>
            <i id="cancel" class='bx bx-x'></i>
        </label>
    <div class="sidebar">
            <div class="user">
            <img src="usericon.jpg" alt="user image">
                <span><?= $user['username'] ?></span>
            </div>
            <a href="card.php"><i class='bx bxs-receipt' ></i><span>فاتورة بيع</span></a>
            <a href=""><i class='bx bx-repost' ></i><span>استبدال</span></a>
            <a href=""><i class='bx bx-undo' ></i><span>استرجاع</span></a>
            <a href="add_pro_to_inventory.php"><i id="btn1logo" class='bx bxs-store'></i><span>اضافة للمخزن</span></a>
            <a href=""><i class='bx bxs-truck' ></i><span>نقل من المخزن</span></a>
            <a href="reports.php"><i class='bx bxs-report' ></i><span>تقارير</span></a>
            <a href=""><i class='bx bxs-shopping-bag' ></i><span>طلب توريد</span></a>
            <a href="add_supplier.php"><i class='bx bxs-user-plus'></i><span>اضافة مورد</span></a>
            <a id="logout" href="database/logout.php"><i class='bx bx-log-out-circle'></i><span>تسجيل الخروج</span></a>
        </div>
    <style>
        form input{
            position:relative;
            top:1px;
        }
        form h1{
            top:26px;
            top:-3px;
        }
        label{
            top: 2px;
           left: 271px;
        }
        .submitbtn {
        top: -24px;
        }
        .sidebar{
            position: relative;
            left: -809px;
            width: 240px;
            background-color: #6f4026;
            height: 626px;
            transition: all .5s ease;
            top: -1px;
}
.sidebar a{
    display:block;
    color:#ffffff;
    height: 60px;
    width: 100%;
    line-height: 65px;
    padding-left: 30px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    border-top:1px solid black;
    border-left: 5px solid transparent;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif ;
    transition: all .5s ease;
    text-decoration: none;
}
.sidebar a:hover{
    border-left: 18px solid #ffffff;
    color: black;

}
.sidebar a i{
    font-size: 23px;
    margin-right: 16px;

}
.sidebar a span{
    letter-spacing: 1px;
}
#check{
   display: none; 
}
label #list, label #cancel{
   position: absolute;
   left: -747px;
   top: -313px;
   cursor: pointer;
   background: #6f4026;
   height: 45px;
   width: 45px;
   text-align: center;
   line-height: 40px;
   color: #ffffff;
   font-size: 29px;
   border: 1px solid #470C00;
   margin: 15px 30px;
   border-radius: 5px;
   transition: all .5s ease;
}
label #cancel{
    opacity: 0;
    visibility: hidden;
}
#check:checked ~ label #list{
    margin-left: 200px;
    opacity: 0;
    visibility: hidden;
 
 }  
#check:checked ~ label #cancel{
    margin-left: 200px;
    opacity: 1;
    visibility: visible;
 
 } 
#check:checked ~ .sidebar{
    left: -564px;;
} 
.user{
    height: 15%;
    position: inherit;
    left: 23px;
}
.user img{
    width: 56px;
    border-radius: 50%;
    position: inherit;
    top: 12px;

}
.user span{
    font-size: larger;
    font-weight: bolder;
    position: inherit;
    left: 14px;
    top: -6px;
    color: white;

}
#logout:hover{
    color:red;
    border-left: 18px solid red;
}
#label1{
    position: relative;
    display: inline;
    color: #470C00;
}
    </style>
</body>
</html>