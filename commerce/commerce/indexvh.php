<?php
include 'backend/database.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/logo%20safmma.png">
	<title>Ajout d'un nouveau vehicule</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="ajax/ajaxVh.js"></script>
</head>
<body>
<div class="container">
<p id="success"></p>
	<div class="table-wrapper">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-6">
					<h2>Gestion <b><a href="indexvh.php">Vehicule</a></b></h2>
				</div>
				<div class="col-sm-6">
					<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Ajouter Nouvelle Vehicule</span></a>
					<a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple"><i class="fa fa-trash"></i> <span>Supprimer</span></a>
					<a href="admin/tableau de bord.php" class="btn btn-danger" id="modal"><i class="fa fa-close"></i> <span>Quittez</span></a>						
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
					<th>TYPE</th>
					<th>VOITURE</th>
					<th>MATRICULE</th>
					<th>ACTION</th>
				</tr>
			</thead>
			<tbody>
			
			<?php
			$result = mysqli_query($conn,"SELECT * FROM vehicule");
				$i=1;
				while($row = mysqli_fetch_array($result)) {
			?>
			<tr id="<?php echo $row["id_v"]; ?>">
			<td>
						<span class="custom-checkbox">
							<input type="checkbox" class="user_checkbox" data-user-id="<?php echo $row["id_v"]; ?>">
							<label for="checkbox2"></label>
						</span>
					</td>
				<td><?php echo $i; ?></td>
				<td><?php echo $row["type_v"]; ?></td>
				<td><?php echo $row["voiture"]; ?></td>
				<td><?php echo $row["matricule"]; ?></td>
				<td>
					<a href="#editEmployeeModal" class="edit" data-toggle="modal">
						<i class="fa fa-edit update" data-toggle="tooltip" 
						data-id="<?php echo $row["id_v"]; ?>"
						data-name="<?php echo $row["type_v"]; ?>"
						data-email="<?php echo $row["voiture"]; ?>"
						data-phone="<?php echo $row["matricule"]; ?>"
						title="Modifier"></i>
					</a>
					<a href="#deleteEmployeeModal" class="delete" data-id="<?php echo $row["id_v"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" 
						title="Supprimer"></i></a>
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
					<h4 class="modal-title">Ajouter vehicule</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Type Vehicule</label>
						<select name="name" id="name" class="form-control" required>
							<option value="choix1">
								<?php 
								$query2 = "SELECT * FROM moyen_transport";
								$result2 = mysqli_query($conn, $query2);
								if ($result2) {
									while($row2 = mysqli_fetch_array($result2)){
										echo '<option value="'.$row2["moyen"].'">'.$row2["moyen"].'</option>';
									} 
								} ?>
							</option>
						</select>
					</div>
					<div class="form-group">
						<label>voiture</label>
						<input type="text" id="email" name="email" class="form-control" required>
					</div>
					<div class="form-group">
						<label>matricule</label>
						<input type="text" id="phone" name="phone" class="form-control" required>
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
					<h4 class="modal-title">Modifier vehicule</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id_u" name="id" class="form-control" required>					
					<div class="form-group">
						<label>Type Vehicule</label>
						<select id="name_u" name="name" class="form-control" required>
							<option value="choix1">
								<?php 
								$query02 = "SELECT * FROM vehicule";
								$result02 = mysqli_query($conn, $query02);
								if ($result02) {
									while($row02 = mysqli_fetch_array($result02)){
										echo '<option value="'.$row02["type_v"].'">'.$row02["type_v"].'</option>';
									} 
								} ?>
							</option>
						</select>
					</div>
					<div class="form-group">
						<label>voiture</label>
						<input type="email" id="email_u" name="email" class="form-control" required>
					</div>
					<div class="form-group">
						<label>matricule</label>
						<input type="phone" id="phone_u" name="phone" class="form-control" required>
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
					<h4 class="modal-title">Supprimer vehicule</h4>
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