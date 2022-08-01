<?php
if(isset($_SESSION['msg'])):
?>

<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
  <strong>Hey!</strong> <?php echo $_SESSION['msg']; ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


<?php
    unset($_SESSION['msg']);
    endif;

?>