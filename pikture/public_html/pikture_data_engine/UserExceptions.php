<?php

/**
 * Exception class to be used in the event that a session creation fails
 * @since 1.0
 */
class SessionCreationException extends Exception{

    public function __construct($msg, $code = 0, Exception $previous = null){
        parent::__construct($msg, $code, $previous);
    }

    public function __toString(){
        return __CLASS__.": [$this->code]: [$this->message]\n";
    }

}

