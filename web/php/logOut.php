<?php
session_start();
session_destroy();
header("Location:/kartun/web/index.php");
?>