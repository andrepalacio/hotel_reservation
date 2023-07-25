<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/show_style.css">
    <style>
        table{
            width: 50%;
        }
    </style>
    <title>Administrador</title>
</head>
<body>
    <?php
        session_start();
        if(!isset($_SESSION['user'])){
            header('location: ../login.php');}
        include_once 'include/admin_navbar.html';
        include_once 'include/admin_class.php';
        $admin = new Admin();
        $rooms = $admin->show_rooms();
        echo "<h2>Habitaciones</h2>";
        echo "<table border='1'>
            <tr>
                <th>Número</th>
                <th>Camas</th>
                <th>Ocupantes</th>
                <th>Categoría</th>
                <!--<th>Eliminar</th>-->
            </tr>";
        while($row = mysqli_fetch_array($rooms)){
            echo "<tr>";
            echo "<td>".$row['num']."</td>";
            echo "<td>".$row['camas']."</td>";
            echo "<td>".$row['ocupantes']."</td>";
            echo "<td>".$row['categoria']."</td>";
            //echo "<td><a href='delete_admin.php?id=".$row['id']."'>Eliminar</a></td>";
            echo "</tr>";
        }
    ?>
</body>
</html>