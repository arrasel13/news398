<?php
session_start();
require_once '../lib/db/connection.php';

if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
}else{
    if(isset($_COOKIE["user_info"])){

    }else{
        $_SESSION['msg']="Please login first";
        header("Location: login.php?status=error");
    }
}

if(isset($_POST['d_banner'])){
    $banner_id = mysqli_real_escape_string($conn, $_POST['d_banner']);

    $banner_sql = "DELETE FROM banner WHERE id=$banner_id";
    $banner_delete = $conn->query($banner_sql);

    if($banner_delete){
        $_SESSION['msg'] = "Banner Info Deleted Successfully";
        header("Location: banner.php?status=success");
        exit(0);
    } else{
        $_SESSION['msg'] = "Banner Info Not Deleted";
        header("Location: banner.php?status=error");
        exit(0);
    }
}
else{
    $_SESSION['msg'] = "You are trying in a wrong way";
    header("Location: banner.php?status=warning");
    exit(0);
}
?>