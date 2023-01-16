<?php
include 'database.php';
if(count($_POST)>0){
	if($_POST['type']==1){
		$num=$_POST['num'];
		$exercise=$_POST['exercise'];
        $chauffeur=$_POST['chauffeur'];
        $objet_om=$_POST['objet_om'];
        $date_m=$_POST['date_m'];
        $date_ret=$_POST['date_ret'];
        $destination=$_POST['destination'];
        $moyen=$_POST['moyen'];
        $matricule=$_POST['matricule'];
        $m1=$_POST['nom_m1']; 
        $m2=$_POST['nom_m2']; 
        $m3=$_POST['nom_m3']; 
        $m4=$_POST['nom_m4']; 
        $marchandise=$_POST['marchandise'];
        $aller=$_POST['aller'];
        $retour=$_POST['retour'];
		
		$sql1 = "SELECT * from `objet_mission` where `objet_m`='$objet_om'";
		$req1 = mysqli_query ($conn,$sql1);
		$data1 = mysqli_fetch_array($req1);
		$objet = $data1[0];
		
		$sql2 = "SELECT * from `destinations` where `destination`='$destination'";
		$req2 = mysqli_query ($conn,$sql2);
		$data2 = mysqli_fetch_array($req2);
		$num_dst = $data2[0];
		
		$date_mission = implode('-',array_reverse  (explode('/',$date_m)));

        $sq = "SELECT * from `chauffeur` where `nom_prenom_ch`='$chauffeur'";
		$req = mysqli_query ($conn,$sq);
		$data=mysqli_fetch_array($req);
		$id_ch = $data[0];
		
		$sq2 = "INSERT INTO `transport`( `id_ch`, `marchandise_transporter`, `aller`, `retour`) 
				 VALUES ('$id_ch','$marchandise','$aller','$retour')";
		$rq2 = mysqli_query($conn, $sq2);
        $query0 = "SELECT * FROM transport ORDER BY id_tr DESC LIMIT 0,1";
		$result0 = mysqli_query($conn, $query0);
		$row0 = mysqli_fetch_array($result0);
		$id_tr = $row0[0];

        $name = array($m1,$m2,$m3,$m4); $mon = implode(" ",$name);
	
		$sql = "INSERT INTO `ordre_missions`( `num_om`, `exercise`, `objet_om`, `date_mission`, `date_retour`, `destination`, `moyen_transport`, `id_m`, `matricule`, `id_tr`) 
		VALUES ('$num','$exercise','$objet','$date_mission','$date_ret','$num_dst','$moyen','$mon','$matricule','$id_tr')";

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
		$chauffeur=$_POST['chauffeur'];
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
		$m1=$_POST['missionnaire1'];
		$m2=$_POST['missionnaire2'];
		$m3=$_POST['missionnaire3'];
		$m4=$_POST['missionnaire4'];
		$marchandise=$_POST['marchandise'];
        $aller=$_POST['aller'];
        $retour=$_POST['retour'];
		/*if($m1 = " "){
			$id_m1 = "choix1";
		}else{*/
			$m11 = explode (" ", $m1);
			$query00 = "SELECT * from `missionnaire` where `nom_m`='$m11[0]' and `prenom_m`='$m11[1]'";
			$result00 = mysqli_query ($conn,$query00);
			if($result00){
				$data00=mysqli_fetch_array($result00);
				$id_m1 = $data00[0];
			}
		//}
		if($m2 = " "){
			$id_m2 = "choix1";
		}else{
			$m22 = explode (" ", $m2);
			$query01 = "SELECT * from `missionnaire` where `nom_m`='$m22[0]' and `prenom_m`='$m22[1]'";
			$result01 = mysqli_query ($conn,$query01);
			if($result01){
				$data01=mysqli_fetch_array($result01);
				$id_m2 = $data01[0];
			}
		}
		if($m3 = " "){
			$id_m3 = "choix1";
		}else{
			$m33 = explode (" ", $m3);
			$query10 = "SELECT * from `missionnaire` where `nom_m`='$m33[0]' and `prenom_m`='$m33[1]'";
			$result10 = mysqli_query ($conn,$query10);
			if($result10){
				$data10=mysqli_fetch_array($result10);
				$id_m3 = $data10[0];
			}
		}
		if($m4 = " "){
			$id_m4 = "choix1";
		}else{
			$m44 = explode (" ", $m4);
			$query11 = "SELECT * from `missionnaire` where `nom_m`='$m44[0]' and `prenom_m`='$m44[1]'";
			$result11 = mysqli_query ($conn,$query11);
			if($result11){
				$data11=mysqli_fetch_array($result11);
				$id_m4 = $data11[0];
			}
		}
		$name = array($id_m1,$id_m2,$id_m3,$id_m4); $mon = implode(" ",$name);
		$matricule=$_POST['matricule'];
		$sql30 = "SELECT * from `ordre_missions` where `num_om`='$num'";
		$req30 = mysqli_query ($conn,$sql30);
		$data30 = mysqli_fetch_array($req30);
		$id_tr = $data30["id_tr"];

		$sqq = "SELECT * from `chauffeur` where `nom_prenom_ch`='$chauffeur'";
		$reqq = mysqli_query ($conn,$sqq);
		$dataq=mysqli_fetch_array($reqq);
		$id_ch = $dataq[0];
		$sq2 = "UPDATE transport set id_ch='$id_ch', marchandise_transporter='$marchandise', aller='$aller', retour='$retour' where id_tr='$id_tr'";
		$rq2 = mysqli_query($conn, $sq2); 

		$sql = "UPDATE ordre_missions set num_om='$numm', exercise='$exercise', objet_om='$objet', date_mission='$date_m', date_retour='$date_retour',
		destination='$num_dst', moyen_transport='$moyen_transport', id_m='$mon', matricule='$matricule', id_tr='$id_tr' where num_om='$num' and id_tr!='0'";
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