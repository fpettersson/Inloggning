<?php 
//startar session som ska hålla reda på vem som loggar in
session_start();

// inkluderar information om databas
include 'db.php';

// object som gör en anslutning till servern med hjälp utav db.php som parametrar
$connect = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($connect->connect_error) die($connect->connect_error);

// använder filter_input för att filtrera bort specialtecken som kan användas vid sql injections
// hämtar 'username' och 'password' som användaren skrivit in i formuläret i index.php vilket är namnet på fälten
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

// query som hämtar data där användarnamnet är det som användaren skrev in
$sql = "SELECT * FROM users WHERE name ='$username'";
// kör query
$result = mysqli_query($connect, $sql);
// sparar resultatet i $row
$row = mysqli_fetch_assoc($result);
// lägger lösenordet från raden i $pwdhash
$pwdhash = $row['password'];
// kollar om det lösenord som användaren skrivit in matchar med det som finns i databasen
$hash = password_verify($password, $pwdhash);

//matchar det inte med det i databasen så printas det ut en text som berättar för användaren att det angivna lösenordet/användarnamnet inte är korrekt
if ($hash == 0) {
	echo "Användarnamnet och lösenordet matchar inte!";
} else {

// php query som kollar om användarnamnet och lösenordet matchar med det i databasen 
$query = "SELECT * FROM users WHERE name = '$username' AND password = '$pwdhash'";
$result = mysqli_query($connect, $query);

 // om uppgifterna matchar skapas en session variabel som håller reda på vem som är inloggad och man skickas vidare till 'Home'-sidan
	$_SESSION['namn'] = $row['name'];
	header("Location: Home.php");
	}

?>	