<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <h1>NETFLIX</h1>
    <form action="./loginTraitement.php" method="POST">
    <div class="mb-3">
        <label for="login" class="form-label">Login</label>    
        <input type="email" name="login" id="login" class="form-control">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>        
        <input type="password" name="password" id="password" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button><br>
    <a href="./inscription.php">S'inscrire</a>
    </form>
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