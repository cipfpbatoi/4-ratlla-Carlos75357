<?php

namespace Joc4enRatlla\Services;

/**
 * Class Service
 * @package Joc4enRatlla\Services
 */
class Service
{
    /**
     * Carga una vista
     * @param string $view nombre de la vista a cargar
     * @param array $data datos a pasar a la vista
     * @return void
     */
    public static function loadView($view, $data = [])
    {
        $viewPath = str_replace('.', '/', $view);
        extract($data);

        include  $_SERVER['DOCUMENT_ROOT'] . "/../Views/$viewPath.view.php";

    }
}
