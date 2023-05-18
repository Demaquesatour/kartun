<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="fcc c-base">
        <div class="fcsc c-log">
            <div class="fcc c-brand">
                <img src="../img/logo.png" alt="">
            </div>
            <form class="fcsc" action="autho.php" method="POST">
                <p>USUARIO</p>
                <input type="text" required autocomplete="off" placeholder="Ingrese su usuario" name="usuario">
                <p>CONTRASEÑA</p>
                <input type="password" required placeholder="Ingrese su contraseña" name="clave">
                <input id="npt" type="submit" value="Ingresar">
            </form>
        </div>
    </div>
</body>
</html>