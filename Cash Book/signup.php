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
      if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])){
        if(empty($_POST['username'])){
          $usererror = "The Username field is required";
        }
        if(empty($_POST['password'])){
          $passerror = "The Password field is required";
        }
        if(empty($_POST['email'])){
          $emailerror = "The Email field is required";
        }
      }else{
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $stmt = $pdo->prepare("INSERT INTO users(username, password, email) VALUES('$username', '$password', '$email')");
        $stmt->execute();
        echo "<script>alert('registered successfully!'); window.location.href='login.php';</script>";
      }
    }
    ?>
    <div class="container" style="margin-top:250px;">
      <div class="card w-50 ms-auto me-auto">
        <div class="card-header">
          <div class="row">
            <div class="col-10">
              <h1>Signup To Proceed</h1>
            </div>
            <div class="col">
              <a href="index.php" class="float-end btn btn-secondary">Back</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form action="signup.php" method="post">
            <label>Username</label>
            <input type="text" name="username" class="form-control">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
            <div class="row container me-auto ms-auto">
              <button type="submit" class="btn btn-primary">Sign Up</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
