<?php
session_start();
include('config.php');
if(isset($_POST['login'])){
$email = $_POST["username"];
$password = $_POST["password"];

    $check_email2 = mysqli_query($conn, "SELECT * FROM admin WHERE username_admin='$email' AND password_admin='$password'");

  	if (mysqli_num_rows($check_email2) > 0) {
    	$row = mysqli_fetch_assoc($check_email2);
		//$_SESSION["login_id"] = $row['id_client'];
		$_SESSION['alogin']=$email;
		header("Location: tableau de bord.php");
	}
}
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<link rel="icon" href="img/logo%20safmma.png">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Gestionnaire | connexion administrateur</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	
	<div class="login-page bk-img" style="background-color: #ebf6f9;">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<br><br>
						<h1 class="text-center" style="color:green;font-family: courier;font-weight: bold;">Connexion administrateur</h1>
						<center><a href="../index.php" >Accueil</a></center>
						<div class="well row pt-2x pb-3x bk-light">
						<br>
							<div class="col-md-8 col-md-offset-2">
							
								<form method="post">
									
									<label for="" class="text-uppercase text-sm">Nom d'administrateur </label>
									<input type="text" placeholder="Username" name="username" class="form-control mb" required>

									<label for="" class="text-uppercase text-sm">Mot de passe</label>
									<input type="password" placeholder="Password" name="password" class="form-control mb" required>
									<button class="btn btn-primary btn-block" name="login" type="submit">IDENTIFIER</button>
								</form>
							</div>
						</div>
						<div class="text-center">
							<a href="#" class="color:red;">Mot de passe oublié?</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

</body>

</html>