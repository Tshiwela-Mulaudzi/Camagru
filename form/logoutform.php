<?php
include('credentials.php');
        
session_unset();
session_destroy;
header("location: ../index0.php");
?>