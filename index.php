<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<br><br><br><br>

<!-- loggin formulär 
använder required för att användaren ska behöva fylla i båda fälten innan något script körs
-->
</div>
<div class="container">
<form class="form-horizontal" action="login.php" method="post">
<div class="form-group">
<h1>Logga in</h1>
	<label for="Username">Användarnamn</label>
	<input type="text" class="form-control" name="username" placeholder="Användarnamn" ><br>
	<label for="Password">Lösenord</label>
	<input type="password" class="form-control" name="password" placeholder="Lösenord" required><br><br>
	<input type="submit" class="btn btn-default" value="Logga in">
</div>
</form>
</div>
</body>
</html>