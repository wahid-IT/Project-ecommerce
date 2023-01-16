<?php
include 'connect_db.php';

require 'vendor/autoload.php';

session_start();
error_reporting(0);

if (isset($_POST["signup"])) {
  $full_name = $_POST["signup_full_name"];
  $email = $_POST["signup_email"];
  $password = $_POST["signup_password"];
  $cpassword = $_POST["signup_cpassword"];
  $phone = $_POST["signup_phone"];

  $check_email = mysqli_num_rows(mysqli_query($conn, "SELECT username FROM client WHERE username='$email'"));

  if ($password !== $cpassword) {
    echo "<script>alert('Les mots de passe ne correspond pas');</script>";
  } elseif ($check_email > 0) {
    echo "<script>alert('Email existe déjà dans notre base de données.');</script>";
  } else {
    $sql = "INSERT INTO client (username, password2, nom_prenom, telephone, paiement) VALUES
     ('$email', '$password', '$full_name', '$phone', '0')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      echo "<script>alert('Inscription réalisé avec succés');</script>";
      $_POST["signup_full_name"] = "";
      $_POST["signup_email"] = "";
      $_POST["signup_password"] = "";
      $_POST["signup_cpassword"] = "";
      $_POST["signup_phone"] = "";
    }
  }
}

if (isset($_POST["signin"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $check_email = mysqli_query($conn, "SELECT * FROM client WHERE username='$email' AND password2='$password'");

  if (mysqli_num_rows($check_email) > 0) {
    $row = mysqli_fetch_assoc($check_email);
    $_SESSION["login_id"] = $row['id_client'];
    //header("Location: welcome.php");
    header("location:home.php");
  } else {
    $check_email2 = mysqli_query($conn, "SELECT * FROM admin WHERE username_admin='$email' AND password_admin='$password'");

  if (mysqli_num_rows($check_email2) > 0) {
    $row = mysqli_fetch_assoc($check_email2);
    //$_SESSION["login_id"] = $row['id_client'];
    $_SESSION['alogin']=$email;
    header("Location: tableau de bord.php");
  }else{
    echo "<script>alert('Votre informations sont incorrects. Essaie une autre fois.');</script>";
  }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <title>Se connecter - One Click Delivery</title>
  <link rel="icon" type="image" href="/One-click-delivery/images/one-click.jpg">
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="" method="post" class="sign-in-form">
          <h2 class="title">Se connecter</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Adresse Email" name="email" value="<?php echo $_POST['email']; ?>" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Mot de passe" name="password" value="<?php echo $_POST['password']; ?>" required />
          </div>
          <input type="submit" value="Login" name="signin" class="btn solid" />
          <p style="display: flex;justify-content: center;align-items: center;margin-top: 20px;"><a href="/One-click-delivery/index.html" ></a></p>
        </form>
        <form action="" class="sign-up-form" method="post">
          <h2 class="title">S'inscrire</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Nom et Prénom" name="signup_full_name" required />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Address Email" name="signup_email" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Mot de passe" name="signup_password" required>
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Confirmer Mot de passe" name="signup_cpassword" required>
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="text" placeholder="Téléphone" name="signup_phone" required>
          </div>
          <input type="submit" class="btn" name="signup" value="S'inscrire">
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>Nouveau ici ?</h3>
          <p>
          Rejoindrez nous
          </p>
          <button class="btn transparent" id="sign-up-btn">
            S'inscrire
          </button>
        </div>
        <img src="img/log.svg" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>Un membre de nous ?</h3>
          <p>
          Bienvenu
          </p>
          <button class="btn transparent" id="sign-in-btn">
            Se connecter
          </button>
        </div>
        <img src="img/register.svg" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <script src="app.js"></script>
</body>

</html>