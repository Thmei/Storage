<?php
    require_once 'DatabaseExceptions.php';
    /**
     * Utility class for creating and binding dynamic prepared statements for an atomic MySQL table
     * This class provides all basic CRUD operations through the use of MySQL prepared statements. 
     * Each CRUD method returns an prepared and database-bound statement ready to be executed by the user of this class.
     * @since 1.0
     */
    class PreparedStatementGenerator{

        public $table_name;
        public $conn;

        public function __construct($table_name, $conn){
            $this->table_name=$table_name;
            $this->conn=$conn;
        }


        /**
         * Constructs and binds a valid INSERT Prepared Statement from the values specified.
         * @see prepare()
         * @see paramType()
         * @see mysqli@prepare()
         * @since 1.0
         * @param array $values Associative array of column=>value pairs to be inserted.
         * @return mysqli_stmt. A mysqli prepared statement for inserting the specified values into the table.
         */
        public function prepareCreate($values){
            $param_types="";
            $insert_statement = "INSERT INTO ".$this->table_name."(";
            $value_statement = "VALUES(";

            foreach ($values as $column_name => $column_value){
                $param_types .= $this->paramType($column_value);
                $insert_statement .= $column_name.',';
                $value_statement .= "?".',';
            }
            $insert_statement = rtrim($insert_statement, ',').') ';
            $value_statement = rtrim($value_statement, ',').')';
            $sql = $insert_statement.$value_statement;
            $values = array_values($values);
            $stmt = $this->prepare($sql, $values, $param_types);
            return $stmt;
        }

        /**
         * Constructs and binds a valid SELECT-FROM-WHERE Prepared Statement from the values and column
         * @see prepareWhere()
         *
         * @param array $compare_values Associative array of column=>value pairs to be compared.
         * @param array $columns Read only the specifie
         * @return mysqli_stmt. A mysqli prepared statement for reading the specified values from the table.
         */
        public function prepareRead($compare_values, $columns){
            $select_statement = "SELECT ";
            $from_statement = "FROM ".$this->table_name.' ';
            list($where_statement, $param_types) = $this->prepareWhere($compare_values);
            foreach ($columns as $column_name){
                $select_statement .= $column_name.',';
            }
            $select_statement = rtrim($select_statement, ',').' ';

            $sql = $select_statement.$from_statement.$where_statement;
            $values = array_values($compare_values);
            $stmt = $this->prepare($sql, $values, $param_types);
            return $stmt;
        }

        public function prepareSearch($col_search, $col_return){
            $select_statement = "SELECT ";
            $from_statement = "FROM ".$this->table_name.' ';
            list($where_statement, $param_types) = $this->prepareWhere($col_search, True);
            foreach ($col_return as $column_name){
                $select_statement .= $column_name.',';
            }
            $select_statement = rtrim($select_statement, ',').' ';

            $sql = $select_statement.$from_statement.$where_statement;
            $values = array_values($col_search);
            $stmt = $this->prepare($sql, $values, $param_types);
            return $stmt;
        }

        /**
         * Constructs and binds a valid UPDATE-SET-WHERE Prepared Statement from the compare_values and set_values specified
         * @see prepareWhere()
         * @since 1.0
         * @param array $set_values Associative array of column=>value pairs to set.
         * @param array $compare_values Associative array of column=>value pairs to compare.
         * @return mysqli_stmt. A mysqli prepared statement for updating the specified values in the table.
         */
        public function prepareUpdate($set_values, $compare_values){
            $update_statement = "UPDATE ".$this->table_name.' ';
            $set_statement = "SET ";
            $param_types = "";
            foreach ($set_values as $column_name => $column_value){
                $param_types .= $this->paramType($column_value);
                $set_statement .= $column_name.'='."?,";
            }
            list($where_statement, $where_param_types)  = $this->prepareWhere($compare_values);
            $param_types .= $where_param_types;
            $set_statement = rtrim($set_statement, ",").' ';
            $sql = $update_statement.$set_statement.$where_statement;
            $values = array_merge(array_values($set_values), array_values($compare_values));
            $stmt = $this->prepare($sql, $values, $param_types);
            return $stmt;
        }

        /**
         * Constructs and binds a valid DELETE-FROM-WHERE SQL statement from the compare_values specified.
         * @see prepareWhere()
         * @since 1.0
         * @param array $compare_values Associative array of column=>value for whom the rows should be deleted.
         * @return mysqli_stmt. A mysqli prepared statement for deleting the specified values from the table.
         */
        public function prepareDelete($compare_values){
            $delete_statement = "DELETE FROM ".$this->table_name.' ';
            list($where_statement, $param_types) = $this->prepareWhere($compare_values);
            $sql = $delete_statement.$where_statement;
            $values = array_values($compare_values);
            $stmt = $this->prepare($sql, $values, $param_types);
            return $stmt;
        }

        /**
         * Constructs a valid WHERE statement to be used in a prepared statement from the compare_values specified
         * Uses typical '?' wildcards in the place of values
         * @since 1.0
         * @param array $compare_values Associative array of column names and values to use in WHERE statement.
         * @throws {DatabaseResourceException}
         * @return array. Two values: 1. the where statement, and 2. the string of param types for the prepared statement
         */
        protected function prepareWhere($compare_values, $logical_like=False){
            $logical_stmt="=";
            if($logical_like){
                $logical_stmt=" LIKE ";
            }
            $where_statement = "WHERE ";
            $param_types = "";
            foreach ($compare_values as $column_name => $column_value){
                $param_types .= $this->paramType($column_value);
                if($logical_like){
                    $where_statement .= $column_name." LIKE CONCAT('%', ?, '%') OR ";
                }
                else{
                    $where_statement .= $column_name."=? AND ";
                }
            }
            if($logical_like){
                $where_statement = rtrim($where_statement, " OR ").';';
            }
            else{
                $where_statement = rtrim($where_statement, " AND ").';';
            }
            
            return array($where_statement, $param_types);
        }

        /**
         * Retrieves the mysqli formatted param type string. i.e 's'=string, 'd'=double, 'i'=int
         * @since 1.0
         * @param Any type. The value for whom the type should be checked.
         * @return string. A single character representing the type of the the value specified. Defaults to 's'.
         */
        protected function paramType($value){
            if (is_string($value)){
                return 's'; 
            }
            else if(is_int($value)){
                return 'i';
            }
            else if (is_float($value)){
                return 'd';
            }
            else{
                return 's';
            }
        }

        /**
         * Dynamically prepares a mysqli prepared statement
         * @since 1.0
         * @param sql. The sql to be prepared. The sql should include the typical '?' wildcard syntax for values
         * @param array @values. The values to be bound to the prepared statement in place of the '?' wildcards 
         * @return mysqli_stmt. A prepared statement that is bound to the mysql server.
         */
        protected function prepare($sql, $values, $param_types){
            $params = array();
            $params [] = & $param_types;
            $num_values = count ($values);
            for($i = 0; $i < $num_values; $i++) {
                $params[] = & $values[$i];
            }
            $stmt = $this->conn->prepare($sql);

            if ($stmt) {
                call_user_func_array(array($stmt, 'bind_param'), $params);
                return $stmt;
            }
            else{
                throw new PreparedStatementException($this->conn->error);
                return;
            }
        }
    }
?>
