<?php
session_start();
if ($_SESSION['cryptcode'] == MD5(strtoupper($_POST['code']))) {
    echo "true";
} else {
    echo "false ";
}
?>