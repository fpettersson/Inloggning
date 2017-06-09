<?php 
//startar session som ska hålla reda på vem som loggar in
session_start();

// inkluderar information om databas
include 'db.php';

// object som gör en anslutning till servern med hjälp utav db.php som parametrar
$connect = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($connect->connect_error) die($connect->connect_error);

// använder mysqli_real_escape_string för att filtrera bort specialtecken som kan användas vid sql injections
// hämtar 'username' och 'password' som användaren skrivit in i formuläret i index.php vilket är namnet på fälten
$uid = mysqli_real_escape_string($connect, $_POST['username']);
$pwd = mysqli_real_escape_string($connect, $_POST['password']);

// query som hämtar data där användarnamnet är det som användaren skrev in, förbereder query
$stmt = $connect->prepare("SELECT * FROM users WHERE name=?");

// binder ? till username som ska vara en sträng (s)
$stmt->bind_param("s", $username);

$username = $uid;
$password = $pwd;
// kör query
$stmt->execute();

// hämtar resultatet
$result = $stmt->get_result();

// sparar resultatet i $row
$row = mysqli_fetch_assoc($result);

// lägger lösenordet från raden i $pwdhash
$pwdhash = $row['password'];

// jämför det lösenord som användaren skrivit in och kollar om det matchar med det som finns i databasen
$hash = password_verify($password, $pwdhash);

// matchar det inte med det i databasen så printas det ut en text som berättar för användaren att det angivna lösenordet/användarnamnet inte är korrekt
if ($hash == 0) {
	echo "Användarnamnet och lösenordet matchar inte!";
} else {

// php query som kollar om användarnamnet och lösenordet matchar med det i databasen 
$stmt = $connect->prepare("SELECT * FROM users WHERE name = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);

$username = $uid;
$password = $pwdhash;
$stmt->execute();

$result = $stmt->get_result();
	
	if (!$row = mysqli_fetch_assoc($result)) {
		echo "Användarnamnet och lösenordet matchar inte!";
	} else {
		// om uppgifterna matchar skapas en session variabel som håller reda på vem som är inloggad och man skickas vidare till 'Home'-sidan
	$_SESSION['namn'] = $row['name'];
	header("Location: Home.php");
	}

}

?>	