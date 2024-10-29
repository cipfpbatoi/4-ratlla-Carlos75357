<div class="panel">
    <div class="player-data">
        <div class="player">
            <div class="label">Jugador 1:</div>
            <div class="name"><?= $players[1]->getName() ?></div>
            <div class="label">Color:</div>
            <div class="color"><?= $players[1]->getColor() ?></div>
            <div class="label">Puntuación:</div>
            <div class="score"><?= $scores[1] ?></div>
        </div>
        </br>
        <div class="player">
            <div class="label">Jugador 2:</div>
            <div class="name"><?= $players[2]->getName() ?></div>
            <div class="label">Color:</div>
            <div class="color"><?= $players[2]->getColor() ?></div>
            <div class="label">Puntuación:</div>
            <div class="score"><?= $scores[2] ?></div>
        </div>
    </div>
</div>
