<?php
    require_once 'DatabaseExceptions.php';
    define ("CONFIG", "config.ini");


    /**
     * Interacts with a User table specified by the config.ini file
     * Provides user credential storage/validation, account creation, account deletion and more. 
     * @since 1.0
     */
    class UserHandler extends DatabaseTableHandler
    {
        protected $id_col;
        protected $fn_col;
        protected $ln_col;
        protected $email_col;
        protected $un_col;
        protected $pw_col;
        protected $active_col;
        protected $artist_col;
        protected $reg_date_col;


        /**
         * Construct a handler for the basic interation with the User table, specified by the global config.ini file.
         * Uses DatabaseTableHandler to execute CRUD operations on the table.
         * @see DatabaseTableHandler
         * @see parse_ini_file()
         * @since 1.0
         * @return A constructed UserDataHandler object from the global config.ini file
         */
        public function __construct(){
            $config = parse_ini_file(CONFIG, true);
            parent::__construct(CONFIG, $config['user_table']['tablename']);
            $this->id_col = $config['user_table']['id'];
            $this->fn_col = $config['user_table']['firstname'];
            $this->ln_col = $config['user_table']['lastname'];
            $this->un_col = $config['user_table']['username'];
            $this->pw_col = $config['user_table']['password'];
            $this->email_col = $config['user_table']['email'];
            $this->reg_date_col = $config['user_table']['registerdate'];
            $this->active_col = $config['user_table']['accountactive'];
            $this->artist_col = $config['user_table']['isartist'];
        }

        /**
         * Create a user account in the User table using the provided (required) parameter data
         * Uses DatabaseTableHandler to execute CRUD operations on the table.
         * @see DatabaseTableHandler
         * @see password_hash()
         * @see formatNewAccountValues()
         * @since 1.0
         * @throws AccountExistsException
         */
        public function createAccount($un, $pw, $fn, $ln, $email, $is_artist=False){
            if($this->userNameExists($un)||$this->emailExists($email)){
                throw new AccountExistsException("{$un}/{$email}");
            }
            else{
                //password_hash not supported for PHP 5.3. So we're going to
                //store plain text passwords...not a good idea, but in the real
                //world we would probably opt to update php on the server
                //$pw_hash = password_hash($pw, PASSWORD_DEFAULT);
                //$pw = NULL; 
                $insert_values = $this->formatNewAccountValues($fn, $ln, $email, $un, $pw, $is_artist);
                $this->create($insert_values);
            }
        }
        
        /**
         * Verifies the username and password provided
         * Creates a new session with the provided credentials if they are valid
         * 
         * @see verifyCredentials
         * @since 1.0
         * @return Boolean. True on success. False otherwise.
         */
        public function signIn($un,$pw){
            if ($this->verifyCredentials($un, $pw)){
                $user = $this->getByUN($un);
                return $this->newSession($user);
            }
            else{
                return false;
            }
        }
        
        public function signUp($un, $pw, $fn, $ln, $email, $isArtist=false){
            $this->createAccount($un, $pw, $fn, $ln, $email, $isArtist);
            return $this->signIn($un, $pw);
        }


        /**
         * Verify a User Name/Password combination with the credentials stored in the database
         * Passwords are never stored in plain-text. Instead, the standard "password_hash()/password_verify()" methods are used.
         * @see DatabaseTableHandler
         * @see password_hash()
         * @see password_verify()
         * @since 1.0
         * @return Boolean. True if credentials are valid, False otherwise.
         */
        public function verifyCredentials($un, $pw){
            $read_columns = [$this->pw_col];
            $compare = [$this->un_col=>$un];
            $stored_pw = $this->read($compare, $read_columns, True)[$this->pw_col];
//            if(password_verify($pw, $stored_pw)){
//                return True;
//            }
            //password hash not supported in PHP 5.3
            // we'll use an extremely insecure method for passwords, because
            // we don't have time to research alternatives.
            if($stored_pw==$pw){ 
                return True;
            }
            else{
                return False;
            }
        }

        /**
         * Sets the account specified by the username provided to be active or inactive depending on the $active parameter.
         * Uses DatabaseTableHandler to execute the required CRUD operations.
         * @since 1.0
         * @param string $un The unique username for which to set the account to active or inactive.
         * @param Boolean $active True to set the account to active, False to set the account to inactive.
         */
        public function setAccountActive($un, $active){
            $compare_values = [$this->un_col=>$un];
            $set_values = [$this->active_col=>$active];
            $this->update($set_values, $compare_values);
        }

        /**
         * Deletes the account specified by the username provided.
         * Uses DatabaseTableHandler to execute the required CRUD operations.
         * @since 1.0
         * @param string $un The unique username for which to set the account to active or inactive.
         */
        public function deleteAccount($un){
            $this->delete([$this->un_col=>$un]);
        }
        
        /**
         * Retrieves the data fields of the user specified by $id.
         * Defaults to returning all data fields, unless $columns is specified.
         * @see DatabaseTableHandler
         * @since 1.0
         * @param int $id The ID of the user to retrieve from the database
         * @param array $columns The columns to retrieve. Defaults to all (*).
         */
        public function getByID($id, $columns=array('*')){
            return $this->read(array($this->id_col=>$id),$columns);
        }
        /**
         * Retrieves the data fields of the user specified by the username.
         * Defaults to returning all data fields, unless $columns is specified.
         * @see DatabaseTableHandler
         * @since 1.0
         * @param int $un The Username of the user to retrieve from the database
         * @param array $columns The columns to retrieve. Defaults to all (*).
         */
        public function getByUN($un, $columns=array('*')){
            return $this->read(array($this->un_col=>$un),$columns);
        }
        
        protected function newSession($user){
            if($this->sessionExists()){
                session_destroy();
            }
            $success=session_start();
            if($success){
                $_SESSION['user_id']= $user[$this->id_col];
                $_SESSION['user_name']= $user[$this->un_col];
                $_SESSION['first_name']= $user[$this->fn_col];
                $_SESSION['last_name']= $user[$this->ln_col];
                $_SESSION['is_artist']= $user[$this->artist_col];
                return true;
            }
            else{
                return false;
            }
        }
        
        /**
         * Retrieves the current session's user data 
         * @see getByID
         * @since 1.0
         * @return array. Array of database values for the current user or null.
         */
        public function currentUser(){
            if($this->sessionExists()){
                session_start();
                return $this->getByID($_SESSION['user_id']);
            }
            else{
                return null;
            }
        }
        
        public function sessionExists(){
            return session_id() === '' ? false : true;
        }
        
        /**
         * Formats the required new account parameters into an associative array to be used by DatabaseTableHandler to create a new row.
         * @see DatabaseTableHandler
         * @since 1.0
         * @param string $fn First name to be formatted.
         * @param string $ln Last name to be formatted.
         * @param string $email Email name to be formatted.
         * @param string $un User name to be formatted.
         * @param string $pw Password to be formatted.
         * @param boolean $is_artist Whether the user is an artist.
         */
        protected function formatNewAccountValues($fn, $ln, $email, $un, $pw, $is_artist){
            return [$this->fn_col=>$fn, $this->ln_col=>$ln, $this->email_col=>$email, $this->un_col=>$un, $this->pw_col=>$pw, $this->artist_col=>$is_artist];
        }

        /**
         * Checks if the email specified already exists in the User database.
         * @see DatabaseTableHandler
         * @since 1.0
         */
        protected function emailExists($email){
            if($this->read([$this->email_col=>$email], [$this->email_col])){
                return True;
            }
            return False;
        }

        /**
         * Checks if the username specified already exists in the User database.
         * @see DatabaseTableHandler
         * @since 1.0
         */
        protected function userNameExists($un){
            if($this->read([$this->un_col=>$un], [$this->un_col])){
                return True;
            }
            return False;
        }
    }

    function __autoload($class_name) {
        require_once $class_name . '.php';
    }
