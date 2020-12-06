<?php
session_start();
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
    <h1>Book Tickets</h1>      
    <p>Welcome to Railway Reservation System</p>
    
  </div>
</div>
<!-- <div class="container-fluid bg-danger"><marquee><p><h1>Trains Available in Service</h1></p></marquee></div> -->
<div class="container-fluid bg-danger pt-3 pb-3">
    <h4>Check Availability </h4>
    <form action="booktrain.php" method="post" class="form">
              
            <input type="number" name="agent_id" id="agent_id" placeholder="Agent ID">
            <input type="password" name="password" id="password" placeholder="password">
            <input type="number" name="uid" id="uid" placeholder="Train Number">
            <input type="date" name="date" id="date" placeholder="Enter Date">
            <input type="number" name="num" id="num" placeholder="No of passengers">
            <select name="coach">
              <option value = "AC">AC</option>
              <option value = "SL">SL</option>
            </select>
            <button class="btn btn-success" type="submit" name="submit">Check</button> 
        </form>
  </div>
</body>
</html>

<?php 
  $username = "root"; 
  $password = ""; 
  $database = "railways"; 
  $mysqli = new mysqli("localhost", $username, $password, $database);
  $result = null; 
  if(isset($_POST["submit"]))
  {
    $uid = $_POST["uid"];
    $date = $_POST["date"];
    $nop = $_POST["num"];
    $coach = $_POST["coach"];
    $agent_id = $_POST["agent_id"];
    $pass = $_POST["password"];
    $_SESSION["uid"] = $uid;
    $_SESSION["date"] = $date;
    $_SESSION["num"] = $nop;
    $_SESSION["coach"] = $coach;
    $_SESSION["agent_id"] = $_POST["agent_id"];
    //date check
    $q = "SELECT agent_id FROM booking_agent WHERE agent_id='$agent_id' and name='$pass';";
    $temp_r = $mysqli->query($q);
    if( mysqli_num_rows($temp_r)==0)
    {
      die("ERROR: Agent ID or Password is incorrect!");
    }
    $today = date("Y-m-d H:i:s");
    if($today>$date){
      die("ERROR: Please check date");
    }

    if($coach=="AC")
    {
      $query = "SELECT count(*) FROM released_train WHERE uid='$uid' and date='$date' and ((noac*18)-lac)>=$nop GROUP BY uid  ;";
      // echo "$query";
      $result=$mysqli->query($query);
      $count = mysqli_num_rows($result);
      if($count>0){ ?>
        <br>
        <center><h3>You can add the details of the passengers below</h3></center>
        <hr>
        <div class="contianer w-25 m-auto">
          <form action="book.php" mehtod="post">
        <?php for($x=0;$x<$nop;$x++){ ?>
          <br><label>Passenger <?php echo $x+1 ?></label>
          <input type="text" name="name[]" placeholder="Passenger Name">
        <?php } ?>
        <button type="submit" class="btn btn-success" name="submit">Book Ticket</button>
      </form>
        </div>
      <?php 
        $result->free();
      }
      else
      {
        ?>
        <CENTER><h3>
          <?php echo "ERROR: The train is full or has not been released"; ?>
        </h3></CENTER>
        <?php
      }
    }
    else
    {
      $query = "SELECT count(*) FROM released_train WHERE uid='$uid' and date='$date' and ((nosc*24)-lsc)>=$nop GROUP BY uid  ;";
      // echo "$query";
      $result=$mysqli->query($query);
      $count = mysqli_num_rows($result);
      if($count>0){ ?>
         <br>
        <center><h3>You can add the details of the passengers below</h3></center>
        <hr>
        <div class="contianer w-25 m-auto">
          <form action="book.php" mehtod="post">
        <?php for($x=0;$x<$nop;$x++){ ?> 
          <br><label> Passenger <?php echo $x+1 ?></label>
          <input type="text" name="name[]" placeholder ="Passenger Name">
        <?php } ?>
        <button type="submit" class="btn" name="submit">Book Ticket</button>
      </form>
        </div>
      <?php 
    $result->free();
     } 
     else
      {?>
        <CENTER><h3>
          <?php echo "ERROR: The train is full or has not been released"; ?>
        </h3></CENTER>
        <?php
      }
    }
  }
?>