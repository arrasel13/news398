<?php
session_start();
$i = 1;
while ($i <= 10) {
    echo $i++ . "<br>";
}

// include_once 'includes/functions.php';
if(isset($_POST['submit'])){
    #Process Form Data

    #Give a message
    // flash("msg", "Form submitted successfully");
    $_SESSION['msg'] = "Category Data Inserted Successfully";

    #Redirect
    header("Location: text.php")
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="css/toaster.min.css" rel="stylesheet" />
    
</head>
<body>
    
<!-- <button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="..." class="rounded me-2" alt="...">
      <strong class="me-auto">Bootstrap</strong>
      <small>11 mins ago</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Hello, world! This is a toast message.
    </div>
  </div>
</div> -->


<!-- <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <img src="..." class="rounded me-2" alt="...">
    <strong class="me-auto">Bootstrap</strong>
    <small class="text-muted">11 mins ago</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    Hello, world! This is a toast message.
  </div>
</div> -->

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

    <input type="submit" name="submit" value="">

</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
    <script src="../js/toastr.min.js"></script>
    <script src="../js/scripts.js"></script>
    <script>
        <?php if(isset($_SESSION['msg'])): ?>
            toastr.success("<?php echo flash('msg') ?>");
        <?php endif ?>
    </script>

</body>
</html>