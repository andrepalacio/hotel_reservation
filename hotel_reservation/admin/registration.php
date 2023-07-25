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
    <h2>Registrar Administrador</h2>
    <p>Por favor ingrese los datos del administrador a registrar</p>
    
    <form method="post">
        <div>
            <label for="id_admin">Cédula o ID:</label>
            <input type="number" min=0 name="id_admin" placeholder="123456789" required>
        </div>
        <div class="form-group">
            <label for="username">Nombre de usuario:</label>
            <input type="text" name="username" placeholder="Jhon123" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" placeholder="********" required>
        </div>
        <div class="form-group">
            <label for="name">Nombre completo:</label>
            <input type="text" name="name" placeholder="Jhon Murcia" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="example@correo" required>
        </div>
        <div>
            <label for="address">Dirección</label>
            <input type="text" name="address" placeholder="Calle 123 # 45-67" required>
        </div>
        <button type="submit" name="submit">Registrar</button>
    </form>

    <?php
        include_once 'include/admin_class.php';
        $admin = new Admin();
        if(isset($_POST['submit'])){
            $id_admin = $_POST['id_admin'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $answer = $admin->register_admin($id_admin, $username, $password, $name, $email, $address);
            if($answer){
                echo "<script>alert('Administrador registrado exitosamente')</script>";
            }else{
                echo "<script>alert('Error al registrar administrador')</script>";
            }
        }
    ?>
</body>
</html>