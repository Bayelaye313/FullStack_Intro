<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

require_once "connexion.php";

$product_list = array();
$product_err = "";

// Récupérer la liste des produits et leurs quantités en stock
$sql = "SELECT p.id, p.product_name, IFNULL(COALESCE(si.qte_ajout, 0) - COALESCE(so.qte_sortie, 0), 0) AS qte_en_stock
        FROM products p
        LEFT JOIN (
            SELECT product_id, SUM(qte_ajout) AS qte_ajout
            FROM stock_in
            GROUP BY product_id
        ) si ON p.id = si.product_id
        LEFT JOIN (
            SELECT product_id, SUM(qte_sortie) AS qte_sortie
            FROM stock_out
            GROUP BY product_id
        ) so ON p.id = so.product_id";
if ($result = $pdo->query($sql)) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $product_list[] = $row;
    }
} else {
    $product_err = "Erreur lors de la récupération des produits.";
}

unset($pdo);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
    <title>session - Vérifier la quantité en stock</title>
</head>
<body>
    <h2>Vérifier la quantité des produits en stock</h2>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">

                <table class="table table-success table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom du produit</th>
                            <th>Quantité en stock</th>
            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($product_list)) {
                            $counter = 1; // Compteur pour le numéro
                            foreach ($product_list as $product) {
                                echo "<tr>";
                                echo "<td>" . $counter . "</td>"; // Colonne numéro
                                echo "<td>" . $product['product_name'] . "</td>";
                                echo "<td>" . $product['qte_en_stock'] . "</td>";
                                echo "</tr>";
                                $counter++; // Augmenter le compteur
                            }
                        } else {
                            echo "<tr><td colspan='3'>Aucun produit trouvé.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <p><a href="session.php">Retour au tableau de bord</a></p>

</body>
</html>