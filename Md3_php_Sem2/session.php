<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
</head>
<body class="bg-light">
    <h1 class="ms-4 text-primary">Tableau de Bord</h1>
    <p class="ms-4 fs-3">Bienvenue, <?php echo $_SESSION["username"]; ?>!</p>

    <h2>Opérations Disponibles:</h2>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
                <div class="list-group">
                    <a class="list-group-item btn btn-primary" role="button" href="add_product.php">Enregistrer un Produit Stocké</a>
                    <a class="list-group-item btn btn-warning" role="button" href="retrait_produit.php">Enregistrer un Produit Pris</a>
                    <a class="list-group-item btn btn-success" role="button" href="quantite_stock.php">Vérifier la Quantité des Produits</a>
                </div>
             </div>
        </div>
    </div>
    <p class="m-3"><a href="logout.php">Se Déconnecter</a></p>
</body>
</html>
