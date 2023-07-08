<?php
include 'config/connect.php';

if($_POST){
  if(empty($_POST['category_name'])){
    $categorynameerror = "The Category Name is required";
  }else{
    $category_name = $_POST['category_name'];
    $stmt = $pdo->prepare("INSERT INTO expence_category(category_name) VALUES('$category_name')");
    $stmt->execute();
    if($stmt){
      echo "<script>alert('Successfully Added an Category!'); window.location.href='add_exp_cat.php'; </script>";
    }
  }
}

?>
