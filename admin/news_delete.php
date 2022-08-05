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

    if(isset($_POST['d_news'])){
        $n_id = mysqli_real_escape_string($conn, $_POST['d_news']);
        
        $n_sql = "DELETE FROM news WHERE id=$n_id";
        $n_delete = $conn->query($n_sql);

        if($n_delete){
            $_SESSION['msg'] = "News Deleted Successfully";
            header("Location: news.php?status=success");
            exit(0);
        } else{
            $_SESSION['msg'] = "News Not Deleted";
            header("Location: news.php?status=error");
            exit(0);
        }
    }
    else{
        $_SESSION['msg'] = "You are trying in a wrong way";
        header("Location: news.php?status=warning");
        exit(0);
    }
?>