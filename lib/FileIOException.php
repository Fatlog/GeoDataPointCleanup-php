<?
/**
 * Custom Exception for handling issues related to File IO.
 */
class FileIOException extends Exception
{
    /**
	 * Redefine the exception so message isn't optional.
	 */
    public function __construct($message, $code = 0, Exception $previous = null) {
        // Call parent constructor
        parent::__construct($message, $code, $previous);
    }

    /**
	 * Custom string representation of object.
	 */
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
?>