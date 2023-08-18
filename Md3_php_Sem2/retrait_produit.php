<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

require_once "connexion.php";

$product_name = $quantity = "";
$product_name_err = $quantity_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["product_name"]))) {
        $product_name_err = "Veuillez entrer le nom du produit.";
    } else {
        $product_name = trim($_POST["product_name"]);
    }

    if (empty(trim($_POST["quantity"]))) {
        $quantity_err = "Veuillez entrer la quantité.";
    } else {
        $quantity = trim($_POST["quantity"]);
    }

    if (empty($product_name_err) && empty($quantity_err)) {
        // Récupérer l'ID du produit
        $stmt_get_product_id = $pdo->prepare("SELECT id, quantity FROM products WHERE product_name = :product_name");
        $stmt_get_product_id->bindParam(":product_name", $product_name, PDO::PARAM_STR);
        
        if ($stmt_get_product_id->execute()) {
            $product = $stmt_get_product_id->fetch(PDO::FETCH_ASSOC);

            if ($product) {
                $available_quantity = $product['quantity'];
                
                if ($quantity <= $available_quantity) {
                    // Effectuer l'enregistrement de la sortie de stock
                    $stmt = $pdo->prepare("INSERT INTO stock_out (product_id, qte_sortie, date_sortie) VALUES (:product_id, :qte_sortie, NOW())");
                    
                    // Lier les valeurs des paramètres
                    $stmt->bindParam(":product_id", $product['id'], PDO::PARAM_INT);
                    $stmt->bindParam(":qte_sortie", $quantity, PDO::PARAM_INT);

                    if ($stmt->execute()) {
                        header("Location: retrait_produit.php");
                    } else {
                        echo "Oops!  Veuillez réessayer plus tard.";
                    }
                } else {
                    $quantity_err = "La quantité demandée dépasse la quantité disponible en stock.";
                }
            } else {
                $product_name_err = "Aucun produit trouvé avec ce nom.";
            }
        } else {
            echo "Oops!  Veuillez réessayer plus tard.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enregistrer les Produits Pris</title>
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
</head>
<body>
    <h2 >Enregistrer les Produits Pris:</h2>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <form action="retrait_produit.php" method="post">
                    <div class="mb-3">
                        <label for="txt3" class="form-label">Nom du Produit:</label>
                        <input type="text" name="product_name" id="txt3" class="form-control">
                        <span ><?php echo $product_name_err; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="txt4" class="form-label">Quantité:</label>
                        <input type="text" name="quantity" id="txt4" class="form-control">
                        <span><?php echo $quantity_err; ?></span>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Enregistrer" role="button" class="btn-outline-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <p class="m-2"><a href="session.php">Retour au Tableau de Bord</a></p>
</body>
</html>