<?php

require_once "DatabaseExceptions.php";
require_once 'PreparedStatementGenerator.php';
    /**
     * Base class for interacting with an Atomic MySQL Table.
     * This is a base class which provides CRUD operations with an existent Table.
     * Creation of a MySQL table is outside the scope of the intended functionality of this class.
     * @since 1.0
     */
    class DatabaseTableHandler{
        public    $table_name;
        public    $conn;
        protected $server;
        protected $user_name;
        protected $password;
        protected $db_name;
        protected $tables;
        public $stmt_generator;

        /**
         * Construct a handler for the specified MySQL table using the credentials in the configFile.
         * The database table should exist in the database profided in the Config file (.ini format).
         * @since 1.0
         * @see connect() getColumnNames()
         * @param string $configFile Config file name in .ini format Specify 'servername' 'user_name' 'password' and 'db_name'.
         * @param string $table_name Table name to use for the object's lifetime--must exist in the specified database.
         * @return DatabaseTableHandler An instance of DatabaseTableHandler.
         */
        public function __construct($configFile, $table_name){
            $config            = parse_ini_file($configFile, true);
            $this->server      = $config['database']['servername'];
            $this->user_name    = $config['database']['username'];
            $this->password    = $config['database']['password'];
            $this->db_name      = $config['database']['dbname'];
            $this->table_name   = $table_name;
            $this->connect();
            $this->column_names = $this->getColumnNames();
            $this->stmt_generator = new PreparedStatementGenerator($this->table_name, $this->conn);
        }

        /**
         * Connect to the database specified by the initial configFile argument passed to __construct().
         * @since 1.0
         * @throws {DatabaseConnectionException}
         */
        protected function connect(){
            $this->conn = new mysqli($this->server, $this->user_name, $this->password, $this->db_name);
            if ($this->conn->connect_error) {
              throw new DatabaseConnectionException($this->conn->connect_error);
            }
        }

        /**
         * Closes the connection to the database.
         * @since 1.0
         */
        public function close(){
            mysqli_close($this->conn);
        }

        /**
         * Executes the constructed and bound prepared statement.
         * The statement is passed by reference to be accessible outside of function.
         * @since 1.0
         * @param mysqli_stmt @stmt. A properly constructed and bound mysqli prepared statement.
         * @throws {PreparedStatementException}
         */
        protected function execute(&$stmt){
            if(!$stmt->execute()){
                throw new PreparedStatementException($stmt->error);
            }
        }

        /**
         * Creates a row in $this->table_name
         * First constructs and binds the required prepared statement to mysqli.
         * @see PreparedStatementGenerator
         * @since 1.0
         *
         * @param array $values {
         *     An associative array of column names and values to insert into the table.
         *
         *     @type string $rowName A row for which to insert a value.
         *     @type string $value A value to insert into $rowName
         * }
         */
        public function create($values){
            $this->validateColumns(array_keys($values));
            $stmt = $this->stmt_generator->prepareCreate($values);
            $this->execute($stmt);
            $stmt->close();
            return $this->conn->insert_id;
        }

        /**
         * Reads a row (or specified columns) from $this->table_name.
         * First constructs and binds the required prepared statement to mysqli.
         * @see PreparedStatementGenerator
         * @since 1.0
         * @param array $values {
         *     An associative array of row names and values to compare/read from the table.
         *
         *     @type string $rowName A row for which to compare a value.
         *     @type string $value A value to compare against for the SELECT-FROM-WHERE statement
         * }
         * @param array $columns Optional. Optionally read only the specified columns that result from the SELECT statement. Defaults to '*'.
         * @param Boolean $single_row Optional. Optionally read only the first result that is found. Defaults to False;
         * @return array. An associative array of results specified [empty if no results were found].
         */
        public function read($compare_values, $columns=array("*"), $single_row=True){
            $this->validateColumns(array_keys($compare_values));
            if(!$columns=='*'){
                $this->validateColumns($columns);
            }
            $stmt = $this->stmt_generator->prepareRead($compare_values, $columns);
            $this->execute($stmt);
            $results_assoc = fetch_assoc_stmt($stmt, true);
            
            //returning 
            if(empty($results_assoc))
            {return 0;}
            
            if($single_row){
                return $results_assoc[0];
            }
            else{
                return $results_assoc;
            }
        }

        /**
         * Reads a row (or specified columns) from $this->table_name using the LIKE keyword equal to the compare values specified.
         * First constructs and binds the required prepared statement to mysqli.
         * @see PreparedStatementGenerator
         * @since 1.0
         * @param array $compare_values {
         *     An associative array of row names and values to compare/read from the table.
         *
         *     @type string $rowName A row for which to compare a value.
         *     @type string $value A value to compare against for the SELECT-FROM-WHERE statement
         * }
         * @param array $columns Optional. Optionally read only the specified columns that result from the SELECT statement. Defaults to '*'.
         * @param Boolean $single_row Optional. Optionally read only the first result that is found. Defaults to False;
         * @return array. An associative array of results specified [empty if no results were found].
         */
        public function search($compare_values, $columns=array("*"), $single_row=False){
            $this->validateColumns(array_keys($compare_values));
            if(!$columns=='*'){
                $this->validateColumns($columns);
            }
            $stmt = $this->stmt_generator->prepareSearch($compare_values, $columns);
            $this->execute($stmt);
            $results_assoc = fetch_assoc_stmt($stmt, true);
            if($single_row){
                return $results_assoc[0];
            }
            else{
                return $results_assoc;
            }
        }
        
        

        /**
         * Updates the specified columns in $this->table_name with $set_values based on the $compare_values
         * First constructs and binds the required prepared statement to mysqli.
         * @see PreparedStatementGenerator
         * @since 1.0
         * @param array $set_values {
         *     An associative array of row names and values to set on rows that match the $compare_values array.
         *
         *     @type string $rowName A row for which to set a value.
         *     @type string $value A value to set for the row.
         * }
         * @param array $compare_values {
         *     An associative array of row names and values to compare.
         *     @type string $rowName A row for which to compare a value
         *     @type string $value A value to compare for the row.
         * }
         * @return int. Number of rows affected by the update.
         */
        public function update($set_values, $compare_values){
            $this->validateColumns(array_keys($set_values));
            $this->validateColumns(array_keys($compare_values));
            $stmt = $this->stmt_generator->prepareUpdate($set_values, $compare_values);
            $this->execute($stmt);
            return $stmt->affected_rows;
        }


        /**
         * Deletes the specified rows in $this->table_name based on $compare_values
         * First constructs and binds the required prepared statement to mysqli.
         * @see PreparedStatementGenerator
         * @since 1.0
         * @param array $compare_values {
         *     An associative array of row names and values to compare.
         *
         *     @type string $rowName A row for which to compare a value
         *     @type string $value A value to compare for the row.
         * }
         * @throws {MySQLQueryException}
         * @return int. Number of rows affected by the delete.
         */
        public function delete($compare_values){
            $this->validateColumns(array_keys($compare_values));
            $stmt = $this->stmt_generator->prepareDelete($compare_values);
            $this->execute($stmt);
            return $stmt->affected_rows;
        }
        /**
         * Gets the top values of the given column with max_return rows.
         * @since 1.0
         * @param string columnName to get max n values from
         * @param int max_return max number of records to return
         */
        public function getTopN($order_by_column, $max_return){
            $sql = "SELECT * FROM ".$this->table_name;
            $sql .= " ORDER BY ".$order_by_column." DESC";
            $sql .= " LIMIT ".$max_return.";";
            $sql_result = $this->conn->query($sql);
            $results = array();
            while ($data = $sql_result->fetch_assoc()){
                $results[] = $data;
            }
            return $results;
        }


        /**
         * Throws an exception if any of the specified columns are invalid.
         * @see getColumnNames()
         * @see columnExists()
         * @since 1.0
         * @throws DatabaseResourceException
         */
        protected function validateColumns($columns){
            foreach ($columns as $column){
                if (!$this->columnExists($column)){
                    throw new DatabaseResourceException($column);
                }
            }
        }

        /**
         * Check if the specified column exists in $this->column_names
         * @see getColumnNames()
         * @since 1.0
         * @return boolean. True if column exists in $this->column_names, false otherwise.
         */
        protected function columnExists($columnName){
            return in_array($columnName, $this->column_names);
        }

        /**
         * Retrieve column names that exist in $this->table_name
         * @since 1.0
         * @throws {MySQLQueryException}
         * @return An array of column name strings
         */
        protected function getColumnNames(){
            $q = $this->conn->query('DESCRIBE '.$this->table_name);
            if ($this->conn->error){
                throw new MySQLQueryException($this->conn->error);
            }
            $column_names = array();
            while($row = $q->fetch_assoc()) {
                array_push($column_names, $row['Field']);
            }
            return $column_names;
        }
    }

        /**
        * Fetches the results of a prepared statement as an array of associative
        * arrays such that each stored array is keyed by the result's column names.
        * @param stmt   Must have been successfully prepared and executed prior to calling this function
        * @param buffer Whether to buffer the result set; if true, results are freed at end of function
        * @return An array, possibly empty, containing one associative array per result row
        */
        function fetch_assoc_stmt(mysqli_stmt $stmt, $buffer = true) {
            if ($buffer) {
                $stmt->store_result();
            }
            $fields = $stmt->result_metadata()->fetch_fields();
            $args = array();
            foreach($fields AS $field) {
                $key = str_replace(' ', '_', $field->name); // space may be valid SQL, but not PHP
                $args[$key] = &$field->name; // this way the array key is also preserved
            }
            call_user_func_array(array($stmt, "bind_result"), $args);
            $results = array();
            while($stmt->fetch()) {
                $results[] = array_map("copy_value", $args);
            }
            if ($buffer) {
                $stmt->free_result();
            }
            return $results;
        }
        function copy_value($v) {
            return $v;
        }
