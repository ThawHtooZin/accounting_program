<?php
include 'config/connect.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM sale_items WHERE id=$id");
$stmt->execute();
echo "<script>alert('Deleted a Sale Item successfully'); window.location.href='index.php';</script>";
?>
