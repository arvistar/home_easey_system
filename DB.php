<?php

class DB
{
    public const HOST = "localhost";
    public const DBNAME = "services";
    public const USERNAME = "root";
    public const PASSWORD = "";
 
    protected static $_stmt = null;

    public static function getConnection()
    {
        try {
            $conn = new PDO("mysql:host=".self::HOST.";dbname=".self::DBNAME, self::USERNAME, self::PASSWORD, []);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $conn;
    }

    public static function query($sql, $params = array())
    {
        try {
            self::$_stmt = self::getConnection()->prepare($sql);
            
            if (strstr($sql, "SELECT") === false) {
                return self::$_stmt->execute($params);
            }

            if (empty($params)) {
                self::$_stmt->execute();
            } else {
                self::$_stmt->execute($params);
            }

            return self::$_stmt;
        }
         catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getStmt()
    {
        return self::$_stmt;
    }
}
