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

    /**
     * Obtenir tous les utilisateurs enregistrés
     */
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

    /**
     * Obtenir tous les utilisateurs recent
     */
    public function getRecent_users()
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'select * from users order by insert_date DESC limit 4';
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

    /**
     * Obtenir les utilisateurs par l'ID
     */
    public function getUserById($user_id)
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'select * from users where id = :id';
            $query = $connectDB->prepare($sql);
            $query->bindValue(':id', $user_id, PDO::PARAM_INT);
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

    /**
     * Obtenir les utilisateurs par le Pseudo
     */
    public function getUserByPseudo($pseudo)
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'select * from users where pseudo = :pseudo';
            $query = $connectDB->prepare($sql);
            $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
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

    /**
     * Obtenir l'admin par son pseudo
     */
    public function getAdminByPseudo($pseudo)
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'select * from admin where pseudo = :pseudo';
            $query = $connectDB->prepare($sql);
            $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
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

    /**
     * Vérifie que le Pseudo n'est pas déja dans la base de donnée
     */
    public function isPseudo($pseudo)
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'select * from users where pseudo = :pseudo';
            $query = $connectDB->prepare($sql);
            $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
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

    /**
     * Vérifie que l'Email n'est pas déja dans la base de donnée
     */
    public function isEmail($email)
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'select * from users where email = :email';
            $query = $connectDB->prepare($sql);
            $query->bindValue(':email', $email, PDO::PARAM_STR);
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

    /**
     * Connection de l'utilisateur
     */
    public function usersLogin($identifiant, $password)
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'select * from users where pseudo = :identifiant and password = :password';
            $query = $connectDB->prepare($sql);
            $query->bindValue(':identifiant', $identifiant, PDO::PARAM_STR);
            $query->bindValue(':password', $password, PDO::PARAM_STR);
            $query->execute();
            $datas = [];

            $rowCount = $query->rowCount();
            if ($rowCount === 0) {
                return false;
            }

            $datas = $query->fetch(PDO::FETCH_ASSOC);
            return $datas;
        } catch (PDOException $ex) {
            return $ex->getMessage() . $ex->getLine();
        }
    }

    /**
     * Connection de l'administrateur
     */
    public function adminLogin($identifiant, $password)
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'select * from admin where pseudo = :identifiant and password = :password';
            $query = $connectDB->prepare($sql);
            $query->bindValue(':identifiant', $identifiant, PDO::PARAM_STR);
            $query->bindValue(':password', $password, PDO::PARAM_STR);
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

    /**
     * Insertion de l'utilisateur
     */
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

    /**
     * Modification des informations de l'utilisateur
     */
    public function updateUsers($user_id, $fullname, $contact, $email, $pseudo)
    {
        try {
            $connectDB = self::connectDB();
            $sql = "update users set fullname = :fullname, contact = :contact, email = :email, pseudo = :pseudo where id = :id";
            $query = $connectDB->prepare($sql);
            $query->bindValue(':id', $user_id, PDO::PARAM_INT);
            $query->bindValue(':fullname', $fullname, PDO::PARAM_STR);
            $query->bindValue(':contact', $contact, PDO::PARAM_STR);
            $query->bindValue(':email', $email, PDO::PARAM_STR);
            $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
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

    /**
     * Modification du mot de passe de l'utilisateur
     */
    public function updateUsersPass($user_id, $password)
    {
        try {
            $connectDB = self::connectDB();
            $sql = "update users set password = :password where id = :id";
            $query = $connectDB->prepare($sql);
            $query->bindValue(':id', $user_id, PDO::PARAM_INT);
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

    /**
     * Suppression de l'utilisateur
     */
    public function deleteUser($user_id)
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'delete from users where id = :id';
            $query = $connectDB->prepare($sql);
            $query->bindValue(':id', $user_id, PDO::PARAM_INT);
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

    /**
     * Modification des informations de l'admin
     */
    public function updateAdmin($fullname, $pseudo)
    {
        try {
            $connectDB = self::connectDB();
            $sql = "update admin set fullname = :fullname, pseudo = :pseudo";
            $query = $connectDB->prepare($sql);
            $query->bindValue(':fullname', $fullname, PDO::PARAM_STR);
            $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
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

    /**
     * Modification du mot de passe de l'admin
     */
    public function updateAdminPass($password)
    {
        try {
            $connectDB = self::connectDB();
            $sql = "update admin set password = :password";
            $query = $connectDB->prepare($sql);
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

    /**
     * Insertion des messages
     */
    public function insertMessages($fullname, $contact, $email, $message)
    {
        try {
            $connectDB = self::connectDB();
            $sql = "insert into messages(fullname, contact, email, message) VALUES (:fullname, :contact, :email, :message)";
            $query = $connectDB->prepare($sql);
            $query->bindValue(':fullname', $fullname, PDO::PARAM_STR);
            $query->bindValue(':contact', $contact, PDO::PARAM_STR);
            $query->bindValue(':email', $email, PDO::PARAM_STR);
            $query->bindValue(':message', $message, PDO::PARAM_STR);
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

    /**
     * Obtenir tous les messages
     */
    public function getAll_messages()
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'select * from messages order by etat ASC';
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

    /**
     * Obtenir les messages par l'ID
     */
    public function getMessage($message_id)
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'select * from messages where id = :id';
            $query = $connectDB->prepare($sql);
            $query->bindValue(':id', $message_id, PDO::PARAM_INT);
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

    /**
     * Suppression des messages
     */
    public function deleteMessage($message_id)
    {
        try {
            $connectDB = self::connectDB();
            $sql = 'delete from messages where id = :id';
            $query = $connectDB->prepare($sql);
            $query->bindValue(':id', $message_id, PDO::PARAM_INT);
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

    /**
     * Modifier l'etat des messages
     */
    public function viewMessage($message_id)
    {
        try {
            $connectDB = self::connectDB();
            $sql = "update messages set etat = 1 where id = :id";
            $query = $connectDB->prepare($sql);
            $query->bindValue(':id', $message_id, PDO::PARAM_INT);
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
