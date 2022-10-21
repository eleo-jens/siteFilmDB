<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <link href="./style_login.css" rel="stylesheet">
        <title>Document</title>
</head>
<body id="login">
    <div class="wrapper">
        <div class="heading">
            <h1>NETFLIX</h1>
        </div>
        <form action="./loginTraitement.php" method="POST">
            <div class="mb-3">
                <span>
                    <i class="fa-solid fa-user"></i>
                    <!-- <label for="login" class="form-label">Login</label>     -->
                    <input type="email" name="login" id="login" class="form-control" placeholder="Email">
                </span>
            </div>
            <div class="mb-3">
                <span>
                    <i class="fa-solid fa-lock"></i>
                    <!-- <label for="password" class="form-label">Password</label>         -->
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                </span>
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
            <button class="btn btn-primary"><a href="./inscription.php">S'inscrire</a></button>
        </form>
    </div>
    <?php
        if (isset ($_GET['error'])){
            // traiter les différents types d'erreur
            switch ($_GET['error']){
                case "badPass":
                    echo "<h5>Le pass est incorrecte</h5>";
                    break;
            }
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>