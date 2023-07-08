<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-5">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col">
              <h2>Add Sale</h2>
            </div>
            <div class="col">
              <a href="index.php" class="btn btn-secondary float-end">Back</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form action="add.php" method="post">
            <label>Item Name</label>
            <input type="text" name="name" class="form-control">
            <label>Price</label>
            <input type="number" name="price" class="form-control">
            <label>Category</label>
            <select class="form-control" name="category">

            </select>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
