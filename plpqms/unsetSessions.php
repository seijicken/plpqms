<?php
session_start();
            $_SESSION = NULL;
            $_SESSION = [];
            session_unset();
            session_destroy();
            header("Location: forgotPass.php")
           
            ?>