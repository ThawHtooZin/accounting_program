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
    if($_POST){
      if($_POST['expence_income_category'] == 'expence'){
        if(empty($_POST['expenceamount']) || empty($_POST['remark'])){
          if(empty($_POST['expenceamount'])){
            $expenceerror = "The Expence Amount is Required";
          }
          if(empty($_POST['remark'])){
            $remarkerror = "The Remark Amount is Required";
          }
        }else{
          $category_id = $_POST['expence'];
          $remark = $_POST['remark'];
          $expenceamount = $_POST['expenceamount'];
          $incomeamount = 0;
          $stmt = $pdo->prepare("INSERT INTO expence_income(category_id, remark, expence, income) VALUES('$category_id','$remark','$expenceamount', '$incomeamount')");
          $stmt->execute();
          if($stmt){
            echo "<script>alert('Added the Expence Successfully!'); window.location.href='index.php';</script>";
          }
        }
      }elseif($_POST['expence_income_category'] == 'income'){
        if(empty($_POST['incomeamount']) || empty($_POST['remark'])){
          if(empty($_POST['incomeamount'])){
            $expenceerror = "The Income Amount is Required";
          }
          if(empty($_POST['remark'])){
            $remarkerror = "The Remark Amount is Required";
          }
        }else{
          $category_id = $_POST['income'];
          $remark = $_POST['remark'];
          $incomeamount = $_POST['incomeamount'];
          $expenceamount = 0;
          $stmt = $pdo->prepare("INSERT INTO expence_income(category_id, remark, expence, income) VALUES('$category_id','$remark','$expenceamount', '$incomeamount')");
          $stmt->execute();
          if($stmt){
            echo "<script>alert('Added the Income Successfully!'); window.location.href='index.php';</script>";
          }
        }
      }
    }
    ?>
    <div class="container" style="margin-top:100px;">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-11">
              <h2>Add Income/Expence</h2>
            </div>
            <div class="col-1">
              <a href="index.php" class="btn btn-secondary">Back</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form action="add.php" method="post">
            <label>Category</label>
              <select class="form-control" name="expence_income_category" id="category">
                <option value="expence">Expence</option>
                <option value="income">Income</option>
              </select>
              <br>
              <div id="expence">
                <p>Expence Category</p>
                <select name="expence" class="form-control">
                  <?php
                  $expstmt = $pdo->prepare("SELECT * FROM expence_category");
                  $expstmt->execute();
                  $expdatas = $expstmt->fetchall();
                  foreach ($expdatas as $expdata) {
                  ?>
                  <option value="<?php echo $expdata['id']; ?>"><?php echo $expdata['category_name']; ?></option>
                  <?php
                  }
                  ?>
                </select>
                <a href="add_exp_cat.php" class="btn btn-default">Add Category</a>
                <br>
                <br>
                <label>Expence Amount</label>
                <input type="number" name="expenceamount" class="form-control" placeholder="Expence Amount">
                <p class="text-danger"><?php if(!empty($expenceerror)){ echo $expenceerror; } ?></p>
              </div>
              <div id="income" style="display:none;">
                <p>Income Category</p>
                <select name="income" class="form-control">
                  <?php
                  $incstmt = $pdo->prepare("SELECT * FROM income_category");
                  $incstmt->execute();
                  $incdatas = $incstmt->fetchall();
                  foreach ($incdatas as $incdata) {
                  ?>
                  <option value="<?php echo $incdata['id']; ?>"><?php echo $incdata['category_name']; ?></option>
                  <p class="text-danger"><?php if(!empty($incomerror)){ echo $incomerror; } ?></p>
                  <?php
                  }
                  ?>
                </select>
                <a href="add_inc_cat.php" class="btn btn-default">Add Category</a>
                <br>
                <br>
                <label>Income Amount</label>
                <input type="number" name="incomeamount" class="form-control" placeholder="Income Amount">
              </div>
              <br>
              <label>Remark</label>
              <textarea name="remark" rows="3" cols="80" class="form-control" placeholder="Remark"></textarea>
              <p class="text-danger"><?php if(!empty($remarkerror)){echo $remarkerror;} ?></p>
              <br>
              <div class="row  me-auto ms-auto">
                <button type="submit" class="btn btn-primary">Add</button>
              </div>
          </form>
        </div>
      </div>
    </div>
    <script>
    document.getElementById('category').onchange=check;
    var change = 1;
    function check() {
      console.log(change);
      if(change == 0){
        document.getElementById('expence').style.display = 'block';
        document.getElementById('income').style.display = 'none';
        change = 1;
      }else if(change == 1){
        document.getElementById('income').style.display = 'block';
        document.getElementById('expence').style.display = 'none';
        change = 0;
      }

    }
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
  </body>
</html>
