<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reservas</title>
    <link rel="stylesheet" href="admin/css/booking_style.css">
</head>
<body>
    <?php include_once 'header.html'; ?>
    <h2>Reservar Habitación</h2>
    <p>Ingrese los siguientes datos para proceder con la reserva</p>

    <form method="post" name="hab_reserva">
        <div class="form-group0">
            <label for="checkin">Ingreso :</label>&nbsp;
            <input type="date" name="checkin">
        </div>

        <div class="form-group0">
            <label for="checkout">Salida:</label>&nbsp;
            <input type="date" name="checkout">
        </div>

        <div class="form-group0">
            <label for="room_category">Categoría de habitación:</label>
            <select name="room_category" id="room_category">
                <option value="Sencilla">Sencilla</option>
                <option value="Cama Doble">Doble</option>
                <option value="Familiar">Familiar</option>
                <option value="Suite">Suite</option>
            </select>
        </div>

        <div class="form-group">
            <label for="id_client">Cédula o ID:</label>
            <input type="number" min=0 name="id_client" placeholder="123456789" required>
        </div>

        <div class="form-group">
            <label for="name">Nombre completo:</label>
            <input type="text" name="name" placeholder="Jhon Murcia" required>
        </div>
        <div class="form-group">
            <label for="phone">Número telefónico:</label>
            <input type="number" min=0 name="phone" placeholder="301XXXXXXX" required>
        </div>
            
        <button type="submit" name="submit">Reservar</button>
    </form>

    <?php
        if (isset($_POST['submit'])) {
            include_once 'admin\include\db_config.php';
            $db_conn = new mysqli($servername, $username, $password, $dbname);
            if ($db_conn->connect_error) {
              die("Conexión fallida: " . $db_conn->connect_error);
            }
            $room_category = $_POST['room_category'];
            $sql = "SELECT * FROM habitaciones WHERE categoria='$room_category' AND num NOT IN (SELECT numHabitacion FROM reservas)";
            $result = $db_conn->query($sql);
            if (!$result) {
                echo "<p>No hay habitaciones disponibles para la categoría o fecha seleccionada</p>";
            } else {
                $row = $result->fetch_assoc();
                $num = $row["num"];
                $sql2 = "INSERT INTO reservas (numHabitacion, ingreso, salida, idCliente, nombreCliente, telefono) 
                    VALUES ('$num', '$_POST[checkin]', '$_POST[checkout]', '$_POST[id_client]', '$_POST[name]', '$_POST[phone]')";
                if ($db_conn->query($sql2) === TRUE) {
                    echo "<p>Reserva realizada con éxito</p>";
                } else {
                    echo "<p>Error al realizar la reserva</p>";
                }
            }
            $db_conn->close();
        }
    ?>
</body>
</html>