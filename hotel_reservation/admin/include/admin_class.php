<?php
    class admin{
        public $db;
        public $admin_id;
        public function __construct(){
            $this->db = new mysqli("localhost", "root", "", "reservation");
            if(mysqli_connect_errno()){
                echo "Error: No es posible conectarse a la base de datos";
                exit;
            }
        }

        /*** for admin_id set ***/
        public function set_admin_id($id){
            $this->admin_id = $id;
        }

        /*** for login process ***/
        public function check_login($username, $password){
            //$password = hash('sha256', $password);
            $sql = "SELECT id FROM administrador WHERE (usNombre='$username' OR email='$username') AND usClave='$password'";
            //checking if the username is available in the table
            $result = mysqli_query($this->db, $sql);
            $user_data = mysqli_fetch_array($result);
            $count_row = $result->num_rows;
            if($count_row == 1){
                return $user_data["id"];
            }else{return NULL;}
        }

        /*** for registration process ***/
        public function register_admin($usID,$username, $password, $name, $email, $address){
            //$password = hash('sha256', $password);
            $sql = "SELECT * FROM administrador WHERE usNombre='$username' OR email='$email'";
            //checking if the username or email is available in db
            $check = $this->db->query($sql);
            $count_row = $check->num_rows;
            //if the username is not in db then insert to the table
            if($count_row == 0){
                $sql1 = "INSERT INTO administrador (id, usNombre, usClave, nombre, email, direccion, avaliable) VALUES ('$usID','$username', '$password', '$name', '$email', '$address', 1)";
                $result = mysqli_query($this->db, $sql1) or die(mysqli_connect_errno()."Información no insertada");
                return $result;
            }else{return false;}
        }

        /*** for get user by id ***/
        public function get_admin_by_id($id){
            $sql = "SELECT * FROM administrador WHERE id='$id'";
            $result = mysqli_query($this->db, $sql);
            return $result;
        }

        /*** for modify user ***/
        public function modify_admin($id, $username, $password, $name, $email, $address){
            //$password = hash('sha256', $password);
            $sql1 = "UPDATE administrador SET usNombre='$username', usClave='$password', nombre='$name', email='$email', direccion='$address' WHERE id='$id'";
            $result = mysqli_query($this->db, $sql1) or die(mysqli_connect_errno()."Información no modificada");
            return $result;
        }

        /***for showing users***/
        public function get_admin(){
            $sql = "SELECT id, usNombre, usClave, nombre, email, direccion FROM administrador WHERE avaliable=1";
            $result = mysqli_query($this->db, $sql) or die(mysqli_connect_errno()."Información no encontrada");
            return $result;
        }

        /***for delete a user***/
        public function delete_admin($id){
            $sql = "UPDATE administrador SET avaliable=0 WHERE id='$id'";
            $result = mysqli_query($this->db, $sql) or die(mysqli_connect_errno()."Información no eliminada");
            return $result;
        }

        /**for booking a room***/
        public function book_room($checkin, $checkout, $room_category, $id_client, $name, $phone){
            $sql = "SELECT * FROM habitaciones WHERE categoria='$room_category' AND num NOT IN (SELECT numHabitacion FROM reservas)";
            $result = mysqli_query($this->db, $sql);
            if (!$result) {
                echo "<p>No hay habitaciones disponibles para la categoría o fecha seleccionada</p>";
                return false;
            } else {
                $row = $result->fetch_assoc();
                $num = $row["num"];
                $sql1 = "INSERT INTO reservas (numHabitacion, idEmpleado, ingreso, salida, idCliente, nombreCliente, telefono) 
                    VALUES ('$num', '$this->admin_id','$_POST[checkin]', '$_POST[checkout]', '$_POST[id_client]', '$_POST[name]', '$_POST[phone]')";
                $result = mysqli_query($this->db, $sql1) or die(mysqli_connect_errno()."Información no insertada");
                $sql2 = "UPDATE habitaciones SET ocupada=1 WHERE num='$num'";
                $result2 = mysqli_query($this->db, $sql2);
                return $result;
            }
        }

        /***for booked rooms***/
        public function show_booked_rooms(){
            $sql = "SELECT * FROM reservas";
            $result = mysqli_query($this->db, $sql) or die(mysqli_connect_errno()."Información no encontrada");
            return $result;
        }

        public function show_del_booked_rooms(){
            $sql = "SELECT * FROM reservas_canceladas";
            $result = mysqli_query($this->db, $sql) or die(mysqli_connect_errno()."Información no encontrada");
            return $result;
        }

        /***for modify booked rooms***/
        public function modify_booked_rooms($numReserva, $checkin, $checkout, $id_client, $name, $phone){
            $sql = "SELECT * FROM reservas WHERE id='$numReserva'";
            $result = mysqli_query($this->db, $sql) or die(mysqli_connect_errno()."Información no encontrada");
            if ($result->num_rows > 0) {
                $sql2 = "UPDATE reservas SET idEmpleado='$this->adminID' ingreso='$checkin', salida='$checkout', idCliente='$id_client', nombreCliente='$name', telefono='$phone' WHERE id='$numReserva'";
                $result = mysqli_query($this->db, $sql2) or die(mysqli_connect_errno()."Información no modificada");
                return $result;
            } else {
                return "<p>No hay reservas con ese número</p>";
            }
        }

        /***for delete booked rooms***/
        public function delete_booking($numReserva, $id_client){
            $sql = "SELECT * FROM reservas WHERE id='$numReserva' OR idCliente='$id_client'";
            $result = mysqli_query($this->db, $sql) or die(mysqli_connect_errno()."Información no encontrada");
            if ($result->num_rows > 0) {
                $result = $result->fetch_assoc();
                $sql1 = "INSERT INTO reservas_canceladas (id, numHabitacion, idEmpleado, ingreso, salida, idCliente, nombreCliente, telefono) 
                    VALUES ('$result[id]', '$result[numHabitacion]', '$this->admin_id', '$result[ingreso]', '$result[salida]', '$result[idCliente]', '$result[nombreCliente]', '$result[telefono]')";
                $result1 = mysqli_query($this->db, $sql1) or die(mysqli_connect_errno()."Información no insertada");
                $sql2 = "DELETE FROM reservas WHERE id='$numReserva' OR idCliente='$id_client'";
                $result = mysqli_query($this->db, $sql2) or die(mysqli_connect_errno()."Información no eliminada");
                return $result;
            } else {
                return false;
            }
        }

        /***for add rooms***/
        public function add_rooms($numHabitacion, $categoria, $precio){
            $sql = "SELECT * FROM habitaciones WHERE num='$numHabitacion'";
            $result = mysqli_query($this->db, $sql) or die(mysqli_connect_errno()."Información no encontrada");
            if ($result->num_rows > 0) {
                return "<p>Ya existe una habitación con ese número</p>";
            } else {
                $sql2 = "INSERT INTO habitaciones (num, categoria, precio) VALUES ('$numHabitacion', '$categoria', '$precio')";
                $result = mysqli_query($this->db, $sql2) or die(mysqli_connect_errno()."Información no insertada");
                return $result;
            }
        }

        /***for showing rooms***/
        public function show_rooms(){
            $sql = "SELECT num, camas, ocupantes, categoria FROM habitaciones";
            $result = mysqli_query($this->db, $sql) or die(mysqli_connect_errno()."Información no encontrada");
            return $result;
        }

        /*** for showing occupied rooms ***/
        public function show_occrooms(){
            $sql = "SELECT num, camas, ocupantes, categoria FROM habitaciones where ocupada = 1";
            $result = mysqli_query($this->db, $sql) or die(mysqli_connect_errno()."Información no encontrada");
            return $result;
        }

        /***for delete rooms***/
        public function delete_rooms($numHabitacion){
            $sql = "SELECT * FROM habitaciones WHERE num='$numHabitacion'";
            $result = mysqli_query($this->db, $sql) or die(mysqli_connect_errno()."Información no encontrada");
            if ($result->num_rows > 0) {
                $result = $result->fetch_assoc();
                $sql1 = "INSERT INTO habitaciones_elimindadas (num, camas, ocupantes, categoria, idEmpleado) 
                    VALUES ('$result[num]', '$result[camas]', '$result[ocupantes]', '$result[categoria]', '$this->admin_id')";
                $result1 = mysqli_query($this->db, $sql1) or die(mysqli_connect_errno()."Información no insertada");
                $sql2 = "DELETE FROM habitaciones WHERE num='$numHabitacion'";
                $result = mysqli_query($this->db, $sql2) or die(mysqli_connect_errno()."Información no eliminada");
                return $result;
            } else {
                return "<p>No hay habitaciones con ese número</p>";
            }
        }

        /***for modify rooms***/
        public function modify_rooms($numHabitacion, $camas, $ocupantes, $categoria){
            $sql = "SELECT * FROM habitaciones WHERE num='$numHabitacion'";
            $result = mysqli_query($this->db, $sql) or die(mysqli_connect_errno()."Información no encontrada");
            if ($result->num_rows > 0) {
                $sql2 = "UPDATE habitaciones SET camas='$camas', ocupantes='$ocupantes', categoria='$categoria' WHERE num='$numHabitacion'";
                $result = mysqli_query($this->db, $sql2) or die(mysqli_connect_errno()."Información no modificada");
                return $result;
            } else {
                return "<p>No hay habitaciones con ese número</p>";
            }
        }

        /***for log out***/
        public function log_out(){
            unset($_SESSION['user']);
            unset($_SESSION['id']);
            session_destroy();
            header("location:../index.php");
        }
    }
?>