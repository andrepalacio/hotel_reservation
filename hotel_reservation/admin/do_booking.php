<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/booking_style.css">
    <title>Administrador</title>
</head>
<body>
    <?php 
        session_start();
        include_once 'include/admin_navbar.html';
        if(!isset($_SESSION['user'])){
            header('location: ../login.php');}
    ?>
    <h2>Reservar habitación</h2>
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
        include_once 'include/admin_class.php';
        $admin = new Admin();
        if(isset($_POST['submit'])){
            $checkin = $_POST['checkin'];
            $checkout = $_POST['checkout'];
            $room_category = $_POST['room_category'];
            $id_client = $_POST['id_client'];
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $answer = $admin->book_room($checkin, $checkout, $room_category, $id_client, $name, $phone);
            if($answer){
                echo "<script>alert('Reserva exitosa')</script>";
            }else{
                echo "<script>alert('Error al reservar')</script>";
            }
        }
    ?>
</body>
</html>