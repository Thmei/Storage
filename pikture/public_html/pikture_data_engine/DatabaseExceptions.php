<?php
/**
 * Exception class to be used in the event that a database connection fails.
 * @since 1.0
 */
class DatabaseConnectionException extends Exception{

    public function __construct($msg, $code = 0, Exception $previous = null){
        parent::__construct($msg, $code, $previous);
    }

    public function __toString(){
        return __CLASS__.": [$this->code]: [$this->message]\n";
    }

}

/**
 * Exception class to be used in the event a database resource access failed
 * @since 1.0
 */
class DatabaseResourceException extends Exception{

    public function __construct($msg, $code = 0, Exception $previous = null){
        parent::__construct($msg, $code, $previous);
    }

    public function __toString(){
        return __CLASS__.": [$this->code]: [Resource access failed for $this->message]\n";
    }

}

/**
 * Exception class to be used in the event that a MySQL query failed
 * @since 1.0
 */
class MySQLQueryException extends Exception{

    public function __construct($msg, $code = 0, Exception $previous = null){
        parent::__construct($msg, $code, $previous);
    }

    public function __toString(){
        return __CLASS__.": [$this->code]: [Failed query: $this->message]\n";
    }

}

/**
 * Exception class to be used in the event that a MySQL query failed
 * @since 1.0
 */
class PreparedStatementException extends Exception{

    public function __construct($msg, $code = 0, Exception $previous = null){
        parent::__construct($msg, $code, $previous);
    }

    public function __toString(){
        return __CLASS__.": [$this->code]: [$this->message]\n";
    }

}

/**
 * Exception class to be used if an account creation fails because unique resources already exist
 * @since 1.0
 */
class AccountExistsException extends Exception{

    public function __construct($msg, $code = 0, Exception $previous = null){
        parent::__construct($msg, $code, $previous);
    }

    public function __toString(){
        return __CLASS__.": [$this->code]: [One or more data items--required to be unique--for account creation already exists in the table: $this->message]\n";
    }

}

?>
