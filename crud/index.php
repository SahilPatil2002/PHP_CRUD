<?php

// INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'study', 'learn php as soon as possible.', current_timestamp());

$insert = false;
$update = false;
$delete = false;
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
  die("Sorry failed to connect : ".mysqli_connect_error());
}else{
  // echo "Connection Successful<br>";
}


if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  // echo $sno;
  $delete = true;
  $sql = "DELETE FROM `notes` WHERE `sno` = $sno";
  $result = mysqli_query($conn , $sql);
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
if(isset($_POST['snoEdit'])){
  // echo "yes";
  $sno = $_POST["snoEdit"];
  $title = $_POST["titleEdit"];
  $description = $_POST["descriptionEdit"];
  $sql = "UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `notes`.`sno` = $sno";
  $result = mysqli_query($conn, $sql);
  if($result){
    // echo "the record has been inserted";
    $update = true;
  }
  else{
    echo "The Note is not updated due to some error";
    mysqli_error($conn);
  }
}
else{
  // echo "no";

  $title = $_POST["title"];
  $description = $_POST["description"];
  $sql = "INSERT INTO `notes`(`title`,`description`)VALUES('$title','$description')";
  $result = mysqli_query($conn, $sql);

  if($result){
    // echo "the record has been inserted";
    $insert = true;
  }
  else{
    echo "not inserted ";
    mysqli_error($conn);
  }
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>crud operation</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
  </script>
</head>

<body>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Edit this note</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/crud/index.php" method="POST">
      <div class="modal-body">
        <input type="hidden" name="snoEdit" id="snoEdit">
        <div class="mb-3">
          <label for="title" class="form-label">Note Title</label>
          <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
          <label for="desc" class="form-label">Note Description</label>
          <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>


  <nav class="navbar navbar-expand-lg bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">PHP CRUD</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="#">Contact</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-light" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>


  <?php 
    
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success</strong> Your note has been successfully inserted.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
  
  ?>

  <?php 
  if($update){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Success</strong> Your note has been successfully Updated.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
  ?>

  <?php 
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success</strong> Your note has been successfully Deleted.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
  ?>


  



  <div class="container my-3">
    <h2>Add a note</h1>
      <form action="/crud/index.php" method="POST">
        <div class="mb-3">
          <label for="title" class="form-label">Note Title</label>
          <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
          <label for="desc" class="form-label">Note Description</label>
          <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Note</button>
      </form>
  </div>


  <div class="container my-4">
    
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Sr. no.</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php
        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $sno = $sno + 1;
          echo "<tr>
          <th scope='row'>".$sno ."</th>
          <td>".$row['title'] ."</td>
          <td>".$row['description'] ."</td>
          <td><button class='btn btn-sm btn-primary edit' id=".$row['sno'] .">Edit</button> <button class='btn btn-sm btn-danger delete' id=d".$row['sno'] .">Delete</button></td>
        </tr>";
          // echo $row['sno']. ". Title is ". $row['title']. " & Desc is ".$row['description'];
          // echo "<br>";
        }
        
        
        ?>
        
        
        
      </tbody>
    </table>



  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>