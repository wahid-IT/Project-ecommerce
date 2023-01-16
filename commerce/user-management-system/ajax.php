<?php
$conn = mysqli_connect("localhost", "root", "", "ordredemission");
mysqli_query($conn, "set NAMES utf8");

if(isset($_GET['nom']) && !empty($_GET['nom'])){
	$nom = $_GET['nom'];
	
	$query = "SELECT * FROM missionnaire WHERE nom_m='$nom'";
	$result = mysqli_query($conn, $query);
	$count = mysqli_num_rows($result);
	if($count >0){
		while($row= mysqli_fetch_array($result)){
			echo '<option value="'.$row['prenom_m'].'">'.$row['prenom_m'].'</option>';
		}
	} else{
		echo '<option>Prenom n existe pas</option>';
	}
} else{
	echo '<h1>Ereur</h1>';
}

?>