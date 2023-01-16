<?php
$conn = mysqli_connect("localhost", "root", "", "ordredemission");
mysqli_query($conn, "set NAMES utf8");

if(isset($_GET['nom_ms2']) && !empty($_GET['nom_ms2'])){
	$nom_ms = $_GET['nom_ms2'];
	$name = explode(" ", $nom_ms);
	$query = "SELECT * from `missionnaire` where `nom_m`='$name[0]' and `prenom_m`='$name[1]'";
	$result = mysqli_query ($conn,$query);
	
	while($row= mysqli_fetch_array($result)){
		echo '<option value="'.$row['id_m'].'">'.$row['id_m'].'</option>';
	}
	
} else{
	echo '<h1>Ereur</h1>';
}

?>