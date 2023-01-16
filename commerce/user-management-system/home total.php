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
	<script src="ajax/ajax0.js"></script>
	<title>Creer Ordre de Mission</title>
	<link rel="icon" href="images/logo%20safmma.png">
  </head>
  <body>
  	<div class="container">
		<p id="success"></p>
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><a href="home total.php">Gestion <b>Ordre de Mission</b></a></h2>
					</div>
					<div class="col-sm-6">
						<a href="admin/tableau de bord.php" class="btn btn-danger" id="modal"><i class="material-icons"></i> <span>Quittez</span></a>						
					</div>
					<form align="center" action="" method="GET"></br></br></br></br>
						<input type="text" placeholder="Chercher ici" name="search">&nbsp;
						<input type="submit" value="Chercher" name="btn" class="btn btn-sm btn-primary">
					</form>
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
						<th>Objet de la mission</th>
						<th>Date de la mission</th>
						<th>Date de retour la mission</th>
						<th>Destination</th>	  
						<th>Moyen de transport</th>	  
						<th>Missionnaire / Chauffeur</th>	  
						<th>Matricule de voiture</th>
						<th>ACTION</th>	
					</tr>
				</thead>
				<tbody>
				<?php
				$query = "SELECT * FROM ordre_missions ORDER BY num_om";
									
				if( isset($_GET['search']) ){
					$name = mysqli_real_escape_string($conn, htmlspecialchars($_GET['search']));
					$sql = "SELECT * FROM missionnaire WHERE nom_m='$name' OR prenom_m='$name'";
					$result1 = mysqli_query($conn, $sql); 
					if($row1 = mysqli_fetch_array($result1)){	
						$query = "SELECT * FROM ordre_missions WHERE num_om ='$name' OR exercise ='$name' OR id_m ='$row1[0]'";
					}else{
						$query = "SELECT * FROM ordre_missions WHERE num_om ='$name' OR exercise ='$name'";
					}
				}
				$result = mysqli_query($conn,$query);
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
						if($row["id_tr"]==0){
							$sql = "SELECT * FROM missionnaire WHERE id_m='$row[id_m]'";
							$result1 = mysqli_query($conn, $sql); 
							if($row1 = mysqli_fetch_array($result1)){
								echo $row1[1]; echo " "; echo $row1[2]; 
							}
						}else{
							$sql = "SELECT * FROM transport WHERE id_tr='$row[id_tr]'";
							$result1 = mysqli_query($conn, $sql); 
							if($row1 = mysqli_fetch_array($result1)){
								$sqll = "SELECT * FROM chauffeur WHERE id_ch='$row1[id_ch]'";
								$result1l = mysqli_query($conn, $sqll); 
								if($row1l = mysqli_fetch_array($result1l)){
									echo $row1l[1];  
								}
							}
						}
						?>
					</td>	
					<td><?php echo $row["matricule"]; ?></td>
					<td><?php if($row["id_tr"]==0){?>
						<a href="test.php?num_om=<?php echo $row["num_om"]; ?>" class="print" data-toggle="modal">
							Imprimer</a>
							<?php } else{?>
						<a href="test01.php?num_om=<?php echo $row["num_om"]; ?>" class="print" data-toggle="modal">
							Imprimer</a>
						<?php	}?>
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
							<label>Exercice</label>
							<select id="exercise" name="exercise" class="form-control" required>
								<option value="2022">2022</option>
								<option value="2023">2023</option>
								<option value="2023">2024</option>
								<option value="2023">2025</option>
							</select>
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
	<!-- Supprimer Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
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