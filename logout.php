<?php
session_start();
unset($_SESSION['email1']);
session_destroy();
session_write_close();
header('Location: indexlog.html');
die;
?>