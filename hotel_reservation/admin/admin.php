<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <style>
        h2{
            text-align: center;
            margin: 15px;
            font-style: italic;
        }
        img{
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <?php
        session_start();
        include_once 'include/admin_navbar.html';
        include_once 'include/admin_class.php';
        if(isset($_SESSION['user'])){
            echo "<h2>Bienvenido ".$_SESSION['user']."</h2>";
            echo "<img src='../img/admin.jpg' alt='admin' width='50%'>";
        }else{
            header('location: ../login.php');
        }
    ?>
</body>
</html>