<?php  include 'backend/database.php';?>
<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="ajax/ajax00.js"></script>
	<title>Creer Ordre de Mission Chauffeur</title>
	<link rel="icon" href="images/logo%20safmma.png">
	<style>
		span{
			font-size: 16px;
		}
		body{
			background-color: #F0FFFF;
		}
	</style>
  </head>
  <body>
  	<div class="container">
		<p id="success"></p>
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<a href="index.php" class="btn btn-default" id="modal"><i class="material-icons"></i> <span>Quittez</span></a>	
						<h2><a href="home2 - copie.php">Gestion <b>Ordre de Mission Chauffeur</b></a></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Ajouter Nouvelle Ordre de mission</span></a>
						<a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple"><i class="material-icons"></i> <span>Supprimer</span></a>					
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th>N°</th>
						<th>Numéro</th>
						<th>Exercice</th>
                        <th>Chauffeur</th>
						<th>Objet</th><!-- de la mission-->
						<th>Date</th><!-- de la mission-->
						<th>Retour</th><!-- Date de la mission-->
						<th>Destination</th>	  
						<th>Moyen</th>	  <!-- de transport-->
						<th>Matricule</th><!-- de voiture-->
                        <th>Personnes </th><!-- Transportées-->
                        <th>Marchandise </th><!-- transporté-->
                        <th>Allée</th>
                        <th>Retour</th>
						<th>ACTION</th>	
					</tr>
				</thead>
				<tbody>
				<?php
				$result = mysqli_query($conn,"SELECT * FROM ordre_missions WHERE id_tr != '0' ORDER BY num_om");
					$i=1;
					while($row = mysqli_fetch_array($result)) {
				?>
				<tr id="<?php echo $row["num_om"]; ?>">
					<td>
						<span class="custom-checkbox">
							<input type="checkbox" class="user_checkbox" data-user-id="<?php echo $row["id_m"]; ?>">
							<label for="checkbox2"></label>
						</span>
					</td>
					<td><?php echo $i; ?></td>
					<td><?php echo $row["num_om"]; ?></td>
					<td><?php echo $row["exercise"]; ?></td>
                    <td>
                        <?php
                            $q0 = "SELECT * FROM transport WHERE id_tr='$row[id_tr]'";
                            $res0 = mysqli_query($conn, $q0); 
                            if($r0 = mysqli_fetch_array($res0)){
                                $q1 = "SELECT * FROM chauffeur WHERE id_ch='$r0[id_ch]'";
                                $res1 = mysqli_query($conn, $q1); 
                                if($r1 = mysqli_fetch_array($res1)){
                                    echo $r1["nom_prenom_ch"];
                                }
                            } 
                        ?></td>	
					<td><?php 
						$sql0 = "SELECT * FROM objet_mission WHERE id_obj='$row[objet_om]'";
						$result0 = mysqli_query($conn, $sql0); 
						if($row0 = mysqli_fetch_array($result0)){
							echo $row0[1];
						} 
						?>
					</td>	
					<td><?php echo $row["date_mission"]; ?></td>	
					<td><?php echo $row["date_retour"]; ?></td>	
					<td><?php
						$sql10 = "SELECT * FROM destinations WHERE id_dst='$row[destination]'";
						$result10 = mysqli_query($conn, $sql10); 
						if($row10 = mysqli_fetch_array($result10)){
							echo $row10[1]; 
						}?>
					</td>	
					<td><?php echo $row["moyen_transport"]; ?></td>	
					<td><?php echo $row["matricule"]; ?></td>
                    <td><?php 
                        $name = explode(" ",$row['id_m']);
						$sq2 = "SELECT * FROM missionnaire WHERE id_m='$name[0]'";
						$res1 = mysqli_query($conn, $sq2); 
						
						$sq20 = "SELECT * FROM missionnaire WHERE id_m='$name[1]'";
						$res10 = mysqli_query($conn, $sq20); 
						
						$sq200 = "SELECT * FROM missionnaire WHERE id_m='$name[2]'";
						$res100 = mysqli_query($conn, $sq200); 
					
						$sq2000 = "SELECT * FROM missionnaire WHERE id_m='$name[3]'";
						$res1000 = mysqli_query($conn, $sq2000); 
						
						if($r1 = mysqli_fetch_array($res1)){
							echo $r1[1]; echo " "; echo $r1[2]; 
						}echo "-";
						if($r10 = mysqli_fetch_array($res10)){
							echo $r10[1]; echo " "; echo $r10[2]; 
						}echo "-";
						if($r100 = mysqli_fetch_array($res100)){
							echo $r100[1]; echo " "; echo $r100[2]; 
						}echo "-";
						if($r1000 = mysqli_fetch_array($res1000)){
							echo $r1000[1]; echo " "; echo $r1000[2]; 
						}
						?>
					</td>
					<td><?php 
						 $sd = "SELECT * FROM transport WHERE id_tr='$row[id_tr]'";
						 $resd = mysqli_query($conn, $sd); 
						 if($rd = mysqli_fetch_array($resd)){
							echo $rd["marchandise_transporter"];
						 } 
					?></td>	
					<td><?php 
						$ssd = "SELECT * FROM transport WHERE id_tr='$row[id_tr]'";
						$ressd = mysqli_query($conn, $ssd); 
						if($srd = mysqli_fetch_array($ressd)){
						   echo $srd["aller"];
						} 
					?></td>	
					<td><?php 
						$ssd2 = "SELECT * FROM transport WHERE id_tr='$row[id_tr]'";
						$ressd2 = mysqli_query($conn, $ssd2); 
						if($srd2 = mysqli_fetch_array($ressd2)){
						   echo $srd2["retour"];
						} 
					?></td>	
					<td>
						<a href="#editEmployeeModal" class="edit" data-toggle="modal">
							<i class="fa fa-edit update" data-toggle="tooltip"
							data-id="<?php echo $row["num_om"]; ?>"
							data-exercise="<?php echo $row["exercise"]; ?>"
							data-chauffeur="<?php $q0 = "SELECT * FROM transport WHERE id_tr='$row[id_tr]'";
											$res0 = mysqli_query($conn, $q0); 
											if($r0 = mysqli_fetch_array($res0)){
												$q1 = "SELECT * FROM chauffeur WHERE id_ch='$r0[id_ch]'";
												$res1 = mysqli_query($conn, $q1); 
												if($r1 = mysqli_fetch_array($res1)){
													echo $r1["nom_prenom_ch"];
												}
											} ?>"
							data-objet_om="<?php $sql0 = "SELECT * FROM objet_mission WHERE id_obj='$row[objet_om]'";
											  $result0 = mysqli_query($conn, $sql0); 
											  if($row0 = mysqli_fetch_array($result0)){
											    	echo $row0[1];
											  } ?>"
							data-date_m="<?php echo $row["date_mission"]; ?>"
							data-date_r="<?php echo $row["date_retour"]; ?>"
							data-destination="<?php $sql10 = "SELECT * FROM destinations WHERE id_dst='$row[destination]'";
													$result10 = mysqli_query($conn, $sql10); 
													if($row10 = mysqli_fetch_array($result10)){
														echo $row10[1]; 
													} ?>"
							data-moyen="<?php echo $row["moyen_transport"]; ?>"
							data-matricule="<?php echo $row["matricule"]; ?>"
							data-missionnaire1="<?php $nam = explode(" ",$row['id_m']);
												$sq2 = "SELECT * FROM missionnaire WHERE id_m='$nam[0]'";
												$res1 = mysqli_query($conn, $sq2); 
												if($r1 = mysqli_fetch_array($res1)){
													echo $r1[1]; echo " "; echo $r1[2]; 
												}?>"
							data-missionnaire2="<?php $nam2 = explode(" ",$row['id_m']); 
												$sq20 = "SELECT * FROM missionnaire WHERE id_m='$nam[1]'";
												$res10 = mysqli_query($conn, $sq20); 
												if($r10 = mysqli_fetch_array($res10)){
													echo $r10[1]; echo " "; echo $r10[2]; 
												}?>"
							data-missionnaire3="<?php $nam3 = explode(" ",$row['id_m']); 
												$sq200 = "SELECT * FROM missionnaire WHERE id_m='$nam[2]'";
												$res100 = mysqli_query($conn, $sq200);
												if($r100 = mysqli_fetch_array($res100)){
													echo $r100[1]; echo " "; echo $r100[2]; 
												} ?>"
							data-missionnaire4="<?php $nam4 = explode(" ",$row['id_m']); 
												$sq2000 = "SELECT * FROM missionnaire WHERE id_m='$nam[3]'";
												$res1000 = mysqli_query($conn, $sq2000); 
												if($r1000 = mysqli_fetch_array($res1000)){
													echo $r1000[1]; echo " "; echo $r1000[2]; 
												} ?>"
							data-marchandise="<?php $sd = "SELECT * FROM transport WHERE id_tr='$row[id_tr]'";
												$resd = mysqli_query($conn, $sd); 
												if($rd = mysqli_fetch_array($resd)){
													echo $rd["marchandise_transporter"];
												}  ?>"
							data-aller="<?php $ssd = "SELECT * FROM transport WHERE id_tr='$row[id_tr]'";
											$ressd = mysqli_query($conn, $ssd); 
											if($srd = mysqli_fetch_array($ressd)){
											echo $srd["aller"];
											}  ?>"
							data-retour="<?php $ssd2 = "SELECT * FROM transport WHERE id_tr='$row[id_tr]'";
											$ressd2 = mysqli_query($conn, $ssd2); 
											if($srd2 = mysqli_fetch_array($ressd2)){
											echo $srd["retour"];
											}  ?>"
							title="Modifier"></i>
						</a>
						<a href="#deleteEmployeeModal" class="delete" data-id="<?php echo $row["num_om"]; ?>" data-toggle="modal"><i class="fa fa-trash" 
							title="Supprimer"></i></a>
						<a href="test01.php?num_om=<?php echo $row["num_om"]; ?>" class="print" data-toggle="modal">
						<i class="fa fa-print" title="Imprimer"></i></a>
					</td>
				</tr>
				<?php
				$i++;
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- Ajouter Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="user_form">
					<div class="modal-header">						
						<h4 class="modal-title">Ajouter Ordre de mission pour chauffeur</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>N° Ordre de mission</label> 
							<input id="num" name="num" class="form-control" value="
								<?php 
									$req = mysqli_query($conn,"SELECT * FROM ordre_missions ORDER BY num_om DESC LIMIT 0,1");
									if($donnees = mysqli_fetch_array($req))
										echo ($donnees['num_om'])+1;
									else
										echo 1;
								?>" required>
						</div>					
						<div class="form-group">
							<label>Exercice</label>
							<input id="exercise" name="exercise" value="2022" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Chauffeur</label>
							<select id="chauffeur" name="chauffeur" class="form-control" required>
								<option selected="selected">Select Chauffeur
								<?php 
								$query04 = "SELECT * FROM chauffeur";
								$result04 = mysqli_query($conn, $query04);
								if ($result04) {
									while($row04 = mysqli_fetch_array($result04)){
										echo '<option value="'.$row04[1].'">'.$row04[1].'</option>';
									} 
								} ?>
								</option>
							</select>
						</div>
						<div class="form-group">
							<label>Objet de la Mission</label>
							<select id="objet_om" name="objet_om" class="form-control" required>
								<option selected="selected">Select Objet
								<?php 
								$query4 = "SELECT * FROM objet_mission";
								$result4 = mysqli_query($conn, $query4);
								if ($result4) {
									while($row4 = mysqli_fetch_array($result4)){
										echo '<option value="'.$row4[1].'">'.$row4[1].'</option>';
									} 
								} ?>
								</option>
							</select>
						</div>
						<div class="form-group">
							<label>Date de la mission</label>
							<input id="date_m" name="date_m" type="date" class="form-control" required>
							<label>Date de retour</label>
							<input id="date_ret" name="date_ret" type="date" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Destination</label>
							<select id="destination" name="destination" class="form-control" required>
								<option value="choix1">
								<?php 
								$query5 = "SELECT * FROM destinations";
								$result5 = mysqli_query($conn, $query5);
								if ($result5) {
									while($row5 = mysqli_fetch_array($result5)){
										echo '<option value="'.$row5[1].'">'.$row5[1].'</option>';
									} 
								} ?>
								</option>
							</select> 
						</div>
						<div class="form-group">
							<label>Moyen de transport</label>
							<select id="moyen" name="moyen" class="form-control" required>
								<option value="choix1">
								<?php
								$query6 = "SELECT * FROM moyen_transport";
								$result6 = mysqli_query($conn, $query6); 
								if ($result6) {
									while($row6 = mysqli_fetch_array($result6)){
										echo '<option value="'.$row6[1].'">'.$row6[1].'</option>';
									} 
								} ?>
								</option>
							</select>
							<label>Matricule</label>
							<select id="matricule" name="matricule" class="form-control" required>
								<option value="choix1">Matricule</option>
							</select>
						</div>				
						<div class="form-group">
							<p>Personnes Transportées</p>
							<label>1. Nom du demandeur</label>
							<select id="nom_m1" name="nom_m1" class="form-control" required>
								<option value="choix1">Select Personnel
									<?php 
									$query2 = "SELECT * FROM missionnaire";
									$result2 = mysqli_query($conn, $query2); 
									if ($result2) {
										while($row2 = mysqli_fetch_array($result2)){
											echo '<option value="'.$row2["nom_m"].' '.$row2["prenom_m"].'">'.$row2["nom_m"].' '.$row2["prenom_m"].'</option>';
										} 
									} ?>
								</option>
							</select> 
							<label>2. Nom du demandeur</label>
							<select id="nom_m2" name="nom_m2" class="form-control" required>
								<option value="choix1">Select Personnel
									<?php 
									$query2 = "SELECT * FROM missionnaire";
									$result2 = mysqli_query($conn, $query2); 
									if ($result2) {
										while($row2 = mysqli_fetch_array($result2)){
											echo '<option value="'.$row2["nom_m"].' '.$row2["prenom_m"].'">'.$row2["nom_m"].' '.$row2["prenom_m"].'</option>';
										} 
									} ?>
								</option>
							</select> 
							<label>3. Nom du demandeur</label>
							<select id="nom_m3" name="nom_m3" class="form-control" required>
								<option value="choix1">Select Personnel
									<?php 
									$query2 = "SELECT * FROM missionnaire";
									$result2 = mysqli_query($conn, $query2); 
									if ($result2) {
										while($row2 = mysqli_fetch_array($result2)){
											echo '<option value="'.$row2["nom_m"].' '.$row2["prenom_m"].'">'.$row2["nom_m"].' '.$row2["prenom_m"].'</option>';
										} 
									} ?>
								</option>
							</select> 
							<label>4. Nom du demandeur</label>
							<select id="nom_m4" name="nom_m4" class="form-control" required>
								<option value="choix1">Select Personnel
									<?php 
									$query2 = "SELECT * FROM missionnaire";
									$result2 = mysqli_query($conn, $query2); 
									if ($result2) {
										while($row2 = mysqli_fetch_array($result2)){
											echo '<option value="'.$row2["nom_m"].' '.$row2["prenom_m"].'">'.$row2["nom_m"].' '.$row2["prenom_m"].'</option>';
										} 
									} ?>
								</option>
							</select> 
						</div>
						<div class="form-group">
							<label>Marchandise transportée</label>
							<input id="marchandise" name="marchandise" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Aller</label>
							<input id="aller" name="aller" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Retour</label>
							<input id="retour" name="retour" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" value="1" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Quittez">
						<button type="button" class="btn btn-success" id="btn-add">Ajouter</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Modifier Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="update_form">
					<div class="modal-header">						
						<h4 class="modal-title">Modifier Ordre de Mission</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_u" name="id" class="form-control" required>					
						<div class="form-group">
							<label>Num</label>
							<input type="text" id="num_u" name="num" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Nouveau Numéro</label>
							<input type="text" id="numm_u" name="numm" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Exercise</label>
							<input type="text" id="exercise_u" name="exercise" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Chauffeur</label>
							<input type="text" id="chauffeur_u" name="chauffeur" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Objet de mission</label>
							<input type="text" id="objet_u" name="objet" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Date de mission</label>
							<input type="date" id="datem_u" name="datem" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Date de retour</label>
							<input type="date" id="dater_u" name="dater" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Destination</label>
							<input type="city" id="destination_u" name="destination" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Moyen de Transport</label>
							<input type="text" id="moyen_u" name="moyen" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Matricule</label>
							<input type="text" id="matricule_u" name="matricule" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Missionnaire 1</label>
							<input type="text" id="missionnaire1_u" name="missionnaire1" class="form-control" required>
							<label>Missionnaire 2</label>
							<input type="text" id="missionnaire2_u" name="missionnaire2" class="form-control" required>
							<label>Missionnaire 3</label>
							<input type="text" id="missionnaire3_u" name="missionnaire3" class="form-control" required>
							<label>Missionnaire 4</label>
							<input type="text" id="missionnaire4_u" name="missionnaire4" class="form-control" required>
						</div>					
					</div>
					<div class="form-group">
							<label>Marchandise transporté</label>
							<input type="text" id="marchandise_u" name="marchandise" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Aller</label>
							<input type="text" id="aller_u" name="aller" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Retour</label>
							<input type="text" id="retour_u" name="retour" class="form-control" required>
						</div>
						<div class="modal-footer">
							<input type="hidden" value="2" name="type">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Quittez">
							<button type="button" class="btn btn-info" id="update">Modifier</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Supprimer Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Supprimer Ordre de Mission Chauffeur</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_d" name="id" class="form-control">					
						<p>Vous avez sûr de supprimer ce champ?</p>
						<p class="text-warning"><small>Cette action ne peut être undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Quittez">
						<button type="button" class="btn btn-danger" id="delete">Supprimer</button>
					</div>
				</form>
			</div>
		</div>
	</div>
  </body>
</html>
<script>
$(document).ready(function() {
	$('#moyen').on('change',function(){
		var moyen = $(this).val();
		if(moyen!=""){
			$.get(
			  "ajax2.php",
			  {moyen: moyen},
			  function(data){
				  $('#matricule').html(data);
			  }
			);
		} else{
			$('#matricule').html('<option>Select Moyen</option>')
		}
	});
});
$(document).ready(function() {
	$('#nom_m1').on('change',function(){
		var nom_ms = $(this).val();
		if(nom_ms!=""){
			$.get(
			  "ajax3.php",
			  {nom_ms: nom_ms},
			  function(data){
				  $('#nom_m1').html(data);
			  }
			);
		} else{
			$('#nom_m1').html('<option>Select Missionnaire</option>')
		}
	});
});
$(document).ready(function() {
	$('#nom_m2').on('change',function(){
		var nom_ms2 = $(this).val();
		if(nom_ms2!=""){
			$.get(
			  "ajax30.php",
			  {nom_ms2: nom_ms2},
			  function(data){
				  $('#nom_m2').html(data);
			  }
			);
		} else{
			$('#nom_m2').html('<option>Select Missionnaire</option>')
		}
	});
});
$(document).ready(function() {
	$('#nom_m3').on('change',function(){
		var nom_ms3 = $(this).val();
		if(nom_ms3!=""){
			$.get(
			  "ajax300.php",
			  {nom_ms3: nom_ms3},
			  function(data){
				  $('#nom_m3').html(data);
			  }
			);
		} else{
			$('#nom_m3').html('<option>Select Missionnaire</option>')
		}
	});
});
$(document).ready(function() {
	$('#nom_m4').on('change',function(){
		var nom_ms4 = $(this).val();
		if(nom_ms4!=""){
			$.get(
			  "ajax3000.php",
			  {nom_ms4: nom_ms4},
			  function(data){
				  $('#nom_m4').html(data);
			  }
			);
		} else{
			$('#nom_m4').html('<option>Select Missionnaire</option>')
		}
	});
});
</script>