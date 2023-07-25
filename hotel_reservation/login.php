<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Sesion</title>
    <style>
        body {
            background-color: #f1f1f1;
        }

        form {
            margin: 10% auto;
            width: 30%;
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        input[type="text"], input[type="password"] {
            display: block;
            margin: 20px auto;
            padding: 10px;
            width: 80%;
            border-radius: 5px;
            border: none;
            background-color: #f1f1f1;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php include_once 'header.html'; ?>
    <form action="" method="post" name="login">
        <div class="form-group">
            <label for="username">Nombre de Usuario o Email:</label>
            <input type="text" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit" name="submit">Iniciar sesion</button>
    </form>
    <?php
        include_once 'admin\include\admin_class.php';
        $admin = new Admin();
        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $check = $admin->check_login($username, $password);
            if($check != NULL){
                session_start();
                $_SESSION['user'] = $username;
                $_SESSION['id'] = $check;
                header('location: admin\admin.php');
            }else{
                echo "<script>alert('Usuario o contraseña incorrectos')</script>";
            }
        }
    ?>
</body>
</html>