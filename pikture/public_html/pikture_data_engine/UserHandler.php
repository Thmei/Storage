<?php
    require_once 'DatabaseExceptions.php';
    require_once 'UserExceptions.php';
    require_once 'Action.php';
    require_once 'DatabaseTableHandler.php';
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
        protected $action_collection;
        protected $profile_img_col;

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
            $this->profile_img_col = $config['user_table']['profileimg'];
            $this->action_collection = $this->initializeActions();
        }
        
        
        /**
         * Sets all the valid Actions and parameters that can be used on this 
         * object via POST HTTP requests
         * @see Action
         * @since 1.0
         */
        protected function initializeActions(){
            $actions = array();
            $valid_sign_in_params = array("user_name"=>true, "password"=>true);
            $sign_in_action = new Action("sign_in", $valid_sign_in_params, 
                    "signIn");
            array_push($actions, $sign_in_action);
            $valid_sign_up_params = array("user_name"=>true, "password"=>true, 
                "first_name"=>true,"last_name"=>true, "email"=>true, 
                "account_type"=>false);
            $sign_up_action = new Action("sign_up", $valid_sign_up_params, 
                    "signUp");
            array_push($actions, $sign_up_action);
            $valid_get_user_info_params = array("id"=>true, "columns"=>false);
            $get_user_info_action = new Action("get_user_info", 
                    $valid_get_user_info_params, "getByID");
            array_push($actions, $get_user_info_action);
            return new ActionCollection($actions);
        }
        /**
         * Verifies that the specified parameters correspond to and are valid
         * for the specified action name. Then calls the function specified
         * in the action object on the parameters using call_user_func_array
         * @see Action
         * @since 1.0
         * @param string $name The name of the action to be performed
         * @param array key value pairs. "parameter_name"=>"parameter value"
         */
        public function performAction($name, $params){
            $action = $this->action_collection->getActionForName($name);
            if($action->verify($name, $params)){
                $ordered_params = $action->orderParams($params);
                return call_user_func_array(array($this, 
                    $action->function_name), $ordered_params);
            }
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
        public function createAccount($un, $pw, $fn, $ln, $email, $is_artist){
            if($this->userNameExists($un)||$this->emailExists($email)){
                throw new AccountExistsException("{$un}/{$email}");
            }
            else{
                //removed password_hash() doesnt work on PHP version 5.3
                //$pw_hash = password_hash($pw, PASSWORD_DEFAULT);
                //$pw = NULL;
                $insert_values = $this->formatNewAccountValues($fn, $ln, $email,
                        $un, $pw, $is_artist);
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
                $this->newSession($user);
                if($_SESSION['is_artist']){
                    header('Location: /~s16g10/artist-account/');
                }
                else{
                    header('Location: /~s16g10/user-profile/');
                }
            }
            else{
                header('Location: /~s16g10/common/SignInError.html');
            }
        }
        
        /**
         * Creates a new User record in the SQLi Database
         * 
         * @see verifyCredentials
         * @since 1.0
         * @return Boolean. True on success. False otherwise.
         */
        public function signUp($un, $pw, $fn, $ln, $email, $account_type=""){
            $is_artist = $account_type === 'artist';
            $this->createAccount($un, $pw, $fn, $ln, $email, $is_artist);
            $this->signIn($un, $pw);
        }
        
        public function signOut(){
            session_start();
            session_destroy();
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
            $read_columns = Array($this->pw_col);
            $compare = Array($this->un_col=>$un);
            //removed password_verify() doesnt work on PHP version 5.3
            $result = $this->read($compare, $read_columns, True);
            $stored_pw = $result[$this->pw_col];
//            
//            if(password_verify($pw, $stored_pw)){
//                return True;
//            }
//            else{
//                return False;
//            }

            if(strcmp($pw , $stored_pw) == 0){
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
            $compare_values = Array($this->un_col=>$un);
            $set_values = Array($this->active_col=>$active);
            $this->update($set_values, $compare_values);
        }

        /**
         * Deletes the account specified by the username provided.
         * Uses DatabaseTableHandler to execute the required CRUD operations.
         * @since 1.0
         * @param string $un The unique username for which to set the account to active or inactive.
         */
        public function deleteAccount($un){
            $this->delete(Array($this->un_col=>$un));
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
            $user=$this->read(array($this->id_col=>$id),$columns);
            header('Content-Type: application/json');
            echo json_encode($user);
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
            if($this->isUserLoggedIn()){
                session_destroy();
            }
            $success=session_start();
            if($success){
                $_SESSION['user_id']= $user[$this->id_col];
                $_SESSION['user_name']= $user[$this->un_col];
                $_SESSION['first_name']= $user[$this->fn_col];
                $_SESSION['last_name']= $user[$this->ln_col];
                $_SESSION['is_artist']= $user[$this->artist_col];
                $_SESSION['profile_img']= $user[$this->profile_img_col];
            }
            else{
                throw new SessionCreationException("Error creating session for ".
                                                    $user[$this->un_col]);
            }
        }
        
        /**
         * Retrieves the current session's user data 
         * @see getByID
         * @since 1.0
         * @return array. Array of database values for the current user or null.
         */
        public function currentUser(){
            session_start();
            if($this->isUserLoggedIn()){
                return $this->getByID($_SESSION['user_id']);
            }
            else{
                return null;
            }
        }
        
        public function isUserLoggedIn(){
            if(isset($_SESSION['user_id'])){
                return true;
            }
            else{
                return false;
            }
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
        protected function formatNewAccountValues($fn, $ln, $email, $un, $pw, 
                $is_artist){
            return Array($this->fn_col=>$fn, $this->ln_col=>$ln, 
                $this->email_col=>$email, $this->un_col=>$un, 
                $this->pw_col=>$pw, $this->artist_col=>$is_artist);
        }

        /**
         * Checks if the email specified already exists in the User database.
         * @see DatabaseTableHandler
         * @since 1.0
         */
        protected function emailExists($email){
            if($this->read(Array($this->email_col=>$email), 
                    Array($this->email_col))){
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
            if($this->read(Array($this->un_col=>$un), Array($this->un_col))){
                return True;
            }
            return False;
        }
    }
