<?php
session_start();
require '../lib/db/connection.php';

if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
}else{
    if(isset($_COOKIE["user_info"])){

    }else{
        $_SESSION['msg']="Please login first";
        header("Location: login.php?status=error");
    }
}

if(isset($_POST['banner_update'])){
    $banner_id = $_POST['banner_id'];
    $banner_icon = $_POST['banner_icon'];
    $banner_title = $_POST['banner_title'];
    $banner_description = $_POST['banner_description'];
    $banner_status = $_POST['banner_status'];

    $banner_update = "UPDATE banner SET banner_icon='$banner_icon', banner_title='$banner_title', banner_description='$banner_description', banner_status='$banner_status' WHERE id=$banner_id ";

    if($banner_query = $conn->query($banner_update)){
        $_SESSION['msg']="Banner Info Updated Successfully";
        header("Location: banner.php?status=success");
        exit(0);
    }else{
        $_SESSION['msg']="Banner Info Not Updated";
        header("Location: banner.php?status=error");
        exit(0);
    }
}

if(isset($_GET['id'])){
    $edit_id = $_GET['id'];
    // echo $edit_id;
    // exit;

    $banner_select = "SELECT * FROM banner WHERE id=$edit_id ";
    $banner_query = $conn->query($banner_select);

    $banner_result = $banner_query->num_rows;
    // var_dump($cat_result);
    // exit;

    if($banner_query->num_rows > 0){
        while($banner_result = $banner_query->fetch_assoc()){

            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="utf-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
                <meta name="description" content="" />
                <meta name="author" content="" />
                <title>Banner - MyNews</title>
                <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
                <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
                <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/css/fontawesome-iconpicker.min.css"> -->
                <link rel="stylesheet" href="css/toastr.min.css">
                <link href="css/styles.css" rel="stylesheet" />
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
                                <h2>Category Form</h2>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <div class="mb-3">
                                        <label for="banner_icon" class="form-label">Banner Icon</label>
                                        <input type="hidden" class="form-control banner_id" id="banner_id" name="banner_id" value="<?php echo $banner_result['id']; ?>">
                                        <input type="text" class="form-control banner_icon" id="banner_icon" name="banner_icon" value="<?php echo $banner_result['banner_icon']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="banner_title" class="form-label">Banner Title</label>
                                        <input type="text" class="form-control banner_title" id="banner_title" name="banner_title" value="<?php echo $banner_result['banner_title']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="banner_description" class="form-label">Banner Description</label>
                                        <textarea class="form-control banner_description" id="banner_description" name="banner_description" rows="3" required><?php echo $banner_result['banner_description']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-select banner_status" id="banner_status" name="banner_status" required>
                                            <option selected>Select Status</option>
                                            <option value="1" <?php echo ($banner_result['banner_status'] == 1)? 'selected="selected"':'';?>>Publish</option>
                                            <option value="2" <?php echo ($banner_result['banner_status'] == 2)? 'selected="selected"':'';?>>Unpublish</option>
                                        </select>
                                    </div>

                                    <button type="submit" name="banner_update" class="btn btn-primary">Update Banner</button>
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
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
            <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
            <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
            <script src="js/datatables-simple-demo.js"></script>
            <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/js/fontawesome-iconpicker.min.js"></script> -->
            <script src="js/scripts.js"></script>


            </body>
            </html>

            <?php
        }
    } else{
        $_SESSION['msg']="You have no record to show";
        header("Location: banner.php?status=info");
        exit(0);
    }
} else{
    $_SESSION['msg']="You are trying in a wrong way";
    header("Location: banner.php?status=warning");
    exit(0);
}
?>