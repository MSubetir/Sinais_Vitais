<?php
    session_start();

    function isLoggedIn() {
        if (isset($_SESSION['idAccess'])) {
            return true;
        } else {
            return false;
        }
    }
