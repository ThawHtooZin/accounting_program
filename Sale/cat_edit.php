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
    if($_POST){
      if(empty($_POST['category_name'])){
        $caterror = "The Category Name Field is Required";
      }else{
        $category_name = $_POST['category_name'];
        $stmt = $pdo->prepare("UPDATE category SET category_name=$category_name");
        $stmt->execute();
        echo "<script>alert('Category Added Successfully');</script>";
      }
    }
    ?>
    <div class="container mt-5">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col">
              <h2>Add Category</h2>
            </div>
            <div class="col">
              <a href="category_admin.php" class="btn btn-secondary float-end">Back</a>
            </div>
          </div>
        </div>
        <?php
        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM category WHERE id=$id");
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <div class="card-body">
          <form action="cat_add.php" method="post">
            <label>Category Name</label>
            <input type="text" name="category_name" class="form-control" placeholder="Category Name" value="<?php echo $data['category_name'] ?>">
            <p class="text-danger"><?php if(!empty($caterror)){echo $caterror;} ?></p>
            <button type="submit" class="btn btn-primary">Add Category</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
