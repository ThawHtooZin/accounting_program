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
    <?php
      $stmt = $pdo->prepare("SELECT * FROM category");
      $stmt->execute();
      $datas = $stmt->fetchall();
    ?>
    <div class="container mt-5">
      <a href="cat_add.php" class="btn btn-success">Add Category</a>
      <table class="table table-stripe">
        <thead>
          <tr>
            <th>Category Id</th>
            <th>Category Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($datas as $data) {
            ?>
            <tr>
              <td><?php echo $data['id']; ?></td>
              <td><?php echo $data['category_name']; ?></td>
              <td>
                <a href="cat_edit.php?id=<?php echo $data['id']; ?>" class="btn btn-warning">Edit</a>
                <a href="cat_delete.php?id=<?php echo $data['id']; ?>" class="btn btn-danger">Delete</a>
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
