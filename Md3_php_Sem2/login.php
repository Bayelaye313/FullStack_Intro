<?php
session_start();

require_once "connexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);

    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $user["username"];
        header("Location: session.php");
        exit;
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
</head>
<body>
    <h2 class="ms-4 text-primary">Se connecter</h2>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <form action="login.php" method="post">
                    <div class="mb-3">
                        <label for="user" class="form-label" >Nom d'utilisateur:</label>
                        <input type="text" name="username" id="user" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Mot de passe:</label>
                        <input type="password" name="password" id="pass" class="form-control" >
                    
                    </div >
                    <div class="mb-3">
                        <input type="submit" value="Se connecter" class="btn-outline-primary">
                    </div>
                    <p>Vous n'avez pas de compte? <a href="inscription.php">S'inscrire</a></p>
                </form>
            </div>
        </div>
    </div>    
        <!-- Script Bootstrap -->
        <script src="assets/js/bootstrap.bundle.min.js" ></script>
</body>
</html>
