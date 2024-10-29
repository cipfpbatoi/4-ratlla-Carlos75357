<?php

namespace Joc4enRatlla\Services;

use Monolog\Logger as MonologLogger;
use Monolog\Handler\StreamHandler;

/**
 * Logger service for managing logging operations.
 */
class Logger
{
    private static ?MonologLogger $instance = null;

    /**
     * Private constructor to prevent direct instantiation.
     */
    private function __construct() {}

    /**
     * Get the logger instance.
     *
     * @return MonologLogger
     */
    public static function getLogger(): MonologLogger {
        if (self::$instance === null) {
            self::$instance = new MonologLogger('game_logger');
            self::$instance->pushHandler(new StreamHandler(__DIR__ . '/../../logs/game.log', MonologLogger::INFO));
            self::$instance->pushHandler(new StreamHandler(__DIR__ . '/../../logs/error.log', MonologLogger::ERROR));
        }
        return self::$instance;
    }
}

