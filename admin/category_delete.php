<?php
    session_start();
    require_once '../lib/db/connection.php';

    if(isset($_POST['d_category'])){
        $c_id = mysqli_real_escape_string($conn, $_POST['d_category']);
        
        $c_sql = "DELETE FROM category WHERE id=$c_id";
        $c_delete = $conn->query($c_sql);

        if($c_delete){
            $_SESSION['msg'] = "Category Deleted Successfully";
            header("Location: category.php?status=success");
            exit(0);
        } else{
            $_SESSION['msg'] = "Category Not Deleted";
            header("Location: category.php?status=error");
            exit(0);
        }
    }
    else{
        $_SESSION['msg'] = "You are trying in a wrong way";
        header("Location: category.php?status=warning");
        exit(0);
    }
?>