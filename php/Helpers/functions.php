<?php

/**
 * Carga una vista
 *
 * @param string $view nombre de la vista a cargar
 * @param array $data datos a pasar a la vista
 * @return void
 */
function loadView($view, $data = [])
{
    Joc4enRatlla\Services\Service::loadView($view, $data);
}

/**
 * Muere el programa mostrando informacion de depuracion
 *
 * @param mixed $data datos a mostrar
 * @return void
 */
function dd(...$data)
{
    echo "<pre>";
    foreach ($data as $d) {
        var_dump($d);
    }

    echo "</pre>";
    die();
}
