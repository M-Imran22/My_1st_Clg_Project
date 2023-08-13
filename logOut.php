<?php
session_start();
unset($_SESSION["profile_data"]);
header("Location: http://127.0.0.1/modified_project/login.php");
