<?php 
$username = "root"; 
$password = ""; 
$database = "railways"; 
$mysqli = new mysqli("localhost", $username, $password, $database); 
$result=null;
if (isset($_POST["password"])) {
  $name = $_POST["password"];
  $agent_id = $_POST["agent_id"];
$query = "SELECT * FROM ticket T, booking_agent B  WHERE T.agent_id=B.agent_id and T.agent_id='$agent_id' and B.name='$name';";

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
    <h1>Check Bookings</h1>      
    <p>Welcome to Railway Reservation System</p>
    
  </div>
</div>
<div class="container">
    
    <form action="" method="post">
            <input type="text" name="agent_id" id="agent_id" placeholder="Enter Agent ID">
            <input type="password" name="password" id="password" placeholder="Enter password"> 
            <button class="btn btn-warning">Find</button> 
        </form>
  </div>
<center>


<?php
  if(is_null($result))
    die();
  if(mysqli_num_rows($result)==0)
  {die("ERROR: Incorrect ID or password");}
  if(!is_null($result))
  {
    ?>
    <br><br>
    <table border="0" cellspacing="2" cellpadding="2" class="table w-50 m-auto"> 
      <thead class="thead-dark"> 
          <tr>
          <th> <font face="Arial">PNR</font> </th> 
          <th> <font face="Arial">Train ID</font> </th> 
          <th> <font face="Arial">Number of Passengers</font> </th>
          <th> <font face="Arial">Date</font> </th>
          </tr>
      </thead>
      <?php
    $i=0;
  while($row = mysqli_fetch_array($result)) {
  ?>
  <tr >
  <td><?php echo $row["pnr"]; ?></td>
  <td><?php echo $row["uid"]; ?></td>
  <td><?php echo $row["nop"]; ?></td>
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