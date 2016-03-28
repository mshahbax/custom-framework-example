<?php

/**
 * Handling database connection
 *
 * @author Muhammad Shahbaz <mohammadshahbax@mail.com>
 * 
 */
abstract class DbConnect {

    protected static $conn = NULL;

    /**
     * Returns the PDO Adapter object
     * 
     * @return Mysqli Object
     */
    function getConnection()
    {
        if (self::$conn == NUll) {
            self::$conn = $this->connect();
        }
        return self::$conn;
    }

    /**
     * Establishing database connection
     * @return database connection handler
     */
    function connect()
    {
        include_once dirname(__FILE__) . '/DBConfig.php';

        try {
            $db_username = DB_USERNAME;
            $db_password = DB_PASSWORD;
            $db_host = DB_HOST;
            $db_name = DB_NAME;
            self::$conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

        // returing connection resource
        return self::$conn;
    }

    /**
     * 
     * @param type $table Datbase table name
     * @param type $data Dataset to save in database table
     * @return boolean returns the rows inserted or false 
     */
    function save($table, $data)
    {
        $bindArray = array();
        foreach ($data as $field_name => $field_value) {
            $fields[] = $field_name;
            $fieldsHolders[] = ":$field_name";
            $bindArray[":$field_name"] = $field_value;
        }
        $fields = implode(",", $fields);
        $fieldsHolders = implode(",", $fieldsHolders);

        $query = "INSERT INTO $table  ($fields) VALUES ($fieldsHolders)";
        $statement = $this->getConnection()->prepare($query);
        try {
            if ($statement->execute($bindArray)) {
                return $this->getConnection()->lastInsertId();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * 
     * @param type $table Datbase table name
     * @param type $data Dataset to save in database table
     * @param type $where condition to update in database table
     * @return boolean returns the rows inserted or false 
     */
    function update($table, $data, $where = "", $bindParams = array())
    {
        foreach ($data as $field_name => $field_value) {
            $fields[] = "$field_name = :$field_name";
            $bindParams[":$field_name"] = isset($bindParams[":$field_name"]) ? $bindParams[":$field_name"] : $field_value;
        }

        $fields = implode(",", $fields);

        $query = "UPDATE " . $table . " SET " . $fields . " WHERE " . $where;
        try {
            $statement = $this->getConnection()->prepare($query);
            return !empty($bindParams) ? $statement->execute($bindParams) : $statement->execute();
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * 
     * @param type $table Database table name
     * @param type $where condition to delete record(s)
     * @return boolean returns the rows inserted or false
     */
    function delete($table, $where, $bindParams = array())
    {
        $query = "DELETE FROM " . $table . " WHERE " . $where;
        try {
            $statement = $this->getConnection()->prepare($query);
            return !empty($bindParams) ? $statement->execute($bindParams) : $statement->execute();
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * 
     * @param type $table Database table name
     * @param type $where condition to count record(s)
     * @return boolean returns the rows inserted or false
     */
    function countRows($table, $where, $bindParams = array())
    {
        $query = "SELECT count(*) FROM " . $table . " WHERE " . $where;
        try {
            $statement = $this->getConnection()->prepare($query);
            $execute = !empty($bindParams) ? $statement->execute($bindParams) : $statement->execute();
            if ($execute) {
                return $statement->fetchColumn();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * 
     * @param type $query Query string to execute in database
     * @return type returns the query insertion status
     */
    public function runQuery($query, $bindParams = array())
    {
        try {
            $statement = $this->getConnection()->prepare($query);
            return !empty($bindParams) ? $statement->execute($bindParams) : $statement->execute();
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    public function getRow($query, $bindParams = array())
    {
        try {
            $statement = $this->getConnection()->prepare($query);
            !empty($bindParams) ? $statement->execute($bindParams) : $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    public function getAll($query, $bindParams = array())
    {
        try {
            $statement = $this->getConnection()->prepare($query);
            !empty($bindParams) ? $statement->execute($bindParams) : $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}
