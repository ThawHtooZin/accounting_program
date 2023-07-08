<?php
include 'config/connect.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <body>
    <?php
    include 'navbar.php';
    ?>
    <div class="container mt-5">
      <a href="add.php" class="btn btn-success">Add</a>
      <table class="table table-stripe">
        <thead>
          <tr>
            <th>Item Code</th>
            <th>Item Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Date</th>
            <th>Quantity</th>
            <th>Voucher Number</th>
            <th>Total Price</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $stmt = $pdo->prepare("SELECT * FROM sale_items");
          $stmt->execute();
          $datas = $stmt->fetchall();
          foreach ($datas as $data) {
            ?>
            <tr>
              <td><?php echo $data['id']; ?></td>
              <td><?php echo $data['item_name']; ?></td>
              <td><?php echo $data['price'] ?>ks</td>
              <td><?php echo $data['category_id'] ?></td>
              <td><?php echo $data['date'] ?></td>
              <td><?php echo $data['quantity'] ?></td>
              <td><?php echo $data['voucher_no'] ?></td>
              <td><?php echo $data['total_price'] ?>ks</td>
              <td>
                <a href="edit.php?id=<?php echo $data['id']; ?>" class="btn btn-warning">Edit</a>
                <a href="delete.php?id=<?php echo $data['id']; ?>" class="btn btn-danger">Delete</a>
              </td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </body>
</html>
