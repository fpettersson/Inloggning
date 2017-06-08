<?php 
//startar session som ska hålla reda på vem som loggar in
session_start();

include 'db.php';

// använder filter_input för att filtrera bort specialtecken som kan användas vid sql injections

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

// object gör en anslutning till servern med hjälp utav db.php som parametrar
$connect = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($connect->connect_error) die($connect->connect_error);

// php query som kollar om användarnamnet och lösenordet finns med i databasen 
$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($connect, $query);
//finns det inte med så printas det ut en text som berättar för användaren att det angivna lösenordet/användarnamnet inte är korrekt
if (!$row = mysqli_fetch_assoc($result)) {
	echo "Wrong username or password!";
} // annars skapas en session variabel som håller reda på vem som är inloggad och man skickas vidare till 'Home'-sidan
else {
	$_SESSION['id'] = $row['id'];
	header("Location: Home.php");
}
?>	