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
        // Récupérer l'ID du produit s'il existe déjà
        $stmt_get_product_id = $pdo->prepare("SELECT id, quantity FROM products WHERE product_name = :product_name");
        $stmt_get_product_id->bindParam(":product_name", $product_name, PDO::PARAM_STR);
        
        if ($stmt_get_product_id->execute()) {
            $product = $stmt_get_product_id->fetch(PDO::FETCH_ASSOC);

            if ($product) {
                // Mise à jour de la quantité dans la table stock_in
                $stmt_update_stock_in = $pdo->prepare("INSERT INTO stock_in (product_id, qte_ajout, date_ajout) 
                                                      VALUES (:product_id, :qte_ajout, NOW())
                                                      ON DUPLICATE KEY UPDATE qte_ajout = qte_ajout + :qte_ajout");
                $stmt_update_stock_in->bindParam(":product_id", $product['id'], PDO::PARAM_INT);
                $stmt_update_stock_in->bindParam(":qte_ajout", $quantity, PDO::PARAM_INT);
                
                if ($stmt_update_stock_in->execute()) {
                    header("Location: add_product.php");
                } else {
                    echo "Oops!  Veuillez réessayer plus tard.";
                }
            } else {
                // Ajouter un nouveau produit dans la table products
                $stmt_add_product = $pdo->prepare("INSERT INTO products (product_name, quantity) VALUES (:product_name, :quantity)");
                $stmt_add_product->bindParam(":product_name", $product_name, PDO::PARAM_STR);
                $stmt_add_product->bindParam(":quantity", $quantity, PDO::PARAM_INT);

                if ($stmt_add_product->execute()) {
                    $product_id = $pdo->lastInsertId();
                    
                    // Ajouter une entrée dans la table stock_in
                    $stmt_add_stock_in = $pdo->prepare("INSERT INTO stock_in (product_id, qte_ajout, date_ajout) VALUES (:product_id, :qte_ajout, NOW())");
                    $stmt_add_stock_in->bindParam(":product_id", $product_id, PDO::PARAM_INT);
                    $stmt_add_stock_in->bindParam(":qte_ajout", $quantity, PDO::PARAM_INT);
                    
                    if ($stmt_add_stock_in->execute()) {
                        header("Location: add_product.php");
                    } else {
                        echo "Oops!  Veuillez réessayer plus tard.";
                    }
                } else {
                    echo "Oops!  Veuillez réessayer plus tard.";
                }
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
    <title>Enregistrer un Produit</title>
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
</head>
<body>
    <h2>Enregistrer un Produit</h2>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">

                <form action="add_product.php" method="post">
                    <div class="mb-3">
                        <label for="txt" class="label-form">Nom du Produit</label>
                        <input type="text" name="product_name" class="form-control">
                        <span><?php echo $product_name_err; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="txt2" class="label-form">Quantité</label>
                        <input type="text" name="quantity" id="txt2" class="form-control">
                        <span><?php echo $quantity_err; ?></span>
                    </div>
                    <div>
                        <input type="submit" value="Enregistrer" role="button" class="btn-outline-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
        <p class="m-2"><a href="session.php">Retour au Tableau de Bord</a></p>
</body>
</html>