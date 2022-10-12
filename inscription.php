<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action ="./inscriptionTraitement.php" method="POST">
        Nom: <input type="text" name="nom" class="form-control">
        Email: <input type="email" name="login" class="form-control">
        Password: <input type="password" name="password" class="form-control">
        Re-tapez le password: <input type="password" name="repassword" class="form-control">
        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>