<?php
$conn = mysqli_connect("localhost", "root", "", "ordredemission");
mysqli_query($conn, "set NAMES utf8");

if(isset($_GET['moyen']) && !empty($_GET['moyen'])){
	$moyen = $_GET['moyen'];
	
	$query = "SELECT * FROM vehicule WHERE type_v='$moyen'";
	$result = mysqli_query($conn, $query);
	$count = mysqli_num_rows($result);
	if($count >0){
		while($row= mysqli_fetch_array($result)){
			echo '<option value="'.$row['voiture'].','.$row['matricule'].'">'.$row['voiture'].','.$row['matricule'].'</option>';
		}
	} else{
		echo '<option>Matricule n existe pas</option>';
	}
} else{
	echo '<h1>Ereur</h1>';
}

?>