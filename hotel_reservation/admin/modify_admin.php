<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
</head>
<body>
    <?php 
        session_start();
        include_once 'include/admin_navbar.html';
        if(!isset($_SESSION['user'])){
            header('location: ../login.php');}
        include_once 'include/admin_class.php';
        echo"<h2>Modificar Administrador</h2>";
        $admin = new Admin();
        $admin->set_admin_id($_SESSION['id']);
        $m_admin = $admin->get_admin($_POST['id_admin']);
        if($m_admin->num_rows > 0){
            $dat_admin = $m_admin->fetch_assoc();
            echo'<form method="post">
                <div>
                    <label for="id_admin">Cédula o ID:</label>
                    <input type="number" name="id_admin" value='.$dat_admin['id'].' readonly="readonly">
                </div>
                <div class="form-group">
                    <label for="username">Nombre de usuario:</label>
                    <input type="text" name="username" value='.$dat_admin['usNombre'].' readonly="readonly">
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
            </form>';
            if(isset($_POST['submit'])){
                $admin->modify_admin($_POST['id_admin'], $_POST['username'], $_POST['password'], $_POST['name'], $_POST['email'], $_POST['address']);
            }
        } else {
            echo "<b>'Administrador no encontrado'</b>";
        }
    ?>
</body>
</html>