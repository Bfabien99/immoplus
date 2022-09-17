<?php

class Users
{

    private static $DBConnection;

    public static function connectDB()
    {
        if (self::$DBConnection === null) {
            self::$DBConnection = new PDO('mysql:host=localhost;dbname=immoplus;charset=utf8', 'root', '');
            self::$DBConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$DBConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        return self::$DBConnection;
    }

    public function getAll_users()
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'select * from users order by insert_date DESC';
            $query = $connectDB->prepare($sql);
            $query->execute();
            $datas = [];

            $rowCount = $query->rowCount();
            if ($rowCount === 0) {
                return false;
                exit();
            }

            $datas = $query->fetchAll(PDO::FETCH_ASSOC);
            return $datas;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }

    public function getRecent_users()
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'select * from users order by insert_date DESC limit 10';
            $query = $connectDB->prepare($sql);
            $query->execute();
            $datas = [];

            $rowCount = $query->rowCount();
            if ($rowCount === 0) {
                return false;
                exit();
            }

            $datas = $query->fetchAll(PDO::FETCH_ASSOC);
            return $datas;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }

    public function getUserById($id)
    {
    }

    public function isUser($email, $pseudo)
    {
    }

    public function usersLogin($identifiant, $password)
    {
    }

    public function insertUsers($fullname, $contact, $email, $pseudo, $password)
    {
    }

    public function updateUsers($fullname, $contact, $email, $pseudo, $password)
    {
    }

    public function deleteUsers($id)
    {
    }
}
