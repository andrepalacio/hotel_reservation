<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="css/forms_style.css">
</head>
<body>
    <?php 
        session_start();
        include_once 'include/admin_navbar.html';
        if(!isset($_SESSION['user'])){
            header('location: ../login.php');}
    ?>
    <h2>Eliminar reservación</h2>
    <form method="post" name="hab_reserva">
        <div class="form-group">
            <label for="id_booking">ID de reservación:</label>&nbsp;
            <input type="number" min=0 name="id_booking">
        </div>
        <div>
            <label for="id_client">Cédula o ID del cliente:</label>
            <input type="number" min=0 name="id_client" required>
        </div>
        <button type="submit" name="submit">Eliminar</button>
    </form>

    <?php
        include_once 'include/admin_class.php';
        $admin = new Admin();
        if(isset($_POST['submit'])){
            $id_booking = $_POST['id_booking'];
            $id_client = $_POST['id_client'];
            $answer = $admin->delete_booking($id_booking, $id_client);
            if($answer){
                echo "<script>alert('Reservación eliminada con éxito')</script>";
            }else{
                echo "<script>alert('Error al eliminar la reservación')</script>";
            }
        }
    ?>
</body>
</html>