<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="./style.css" rel="stylesheet">
    <link href="./style_login.css" rel="stylesheet">
    <title>Inscription</title>
</head>

<body>
    <form action="./inscriptionTraitement.php" method="POST" id="FormInscription">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom: </label>
            <input type="text" name="nom" id="nom" class="form-control">
        </div>
        <div class="mb-3">
            <label for="login" class="form-label">Email: </label>
            <input type="email" name="login" id="login" class="form-control">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password: </label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="mb-3">
            <label for="repassword" class="form-label">Retapez le password: </label>
            <input type="password" name="repassword" id="repassword" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>