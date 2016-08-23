<?php
 error_reporting( ~E_ALL & ~E_DEPRECATED &  ~E_NOTICE );
 
require_once 'db_credentials.php';
 
$db = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// $conn = mysql_connect($dbhost,$dbuser,$dbpass);
// $dbcon = mysql_select_db($dbname);
 
// if ( !$conn ) {
//  die("Connection failed : " . mysql_error());
// }
 
// if ( !$dbcon ) {
//  die("Database Connection failed : " . mysql_error());
//}
 
// Everything commented in this way has been depreceated.
?>

