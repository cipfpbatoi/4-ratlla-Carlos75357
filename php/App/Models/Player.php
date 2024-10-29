<?php
namespace Joc4enRatlla\Models;


/**
 * Class Player
 * @package Joc4enRatlla\Models
 */
class Player {
    /**
     * Nom del jugador
     * @var string
     */
    private $name;

    /**
     * Color de les fitxes
     * @var string
     */
    private $color;

    /**
     * Forma de jugar (automàtica/manual)
     * @var boolean
     */
    private $isAutomatic;

    /**
     * Constructor de la classe Player
     * @param string $name Nom del jugador
     * @param string $color Color de les fitxes
     * @param boolean $isAutomatic Forma de jugar (automàtica/manual)
     */
    public function __construct( $name, $color, $isAutomatic = false) {
        $this->name = $name;
        $this->color = $color;
        $this->isAutomatic = $isAutomatic;
    } 

    /**
     * Retorna el nom del jugador
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Estableix el nom del jugador
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Retorna el color de les fitxes
     * @return string
     */
    public function getColor() {
        return $this->color;
    }

    /**
     * Estableix el color de les fitxes
     * @param string $color
     */
    public function setColor($color) {
        $this->color = $color;
    }

    /**
     * Retorna si el jugador juga de manera automàtica
     * @return boolean
     */
    public function getIsAutomatic() {
        return $this->isAutomatic;
    }

    /**
     * Estableix si el jugador juga de manera automàtica
     * @param boolean $isAutomatic
     */
    public function setIsAutomatic($isAutomatic) {
        $this->isAutomatic = $isAutomatic;
    }
}

