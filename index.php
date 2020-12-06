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
<br> <br>
<div class="card-deck">
    <div class="card bg-info">
      <div class="card-body text-center">
      	<h1>Find Trains</h1>
        <a href="findtrains.php" class="stretched-link"></a>
      </div>
    </div>
    <div class="card bg-warning">
      <div class="card-body text-center">
        <h1>Book Trains</h1>
        <a href="booktrain.php" class="stretched-link"></a>
      </div>
    </div>
    </div>  
  </div>
</div>
<br>
<div class="card-deck">
    <div class="card bg-success">
      <div class="card-body text-center">
      	<h1>Admin Section</h1>
        <a href="admin.php" class="stretched-link"></a>
      </div>
    </div>
    <div class="card bg-danger">
      <div class="card-body text-center">
        <h1>Booked Tickets</h1>
        <a href="bookedtickets.php" class="stretched-link"></a>
      </div>
    </div>
    </div>  
  </div>
</div>
</body>
</html>
