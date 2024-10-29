<?php 

namespace Joc4enRatlla\Exceptions;

use Joc4enRatlla\Services\Logger;

/**
 * Exception thrown when an illegal move is attempted in the game.
 */
class IllegalMoveException extends \Exception {
    /**
     * Constructs a new IllegalMoveException.
     *
     * @param string $message The exception message (default is "Illegal move").
     * @param int $code The exception code (default is 0).
     * @param \Throwable|null $previous The previous throwable used for exception chaining.
     */
    public function __construct($message = "Illegal move", $code = 0, \Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
        Logger::getLogger()->error($message);
    }
}
