<?php 
$username = "root"; 
$password = ""; 
$database = "railways"; 
$mysqli = new mysqli("localhost", $username, $password, $database); 
$result=null;
if (isset($_POST["origin"])) {
  $origin = $_POST["origin"];
$destination = $_POST["destination"];
$query = "SELECT * FROM released_train R, trains T WHERE R.uid=T.uid and origin='$origin' and destination='$destination'";
$result = mysqli_query($mysqli,$query);
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
        <a class="nav-link" href="findtrains.php">Trains</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="bookedtrains.php">Booked Ticket</a>
      </li>
    </ul>
    <span class="navbar-text">
      Ticket Search Ends Here
    </span>
  </div>
</nav>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1>Find Trains for Your Route</h1>      
    <p>Welcome to Railway Reservation System</p>
    
  </div>
</div>
<div class="container">
    
    <form action="" method="post">
            <input type="text" name="origin" id="origin" placeholder="Enter the starting point">
            <input type="text" name="destination" id="destination" placeholder="Enter the destination"> 
            <button class="btn btn-success">Find</button> 
        </form>
  </div>
<br> <br>
<?php

  if(!is_null($result))
  {
    ?>
    <center>

<table border="0" cellspacing="2" cellpadding="2" class="table w-50 m-auto"> 
      <thead class="thead-dark"> 
          <tr>
          <th> <font face="Arial">Train ID</font> </th> 
          <th> <font face="Arial">Origin</font> </th> 
          <th> <font face="Arial">Destination</font> </th>
          <th> <font face="Arial">Date</font> </th>
          </tr>
      </thead>
      <?php
    $i=0;
  while($row = mysqli_fetch_array($result)) {
  ?>
  <tr >
  <td><?php echo $row["uid"]; ?></td>
  <td><?php echo $row["origin"]; ?></td>
  <td><?php echo $row["destination"]; ?></td>
  <td><?php echo $row["date"]; ?></td>
  </tr>
  <?php
  $i++;
  }
  $result->free();
  }
  ?>
</center>
</body>
</html>