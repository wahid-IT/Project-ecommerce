
<?php
$servername = "localhost:8080";
$username = "root";
$password = "";
$dbname = "ordredemission";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$sSQL= 'SET CHARACTER SET utf8'; 
mysqli_query($conn,$sSQL) 
or die ('Can\'t charset in DataBase'); 

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>