<?php
include 'config/connect.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM category WHERE id=$id");
$stmt->execute();
echo "<script>alert('Deleted a category successfully'); window.location.href='category_admin.php';</script>";
?>
