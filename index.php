<?php
require_once 'lib/db/connection.php';

//Banner Query
$banner_select = "SELECT * FROM banner WHERE banner_status=1";
$banner_query = $conn->query($banner_select);

//Categories
$category_select = "SELECT * FROM category";
$category_query = $conn->query($category_select);

//Tech News
$tech_select = "SELECT news.id id, news.n_icon n_icon, news.n_title n_title, news.n_description n_description, category.c_name c_name FROM news, category WHERE news.n_cid=category.id AND category.c_name = 'tech'";
$tech_query = $conn->query($tech_select);

//Health News
$health_select = "SELECT news.id id, news.n_icon n_icon, news.n_title n_title, news.n_description n_description, category.c_name c_name FROM news, category WHERE news.n_cid=category.id AND category.c_name = 'health'";
$health_query = $conn->query($health_select);

//Education News
$education_select = "SELECT news.id id, news.n_icon n_icon, news.n_title n_title, news.n_description n_description, category.c_name c_name FROM news, category WHERE news.n_cid=category.id AND category.c_name = 'education'";
$education_query = $conn->query($education_select);


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
    <!-- banner start -->
    <section class="banner">
      <div class="container">
        <div class="row mh_custom align-items-center">
            <?php
                if($banner_query->num_rows > 0){
                while($banner_result = $banner_query->fetch_assoc()){
            ?>
                <div class="col-lg-7">
                    <div class="b_content">
                      <h1><?php echo $banner_result['banner_title']; ?></h1>
                      <p><?php echo $banner_result['banner_description'];?></p>
                      <a href="#" class="btn btn-dark">Read More</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="b_icon text-center">
                        <i class="<?php echo $banner_result['banner_icon']; ?>" aria-hidden="true"></i>
                    </div>
                </div>
            <?php } } else{ ?>
                <div class="b_content">
                    <h3>No Banner content to show or you have no Published Banner Content</h3>
                </div>
            <?php } ?>
        </div>
      </div>
    </section>
    <!-- banner end -->
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
    <!-- featcategory end -->
    <!-- tech news start -->
    <section class="tech">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="c_title text-center">
              <h1>Tech News</h1>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. consectetur adipisicing elit. </p>
              <hr class="w-25 m-auto">
            </div>
          </div>
        </div>
        <div class="row">

            <?php
                if($tech_query->num_rows > 0){
                    while($tech_result = $tech_query->fetch_assoc()){
            ?>

            <!--Single Tech news start-->
              <div class="col-lg-4">
                <div class="c_news text-center">
                  <i class="<?php echo $tech_result['n_icon'];?>" aria-hidden="true"></i>
                  <h2><?php echo $tech_result['n_title'];?></h2>
                  <p><?php
                      $tech_desc = $tech_result['n_description'];
                      if(strlen($tech_desc) > 30){
                          echo substr($tech_desc, 0, 80). " " . "...<br><br>";
                          echo "<a href='single.php?read=". $tech_result['id'] ."' class='text-dark'>read more</a>";
                      }
                      ?></p>
                </div>
              </div>
            <!--Single Tech News end-->
            <?php } } else { ?>
                    <div><h3>No Tech News to show</h3></div>
            <?php } ?>
        </div>
      </div>
    </section>
    <!-- tech news end -->
    <!-- health news start -->
    <section class="health">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="c_title text-center">
              <h1>Health News</h1>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. consectetur adipisicing elit. </p>
              <hr class="w-25 m-auto">
            </div>
          </div>
        </div>
        <div class="row">
            <?php
                if($health_query->num_rows > 0){
                while($health_result = $health_query->fetch_assoc()){
            ?>
                <!--Single Health News start-->
              <div class="col-lg-4">
                <div class="c_news text-center">
                  <i class="<?php echo $health_result['n_icon'];?>" aria-hidden="true"></i>
                  <h2><?php echo $health_result['n_title'];?></h2>
                    <p><?php
                        $health_desc = $health_result['n_description'];
                        if(strlen($health_desc) > 30){
                            echo substr($health_desc, 0, 80). " " . "...<br><br>";
                            echo "<a href='single.php?read=". $health_result['id'] ."' class='text-dark'>read more</a>";
                        }
                    ?></p>

                </div>
              </div>
                <!--Single Health News end-->
                <?php } } else { ?>
                    <div><h3>No Health News to show</h3></div>
                <?php } ?>
        </div>
      </div>
    </section>
    <!-- health news end -->
    <!-- education news start -->
    <section class="education">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="c_title text-center">
              <h1>Education News</h1>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. consectetur adipisicing elit. </p>
              <hr class="w-25 m-auto">
            </div>
          </div>
        </div>
        <div class="row">
            <?php
            if($education_query->num_rows > 0){
            while($education_result = $education_query->fetch_assoc()){
            ?>

          <div class="col-lg-4">
            <div class="c_news text-center">
              <i class="<?php echo $education_result['n_icon'];?>" aria-hidden="true"></i>
              <h2><?php echo $education_result['n_title'];?></h2>
                <p><?php
                    $education_desc = $education_result['n_description'];
                    if(strlen($education_desc) > 30){
                        echo substr($education_desc, 0, 80). " " . "...<br><br>";
                        echo "<a href='single.php?read=". $education_result['id'] ."' class='text-dark'>read more</a>";
                    }
                ?></p>
            </div>
          </div>
            <?php } } else { ?>
                <div><h3>No Education News to show</h3></div>
            <?php } ?>

        </div>
      </div>
    </section>
    <!-- education news end -->
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