<?php
    //start the session
    session_start();
    if(!isset($_SESSION["user"]))header('location:index.php');

    $user = $_SESSION['user'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الرئيسية |محل بيع مفروشات</title>
    <link rel="stylesheet" href="home.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <div id="home">
        <input type="checkbox" id="check">
        <label for="check">
            <i id="list" class='bx bx-list-ul'></i>
            <i id="cancel" class='bx bx-x'></i>
        </label>
        <a id="login" href="loginpage.html" target="_blank"></a>
        <div id="contacts" >
            <a class="cont cont1" href="">Contact &nbsp;&nbsp;</a>
            <a class="cont cont2" href="">Email&nbsp;&nbsp;</a>
            <a class="cont cont3" href="">Support&nbsp;&nbsp;</a>
            <a class="cont cont4" href="">Privacy Policy</a>
        </div>
        <div>
            <p id="title_label">محل بيع مفروشات</p>
        </div>
        <div class="features">
            <a href="add_pro_to_inventory.php"><button  class="buttons bt1"> <i id="btn1logo" class='bx bxs-store'></i></button><br></a>
            <h3 id="t1">اضافة للمخزن</h3>
            <a href="replace.php"><button class="buttons bt2"> <i class='bx bx-repost' ></i> </button><br></a>
            <h3 id="t2">استبدال</h3>
            <a href="return.php"> <button class="buttons bt3"> <i class='bx bx-undo'></i> </button><br></a>
            <h3 id="t3">استرجاع</h3>
            <a href="card.php"><button  class="buttons bt4"> <i class='bx bxs-receipt' ></i></button><br></a>
            <h3 id="t4">فاتورة بيع</h3>
            <a href="shipping.php"><button  class="buttons bt5"> <i class='bx bxs-truck' ></i></button><br></a>
            <h3 id="t5">نقل من المخزن</h3>
            <a href="reports.php"><button  class="buttons bt6"> <i class='bx bxs-report' ></i></button><br></a>
            <h3 id="t6">تقارير</h3>
            <a href="make_order.php"><button class="buttons bt7"> <i class='bx bxs-shopping-bag' ></i></button><br></a>
            <h3 id="t7">طلب توريد</h3>
            <a href="add_supplier.php"><button  class="buttons bt8"> <i class='bx bxs-user-plus'></i></button><br></a>
            <h3 id="t8">اضافة مورد</h3> 
        </div>
        <div class="social">
            <a href=""><i class='bx bxl-facebook'></i></a>
            <a href=""><i class='bx bxl-linkedin' ></i></a>
            <a href=""><i class='bx bxl-github'></i></a>
            <a href=""><i class='bx bxl-gmail' ></i></a>
            <a href=""><i class='bx bxl-whatsapp'></i></a>
        </div>
        <div class="sidebar">
            <div class="user">
            <img src="usericon.jpg" alt="user image">
                <span><?= $user['username'] ?></span>
            </div>
            <a href="card.php"><i class='bx bxs-receipt' ></i><span>فاتورة بيع</span></a>
            <a href="replace.php"><i class='bx bx-repost' ></i><span>استبدال</span></a>
            <a href="return.php"><i class='bx bx-undo' ></i><span>استرجاع</span></a>
            <a href="add_pro_to_inventory.php"><i id="btn1logo" class='bx bxs-store'></i><span>اضافة للمخزن</span></a>
            <a href="shipping.php"><i class='bx bxs-truck' ></i><span>نقل من المخزن</span></a>
            <a href="reports.php"><i class='bx bxs-report' ></i><span>تقارير</span></a>
            <a href="make_order.php"><i class='bx bxs-shopping-bag' ></i><span>طلب توريد</span></a>
            <a href="add_supplier.php"><i class='bx bxs-user-plus'></i><span>اضافة مورد</span></a>
            <a id="logout" href="database/logout.php"><i class='bx bx-log-out-circle'></i><span>تسجيل الخروج</span></a>
        </div>
    </div>
    <style>
        #title_label{
            display: inline;
            position: relative;
            top: 80px;
            left: 34%;
            font-size: 32px;
            font-weight: bold;
            color:#470C00;
        }
    </style>
</body>
</html>