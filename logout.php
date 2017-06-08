<?php 

session_start();

// avslutar alla sessioner
session_destroy();
// skickar användaren till index.php
header("Location: index.php");

?>