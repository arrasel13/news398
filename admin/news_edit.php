<?php
session_start();
require '../lib/db/connection.php';

if(isset($_POST['news_update'])){
    $n_id = $_POST['n_id'];
    $n_title = $_POST['n_title'];
    $n_icon = $_POST['n_icon'];
    $n_description = $_POST['n_description'];
    $n_cid = $_POST['n_cid'];

    $c_update = "UPDATE news SET n_title='$n_title', n_icon='$n_icon', n_description='$n_description', n_cid='$n_cid' WHERE id=$n_id ";
    
    if($c_query = $conn->query($c_update)){
        $_SESSION['msg']="News Updated Successfully";
        header("Location: news.php?status=success");
        exit(0);
    }else{
        $_SESSION['msg']="News Not Updated";
        header("Location: news.php?status=error");
        exit(0);
    }
}

//Select Category Id
$n_cid_select = "SELECT * FROM category";
$n_query3 = $conn->query($n_cid_select);

if(isset($_GET['id'])){
    $edit_id = $_GET['id'];
    // echo $edit_id;
    // exit;

    $news_select = "SELECT * FROM news WHERE id=$edit_id ";
    $news_query = $conn->query($news_select);

    $news_result = $news_query->num_rows;
    // var_dump($cat_result);
    // exit;

    if($news_query->num_rows > 0){
        while($news_result = $news_query->fetch_assoc()){
            
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>News - MyNews</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/toastr.min.css">
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="admin.php">MyNews Admin</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <!-- <div class="sb-sidenav-menu-heading">Core</div> -->
                            <a class="nav-link" href="admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="category.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Category
                            </a>
                            <a class="nav-link" href="news.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                News
                            </a>
                            <a class="nav-link" href="banner.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Banner
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <!-- <h1 class="mt-4">Tables</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
                        </ol> -->
                        <div class="col-6 my-5">
                            <h3>News Form</h3>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <div class="mb-3">
                                    <label for="n_title" class="form-label">News Title</label>
                                    <input type="hidden" class="form-control n_id" id="n_id" name="n_id" value="<?php echo $news_result['id'] ?>" required>
                                    <input type="text" class="form-control n_title" id="n_title" name="n_title" value="<?php echo $news_result['n_title'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="n_icon" class="form-label">News Icon</label>
                                    <input type="text" class="form-control n_icon" id="n_icon" name="n_icon" value="<?php echo $news_result['n_icon'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="n_description" class="form-label">News Description</label>
                                    <textarea class="form-control n_description" id="n_description" name="n_description" rows="3" required><?php echo $news_result['n_description'] ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="n_cid" class="form-label">News Category</label>
<!--                                    <input type="text" class="form-control n_cid" id="n_cid" name="n_cid" value="--><?php //echo $news_result['n_cid'] ?><!--" required>-->
                                    <select class="form-select n_cid" id="n_cid" name="n_cid" required>

                                        <option selected>Select Category</option>

                                        <?php if($n_query3->num_rows > 0){ ?>
                                            <?php while($n_cid_select = $n_query3->fetch_assoc()) { ?>
                                                <option value="<?php echo $n_cid_select['id']; ?>" <?php echo ($news_result['n_cid'] == $n_cid_select['id'])? 'selected="selected"':'';?> ><?php echo $n_cid_select['c_name'] ?></option>
                                            <?php } } ?>
                                    </select>
                                </div>

                                <button type="submit" name="news_update" class="btn btn-primary">Update News</button>
                            </form>
                        </div>
                    </div>
                </main>
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


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/toastr.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>

    </body>
</html>

<?php
            }
        } else{
            $_SESSION['msg']="You have no record to show";
            header("Location: news.php?status=info");
            exit(0);
        }
    } else{
        $_SESSION['msg']="You are trying in a wrong way";
        header("Location: news.php?status=warning");
        exit(0);
    }
?>