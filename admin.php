 <?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $message = "";
    try {

        $connect = new PDO("mysql:host=$servername;dbname=music", $username, $password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (isset($_POST["login"])) {
            if (empty($_POST["username"]) || empty($_POST["password"])) {
                $message = '<label></label>';
            } else {
                $query = "SELECT * FROM admin WHERE username = :username AND password = :password";
                $statement = $connect->prepare($query);
                $statement->execute(
                    array(
                        'username'     =>     $_POST["username"],
                        'password'     =>     $_POST["password"]
                    )
                );
                $count = $statement->rowCount();
                if ($count > 0) {
                    $_SESSION["username"] = $_POST["username"];
                    header("location:products-admin.php");
                } else {
                    $message = '<label><script>alert("check your username and password");</script></label>';
                }
            }
        }
    } catch (PDOException $error) {
        $message = $error->getMessage();
    }
    ?>
 <!DOCTYPE html>
 <html>

 <head>
     <title>Connexion administrateur</title>
     <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Rubik+Moonrocks&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">


     <style>
         h2 {
             font-family: 'Rubik Moonrocks',
                 cursive;
         }
     </style>
 </head>



 <body class="bg-dark">
     <?php
        require('header.php');
        ?>
     <br />
     <div class="container" style="width:500px;">
         <?php
            if (isset($message)) {
                echo '<label class="text-danger">' . $message . '</label>';
            }
            ?>

         <form class="bg-secondary p-3 rounded" method="post">
             <h2 class="text-center text-light">Connexion administrateur</h2><br />
             <label class="text-light">Username</label>
             <input type="text" name="username" class="form-control" />
             <br />
             <label class="text-light">Password</label>
             <input type="password" name="password" class="form-control" />
             <br />
             <div class="text-center">
                 <input type="submit" name="login" class="btn btn-info" value="Connexion" />
                 <input type="reset" value="Réinitialiser" class="btn btn-danger">
             </div>
         </form>


     </div>
     <br />
     <!-- <div class="text-center">
         <a href="./index.php"><img src="./images/HOME.png" alt="home"></a>

     </div> -->

     <?php
        require('footer.php');
        ?>

     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
 </body>

 </html>