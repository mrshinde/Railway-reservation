<?php
session_start();
$berth_ac = array("LB","LB","UB","UB","UB","SL","SU","LB","LB","UB","UB","UB","SL","SU","LB","LB","UB","UB","UB","SL","SU");
$berth_sl = array("LB","MB","UB","LB","MB","UB","SL","SU","LB","MB","UB","LB","MB","UB","SL","SU","LB","MB","UB","LB","MB","UB","SL","SU");

?>




<!DOCTYPE html>
<html lang="en">
<head>
  <title>Railway Reservation System</title>
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
        <a class="nav-link" href="bookedtickets.php">Booked Tickets</a>
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
<?php 
  $username = "root"; 
  $password = ""; 
  $database = "railways"; 
  $mysqli = new mysqli("localhost", $username, $password, $database);
  $result = null; 
  $uid = $_SESSION["uid"];
  $date = $_SESSION["date"];
  $nop = $_SESSION["num"];
  $coach = $_SESSION["coach"];
  $agent_id = $_SESSION["agent_id"];
  $pnr = $_SESSION["pnr"];
  $lc = 0;
  $m = 0;
  if($coach=="AC")
  {
    $m=18;
    $lc = $_SESSION["lac"];
  }
  else
  {
    $m=24;
    $lc = $_SESSION["lsc"];
  }
?>
  <center>

<table border="0" cellspacing="2" cellpadding="2" class="table w-50 m-auto"> 
      <thead class="thead-dark"> 
          <tr>
          <th> <font face="Arial">PNR</font> </th> 
          <th> <font face="Arial">Train ID</font> </th> 
          <th> <font face="Arial">Number of Passengers</font> </th>
          <th> <font face="Arial">Date</font> </th>
          <th> <font face="Arial">Agent ID</font> </th>
          </tr>
      </thead>
  <tr >
  <td><?php echo $pnr; ?></td>
  <td><?php echo $uid; ?></td>
  <td><?php echo $nop; ?></td>
  <td><?php echo $date; ?></td>
  <td><?php echo $agent_id; ?></td>
  </tr>
</center>
</table>
<table border="0" cellspacing="2" cellpadding="2" class="table w-50 m-auto">
  <thead class="thead-dark">
    <tr>
          <th> <font face="Arial">Passenger Name</font> </th> 
          <th> <font face="Arial">Berth</font> </th> 
          <th> <font face="Arial">Coach</font> </th>
          </tr>
  </thead>
  <?php for ($i=0; $i < $nop; $i++) {?>
  <tr >
  <td><?php echo $_SESSION["name"][$i]; ?></td>
  <td><?php if($coach=="AC")
          {
            echo($berth_ac[($lc+$i+1)%$m]."-".(($lc+$i+1)%$m));
  }
  else
  {
    echo($berth_sl[($lc+$i+1)%$m]."-".($lc+$i+1)%$m);
  }

   ?></td>
  <td><?php echo $coach."-".strval(intdiv(($lc+1),$m) + 1); ?></td>
  </tr>
  <?php
    }
  ?>
</table>
</body>
</html>

