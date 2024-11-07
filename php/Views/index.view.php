<!DOCTYPE html>
<html lang="ca">
<head>
    <link rel="stylesheet" href="4ratlla.css?v=<?php echo time(); ?>">
    <title>4 en ratlla</title>
    <style>
        .player1 {
            background-color: <?= $players[1]->getColor() ?>; /* Color per un dels jugadors */
        }

        .player2 {
            background-color: <?= $players[2]->getColor() ?>; /* Color per l'altre jugador */
        }
    </style>
</head>
<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/../Views/partials/error.view.php'; ?>
    
    <div class="game-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <?php include_once $_SERVER['DOCUMENT_ROOT'].'/../Views/partials/board.view.php'; ?>
            <input type="submit" class="btnSubmit" name="reset" value="Reiniciar joc">
            <input type="submit" class="btnSubmit" name="exit" value="Acabar joc">
            <input type="submit" class="btnSubmit" name="save" value="Guardar partida" <?php $winner != null ? 'disabled' : ''; ?>>
            <input type="submit" class="btnSubmit" name="restore" value="Cargar partida">
            <!-- <input type="submit" class="btnSubmit" name="help" value="Ajuda"> -->
        </form>

        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/../Views/partials/panel.view.php'; ?>
    </div>
</body>
</html>
