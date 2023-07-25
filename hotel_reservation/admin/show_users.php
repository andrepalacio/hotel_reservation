<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/show_style.css">
    <title>Administrador</title>
</head>
<body>
    <?php
        session_start();
        if(!isset($_SESSION['user'])){
            header('location: ../login.php');}
        include_once 'include/admin_navbar.html';
        echo "<h2>Administradores registrados</h2>";
        include_once 'include/admin_class.php';
        $admin = new Admin();
        $result = $admin->get_admin();
        echo "<table border='1'>
            <tr>
                <th>Nombre de usuario</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Dirección</th>
                <!--<th>Eliminar</th>-->
            </tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>".$row['usNombre']."</td>";
            echo "<td>".$row['nombre']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['direccion']."</td>";
            //echo "<td><a href='delete_admin.php?id=".$row['id']."'>Eliminar</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>