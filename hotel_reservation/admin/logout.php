<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('location: ../login.php');
    } else {
        include_once 'include/admin_class.php';
        $admin = new Admin();
        $admin->set_admin_id($_SESSION['id']);
        $admin->log_out();
    }
    
?>