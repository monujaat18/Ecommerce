<?php
$servername = "localhost"; // or your server address
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "ecommerce"; // your database name
$conn = "";// Create connection
try {$conn = new mysqli($servername, $username, $password, $dbname); }
catch(mysqli_sql_exception){
    echo "Error creating connection: ";
}
if($conn)
?>
