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
        try {
            $connectDB = self::connectDB();
            $sql = 'select * from users where id = :id';
            $query = $connectDB->prepare($sql);
            $query->bindValue(':id',$id,PDO::PARAM_INT);
            $query->execute();
            $datas = [];

            $rowCount = $query->rowCount();
            if ($rowCount === 0) {
                return false;
                exit();
            }

            $datas = $query->fetch(PDO::FETCH_ASSOC);
            return $datas;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }

    public function getUserByPseudo($pseudo)
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'select * from users where pseudo = :pseudo';
            $query = $connectDB->prepare($sql);
            $query->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
            $query->execute();
            $datas = [];

            $rowCount = $query->rowCount();
            if ($rowCount === 0) {
                return false;
                exit();
            }

            $datas = $query->fetch(PDO::FETCH_ASSOC);
            return $datas;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }

    public function isPseudo($pseudo)
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'select * from users where pseudo = :pseudo';
            $query = $connectDB->prepare($sql);
            $query->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
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

    public function isEmail($email)
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'select * from users where email = :email';
            $query = $connectDB->prepare($sql);
            $query->bindValue(':email',$email,PDO::PARAM_STR);
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

    public function usersLogin($identifiant, $password)
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'select * from users where pseudo = :identifiant and password = :password';
            $query = $connectDB->prepare($sql);
            $query->bindValue(':identifiant',$identifiant,PDO::PARAM_STR);
            $query->bindValue(':password',$password,PDO::PARAM_STR);
            $query->execute();
            $datas = [];

            $rowCount = $query->rowCount();
            if ($rowCount === 0) {
                return false;
            }

            $datas = $query->fetch(PDO::FETCH_ASSOC);
            return $datas;
        } catch (PDOException $ex) {
            return $ex->getMessage().$ex->getLine();
        }
    }

    public function adminLogin($identifiant, $password)
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'select * from admin where pseudo = :identifiant and password = :password';
            $query = $connectDB->prepare($sql);
            $query->bindValue(':identifiant',$identifiant,PDO::PARAM_STR);
            $query->bindValue(':password',$password,PDO::PARAM_STR);
            $query->execute();
            $datas = [];

            $rowCount = $query->rowCount();
            if ($rowCount === 0) {
                return false;
                exit();
            }

            $datas = $query->fetch(PDO::FETCH_ASSOC);
            return $datas;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }

    public function insertUsers($fullname, $gender, $birth, $description, $contact, $email, $pseudo, $password)
    {
        try {
            $connectDB = self::connectDB();
            $sql = "insert into users(fullname, gender, birth, description, contact, email, pseudo, password) VALUES (:fullname, :gender, :birth, :description, :contact, :email, :pseudo, :password)";
            $query = $connectDB->prepare($sql);
            $query->bindValue(':fullname', $fullname, PDO::PARAM_STR);
            $query->bindValue(':gender', $gender, PDO::PARAM_STR);
            $query->bindValue(':birth', $birth, PDO::PARAM_STR);
            $query->bindValue(':description', $description, PDO::PARAM_STR);
            $query->bindValue(':contact', $contact, PDO::PARAM_STR);
            $query->bindValue(':email', $email, PDO::PARAM_STR);
            $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
            $query->bindValue(':password', $password, PDO::PARAM_STR);
            $query->execute();

            $rowCount = $query->rowCount();
            if ($rowCount === 0) {
                return false;
                exit();
            }

            return true;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
        

    }

    public function updateUsers($fullname, $contact, $email, $pseudo, $password)
    {
    }

    public function deleteUsers($id)
    {
    }
}
