<?php
include 'backend/database.php';
?>
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
	<script src="ajax/ajax0.js"></script>
	<title>Creer Ordre de Mission</title>
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
						<h2><a href="home - copie.php">Gestion <b>Ordre de Mission</b></a></h2>
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
						<th>Objet</th><!-- de la mission-->
						<th>Date</th><!-- de la mission-->
						<th>Date de retour</th><!-- de la mission-->
						<th>Destination</th>	  
						<th>Moyen </th>	<!-- de transport-->  
						<th>Missionnaire</th>	  
						<th>Matricule </th><!-- de voiture-->
						<th>ACTION</th>	
					</tr>
				</thead>
				<tbody>
					<?php
					$result = mysqli_query($conn,"SELECT * FROM ordre_missions WHERE id_tr = '0' ORDER BY num_om");
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
					<td><?php 
						$sql = "SELECT * FROM missionnaire WHERE id_m='$row[id_m]'";
						$result1 = mysqli_query($conn, $sql); 
						if($row1 = mysqli_fetch_array($result1)){
							echo $row1[1]; echo " "; echo $row1[2]; 
						}?>
					</td>	
					<td><?php echo $row["matricule"]; ?></td>
					<td>
						<a href="#editEmployeeModal" class="edit" data-toggle="modal">
							<i class="fa fa-edit update" data-toggle="tooltip"
								data-id="<?php echo $row["num_om"]; ?>"
								data-name="<?php echo $row["exercise"]; ?>"
								data-email="<?php $sql0 = "SELECT * FROM objet_mission WHERE id_obj='$row[objet_om]'";
												$result0 = mysqli_query($conn, $sql0); 
												if($row0 = mysqli_fetch_array($result0)){
														echo $row0[1];
												} ?>"
								data-phone="<?php echo $row["date_mission"]; ?>"
								data-city="<?php echo $row["date_retour"]; ?>"
								data-destination="<?php $sql10 = "SELECT * FROM destinations WHERE id_dst='$row[destination]'";
														$result10 = mysqli_query($conn, $sql10); 
														if($row10 = mysqli_fetch_array($result10)){
															echo $row10[1]; 
														} ?>"
								data-moyen="<?php echo $row["moyen_transport"]; ?>"
								data-missionnaire="<?php $sql = "SELECT * FROM missionnaire WHERE id_m='$row[id_m]'";
														$result1 = mysqli_query($conn, $sql); 
														if($row1 = mysqli_fetch_array($result1)){
															echo $row1[1]; echo " "; echo $row1[2]; 
														} ?>"
								data-matricule="<?php echo $row["matricule"]; ?>"
								title="Modifier">
							</i>
						</a>
						<a href="#deleteEmployeeModal" class="delete" data-id="<?php echo $row["num_om"]; ?>" data-toggle="modal"><i class="fa fa-trash"
							title="Supprimer"></i></a>
						<a href="test.php?num_om=<?php echo $row["num_om"]; ?>" class="print" data-toggle="modal">
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
	<!-- Add Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="user_form">
					<div class="modal-header">						
						<h4 class="modal-title">Ajouter Ordre de mission</h4>
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
							<label>Nom du demandeur</label>
							<select id="nom_m" name="nom_m" class="form-control" required>
								<option value="choix1">Select Nom
									<?php 
									$query2 = "SELECT * FROM missionnaire";
									$result2 = mysqli_query($conn, $query2); 
									if ($result2) {
										while($row2 = mysqli_fetch_array($result2)){
											echo '<option value="'.$row2["nom_m"].'">'.$row2["nom_m"].'</option>';
										} 
									} ?>
								</option>
							</select> 
							<label>Prenom du demandeur</label>
							<select id="prenom" name="prenom" class="form-control" required>
								<option value="choix1">Select Prenom</option>
							</select>
						</div>
						<div class="form-group">
							<label>Objet de la Mission</label>
							<select id="objet_om" name="objet_om" class="objet_om" class="form-control" required>
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
							<label>Date de la mission</label>
							<input id="date_m" name="date_m" type="date" class="form-control" required>
							
							<label>Date de retour</label>
							<input id="date_ret" name="date_ret" type="date" class="form-control" required>
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
	<!-- Edit Modal HTML -->
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
							<input type="text" id="num_u" name="num" required>
							<label>Nouveau Numéro</label>
							<input type="text" id="numm_u" name="numm" required>
						</div>
						<div class="form-group">
							<label>Exercise</label>
							<input type="text" id="exercise_u" name="exercise" class="form-control" required>
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
							<label>Missionnaire</label>
							<input type="text" id="missionnaire_u" name="missionnaire" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Matricule</label>
							<input type="text" id="matricule_u" name="matricule" class="form-control" required>
						</div>					
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
	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="delete_form">
					<div class="modal-header">						
						<h4 class="modal-title">Supprimer Ordre de Mission</h4>
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
	$('#nom_m').on('change',function(){
		var nom = $(this).val();
		if(nom!=""){
			$.get(
			  "ajax.php",
			  {nom: nom},
			  function(data){
				  $('#prenom').html(data);
			  }
			);
		} else{
			$('#prenom').html('<option>Select Nom</option>')
		}
	});
});
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
</script>