<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecció de jugador i color de fitxes</title>
    <link rel="stylesheet" href="jugador.css?v=<?php echo time(); ?>">
</head>
<body>

    <h1>Configuració del Joc</h1>

    <form action="/index.php" method="POST">
        <fieldset>
            <legend>Dades del jugador</legend>
            
            <label for="name">Nom del jugador:</label>
            <input type="text" id="name" name="name" placeholder="Escriu el teu nom" required>

            <div class="color-options">
                <p>Tria el color de les fitxes:</p>
                <?php
                $colors = [
                    'red',
                    'blue',
                    'yellow',
                    'green',
                    'purple',
                    'orange',
                    'pink',
                    'brown',
                    'black',
                    'turquoise',
                    'maroon',
                    'silver',
                    'goldenrod',
                ];
                foreach ($colors as $color) : ?>
                    <label>
                        <input type="radio" name="color" value="<?= $color ?>" required>
                        <span class="color-label <?= $color ?>"></span>
                    </label>
                <?php endforeach; ?>
            </div>
        </fieldset>

        <button type="submit">Començar el joc</button>
    </form>

</body>
</html>