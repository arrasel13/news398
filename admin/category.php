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

// Insert query
if(isset($_POST['c_submit'])){
    
    $c_icon = $_POST['c_icon'];
    $c_name = $_POST['c_name'];

    $c_insert = "INSERT INTO category (`c_icon`, `c_name`) VALUES ('$c_icon', '$c_name')";
    if($c_query1 = $conn->query($c_insert)){
        $_SESSION['msg'] = "Category Data Inserted Successfully";
        header("Location: category.php?status=success");
        exit(0);
        // $result = "<h3 class='text-success'>Category Data Inserted Successfully</h3>";
    }else{

        $_SESSION['msg'] = "Category Not Inserted";
        header("Location: category.php?status=error");
        exit(0);
        // die($conn->error);
    }
}
// Insert query
// Select query
    $c_select = "SELECT * FROM category";
    $c_query2 = $conn->query($c_select);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Category - MyNews</title>
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
                                    <label for="c_icon" class="form-label">Category Icon</label>
                                    <input type="text" class="form-control c_icon icon-picker" id="c_icon" name="c_icon" required>
                                </div>
                                <div class="mb-3">
                                    <label for="c_name" class="form-label">Category name</label>
                                    <input type="text" class="form-control c_name" id="c_name" name="c_name" required>
                                </div>
                                <button type="submit" name="c_submit" class="btn btn-primary">Save Category</button>
                            </form>
                            
                        </div>

                        <hr>
                        
                        <h3>Category Info</h3>

                        <div class="card mb-4">
                            <!-- <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div> -->
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>SN#</th>
                                            <th>Category Id</th>
                                            <th>Category Icon</th>
                                            <th>Category Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php if($c_query2 -> num_rows > 0) { ?>

                                            <?php $i = 1; while($c_final = $c_query2 -> fetch_array()) { ?>
                                        
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $c_final['id']; ?></td>
                                            <td><?php echo $c_final['c_icon']; ?></td>
                                            <td><?php echo $c_final['c_name']; ?></td>
                                            <td class="d-flex">
                                                <a href="category_edit.php?id=<?php echo $c_final['id']; ?>" class="btn btn-info me-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <form action="category_delete.php" method="post">
                                                    <button class="btn btn-danger d_category" name="d_category" value="<?php echo $c_final['id']; ?>"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>

                                        <?php $i++; } ?>
                                        
                                        <?php } else { ?>

                                        <tr>
                                            <td colspan="5">No Category data to show</td>
                                        </tr>
                                        
                                        <?php } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/js/fontawesome-iconpicker.min.js"></script> -->
        <script src="js/scripts.js"></script>

        <?php include_once 'includes/toastr.php' ?>

    </body>
</html>
