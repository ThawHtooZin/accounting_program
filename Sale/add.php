<?php
include 'config/connect.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <?php
    include 'navbar.php';
    ?>
    <?php
    if($_POST){
      if(empty($_POST['name']) || empty($_POST['price']) || empty($_POST['quantity'])){
        if(empty($_POST['name'])){
          $nameerror = "The Item Name field is required";
        }
        if(empty($_POST['price'])){
          $priceerror = "The Price field is required";
        }
        if(empty($_POST['quantity'])){
          $qtyerror = "The Quantity field is required";
        }
      }else{
        $item_name = $_POST['name'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];
        $quantity = $_POST['quantity'];
        $voucher_no = $_POST['voucher_no'];
        $total_price = $quantity * $price;
        $stmt = $pdo->prepare("INSERT INTO sale_items(item_name,price,category_id,quantity,voucher_no,total_price) VALUES('$item_name', '$price', '$category_id', '$quantity', '$voucher_no', '$total_price')");
        $stmt->execute();
        if($stmt){
          echo "<script>alert('inserted Successfully!'); window.location.href='index.php';</script>";
        }
      }
    }
    ?>
    <div class="container mt-5">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col">
              <h2>Add a Sale</h2>
            </div>
            <div class="col">
              <a href="index.php" class="btn btn-secondary float-end">Back</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form action="add.php" method="post">
            <label>Item Name</label>
            <input type="text" name="name" class="form-control" placeholder="Item Name">
            <p class="text-danger"><?php if(!empty($nameerror)){ echo $nameerror;} ?></p>
            <label>Price</label>
            <input type="number" name="price" class="form-control" placeholder="Price">
            <p class="text-danger"><?php if(!empty($pricerror)){ echo $pricerror;} ?></p>
            <label>Category</label>
            <select class="form-control" name="category_id">
              <?php
              $stmt = $pdo->prepare("SELECT * FROM category");
              $stmt->execute();
              $datas = $stmt->fetchall();
              foreach ($datas as $data) {
              ?>
                <option value="<?php echo $data['id']; ?>"><?php echo $data['category_name']; ?></option>
              <?php
              }
              ?>
            </select>
            <br>
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" placeholder="Quantity">
            <label>Voucher No</label>
            <input type="number" name="voucher_no" class="form-control" placeholder="Voucher No">
            <p class="text-danger"><?php if(!empty($qtyerror)){ echo $qtyerror;} ?></p>
            <br>
            <button type="submit" class="btn btn-success">Add a Sale</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
