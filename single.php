<?php
    require_once 'lib/db/connection.php';

//Categories
$category_select = "SELECT * FROM category";
$category_query = $conn->query($category_select);

    if (isset($_GET['read'])){
        $read_news = $_GET['read'];

        $read_sql = "SELECT c_name FROM category WHERE id = (SELECT n_cid FROM news WHERE id=$read_news)";
        $read_category = $conn->query($read_sql);
        $read_category_final = $read_category->fetch_assoc();

        $read_select = "SELECT * FROM news WHERE id=$read_news";
        $read_query = $conn->query($read_select);
        if ($read_query->num_rows > 0){
            while($read_final = $read_query->fetch_assoc()){
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Website Description -->
    <meta name="description" content="MyNews: Corporate Multi Purpose News Blogs Template" />
    <meta name="author" content="Minhaz" />

    <!--  Favicons / Title Bar Icon  -->
    <link rel="icon" href="images/favicon/favicon.png" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="vendor/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/css/bootstrap.css">
    <link rel="stylesheet" href="vendor/css/style.css">
    <link rel="stylesheet" href="vendor/css/media.css">

    <title>MyNews</title>
  </head>
  <body class="bg-light">

    <!-- header start -->
    <header>
      <div class="container">
        <!-- nav -->
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container-fluid">
            <!-- logo -->
            <a class="navbar-brand logo" href="index.php"><h1 class="m-0">MyNews</h1></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <!-- menu -->
            <div class="collapse navbar-collapse menu" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">FAQ</a>
                </li>
              </ul>
              
            </div>
          </div>
        </nav>
        <!-- nav -->
      </div>
    </header>
    <!-- header end -->

    <!-- detail news start -->
    <section class="education">
      <div class="container">

        <div class="row">
          <div class="col-lg-8">
            <div class="c_news text-left details">
              <i class="fa fa-thumbs-up" aria-hidden="true"></i>
              <ul class="list-inline">
                <li class="list-inline-item"><a href="#"><?php echo $read_category_final['c_name']; ?></a></li>
                <li class="list-inline-item"><a href="#">author</a></li>
              </ul>
              <h2><?php echo $read_final['n_title'];?></h2>
              <p><?php echo $read_final['n_description'];?></p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="sidebar bg-dark text-white">
              <p>sidebar content</p>
            </div>
          </div>
        </div>

      </div>
    </section>
    <!-- detail news end -->

    <!-- category start -->
    <section class="category">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="c_title text-center">
              <h1>Popular Categories</h1>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. consectetur adipisicing elit. </p>
              <hr class="w-25 m-auto">
            </div>
          </div>
        </div>
        <div class="row">
            <?php
            if($category_query->num_rows > 0){
                while ($category_final = $category_query->fetch_assoc()){

                    ?>
                    <!--Single Category start-->
                    <div class="col-lg">
                        <div class="f_icon text-center">
                            <a href="#" class="text-dark">
                                <i class="<?php echo $category_final['c_icon']; ?>" aria-hidden="true"></i>
                            </a>
                            <h3><?php echo $category_final['c_name']; ?></h3>
                        </div>
                    </div>
                    <!--Single category end-->
                <?php } } else{ ?>
                <div><h3>No Category to Show</h3></div>
            <?php } ?>
        </div>
      </div>
    </section>
    <!-- category end -->

    <!-- footer start -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="f_text">
              <h2>MyNews</h2>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit nulla cupiditate adipisci assumenda</p>
              <p>libero qui, nobis consequuntur maiores pariatur magni atque impedit quibusdam officiis vel</p>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="f_text">
              <h2>Useful links</h2>
              <ul class="list-unstyled">
                <li><a href="" class="text-dark">Privacy policy</a></li>
                <li><a href="" class="text-dark">Terms & conditions</a></li>
                <li><a href="" class="text-dark">Privacy policy</a></li>
                <li><a href="" class="text-dark">Terms & conditions</a></li>
                <li><a href="" class="text-dark">Privacy policy</a></li>
                <li><a href="" class="text-dark">Terms & conditions</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="f_text">
              <h2>Contact Info</h2>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit nulla cupiditate adipisci assumenda </p>
              <p>libero qui, nobis consequuntur maiores pariatur magni atque impedit quibusdam officiis vel</p>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="f_text">
              <h2>Join Us</h2>
              <form action="#">
                <div class="mb-3">
                  <label for="formGroupExampleInput" class="form-label">Your Email Address</label>
                  <input type="text" class="form-control" id="formGroupExampleInput" >
                </div>
                <div class="mb-3">
                  <button class="btn btn-dark w-100">Subscribe here</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <p class="text-center m-0 copy">MyNews © 2022 All rights reserved.  Lorem ipsum dolor, sit amet.</p>
          </div>
        </div>
      </div>
    </footer>
    <!-- footer end -->

    

    
    <!-- JS links -->
    <script src="vendor/js/popper.min.js"></script>
    <script src="vendor/js/bootstrap.min.js"></script>
    <script src="vendor/js/script.js"></script>
  </body>
</html>

<?php
            }
        }else{
            header("Location: index.php");
        }
    } else{
        header("Location: index.php");
    }
?>