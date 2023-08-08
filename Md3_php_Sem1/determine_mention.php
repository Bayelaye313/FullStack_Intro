<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détermination de la Mention</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Détermination de la Mention</h1>
        <form action="#" method="post">
            <label for="moy">enter moyenne:</label>
            <input type="number" inputmode="numeric" pattern="[0-20]" max="20" name="moy" id="moy">
            <button type="submit">Entrer</button>
        </form>
        <?php
        if(isset($_POST["moy"])){
            $moyenne = $_POST["moy"]; 
            $decision = $moyenne >= 10 ? "Admis" : "Éliminé";
            if ($moyenne >= 17) {
                $mention = "Excellent";
                $colorClass = "text-success";
            } elseif ($moyenne >= 16) {
                $mention = "Très Bien";
                $colorClass = "text-primary";
            } elseif ($moyenne >= 14) {
                $mention = "Bien";
                $colorClass = "text-info";
            } elseif ($moyenne >= 12) {
                $mention = "Assez Bien";
                $colorClass = "text-warning";
            } else {
                $mention = "Passable";
                $colorClass = "text-danger";
            }
        }?>
        
        <p class="mt-4">Décision: <?php echo $decision; ?></p>
        <p class="<?php echo $colorClass; ?>" style="font-size: 14px;">Mention: <?php echo $mention; ?></p>
        
    </div>

    <!-- Script Bootstrap -->
    <script src="assets/js/bootstrap.bundle.min.js" integrity="sha384-ZTVhf2n/ZGtAuZnA9xWf7CuVxUzndzBiBmQYH7MquF8Bx6EJF8eW92I5t7EyhJX" crossorigin="anonymous"></script>
</body>
</html>
