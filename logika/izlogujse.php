<?php
//delete session item 
session_start();
session_destroy();
header("Location: ../prijava.php");


