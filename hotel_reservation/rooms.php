<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Habitaciones</title>
    <style>
        h2{
            text-align: center;
            width: 100%;
            font-style: italic;
        }
        .habs {
            border: 1px solid black;
            border-radius: 10px;
            width: 250px;
            margin: 10px;
            padding: 10px;
            float: left;
        }
        .habs img{
            width: 100%;
            height: 140px;
            border-radius: 5px;
        }
        .habs form input{
            border-radius: 5px;
            border: none;
            background-color: #4CAF50;
            color: white;
            padding: 7px 10px;
            cursor: pointer;
        }
        .habs form input:hover{
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php include_once 'header.html'; ?>
    <h2>Habitaciones</h2>
    
    <?php
        include_once 'admin\include\db_config.php';
        $db_conn = new mysqli($servername, $username, $password, $dbname);
        if ($db_conn->connect_error) {
          die("Conexión fallida: " . $db_conn->connect_error);
        }
        $sql = "SELECT camas, ocupantes, categoria, COUNT(*) AS disponibles FROM habitaciones 
            WHERE num NOT IN (SELECT numHabitacion FROM reservas) GROUP BY categoria";
        $result = $db_conn->query($sql);
        if (!$result) {
            echo "Error interno al consultar la base de datos";
        } else {
            while ($row = $result->fetch_assoc()) {
                $cat_img = "img/" . $row["categoria"] . ".jpg";
                if ($row["categoria"] == "Cama Doble"){
                    $cat_img = "img/Doble.jpg";
                }
                echo "<div class=habs><img src=". $cat_img."><hr>
                    <p>" . $row["categoria"] . "</p> <p>Camas " . $row["camas"] . "</p> </p>Ocupantes " . $row["ocupantes"] . "</p> <p>Disponibles " . $row["disponibles"] . "</p>
                    <form action='booking.php' method='post'> <input type='submit' value='Reservar'></form></div>";
            }
        }
        $db_conn->close();
    ?>
</body>
</html>