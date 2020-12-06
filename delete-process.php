<?php
$server = "localhost";
$username = "root";
$password="";
$conn=mysqli_connect($server,$username,$password,"railways");
if(!$conn){
 die('Could not Connect My Sql:' .mysql_error());
}

$sql = "DELETE FROM trains WHERE uid='" . $_GET["uid"] . "'";
if (mysqli_query($conn, $sql)) {
    // echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
mysqli_close($conn);
    header('Location: list_train.php');

?>