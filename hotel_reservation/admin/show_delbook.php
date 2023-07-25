<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/show_style.css">
    <style>
        .id{
            width: 5%;
        }
        .fk{
            width: 10%;
        }
        .date{
            width: 15%;
        }
        .name{
            width: 25%;
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
        $bookings = $admin->show_del_booked_rooms();
        echo "<h2>Reservas canceladas</h2>";
        echo "<table border='1'>
            <tr>
                <th class='id'>ID</th>
                <th class='fk'>Núm Habitacion</th>
                <th class='fk'>ID Empleado</th>
                <th class='date'>Check-in</th>
                <th class='date'>Check-out</th>
                <th class='fk'>ID Cliente</th>
                <th class='name'>Nombre Cliente</th>
                <th class='fk'>Teléfono</th>
                <th>Fecha eliminación</th>
            </tr>";
        while($row = mysqli_fetch_array($bookings)){
            echo "<tr>";
            echo "<td class='id'>".$row['id']."</td>";
            echo "<td class='fk'>".$row['numHabitacion']."</td>";
            echo "<td class='fk'>".$row['idEmpleado']."</td>";
            echo "<td class='date'>".$row['ingreso']."</td>";
            echo "<td class='date'>".$row['salida']."</td>";
            echo "<td class='fk'>".$row['idCliente']."</td>";
            echo "<td class='name'>".$row['nombreCliente']."</td>";
            echo "<td class='fk'>".$row['telefono']."</td>";
            echo "<td>".$row['fecha_cancelada']."</td>";
            echo "</tr>";
        }
    ?>
</body>
</html>