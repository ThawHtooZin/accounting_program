<?php
include 'config/connect.php';

  echo $id = $_GET['id'];
  $stmt = $pdo->prepare("DELETE FROM income_category WHERE id=$id");
  $stmt->execute();
  echo "<script>alert('Successfully Deleted an Category!'); window.location.href='add_inc_cat.php'; </script>";

?>
