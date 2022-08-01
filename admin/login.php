<?php
session_start();
require_once '../lib/db/connection.php';

if (isset($_POST['loginBtn'])){
    $useremail = $_POST['useremail'];
    $password = md5($_POST['password']);
    $rememberPass = isset($_POST['rememberPass'])?1:0;

//    echo $password."<br>";
//    echo $rememberPass;
//    exit;


    $l_sql = "SELECT * FROM users WHERE useremail='$useremail' AND password='$password'";
    $l_query = $conn->query($l_sql);

    if ($l_query->num_rows > 0){

        $l_query1 = $l_query->fetch_assoc();

        $_SESSION['user'] = $l_query1['username'];
        $_SESSION['msg']="Successfully Logged In";
        header("Location: admin.php?status=success");
    } else{
        $_SESSION['msg']="User Email or Password does not match";
        header("Location: login.php?status=error");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - MyNews</title>
        <link rel="stylesheet" href="css/toastr.min.css">
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control useremail" id="useremail" type="email" name="useremail" placeholder="name@example.com" />
                                                <label for="useremail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="password" type="password" name="password" placeholder="Password" />
                                                <label for="password">Password</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="rememberPass" name="rememberPass" type="checkbox" value="" />
                                                <label class="form-check-label" for="rememberPass">Remember Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
<!--                                                <a class="small" href="no_need/password.html">Forgot Password?</a>-->
                                                <button class="btn btn-primary loginBtn w-100" name="loginBtn" id="loginBtn">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="#">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/toastr.min.js"></script>
        <script src="js/scripts.js"></script>

        <?php include_once 'includes/toastr.php' ?>

    </body>
</html>
