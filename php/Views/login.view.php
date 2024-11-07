<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css?v=<?php echo time(); ?>">
</head>
<body>
    <form method="POST" action="index.php">
        <label for="username">Nom:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Contrasenya:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Iniciar sessió</button>
    </form>

    <? if (isset($error)): ?>
        <div class="error">
            <?= $error; ?>
        </div>
    <? endif; ?>

</body>
</html>

