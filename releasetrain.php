<?php
$insert = false;
if(isset($_POST['uid'], $_POST['date'])){
    // Set connection variables
    $server = "localhost";
    $username = "root";
    $password = "";

    // Create a database connection
    $con = mysqli_connect($server, $username, $password);

    // Check for connection success
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    // echo "Success connecting to the db";

    // Collect post variables
    $uid = $_POST['uid'];
    $date = $_POST['date'];
    $noac = $_POST['noac'];
    $nosc = $_POST['nosc'];
    //date check
    $today = date("Y-m-d H:i:s");
    if($today>$date){
      die("please check date");
    }
    $sql = "INSERT INTO `railways`.`released_train` (`uid`, `date`, `noac`, `nosc`) VALUES ('$uid', '$date', '$noac', '$nosc');";
    // echo $sql;

    // Execute the query
    if($con->query($sql) == true){
        // echo "Successfully inserted";

        // Flag for successful insertion
        $insert = true;
    }
    else{
        echo "ERROR: $sql <br> $con->error";
    }

    // Close the database connection
    $con->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Center</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">RES</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="booktrain.php">Book<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="findtrains">Trains</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
    </ul>
    <span class="navbar-text">
      Ticket Search Ends Here
    </span>
  </div>
</nav>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1>Book Tickets in One Go</h1>      
    <p>Welcome to Railway Reservation System</p>
  </div>
</div>
<marquee><p><h1>Release Train</h1></p></marquee>
<div class="container">
    
    <form action="releasetrain.php" method="post">
            <input type="number" name="uid" id="uid" placeholder="Enter The UID">
            <input type="date" name="date" id="date" placeholder="Enter Date">
            <input type="number" name="noac" id="noac" placeholder="No. of AC coaches">
            <input type="number" name="nosc" id="nosc" placeholder="No. of sleeper coaches">
            <button class="btn">Submit</button> 
        </form>
  </div>
<!-- Build the form here -->
</html>