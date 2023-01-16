<?php
include 'database.php';
if(count($_POST)>0){
	if($_POST['type']==1){
		$num=$_POST['num'];
		$exercise=$_POST['exercise'];
        $nom_m=$_POST['nom_m'];
        $prenom=$_POST['prenom'];
        $objet_om=$_POST['objet_om'];
        $destination=$_POST['destination'];
        $date_m=$_POST['date_m'];
        $date_ret=$_POST['date_ret'];
        $moyen=$_POST['moyen'];
        $matricule=$_POST['matricule'];

        $sql0 = "SELECT * from `missionnaire` where `nom_m`='$nom_m' AND `prenom_m` ='$prenom'";
		$req0 = mysqli_query ($conn,$sql0);
		$data0=mysqli_fetch_array($req0);
		$id_m = $data0[0];
		
		$sql1 = "SELECT * from `objet_mission` where `objet_m`='$objet_om'";
		$req1 = mysqli_query ($conn,$sql1);
		$data1 = mysqli_fetch_array($req1);
		$objet = $data1[0];
		
		$sql2 = "SELECT * from `destinations` where `destination`='$destination'";
		$req2 = mysqli_query ($conn,$sql2);
		$data2 = mysqli_fetch_array($req2);
		$num_dst = $data2[0];
		
		$date_mission = implode('-',array_reverse  (explode('/',$date_m)));
	
		$sql = "INSERT INTO `ordre_missions`( `num_om`, `exercise`, `objet_om`, `date_mission`, `date_retour`, `destination`, `moyen_transport`, `id_m`, `matricule`, `id_tr`) 
		VALUES ('$num','$exercise','$objet','$date_mission','$date_ret','$num_dst','$moyen','$id_m','$matricule','0')";

		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==2){
		$numm=$_POST['numm'];
		$num=$_POST['num'];
		$exercise=$_POST['exercise'];
		$objet_om=$_POST['objet'];
			$sql1 = "SELECT * from `objet_mission` where `objet_m`='$objet_om'";
			$req1 = mysqli_query ($conn,$sql1);
			$data1 = mysqli_fetch_array($req1);
			$objet = $data1["id_obj"]; 
		$date_mission=$_POST['datem'];
			$date_m = implode('-',array_reverse  (explode('/',$date_mission)));
		$date_retour=$_POST['dater'];
		$destination=$_POST['destination'];
			$sql2 = "SELECT * from `destinations` where `destination`='$destination'";
			$req2 = mysqli_query ($conn,$sql2);
			$data2 = mysqli_fetch_array($req2);
			$num_dst = $data2["id_dst"]; 
		$moyen_transport=$_POST['moyen'];
	
		$id_m=$_POST['missionnaire'];
        $name = explode(" ", $id_m);
			$query = "SELECT * from `missionnaire` where `nom_m`='$name[0]' and `prenom_m`='$name[1]'";
			$result = mysqli_query ($conn,$query);
			$row = mysqli_fetch_array($result);
		$matricule=$_POST['matricule'];

		$sql = "UPDATE ordre_missions set num_om='$numm', exercise='$exercise', objet_om='$objet', date_mission='$date_m', date_retour='$date_retour',
				destination='$num_dst', moyen_transport='$moyen_transport', id_m='$row[0]', matricule='$matricule', id_tr='0' where num_om='$num'";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "DELETE FROM `ordre_missions` WHERE num_om=$id ";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==4){
		$id=$_POST['id'];
		$sql = "DELETE FROM ordre_missions WHERE num_om in ($id)";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}

?>