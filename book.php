<?php
// echo "Reached Here At booking";
// echo($_POST[""]);
if(isset($_REQUEST["submit"])){
    // Set connection variables
    session_start();
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "railways";


     $con = mysqli_connect($server, $username, $password,$database);
     // echo "Reached Here At booking1";
    // Check for connection success
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }

    $uid = $_SESSION["uid"];
    $date = $_SESSION["date"];
    $nop = $_SESSION["num"];
    $coach = $_SESSION["coach"];
    $agent_id = $_SESSION["agent_id"];
    $_SESSION["name"] = $_REQUEST["name"];
    $dt = date_create();
	$pnr = date_timestamp_get($dt);
    $_SESSION["pnr"] = $pnr;
    

	
	    $sql = "INSERT INTO ticket (uid, pnr, date,agent_id,nop) VALUES ('$uid', '$pnr', '$date', '$agent_id', '$nop');";
    // echo $sql;
    
    // Execute the query
    if($con->query($sql) == true){
        // echo "Successfully inserted";

        // Flag for successful insertion
    }
    else{
        echo "ERROR: $sql <br> $con->error";
    }

    $berth=0;
    $coach_number=0;
    $temp = "SELECT * FROM released_train WHERE uid='$uid' and date='$date'";

    $result = mysqli_query($con,$temp);
    $row = mysqli_fetch_assoc($result);
    $lac = $row["lac"];
    $lsc = $row["lsc"];    
	$_SESSION["lac"] = $lac;
	$_SESSION["lsc"] = $lsc;

    if ($coach=="AC") {
    	for ($i=0; $i < $nop; $i++) { 
    		$coach_number = intdiv(($lac+1),18) + 1;
    		$berth = fmod($lac+1,18);
    		$tname = $_REQUEST['name'][$i];
    		// echo($_REQUEST['name'][$i]);

    		$query = "INSERT INTO passenger (name, pnr, coach_type, berth, coach_number)
VALUES ('$tname', $pnr, 'AC', $berth, $coach_number)";

    		if($con->query($query) == true){
        // echo "Successfully inserted";
    		}
    		else{
        		echo "ERROR: $query <br> $con->error";
    		}
    		$lac++;
    		$update_ac = "UPDATE released_train SET lac='$lac' WHERE uid='$uid' and date='$date'";
			$con->query($update_ac);
    	}
    }
    else{
    	for ($i=0; $i < $nop; $i++) { 
    		$coach_number = intdiv(($lsc+1),24) + 1;
    		$berth = fmod($lsc+1,24);
    		$tname = $_REQUEST['name'][$i];
    		$query = "INSERT INTO passenger (name, pnr, coach_type, berth, coach_number)
VALUES ('$tname', $pnr, 'SL',$berth,$coach_number)";
    		// $con->query($query);
    		if($con->query($query) == true){
        // echo "Successfully inserted";

        // Flag for successful insertion
    		}
    		else{
        		echo "ERROR: $query <br> $con->error";
    		}
    		$lsc++;
    		$update_sl = "UPDATE released_train SET lsc='$lsc' WHERE uid='$uid' and date='$date'";
			$con->query($update_sl);
    	}    
    }
    $result->free();

    // Close the database connection
    $con->close();
    header('Location: ticket.php');
}
?>