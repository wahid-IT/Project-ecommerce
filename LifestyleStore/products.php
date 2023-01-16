<?php
    session_start();
    require 'check_if_added.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/lifestyleStore.png" />
        <title>Lifestyle Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- jquery library -->
        <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <!-- Latest compiled and minified javascript -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <!-- External CSS -->
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div>
            <?php
                require 'header.php';
            ?>
            <div class="container">
                <div class="jumbotron">
                    <h1>Welcome to our LifeStyle Store!</h1>
                    <p>We have the best cameras, watches and shirts for you. No need to hunt around, we have all in one place.</p>
                </div>
            </div>
            <table style="margin-left:120px;">
                <?php
                    require 'connection.php';
                    $i=0;
                    $result = mysqli_query($con,"SELECT * FROM items");
                    while($row = mysqli_fetch_array($result)){
                        if($i%3 == 0){
                            echo "<tr class='thumbnail'>";
                        }
                        echo "<td class='caption'><a href='cart.php' DA>
                                    <img width='293' height='220' src='{$row["image"]}' alt='Cannon'>
                                </a>
                                <center>
                                    <h3>{$row['name']}</h3>
                                    <p>Price: {$row['price']} DA</p>
                                    <a href='cart_add.php?id=1' class='btn btn-block btn-primary' name='add' value='add' class='btn btn-block btr-primary'>Add to cart</a>
                                </center>
                            </td>";
                        if($i%3 == 2){
                            echo "</tr>";
                        }
                        $i++;
                    }
                ?>
            </table>
            <br><br><br><br><br><br><br><br>
           <footer class="footer">
               <div class="container">
               <center>
                   <p>Copyright &copy Lifestyle Store. All Rights Reserved. | Contact Us: +91 90000 00000</p>
                   <p>This website is developed by Sajal Agrawal</p>
               </center>
               </div>
           </footer>
        </div>
    </body>
</html>
