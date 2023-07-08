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
    $stmt = $pdo->prepare("SELECT * FROM expence_category");
    $stmt->execute();
    $datas = $stmt->fetchall();
    ?>
    <div class="container mt-5">
      <div class="row">
        <div class="col-11">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Category
          </button>
        </div>
        <div class="col-1">
          <a href="add.php" class="btn btn-secondary">Back</a>
        </div>
      </div>
      <table class="table table-striped">
        <tr>
          <th>Category Id</th>
          <th>Category Name</th>
          <th>Action</th>
        </tr>
        <?php
        foreach ($datas as $data) {
          ?>
          <tr>
            <td><?php echo $data['id']; ?></td>
            <td><?php echo $data['category_name']; ?></td>
            <td>
              <a href="del_exp_cat.php?id=<?php echo $data['id']; ?>" class="btn btn-danger">Delete</a>
            </td>
          </tr>
          <?php
        }
        ?>
      </table>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="add_exp_cat_code.php" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
          <button type="button" class="btn btn-danger" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label>Category Name</label>
          <input type="text" name="category_name" class="form-control" required>
          <p class="text-danger"><?php if(!empty($categorynameerror)){echo $categorynameerror;} ?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </div>
    </form>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>
