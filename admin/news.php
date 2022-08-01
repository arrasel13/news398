<?php
session_start();

require_once '../lib/db/connection.php';
$result = null;

// Insert query
if(isset($_POST['n_submit'])){
    $n_title = $_POST['n_title'];
    $n_icon = $_POST['n_icon'];
    $n_description = $_POST['n_description'];
    $n_cid = $_POST['n_cid'];

    $n_insert = "INSERT INTO news(`n_title`, `n_icon`, `n_description`, `n_cid`) VALUES ('$n_title', '$n_icon', '$n_description', '$n_cid')";

    if($n_query1 = $conn->query($n_insert)){
        $_SESSION['msg'] = "News Data Inserted Successfully";
        header("Location: news.php?status=success");
        exit(0);
        // $result = "<h3 class='text-success'>News Data Inserted Successfully</h3>";
    }else{
        $_SESSION['msg'] = "News Data Not Inserted";
        header("Location: news.php?status=error");
        exit(0);
        // die($conn->error);
    }
}
// Insert query

//Select Category Id
$n_cid_select = "SELECT * FROM category";
$n_query3 = $conn->query($n_cid_select);

// Select query
//    $n_select = "SELECT * FROM news";
    $n_select = "SELECT news.id id, news.n_title n_title, news.n_icon n_icon, news.n_description n_description, news.n_cid n_cid, category.c_name cname FROM news, category where news.n_cid = category.id";
    $n_query2 = $conn->query($n_select);

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
                                    <input type="text" class="form-control n_title" id="n_title" name="n_title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="n_icon" class="form-label">News Icon</label>
                                    <input type="text" class="form-control n_icon" id="n_icon" name="n_icon" required>
                                </div>
                                <div class="mb-3">
                                    <label for="n_description" class="form-label">News Description</label>
                                    <textarea class="form-control n_description" id="n_description" name="n_description" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="n_cid" class="form-label">News Category</label>
                                    <!-- <input type="text" class="form-control n_cid" id="n_cid" name="n_cid" required> -->
                                    
                                    <select class="form-select n_cid" id="n_cid" name="n_cid" required>

                                        <option selected>Select Category</option>
                                        
                                        <?php if($n_query3->num_rows > 0){ ?>
                                            <?php while($n_cid_select = $n_query3->fetch_assoc()) { ?>
                                                <option value="<?php echo $n_cid_select['id']; ?>"><?php echo $n_cid_select['c_name'] ?></option>
                                            <?php } } ?>
                                    </select>

                                </div>

                                <button type="submit" name="n_submit" class="btn btn-primary">Save News</button>
                            </form>

                            
                        </div>

                        <hr>
                        
                        <h3>News Info</h3>

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
                                            <th>News ID</th>
                                            <th>News Title</th>
                                            <th>News Icon</th>
                                            <th>News Description</th>
                                            <th>News Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php if($n_query2 -> num_rows > 0) { ?>

                                            <?php $i = 1; while($n_final = $n_query2 -> fetch_array()) { ?>

                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $n_final['id'] ?></td>
                                                    <td><?php echo $n_final['n_title'] ?></td>
                                                    <td><?php echo $n_final['n_icon'] ?></td>
                                                    <td><?php echo $n_final['n_description'] ?></td>
                                                    <td><?php echo $n_final['cname'] ?></td>
                                                    <td class="d-flex">
                                                        <a href="news_edit.php?id=<?php echo $n_final['id'] ?>" class="btn btn-info me-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                                        <form action="news_delete.php" method="post">
                                                            <button class="btn btn-danger d_news" name="d_news" value="<?php echo $n_final['id']; ?>"><i class="fa-solid fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php $i++; } ?>
                                        <?php } else{ ?>
                                        <tr>
                                            <td colspan="6">No News data to show</td>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>

        <?php include_once 'includes/toastr.php' ?>

    </body>
</html>
