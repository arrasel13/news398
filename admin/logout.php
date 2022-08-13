<?php

session_start();
if(isset($_SESSION['user']) || isset($_COOKIE['user_info'])){
    session_destroy();
//    unset($_SESSION['user']);
    if(isset($_COOKIE['user_info'])){
        setcookie('user_info','', time()-3600);
    }
    $_SESSION['msg'] = "Successfully Logged Out!!!";
    header("Location: login.php?status=success");
}else{
    $_SESSION['msg']="Please login first";
    header("Location: login.php?status=error");
}