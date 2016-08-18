<?php
/**
 * Exception class to be used in the event that a session creation fails
 * @since 1.0
 */
class RequiredParameterForActionException extends Exception{

    public function __construct($msg, $code = 0, Exception $previous = null){
        parent::__construct($msg, $code, $previous);
    }

    public function __toString(){
        return __CLASS__.": One or more required parameters were not specified: "
                . "[$this->message]\n";
    }

}

class InvalidActionException extends Exception{

    public function __construct($msg, $code = 0, Exception $previous = null){
        parent::__construct($msg, $code, $previous);
    }

    public function __toString(){
        return __CLASS__.": The action specified does not have a corresponding "
                . "handler function: [$this->message]\n";
    }

}

class InvalidParameterForActionException extends Exception{

    public function __construct($msg, $code = 0, Exception $previous = null){
        parent::__construct($msg, $code, $previous);
    }

    public function __toString(){
        return __CLASS__.": One or more parameters for the action are "
                . "invalid: [$this->message]\n";
    }

}
