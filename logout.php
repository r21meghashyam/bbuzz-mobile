<?php
require('response.php');
unset($_SESSION['id']);
respond(['changePage'=>'/']);
?>