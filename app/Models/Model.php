<?php

namespace app\Models;

class Model
{
    private static $pdo = null;

    public function __construct()
    {
        self::connect();
    }

    protected static function selectRecords(string $table, string $columns = "*", string $where = null)
    {
        try {
            $sql = "SELECT $columns FROM $table";

            if ($where !== null) {
                $sql .= " WHERE $where";
            }

            // Prepare the SQL query
            $stmt = self::$pdo->prepare($sql);
            
            // Execute the prepared statement with any bound parameters
            $stmt->execute();
            
            // Fetch the result set as an associative array
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $e) {
            return null;
        }
    }

    protected static function insertRecord(string $table, array $data)
    {
        // Use prepared statements to prevent SQL injection
        $columns = implode(', ', array_keys($data));

        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        try {
            $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";

            $stmt = self::$pdo->prepare($sql);


            // Bind parameters to the prepared statement by reference
            $i = 1;
            foreach ($data as $key => &$value) {
                $stmt->bindParam($i, $value);
                $i++;
            }
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    protected static function updateRecord($table, $data, $id)
    {
        // Use prepared statements to prevent SQL injection
        $args = array();

        foreach ($data as $key => $value) {
            $args[] = "$key = ?";
        }
        try {
            $sql = "UPDATE $table SET " . implode(',', $args) . " WHERE id = ?";

            $stmt = self::$pdo->prepare($sql);

            if (!$stmt) {
                die("Error in prepared statement: " . self::$pdo->errorInfo()[2]);
            }

            // Bind parameters to the prepared statement

            $i = 1;
            foreach ($data as $key => &$value) {
                $stmt->bindParam($i, $value);
                $i++;
            }
            $stmt->bindParam($i, $id);



            // Execute the prepared statement
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    protected static function deleteRecord(string $table, int $id)
    {
        try {
            // Use prepared statements to prevent SQL injection
            $sql = "DELETE FROM $table WHERE id = ?";
            $stmt = self::$pdo->prepare($sql);



            // Bind parameters to the prepared statement
            $stmt->bindParam(1, $id);

            // Execute the prepared statement
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    private function connect()
    {
        if (!self::$pdo) {
            $config = require("./core/database.php");
            self::$pdo = new \PDO(
                'mysql:host=' . $config['mysql']['host'] . ';dbname=' . $config['mysql']['dbname'],
                $config['mysql']['username'],
                $config['mysql']['password']
            );
        }
    }
}
