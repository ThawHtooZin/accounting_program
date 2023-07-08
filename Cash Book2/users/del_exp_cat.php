<?php
include 'config/connect.php';

  $id = $_GET['id'];
  $stmt = $pdo->prepare("DELETE FROM expence_category WHERE id=$id");
  $stmt->execute();
  if($stmt){
    echo "<script>alert('Successfully Deleted an Category!'); window.location.href='add_exp_cat.php'; </script>";
  }

?>
