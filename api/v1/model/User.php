<?php


class UserException extends Exception
{
}

class User
{
    private $_id;


    public function __construct($id){
        $this->setId($id);
    }

    public function setID($id)
    {
        if (($id !== null) && (!is_numeric($id) || $id <= 0 || $id > 9223372036854775807 || $this->_id !== null)) {
            throw new UserException("User ID error");
        }
        $this->_id = $id;
    }

    public function getID()
    {
        return $this->_id;
    }

    public function returnUserAsArray(){
        $user = [];
        $user['id'] = $this->getID();

        return $user;
    }
}