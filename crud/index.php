<?php
require_once 'partials/Database.php';
$dbobj = new Database();
// var_dump($dbobj);

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- font awesome cdn-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/style.css?v=1">
  <title>PHP CRUD</title>
</head>

<body>
  <h1 class="bg-dark text-light text-center py-2">PHP CRUD APPLICATION</h1>

  <div class="container">
    <!-- Modal -->
    <?php include "form.php"; ?>
    <div class="row mb-3">
      <div class="col-10">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark"><i class="fas fa-search text-white"></i></span>
          </div>
          <input type="text" class="form-control" placeholder="Search here...">
        </div>
      </div>
      <div class="col-2">
        <button class="btn btn-dark" data-toggle="modal" data-target="#usermodel">Add new user</button>
      </div>
    </div>
    <?php include "tabledata.php";
    include "profile.php";
    ?>
    <!--pagination-->
    <nav aria-label="Page navigation example" id="pagination">
      <!-- <ul class="pagination justify-content-center">
        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Next</a></li>
      </ul> -->
    </nav>
  </div>
  <input type="hidden" value="1" name="currentPage" id="currentPage" />
  </div>

  <!--jquery cdn-->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!-- bootstrap and popper js cdn-->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>

  <script src="js/script.js"></script>

</body>

</html>