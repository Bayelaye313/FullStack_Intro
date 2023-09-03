<?php
session_start();

require_once "connexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Vérification si le nom d'utilisateur existe déjà
    $stmt_check = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt_check->execute([$username]);
    //recuperation resultat de la requete
    $user_existant= $stmt_check->fetch();
    if ( $user_existant) {
        $error_message = "Ce nom d'utilisateur est déjà pris. Veuillez en choisir un autre.";
    } else {
        // Insérer les données dans la base de données
        $stmt_insert = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt_insert->execute([$username, $password]);

        header("Location: login.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
</head>
<body>
    <h2 class="ms-4 text-primary">S'inscrire</h2>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <form action="inscription.php" method="post">
                    <div class="mb-3">
                        <label for="user1" class="label-form">Nom d'utilisateur:</label>
                        <input type="text" name="username" id="user1" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label for="pass1" class="label-form">Mot de passe:</label>
                        <input type="password" name="password" id="pass1" class="form-control" >
                    </div>
                        <?php if (isset($error_message)) { ?>
                            <p class="text-danger"><?php echo $error_message; ?></p>
                        <?php } ?>
                    <div class="mb-3">
                        <input type="submit" value="S'inscrire" class="btn-outline-primary">
                    </div>
                    <p >Vous avez déjà un compte? <a href="login.php">Se connecter</a></p>
                </form>
            </div>
        </div>
    </div>
            <!-- Script Bootstrap -->
            <script src="assets/js/bootstrap.bundle.min.js" ></script>

</body>
</html>
