<?php

namespace app\Models;

use database\Connection;

class Model
{
    private static $pdo = null;

    public static function query($q)
    {
        self::connect();
        try {
            // Prepare the SQL query
            $stmt = self::$pdo->prepare($q);

            // Execute the prepared statement with any bound parameters
            $stmt->execute();

            // Fetch the result set as an associative array
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            self::deconnect();
            if (count($result) === 1)
                return $result[0];
            return $result;
        } catch (\PDOException $e) {
            self::deconnect();
            return null;
        }
    }

    public static function selectRecords(string $table, string $columns = "*", string $where = null, $order_by = null)
    {
        self::connect();
        try {
            $sql = "SELECT $columns FROM $table";

            if ($where !== null) {
                $sql .= " WHERE $where";
            }

            if ($order_by !== null) {
                $sql .= " ORDER BY $order_by";
            }

            // Prepare the SQL query
            $stmt = self::$pdo->prepare($sql);

            // Execute the prepared statement with any bound parameters
            $stmt->execute();

            // Fetch the result set as an associative array
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            self::deconnect();
            if (count($result) === 1)
                return $result[0];
            return $result;
        } catch (\PDOException $e) {
            self::deconnect();
            return null;
        }
    }

    protected static function insertRecord(string $table, array $data)
    {
        self::connect();
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
            $lastInsertId = self::$pdo->lastInsertId();
            self::deconnect();
            return $lastInsertId;
        } catch (\PDOException $e) {
            self::deconnect();
            return false;
        }
    }

    protected static function updateRecord($table, $data, $id)
    {
        self::connect();
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
            self::deconnect();
            return true;
        } catch (\PDOException $e) {
            self::deconnect();
            return false;
        }
    }

    protected static function deleteRecord(string $table, string $where)
    {
        self::connect();
        try {
            // Use prepared statements to prevent SQL injection
            $sql = "DELETE FROM $table WHERE $where";
            $stmt = self::$pdo->prepare($sql);

            // Execute the prepared statement
            $stmt->execute();
            self::deconnect();
            return true;
        } catch (\PDOException $e) {
            self::deconnect();
            var_dump("error within deleting ! : " . $table);exit;
            return false;
        }
    }

    private static function connect()
    {
        if (!self::$pdo) {
            $config = require("./core/database.php");
            $mysql = $config['mysql'];
            $con = Connection::getInstance($mysql['dbname'], $mysql['host'], $mysql['username'], $mysql['password']);
            self::$pdo = $con->getPDO();
        }
    }

    private static function deconnect()
    {
        self::$pdo = null;
    }
}
