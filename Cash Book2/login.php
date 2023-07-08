<?php
session_start();
include 'connect.php';
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
    if($_POST){
      if(empty($_POST['username']) || empty($_POST['password'])){
        if(empty($_POST['username'])){
          $usererror = "The Username field is required";
        }
        if(empty($_POST['password'])){
          $passerror = "The Password field is required";
        }
      }else{
        $username = $_POST['username'];
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username='$username'");
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if($data['password'] == $_POST['password']){
          echo "<script>alert('Login Success!'); window.location.href='users/index.php';</script>";
          $_SESSION['username'] = $username;
          $_SESSION['logged_in'] = true;
        }else{
          echo "</script>alert('Invalid Cridential!');</script>";
        }
      }
    }
    ?>
    <div class="container" style="margin-top:250px;">
      <div class="card w-50 ms-auto me-auto">
        <div class="card-header">
          <div class="row">
            <div class="col-10">
              <h1>Login To Proceed</h1>
            </div>
            <div class="col">
              <a href="index.php" class="float-end btn btn-secondary">Back</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form action="login.php" method="post">
            <label>Username</label>
            <input type="text" name="username" class="form-control">
            <p class="text-danger"><?php if(!empty($usererror)){ echo $usererror;}; ?></p>
            <label>Password</label>
            <input type="password" name="password" class="form-control">
            <p class="text-danger"><?php if(!empty($passerror)){ echo $passerror;}; ?></p>
            <div class="row container me-auto ms-auto">
              <button type="submit" class="btn btn-primary">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
