<?php
    //start the session
    session_start();
    if(!isset($_SESSION["user"]))header('location:homepage.php');
    $_SESSION['table'] = 'suppliers';
    $user = $_SESSION['user'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اضافة مورد |محل بيع مفروشات</title>
    <link rel="stylesheet" href="add_supplier.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div id="home">
        <input type="checkbox" id="check">
        <label for="check">
            <i id="list" class='bx bx-list-ul'></i>
            <i id="cancel" class='bx bx-x'></i>
        </label>
        <div id="contacts" >
            <a class="cont cont1" href="">Contact &nbsp;&nbsp;</a>
            <a class="cont cont2" href="">Email&nbsp;&nbsp;</a>
            <a class="cont cont3" href="">Support&nbsp;&nbsp;</a>
            <a class="cont cont4" href="">Privacy Policy</a>
        </div>
         <div id="content_main">
            <h5 id="form_label">اضافة مورد <i class='bx bxs-user-plus'></i></h5>
            <form  action="database/add.php" method="post" class="appForm">
              <div class="appFormInputContainer">
                    <label for="name">الاسم </label>
                    <input class="appFormInput" type="text" name="name" id="name" placeholder="اسم المورد" required>
                </div>
                <div class="appFormInputContainer">
                    <label for="email">البريد الالكتروني</label>
                    <input class="appFormInput" type="email" name="email" id="email" required placeholder="البريد الالكتروني للمورد">
                </div>
                <div class="appFormInputContainer">
                    <label for="location">العنوان</label>
                    <input class="appFormInput" type="text" name="location" id="location" placeholder="عنوان المورد" required>
                </div>
                
                <button type="submit" id="formButton"><i class='bx bx-plus'></i>Add Supplier</button>
                
            </form>
            <?php
            if(isset($_SESSION['response'])){
                $response_message = $_SESSION['response']['message'];
                $is_success = $_SESSION['response']['success'];
            ?>
            <div class="responseMessage">
                <p class="<?= $is_success ? 'responseMessage_success' : 'responseMessage_error'?>">
                <?= $response_message?>
            </p>
            </div>
            <?php unset($_SESSION['response']);} ?>
         </div>
         <button id="showSuppliersBtn" onclick="window.location.href='show_supplier.php';">Show Suppliers</button>


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
            <a href=""><i class='bx bxs-receipt' ></i><span>فاتورة بيع</span></a>
            <a href=""><i class='bx bx-repost' ></i><span>استبدال</span></a>
            <a href=""><i class='bx bx-undo' ></i><span>استرجاع</span></a>
            <a href=""><i id="btn1logo" class='bx bxs-store'></i><span>اضافة للمخزن</span></a>
            <a href=""><i class='bx bxs-truck' ></i><span>نقل من المخزن</span></a>
            <a href=""><i class='bx bxs-report' ></i><span>تقارير</span></a>
            <a href=""><i class='bx bxs-shopping-bag' ></i><span>طلب توريد</span></a>
            <a href="add_supplier.php"><i class='bx bxs-user-plus'></i><span>اضافة مورد</span></a>
            <a id="logout" href=""><i class='bx bx-log-out-circle'></i><span>تسجيل الخروج</span></a>
        </div> 
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>