<?php session_start(); ?>
<?php 
// kollar om det finns en session variabel, vilket skapas om man loggar in, annars blir man skickad till inloggningssidan(index.php)
if (!isset($_SESSION['namn'])) {
	header("Location: index.php");
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
	<title>Home</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<form action="logout.php">
<button class="btn btn-default">Log out</button>
</form>
<div class='jumbotron text-center'>

<?php
echo "<h1>Välkommen " . $_SESSION['namn'] . "!</h1>";
?>
</div>


</body>
</html>