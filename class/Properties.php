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

    public function getAll_properties($id = null)
    {
        try {
            $connectDB = self::connectDB();
            if (is_numeric($id) && $id > 0) {
                $sql = "select * from property where _userId = $id order by post_date DESC";
            } else {
                $sql = 'select * from property order by post_date DESC';
            }

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

    public function getPropertiesById($id)
    {
        try {
            $connectDB = self::connectDB();

            $sql = "select * from property where id = $id";


            $query = $connectDB->prepare($sql);
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

    public function getRecent_properties($id = null)
    {
        try {
            $connectDB = self::connectDB();
            if (is_numeric($id) && $id > 0) {
                $sql = "select * from property where _userId = $id order by post_date DESC limit 10";
            } else {
                $sql = "select * from property order by post_date DESC limit 10";
            }
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

    public function updateProperties($property_id, $title, $description, $type, $address, $area, $price, $shower, $bedroom, $picture)
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'update property set title = :title, description = :description, type = :type, address = :address, area = :area, price = :price, shower = :shower, bedroom = :bedroom, picture = :picture where id = :id';
            $query = $connectDB->prepare($sql);
            $query->bindValue(':id', $property_id, PDO::PARAM_INT);
            $query->bindValue(':title', $title, PDO::PARAM_STR);
            $query->bindValue(':description', $description, PDO::PARAM_STR);
            $query->bindValue(':type', $type, PDO::PARAM_STR);
            $query->bindValue(':address', $address, PDO::PARAM_STR);
            $query->bindValue(':area', $area, PDO::PARAM_INT);
            $query->bindValue(':price', $price, PDO::PARAM_INT);
            $query->bindValue(':shower', $shower, PDO::PARAM_INT);
            $query->bindValue(':bedroom', $bedroom, PDO::PARAM_INT);
            $query->bindValue(':picture', $picture, PDO::PARAM_STR);
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

    public function deleteProperties($property_id)
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'delete from property where id = :id';
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
}
