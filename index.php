<?php
    //start the session
    session_start();
    if(isset( $_SESSION["user"])) header('location:homepage.php');
   $error_message ='';
   if($_POST){
        include('database/connection.php');
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $query ='SELECT * FROM users WHERE users.username="'. $username .'"AND users.password="'. $password .'"LIMIT 1';
        $stmt = $conn->prepare($query);
        $stmt->execute();

       

        if($stmt->rowCount()>0){
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $user = $stmt->fetchAll()[0];
            $_SESSION['user']=$user;
            header('location:homepage.php');

        }
        else $error_message = 'Please Make Sure That The Username And Password Are Correct.. ' ;
        
   }

?>



<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول |محل بيع مفروشات</title>
    <link rel="stylesheet" href="loginstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php if(!empty($error_message)){?>
        <div id="error">
            <p> <strong>Error: </strong> <?= $error_message ?></p>
            
        </div>
    <?php } ?>
        
    <form action="index.php" method="post">
        <h1>تسجيل الدخول</h1>
        <div calss="container">
        <div>
            <label for="user_name" id="username">الاسم</label><br>
            <input type="text" required id="user_name"  name="username" autocomplete="off">
            <i class='bx bxs-user'></i>
        </div>
        <div>
            <label for="password" id="pass">كلمة المرور</label><br>
            <input type="password" required id="password" name="password" autocomplete="off">
            <i class='bx bxs-lock-alt' ></i>
        </div><br>
            <input type="submit" value="تسجيل الدخول" class="submitbtn">
        </div>

    </form>
</body>
</html>