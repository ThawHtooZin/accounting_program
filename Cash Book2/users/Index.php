<?php
session_start();
include 'config/connect.php';
include 'config/config.php';
?>
<?php

if(!empty($_POST['date'])){
  if($_POST['date']){
    setcookie('date', $_POST['date'], time() + (87400 * 36), "/");
  }
}
else{
  if(empty($_GET['pageno'])){
    unset($_COOKIE['date']);
    setcookie('date', null, -1, "/");
  }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <body>
    <div class="container mt-5">
      <h1 class="text-center">Your Cash Book</h1>
      <?php
      if(!empty($_GET['pageno'])){
        $pageno = $_GET['pageno'];
      }else{
        $pageno = 1;
      }
      $numOfrecs = 3;
      $offset = ($pageno -1) * $numOfrecs;

      if(empty($_POST['date'])){
        $stmt = $pdo->prepare("SELECT * FROM expence_income ORDER BY id ");
        $stmt->execute();
        $rawResult = $stmt->fetchall();
        $total_pages = ceil(count($rawResult) / $numOfrecs);

        $stmt = $pdo->prepare("SELECT * FROM expence_income ORDER BY id  LIMIT $offset,$numOfrecs");
        $stmt->execute();
        $result = $stmt->fetchall();
      }else{
        if(!empty($_POST['date'])){
            $date = $_POST['date'];
          }else{
            $date = $_COOKIE['date'];
          }

        // date filter
        $date = $_POST['date'];
        $stmt = $pdo->prepare("SELECT * FROM expence_income WHERE date LIKE '%$date%' ORDER BY id ");
        $stmt->execute();
        $rawResult = $stmt->fetchall();
        $total_pages = ceil(count($rawResult) / $numOfrecs);

        $stmt = $pdo->prepare("SELECT * FROM expence_income WHERE date LIKE '%$date%' ORDER BY id  LIMIT $offset,$numOfrecs");
        $stmt->execute();
        $result = $stmt->fetchall();
      }

      ?>
      <form action="index.php" method="post">
        <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
        <button type="submit" class="btn btn-primary float-end">Filter</button>
        <input type="date" name="date" class="form-control w-25 float-end">
      </form>
      <a href="add.php" class="btn btn-primary btn-lg">Add</a>
      <table class="table table-dark table-stripe">
        <thead>
          <tr>
            <th>#</th>
            <th>Category</th>
            <th>Remark</th>
            <th>Expences</th>
            <th>Income</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if($result){
          foreach ($result as $data) {
            if($data['expence'] != 0){
              $catid = $data['category_id'];
              $catstmt = $pdo->prepare("SELECT * FROM expence_category WHERE id=$catid");
              $catstmt->execute();
              $catdata = $catstmt->fetch(PDO::FETCH_ASSOC);
            }

            if($data['income'] != 0){
              $catid = $data['category_id'];
              $catstmt = $pdo->prepare("SELECT * FROM income_category WHERE id=$catid");
              $catstmt->execute();
              $catdata = $catstmt->fetch(PDO::FETCH_ASSOC);
            }

          ?>
          <tr>
            <td><?php echo $data['id']; ?></td>
            <td><?php echo $catdata['category_name']; ?></td>
            <td><?php echo $data['remark']; ?></td>
            <td><?php echo $data['expence']; ?></td>
            <td><?php echo $data['income']; ?></td>
            <td><?php echo $data['date']; ?></td>
            <td>
              <a href="edit.php" class="btn btn-warning">Edit</a>
              <a href="delete.php" class="btn btn-danger">Delete</a>
            </td>
          </tr>
          <?php
          }
        }
          ?>
        </tbody>
      </table>
      <div aria-label="Page navigation example" style="float:right;">
        <ul class="pagination">
          <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
          <li class="page-item <?php if($pageno <= 1){echo 'disabled';} ?>">
            <a class="page-link" href="<?php if($pageno <= 1){echo '#';} else {echo "?pageno=".($pageno-1);} ?>">Previous</a>
          </li>
          <li class="page-item"><a class="page-link" href="#"><?php echo $pageno; ?></a></li>
          <li class="page-item <?php if($pageno >= $total_pages){echo 'disabled';}; ?>">
            <a class="page-link" href="<?php if($pageno >= $total_pages){echo '#';}else{echo "?pageno=".($pageno+1);} ?>">Next</a>
          </li>
          <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a> </li>
        </ul>
      </div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Total Income</th>
            <th>Total Expence</th>
            <th>Balance</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $inctotalstmt = $pdo->prepare("SELECT SUM(income) AS totalincome FROM expence_income");
          $inctotalstmt->execute();
          $totalincome = $inctotalstmt->fetch(PDO::FETCH_ASSOC);

          $exptotalstmt = $pdo->prepare("SELECT SUM(expence) AS totalexpence FROM expence_income");
          $exptotalstmt->execute();
          $totalexpence = $exptotalstmt->fetch(PDO::FETCH_ASSOC);
          ?>
          <tr>
            <td><?php echo "+" . $totalincome['totalincome'];  ?></td>
            <td><?php echo "-" . $totalexpence['totalexpence'];  ?></td>
            <td><?php echo $totalincome['totalincome'] - $totalexpence['totalexpence']; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </body>
</html>
