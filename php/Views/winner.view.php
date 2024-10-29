<html>
<head>
    <link rel="stylesheet" href="4ratlla.css?v=<?php echo time(); ?>">
    <title>4 en ratlla</title>
    <style>
        .player1 {
            background-color: <?= $players[1]->getColor() ?> ;
        }
        .player2 {
            background-color:  <?= $players[2]->getColor() ?>;
        }

    </style>
</head>
<body>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/../Views/partials/board.view.php'  ?>
<div>

        <h1>Guanyador: Jugador <?= $winner->getName() ?></h1>

</div>
</body>
</html>