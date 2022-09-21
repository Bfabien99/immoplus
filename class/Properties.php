<?php

class Properties
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

    public function getAll_properties()
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'select * from property order by post_date DESC';
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

    public function getRecent_properties()
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'select * from property order by post_date DESC limit 10';
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

    public function getRecent_properties_home()
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'select * from property where etat = 1 order by post_date DESC limit 6';
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

    public function getMostView_properties()
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'select * from property where etat = 1 order by view DESC limit 6';
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

    public function incrementView($property_id)
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'update property set view = view + 1 where id = :id AND etat = 1';
            $query = $connectDB->prepare($sql);
            $query->bindValue(':id', $property_id, PDO::PARAM_INT);
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

    public function publishProperties($property_id)
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'update property set etat = 1 where id = :id';
            $query = $connectDB->prepare($sql);
            $query->bindValue(':id', $property_id, PDO::PARAM_INT);
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


    public function getSearched_properties($sql)
    {
        try {
            $connectDB = self::connectDB();
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
}
